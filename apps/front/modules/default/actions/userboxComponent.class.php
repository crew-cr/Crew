<?php

class userboxComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->isAuthenticated = $this->getUser()->isAuthenticated();
    $this->user = $this->getUser();
  }
}
