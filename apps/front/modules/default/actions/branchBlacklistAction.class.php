<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class branchBlacklistAction extends sfAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $branch = BranchPeer::retrieveByPK($request->getParameter('branch'));
    $this->forward404Unless($branch, 'Branch Not Found');

    $oldtStatus = $branch->getStatus();

    $branch
      ->setIsBlacklisted(true)
      ->setReviewRequest(false)
      ->save()
    ;

    Branch::saveAction(
      $this->getUser()->getId(),
      $branch->getRepositoryId(),
      $branch->getId(),
      $oldtStatus,
      $branch->getStatus()
    );
    
    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode(array('status' => 'blacklisted')));
  }
}
