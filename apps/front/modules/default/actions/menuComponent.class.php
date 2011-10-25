<?php

class menuComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->typeContext         = null;
    $this->widgetDefault       = null;
    $this->form                = new sfForm();
    $this->userIsAuthenticated = $this->user = $this->getUser()->isAuthenticated();

    if ($widgetDefault = $request->getParameter('repository'))
    {
      $this->typeContext = 'Repository';
    }

    else if ($widgetDefault = $request->getParameter('branch'))
    {
      $this->typeContext = 'Branch';
    }

    else if ($widgetDefault = $request->getParameter('file'))
    {
      $this->typeContext = 'File';
    }

    if ($this->typeContext !== null)
    {
      $this->form->setWidget($this->typeContext, new sfWidgetFormPropelChoice(array('model' => $this->typeContext, 'add_empty' => true, 'default' => $widgetDefault), array('name' => strtolower($this->typeContext))));
    }
  }
}
