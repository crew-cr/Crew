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
        $result['message'] = sprintf("Le projet %s (remote : %s) existait deja", $projectName, $remote);
      }
      elseif($project1 || $project2)
      {
        $result['result'] = false;
        $result['message'] = sprintf("Un projet (name : %s, remote : %s) existe deja et rentre en conflit avec le projet que vous voulez ajouter", $projectName, $remote);
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
            $result['message'] = "Ajout nouveau projet OK";
          }
          else
          {
            $result['result'] = false;
            $result['message'] = sprintf("Le remote existant %s est différent de celui demandé %s", $currentRemote, $remote);
          }
        }
        else
        {
          $result['result'] = false;
          $result['message'] = sprintf("Repository % inexistant. Veuillez le creer !", $repository);
        }
      }
    }
    else
    {
      $result['result'] = false;
      $result['message'] = sprintf("Parametre name (%s) ou remote (%s) inexistant", $projectName, $remote);
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($result));
  }
}
