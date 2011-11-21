  public function executeMoveUp(sfWebRequest $request)
  {
    $<?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
    $moved = $<?php echo $this->getSingularName() ?>->moveUp();
    if (false !== $moved)
    {
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $<?php echo $this->getSingularName() ?>)));
      $this->getUser()->setFlash('notice', 'Item moved up.');
    }
    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }
