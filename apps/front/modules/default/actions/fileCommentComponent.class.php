<?php

class fileCommentComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->globalComments = FileCommentQuery::create()
      ->filterByFileId($this->file->getId())
      ->find()
    ;

    $this->userId = $this->getUser()->getGuardUser()->getId();

    $this->form = new FileCommentForm(null, array('file' => $this->file->getId()));
  }
}
