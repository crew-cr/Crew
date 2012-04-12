<?php

class projectAddAction extends sfAction
{
  /**
   * @throws Exception
   * @param $request
   * @return void
   */
  public function execute($request)
  {
    $this->form = new RepositoryForm();

    $name = $request->getParameter('name');
    $remote = $request->getParameter('remote');

    // get the propel connection
    $con = Propel::getConnection();
    $con->beginTransaction();

    $message = '';
    try
    {
      if($name && $remote)
      {
        $repositoryPath = Configuration::get('repositories_path');
        $repositoryName = $name;
        $repository     = sprintf('%s/%s', $repositoryPath, $repositoryName);

        if(!$this->checkLocalRepository($repository, $remote))
        {
          throw new Exception(sprintf("Existing remote is different from remote you want '%s'", $remote));
        }
        else
        {
          $projectStatus = $this->getProjectStatus($name, $remote);
          switch($projectStatus)
          {
            case -1:
              $newProject = new Repository();
              $newProject
                ->setName($name)
                ->setRemote($remote)
                ->setValue($repositoryName)
                ->save()
              ;

              $message = sprintf("The project has been added successfully");
              break;
            case 0:
              throw new Exception(sprintf("A project already exists and conflicts with project you want to add (name: %s, remote: %s)", $name, $remote));
              break;

            default:
              throw new Exception(sprintf("Project '%s' (remote: %s) already exists", $name, $remote));
              break;
          }

          if(!is_dir($repository))
          {
            $cloneStatus = GitCommand::cloneRepository($remote, $repository);
            if($cloneStatus === 0)
            {
              $message .= sprintf(" and remote '%s' is correctly cloned in '%s'", $remote, $repository);
              $this->getUser()->setFlash('notice', $message);
            }
            else
            {
              $message .= sprintf(" but remote '%s' is not cloned in '%s' [status : %s]", $remote, $repository, ($cloneStatus === null ? 'NULL' : $cloneStatus));
              throw new Exception($message);
            }
          }
        }
      }
      else
      {
        throw new Exception(sprintf("Parameter name ('%s') or remote ('%s') not found", $name, $remote));
      }
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      $this->getUser()->setFlash('error', $e->getMessage());
    }

    $this->redirect("default/repositoryList");
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
