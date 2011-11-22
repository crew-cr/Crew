<?php



/**
 * Skeleton subclass for representing a row from the 'profile' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class Profile extends BaseProfile {

  const DEFAULT_AVATAR_URL = "https://a248.e.akamai.net/assets.github.com/images/gravatars/gravatar-140.png";

  public function __toString()
  {
    return ($this->getNickname() != '') ? $this->getNickname() : $this->getsfGuardUser()->getUsername();
  }

  public function getAvatarUrl($size = 24)
  {
    return sprintf("http://www.gravatar.com/avatar/%s?d=%s&s=%s", md5(strtolower(trim($this->getEmail()))), urlencode(self::DEFAULT_AVATAR_URL), $size);
  }

  /**
   * @static
   * @param string $email
   * @param int $size
   * @return string
   */
  public static function getAvatarUrlFromEmail($email, $size = 24)
  {
    if (null === $email)
    {
      $email = 0;
    }

    return sprintf("http://www.gravatar.com/avatar/%s?d=%s&s=%s", md5(strtolower(trim($email))), urlencode(self::DEFAULT_AVATAR_URL), $size);
  }
} // Profile
