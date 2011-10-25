<?php
 
class reviewRequestAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId = $request->getParameter('project');
    $branchName = 'origin/'.$request->getParameter('branch');
    $commit = (string)$request->getParameter('commit'); //Dernier commit

    $repository = RepositoryQuery::create()
      ->filterById($projectId)
      ->findOne()
    ;

    $result = array();
    if($repository)
    {
      BranchPeer::synchronize($repository);

      $branch = BranchQuery::create()
        ->filterByName($branchName)
        ->filterByRepositoryId($repository->getId())
        ->findOne()
      ;

      if($branch)
      {
        if(!$branch->getReviewRequest())
        {
          if(strlen($commit) === 40)
          {
            $cmd = sprintf('git --git-dir="%s/.git" log %s | grep %s', $repository->getValue(), $branch->getCommitStatusChanged(), $commit);
            exec($cmd, $cmdReturn);
            if(count($cmdReturn) == 0)
            {
              $branch->setStatusId(1);
              $branch->setReviewRequest(1);
              $branch->save();
              $result['result'] = true;
              $result['message'] = "Review engagee";
            }
            else
            {
              $result['result'] = true;
              $result['message'] = "Commit deja pris en compte";
            }
          }
          else
          {
            $result['result'] = false;
            $result['message'] = "Commit non valide";
          }
        }
        else
        {
          $result['result'] = false;
          $result['message'] = "Review en cours";
        }
      }
      else
      {
        $result['result'] = false;
        $result['message'] = "Branche invalide";
      }
    }
    else
    {
      $result['result'] = false;
      $result['message'] = "Projet invalide";
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
