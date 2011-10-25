<?php

class userboxComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->user = $this->getUser();
  }
}
