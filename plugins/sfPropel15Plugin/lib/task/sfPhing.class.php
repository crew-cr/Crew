<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once('phing/Phing.php');

/**
 * @package    symfony
 * @subpackage command
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPhing.class.php 24039 2009-11-16 17:52:14Z Kris.Wallsmith $
 */
class sfPhing extends Phing
{
  static public function getPhingVersion()
  {
    return 'sfPhing';
  }

  /**
   * @see Phing
   */
  public function runBuild()
  {
    // workaround for included phing 2.3 which by default loads many tasks
    // that are not needed and incompatible (eg phing.tasks.ext.FtpDeployTask)
    // by placing current directory on the include path our defaults will be loaded
    // see ticket #5054
    $includePath = get_include_path();
    set_include_path(dirname(__FILE__).PATH_SEPARATOR.$includePath);
    parent::runBuild();
    set_include_path($includePath);
  }
}
