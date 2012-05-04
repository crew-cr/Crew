<?php
 
class commentLineComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    // create CommentLineForm
    $this->form = new CommentLineForm(null, array(
      'commit'   => $this->commit,
      'file_id'  => $this->file_id,
      'user_id'  => $this->user_id,
      'position' => $this->position,
      'line'     => $this->line,
      'type'     => CommentPeer::TYPE_LINE
    ));

    // retrieves all line comments of this file $fileId
    $this->comments = CommentQuery::create()
      ->filterByCommit($this->commit)
      ->filterByFileId($this->file_id)
      ->filterByPosition($this->position)
      ->filterByLine($this->line)
      ->leftJoin('sfGuardUserRelatedByUserId')
      ->find()
    ;

    $this->userId = $this->getUser()->getId();

    $this->formVisible = isset($this->form_visible) ? $this->form_visible : true;
  }
}
