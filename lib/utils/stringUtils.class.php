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

  public static function trimTicketInfos($str)
  {
    return preg_replace('/^refs #(\d)+ (:[ ]*)?/i', '', $str);
  }

  /***
   * Shorten file path if too long
   *
   * if filename (excluding directories) is too long, this will return file[...]name.php
   * if path directory is too long this will return foo/ba[...]az/filename.php
   *
   * @static
   *
   * @param string $path   file path to shorten
   * @param int    $length file path max length
   * @param string $with
   * @param int    $at     number of character before splitting with $with
   *
   * @return string
   */
  public static function shortenFilePath($path, $length = 100, $with = '[...]', $at = 20)
  {
    if (strlen($path) < $length)
    {
      return $path;
    }

    $fileName       = basename($path);
    $fileNameLength = strlen($fileName);
    if ($fileNameLength > $length)
    {
      return sprintf('%s%s%s', substr($fileName, 0, $at), $with, substr($fileName, -($length - strlen($with) - $at)));
    }

    $dirName = dirname($path);

    return sprintf('%s%s%s%s', substr($dirName, 0, $at), $with, substr($dirName, -($length - $fileNameLength - strlen($with) - $at)), $fileName);
  }
}
