<?php
 
class branchesAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectId = $request->getParameter('project');

    $branches = BranchQuery::create()
      ->filterByRepositoryId($projectId)
      ->find()
    ;
    $result = array();
    
    if(count($branches) > 0)
    {
      $result = array();
      foreach($branches as $branch)
      {
        $result[] = array(
          'id' => $branch->getId(),
          'name' => $branch->getName(),
          'status' => $branch->getStatus(),
          'projectId' => $branch->getRepositoryId(),
          'commitReference' => $branch->getCommitReference(),
          'commitStatusChanged' => $branch->getCommitStatusChanged(),
          'dateStatusChanged' => $branch->getDateStatusChanged,
          'isBlacklisted' => $branch->getIsBlacklisted(),
          'reviewRequest' => $branch->getReviewRequest()
        );
      }
    }
    else
    {
      $result['result'] = false;
      $result['message'] = "No branches";
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
