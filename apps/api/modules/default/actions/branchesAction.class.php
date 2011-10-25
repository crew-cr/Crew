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
          'id' => $branch->id,
          'name' => $branch->name,
          'status' => $branch->status_id,
          'projectId' => $branch->project_id,
          'commitReference' => $branch->commit_reference,
          'commitStatusChanged' => $branch->commit_status_changed,
          'dateStatusChanged' => $branch->date_status_changed,
          'isBlacklisted' => $branch->is_blacklisted,
          'reviewRequest' => $branch->review_request
        );
      }
    }
    else
    {
      $result['result'] = false;
      $result['message'] = "Pas de branches";
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
