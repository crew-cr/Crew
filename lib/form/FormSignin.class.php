<?php

class FormSignin extends BasesfGuardFormSignin
{
  public function configure()
  {
    parent::configure();
    
    $this->validatorSchema->setPostValidator(new ValidatorUser());
  }
}
