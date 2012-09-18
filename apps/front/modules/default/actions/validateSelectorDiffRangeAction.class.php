<?php

class validateSelectorDiffRangeAction extends crewAction
{

  /**
   *
   * @param sfRequest $request The current sfRequest object
   *
   * @throws InvalidArgumentException
   * @return mixed     A string containing the view name associated with this action
   */
  function execute($request)
  {
    $redirectParameters = $request->getParameter('selector_diff');
    $type               = $redirectParameters['type'];
    $id                 = $redirectParameters['id'];
    $options            = array(
      'git_command' => $this->gitCommand,
      'type'        => $type,
      'id'          => $id,
    );


    $form = new selectorDiffRangeForm(array(), $options);
    $form->bind($redirectParameters);

    $redirectParameters = array();
    if ($form->isValid())
    {
      $redirectParameters['from'] = $form->getValue('from');
      $redirectParameters['to']   = $form->getValue('to');
      $type                       = $form->getValue('type');
      $id                         = $form->getValue('id');
    }

    switch ($type)
    {
      case 'branch':
        $url           = 'default/fileList';
        $parameterName = 'branch';
        break;
      case 'file':
        $url           = 'default/file';
        $parameterName = 'file';
        break;
      default:
        throw new InvalidArgumentException("Invalid type " . $type);
    }
  
    $redirectParameters[$parameterName] = $id;

    $this->redirect($url . '?' . http_build_query($redirectParameters));
  }

}
