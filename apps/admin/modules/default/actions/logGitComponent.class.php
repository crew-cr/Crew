<?php

class logGitComponent extends sfComponent
{
  const DISPLAY_COUNT = 15;

  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $nbLog = $request->getParameter('gitlog', self::DISPLAY_COUNT);

    $this->logs = LogGitQuery::create()
      ->orderById(Criteria::DESC)
      ->limit($nbLog)
      ->find()
    ;

    $total = LogGitQuery::create()
      ->count()
    ;

    if (count($this->logs) < self::DISPLAY_COUNT || $nbLog > $total)
    {
      $this->moreLogs = 0;
    }
    else
    {
      $this->moreLogs = $nbLog + self::DISPLAY_COUNT;
    }
  }
}
