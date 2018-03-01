<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace Pdir\AmphtmlBundle\EventListener;

use Contao\Module;
use Contao\ModuleModel;

class ControllerHookListener
{
    public function __construct()
    {
    }

    /**
     * @param ModuleModel $moduleModel
     * @param string $buffer
     * @param Module $module
     */
    public function getFrontendModule($moduleModel, $buffer, $module)
    {
        return $buffer;
    }
}