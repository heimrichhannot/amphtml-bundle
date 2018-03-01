<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2018 Heimrich & Hannot GmbH
 *
 * @author  Thomas Körner <t.koerner@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace Pdir\AmphtmlBundle\Module;


use Contao\Module;

class ModuleAmpNavigation extends Module
{
    const NAME = 'huh_amp_navigation';

    protected $strTemplate = 'mod_ampcarousel_news';

    protected function compile()
    {
        // TODO: Implement compile() method.
    }
}