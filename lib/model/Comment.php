<?php



/**
 * Skeleton subclass for representing a row from the 'comment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class Comment extends BaseComment
{
  /**
   * @return string
   */
  public function getAuthorName()
  {
    return $this->getsfGuardUserRelatedByUserId()->getProfile()->__toString();
  }

  /**
   * @return string
   */
  public function getAuthorAvatar()
  {
    return $this->getsfGuardUserRelatedByUserId()->getProfile()->getAvatarUrl();
  }

  /**
   * @return string
   */
  public function getCheckMessage()
  {
    if($this->getCheckedAt())
    {
      return sprintf('Done by %s %s', $this->getsfGuardUserRelatedByCheckUserId()->getProfile()->__toString(), $this->getCheckedAt('d/m/Y H:i'));
    }
    else
    {
      return 'Done';
    }
  }

} // Comment
