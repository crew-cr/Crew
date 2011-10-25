<?php

class myUser extends sfGuardSecurityUser
{
  public function __toString()
  {
    return $this->getUsername();
  }
}
