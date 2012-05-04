<?php

/**
 * repository actions.
 *
 * @package    crew
 * @subpackage repository
 * @author     Your name here
 */
class commentToggleAction extends crewAction
{
  /**
   * @param sfWebRequest $request
   * @return void
   */
  public function execute($request)
  {
    $id = $request->getParameter('comment_id');
    $status = ($request->getParameter('status')) ? true : false;

    $this->forward404Unless($id || $status, 'Bad parameters');

    $comment = CommentQuery::create()
      ->filterById($id)
      ->findOne()
    ;
    
    $this->forward404Unless($comment, sprintf('Comment (%s) not found', $id));
    
    if($status)
    {
      $comment
        ->setCheckUserId($this->getUser()->getId())
        ->setCheckedAt('now')
        ->save()
      ;
    }
    else
    {
      $comment
        ->setCheckUserId(null)
        ->setCheckedAt(null)
        ->save()
      ;
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode(array('id' => $id, 'status' => $status, 'message' => $comment->getCheckMessage())));
  }
}
