<?php

class commentGlobalComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    if (null === $this->type)
    {
      throw new Exception('Type has not been awarded to the component.');
    }

    if (null === $this->id)
    {
      throw new Exception('ID has not been awarded to the component.');
    }

    switch ($this->type)
    {
      case CommentPeer::TYPE_BRANCH:

        // data to be transmitted to the form
        $dataForm = array(
          'type' => $this->type,
          'id' => $this->id
        );

        // data to be transmitted to the view
        $this->commentGlobals = CommentQuery::create()
          ->filterByType($this->type)
          ->filterByBranchId($this->id)
          ->leftJoin('sfGuardUserRelatedByUserId')
          ->find()
        ;
        break;

      case CommentPeer::TYPE_FILE:

        // data to be transmitted to the form
        $dataForm = array(
          'type' => $this->type,
          'id' => $this->id
        );

        // data to be transmitted to the view
        $this->commentGlobals = CommentQuery::create()
          ->filterByType($this->type)
          ->filterByFileId($this->id)
          ->leftJoin('sfGuardUserRelatedByUserId')
          ->find()
        ;
        break;
    }

    $this->userId = $this->getUser()->getId();
    
    $this->form = new CommentGlobalForm(null, $dataForm);
  }
}
