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
      'commit_reference' => $this->commit_reference,
      'file_id' => $this->file_id,
      'position' => $this->position,
      'line' => $this->line
    ));

    // retrieves all line comments of this file $fileId
    $this->comments = LineCommentQuery::create()
      ->filterByCommitReference($this->commit_reference)
      ->filterByFileId($this->file_id)
      ->filterByPosition($this->position)
      ->filterByLine($this->line)
      ->leftJoin('sfGuardUser')
      ->find()
    ;

    $this->formVisible = isset($this->form_visible) ? $this->form_visible : true;
  }
}
