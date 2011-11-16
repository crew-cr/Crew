<?php
 
class lineCommentComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    // create lineCommentForm
    $this->form = new LineCommentForm(null, array(
      'commit' => $this->commit,
      'file_id' => $this->file_id,
      'position' => $this->position,
      'line' => $this->line
    ));

    // retrieves all line comments of this file $fileId
    $this->comments = LineCommentQuery::create()
      ->filterByCommit($this->commit)
      ->filterByFileId($this->file_id)
      ->filterByPosition($this->position)
      ->filterByLine($this->line)
      ->leftJoin('sfGuardUser')
      ->find()
    ;

    $this->userId = $this->getUser()->getId();

    $this->formVisible = isset($this->form_visible) ? $this->form_visible : true;
  }
}
