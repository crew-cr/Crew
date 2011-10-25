  public function executeUpdate(sfWebRequest $request)
  {
<?php if (isset($this->params['with_propel_route']) && $this->params['with_propel_route']): ?>
    $this->form = new <?php echo $this->getModelClass().'Form' ?>($this->getRoute()->getObject());
<?php else: ?>
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $<?php echo $this->getSingularName() ?> = <?php echo $this->getModelClass() ?>Query::create()->findPk(<?php echo $this->getRetrieveByPkParamsForAction(43) ?>);
    $this->forward404Unless($<?php echo $this->getSingularName() ?>, sprintf('Object <?php echo $this->getSingularName() ?> does not exist (%s).', <?php echo $this->getRetrieveByPkParamsForAction(43) ?>));
    $this->form = new <?php echo $this->getModelClass().'Form' ?>($<?php echo $this->getSingularName() ?>);
<?php endif; ?>

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
