  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
<?php echo $this->getFormCustomization('new') ?>
    $this-><?php echo $this->getSingularName() ?> = $this->form->getObject();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }
