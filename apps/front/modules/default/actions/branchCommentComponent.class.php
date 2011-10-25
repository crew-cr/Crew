<?php

class branchCommentComponent extends sfComponent
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $this->globalComments = BranchCommentQuery::create()
      ->filterByBranchId($this->branch->getId())
      ->find()
    ;

    $this->form = new BranchCommentForm(null, array('branch' => $this->branch->getId()));
  }
}
