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

    $this->form = new FileCommentForm(null, array('file' => $this->file->getId()));
  }
}
