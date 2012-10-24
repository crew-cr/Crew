<?php

class selectorDiffRangeComponent extends sfComponent
{

  /**
   * @param sfRequest $request The current sfRequest object
   *
   * @throws Exception
   * @return mixed     A string containing the view name associated with this action
   */
  public function execute($request)
  {
    $options = array(
      'git_command' => $this->getContext()->getGitCommand(),
      'type'        => $this->type,
      'id'          => $this->id,
    );
    
    $default = array(
      'type'        => $this->type,
      'id'          => $this->id,
    );
    foreach (array('from', 'to') as $from)
    {
      if ($request->hasParameter($from))
      {
        $default[$from] = $request->getParameter($from);
      }
    }
  
    $this->setVar('form', new selectorDiffRangeForm($default, $options));
  }

}
