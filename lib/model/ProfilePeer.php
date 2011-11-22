<?php



/**
 * Skeleton subclass for performing query and update operations on the 'profile' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lib.model
 */
class ProfilePeer extends BaseProfilePeer {

  /**
   * @static
   * @param string $email
   * @return Profile
   */
  public static function getProfileByEmail($email)
  {
    return ProfileQuery::create()
      ->filterByEmail($email)
      ->findOne();
    ;
  }
} // ProfilePeer
