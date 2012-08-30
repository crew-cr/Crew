<?php

class validateSelectorDiffRangeAction extends crewAction
{

  /**
   * Execute any application/business logic for this component.
   *
   * In a typical database-driven application, execute() handles application
   * logic itself and then proceeds to create a model instance. Once the model
   * instance is initialized it handles all business logic for the action.
   *
   * A model should represent an entity in your application. This could be a
   * user account, a shopping cart, or even a something as simple as a
   * single product.
   *
   * @param sfRequest $request The current sfRequest object
   *
   * @return mixed     A string containing the view name associated with this action
   */
  function execute($request)
  {
    $redirectParameters = $request->getParameter('selector_diff');
    $type = $redirectParameters['type'];
    $id = $redirectParameters['id'];
    $options = array(
      'git_command' => $this->gitCommand,
      'type'        => $type,
      'id'          => $id,
    );
    

    $form = new selectorDiffRangeForm(array(), $options);
    $form->bind($redirectParameters);
    $redirectParameters = array(
      'branch' => 9
    );
    if ($form->isValid()) 
    {
      $redirectParameters['from'] = $form->getValue('from');
      $redirectParameters['to'] = $form->getValue('to');
      $type = $form->getValue('type');
      $id = $form->getValue('id');
   
    } 

    switch ($type)
    {
      case 'branch':
        $url = 'default/fileList';
        $parameterName = 'branch';
        break;
      case 'file':
        $url = 'default/file';
        $parameterName = 'file';
        break;
      default:
        throw new InvalidArgumentException("Invalid type " . $form->getValue('type'));
    }
    $redirectParameters[$parameterName] = $id;

    $this->redirect($url . '?'.http_build_query($redirectParameters));
  }

}
