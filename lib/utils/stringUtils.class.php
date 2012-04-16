<?php
 
class stringUtils {
  /**
   * @static
   * @param string $string
   * @param int $length
   * @param string $etc
   * @param bool $removeLineBreaks
   * @return mixed|string
   */
  public static function shorten($string, $length = 75, $etc = '...', $removeLineBreaks = false)
  {
    if($length == 0)
    {
      $shortenedString = '';
    }
    elseif(strlen($string) > $length)
    {
      $length -= min($length, strlen($etc));
      $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
      $shortenedString = substr($string, 0, $length). $etc;
    }
    else
    {
      $shortenedString = $string;
    }

    return ($removeLineBreaks) ? preg_replace("/(\r\n|\n|\r)/", " ", $shortenedString) : $shortenedString;
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
  public static function shortenFilePath($path, $length = 80, $with = '[...]', $at = 20)
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

    return sprintf('%s%s%s', substr($path, 0, $at), $with, substr($path, -($length - strlen($with) - $at)));
  }

  /**
   * Returns human readable interval from now
   * From last comment of http://css-tricks.com/snippets/php/time-ago-function/
   * 
   * @static
   * @param $i past timestamp
   * @return string
   */
  public static function ago($i)
  {
    $m = time() - $i;
    $o = 'just now';
    $t = array('year'=>31556926,'month'=>2629744,'week'=>604800, 'day'=>86400,'hour'=>3600,'minute'=>60,'second'=>1);
    foreach($t as $u=>$s)
    {
        if($s<=$m)
        {
          $v=floor($m/$s);
          $o="$v $u".($v==1?'':'s').' ago';
          break;
        }
    }
    return $o;
  }
}
