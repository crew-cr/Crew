<?php
 
class stringUtils {
  /**
   * @static
   * @param string $string
   * @param int $length
   * @param string $etc
   * @return mixed|string
   */
  public static function shorten($string, $length = 75, $etc = '...')
  {
    if($length == 0)
    {
      return '';
    }

    if(strlen($string) > $length)
    {

      $length -= min($length, strlen($etc));
      $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
      return substr($string, 0, $length). $etc;
    }
    else
    {
      return $string;
    }
  }

  /**
   * @static
   * @param string $string
   * @param int $length
   * @param string $etc
   * @return mixed|string
   */
  public static function lshorten($string, $length = 75, $etc = '...')
  {
    if($length == 0)
    {
      return '';
    }

    if(strlen($string) > $length)
    {
      $length -= min($length, strlen($etc));
      $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, -($length+1)));
      return $etc . substr($string, -$length);
    }
    else
    {
      return $string;
    }
  }

  public static function displayBranchName($branch)
  {
    return (strpos($branch, 'origin/') === 0) ? substr($branch, 7) : $branch;
  }

  public static function trimTicketInfos($str)
  {
    return preg_replace('/^refs #(\d)+ (:[ ]*)?/i', '', $str);
  }
}
