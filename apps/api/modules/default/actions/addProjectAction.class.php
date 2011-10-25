<?php
 
class addProjectAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $projectName = $request->getParameter('name');
    $remote = $request->getParameter('remote');
    
    $result = array();
    if($projectName && $remote)
    {
      $repository = sfConfig::get('app_projects_repository') . $projectName;

      $projectExiste = RepositoryQuery::create()
        ->filterByName($projectName)
        ->filterByRemote($remote)
        ->findOne()
      ;
      $project1 = RepositoryQuery::create()
        ->filterByName($projectName)
        ->count()
      ;
      $project2 = RepositoryQuery::create()
        ->filterByRemote($remote)
        ->count()
      ;
      if($projectExiste)
      {
        $result['result'] = $projectExiste->getId();
        $result['message'] = sprintf("Project '%s' (remote: %s) already exists", $projectName, $remote);
      }
      elseif($project1 || $project2)
      {
        $result['result'] = false;
        $result['message'] = sprintf("A project (name: %s, remote: %s) already exists and conflicts with project you want to add", $projectName, $remote);
      }
      else
      {
        if(is_dir($repository))
        {
          $currentRemote = GitCommand::getRemote($repository);
          if($currentRemote === $remote)
          {
            $newProject = new Repository();
            $newProject
              ->setName($projectName)
              ->setRemote($remote)
              ->setValue($repository)
              ->save()
            ;
            $result['result'] = $newProject->getId();
            $result['message'] = "Adding project OK";
          }
          else
          {
            $result['result'] = false;
            $result['message'] = sprintf("Existing remote '%s' is different from remote '%s' you want", $currentRemote, $remote);
          }
        }
        else
        {
          $result['result'] = false;
          $result['message'] = sprintf("Repository '%s' not found. Create it !", $repository);
        }
      }
    }
    else
    {
      $result['result'] = false;
      $result['message'] = sprintf("Parameter name (%s) or remote (%s) not found", $projectName, $remote);
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
