<?php
/**
 * @author morgan brunot
 */
class less
{
  /**
   * @return string
   */
  public function getLessPaths()
  {
    return trim(sfConfig::get('app_less_less_dir', '/web/css/less'), '/');
  }

  /**
   * @return string
   */
  public function getCssPaths()
  {
    return trim(sfConfig::get('app_less_css_dir', '/web/css'), '/');
  }

  /**
   * @return array
   */
  public function findLessFiles()
  {
    return sfFinder::type('file')
      ->name('*.less')
      ->discard('_*')
      ->in(sfConfig::get('sf_root_dir'). '/' .$this->getLessPaths());
  }

  /**
   * @static
   * @param string $lessFile
   * @return mixed
   */
  public static function getCssFileName($lessFile)
  {
    return str_replace('.less', '.css', basename($lessFile));
  }

  /**
   * @return void
   */
  public function compileLessFiles()
  {
    foreach($this->findLessFiles() as $lessFile)
    {
      $cssNameFile = self::getCssFileName($lessFile);
      $less = new lessc($lessFile);
      file_put_contents(sfConfig::get('sf_root_dir').'/'.$this->getCssPaths().'/'.$cssNameFile, $less->parse());
    }
  }
}