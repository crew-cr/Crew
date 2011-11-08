<?php
 
class addProjectAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $result      = array();
    $projectName = $request->getParameter('name');
    $remote      = $request->getParameter('remote');
    
    if($projectName && $remote)
    {
      $repository = sfConfig::get('app_projects_repository') . $projectName;

      if(!$this->checkLocalRepository($repository, $remote))
      {
        $result['result'] = false;
        $result['message'] = sprintf("Existing remote is different from remote you want '%s'", $remote);
      }
      else
      {
        $projectStatus = $this->getProjectStatus($projectName, $remote);
        switch($projectStatus)
        {
          case -1:
            $newProject = new Repository();
            $newProject
              ->setName($projectName)
              ->setRemote($remote)
              ->setValue($repository)
              ->save()
            ;
            $result['result'] = $newProject->getId();
            $result['message'] = sprintf("Adding project OK");
            break;
          
          case 0:
            $result['result'] = false;
            $result['message'] = sprintf("A project already exists and conflicts with project you want to add (name: %s, remote: %s)", $projectName, $remote);
            break;
          
          default:
            $result['result'] = $projectStatus;
            $result['message'] = sprintf("Project '%s' (remote: %s) already exists", $projectName, $remote);
            break;
        }

        if(!is_dir($repository))
        {
          $cloneStatus = GitCommand::cloneRepository($remote, $repository);
          if($cloneStatus == 0)
          {
            $result['message'] .= sprintf(" and remote '%s' is correctly cloned in '%s'", $remote, $repository );
          }
          else
          {
            $result['message'] .= sprintf(" but remote '%s' is not cloned in '%s' [status : %s]", $remote, $repository, $cloneStatus);
          }
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
  
  /**
   * @param $repository
   * @param $remote
   * @return bool
   */
  public function checkLocalRepository($repository, $remote)
  {
    return (!is_dir($repository) || GitCommand::getRemote($repository) === $remote);
  }
  
  /**
   * @param $projectName
   * @param $remote
   * @return int
   */
  public function getProjectStatus($projectName, $remote)
  {
    $project1 = RepositoryQuery::create()
      ->filterByName($projectName)
      ->findOne()
    ;
    $project2 = RepositoryQuery::create()
      ->filterByRemote($remote)
      ->findOne()
    ;
    
    if($project1 === null && $project2 === null)
    {
      return -1;
    }
    else if($project1 !== $project2)
    {
      return 0;
    }
    else
    {
      return $project1->getId();
    }
  }
}
