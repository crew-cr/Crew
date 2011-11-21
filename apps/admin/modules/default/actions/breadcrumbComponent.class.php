<?php

class breadcrumbComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->links               = array();
    $this->typeContext         = null;
    $this->widgetDefault       = null;
    $this->form                = null;
    $this->userIsAuthenticated = $this->getUser()->isAuthenticated();

    $criteria = null;

    if ($widgetDefault = $request->getParameter('repository'))
    {
      $this->typeContext = 'Repository';
    }
    else if($widgetDefault = $request->getParameter('branch'))
    {
      $this->typeContext = 'Branch';

      $branch = BranchPeer::retrieveByPK($request->getParameter('branch'));
      if($branch === null)
      {
        throw new \Exception('Branch not found');
      }

      $repository = RepositoryPeer::retrieveByPK($branch->getRepositoryId());
      if($repository === null)
      {
        throw new \Exception('Repository not found');
      }

      $this->links = array(
        array(
          'label' => $repository->getname(),
          'url' => 'default/branchList?repository=' . $repository->getId(),
          'class' => 'repository'
        )
      );

      $criteria = BranchQuery::create()
        ->filterByRepositoryId($repository->getId())
        ->filterByIsBlacklisted(0)
      ;
    }
    else if($widgetDefault = $request->getParameter('file'))
    {
      $this->typeContext = 'File';

      $file = FilePeer::retrieveByPK($request->getParameter('file'));
      if($file === null)
      {
        throw new \Exception('File not found');
      }

      $branch = BranchPeer::retrieveByPK($file->getBranchId());
      if($branch === null)
      {
        throw new \Exception('Branch not found');
      }

      $repository = RepositoryPeer::retrieveByPK($branch->getRepositoryId());
      if($repository === null)
      {
        throw new \Exception('Repository not found');
      }

      $this->links = array(
        array(
          'label' => $repository->__toString(),
          'url' => 'default/branchList?repository=' . $repository->getId(),
          'class' => 'repository'
        ),
        array(
          'label' => $branch->__toString(),
          'url' => 'default/fileList?branch=' . $branch->getId(),
          'class' => 'branch'
        ),
      );

      $criteria = FileQuery::create()
        ->filterByBranchId($branch->getId())
      ;
    }

    if ($this->typeContext !== null)
    {
      $this->form = new sfForm();
      $this->form->setWidget($this->typeContext, new sfWidgetFormPropelChoice(array('model' => $this->typeContext, 'criteria' => $criteria, 'add_empty' => false, 'default' => $widgetDefault), array('name' => strtolower($this->typeContext))));
    }
  }
}
