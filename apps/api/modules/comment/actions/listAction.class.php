<?php
 
class listAction extends crewAction
{
  /**
* @param sfWebRequest $request
* @return string
*/
  public function execute($request)
  {
    
    $branchName = $request->getParameter('branch');
    
    $result = array();

    file_put_contents(
      sprintf("%s/api.log", sfConfig::get('sf_log_dir')), 
      sprintf("%s [%s] list comments = reviewId : %s\n", 
        date('d/m/Y H:i:s'), 
        $_SERVER['REMOTE_ADDR'], 
        $branchName), 
      FILE_APPEND
    );


    $branch = BranchQuery::create()
      ->filterByName($branchName)
      ->findOne()
    ;

    if($branch)
    {
      $comments = $branch->getComments();
      if($comments)
      {
        $result = $comments->toArray();
      }
      
      $this->getResponse()->setStatusCode('200');
    }
    else
    {
      $result['message'] = sprintf("No valid branch '%s'", $branchName);
      $this->getResponse()->setStatusCode('400');
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}

