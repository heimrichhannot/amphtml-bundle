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


use Contao\Controller;
use Contao\Module;
use Contao\NewsModel;
use Contao\System;

class ModuleAmpCarouselNews extends Module
{

    const NAME = 'huh_amp_carousel_news_module';

    protected $strTemplate = 'mod_ampcarousel_news';

    protected function compile()
    {
        $news = NewsModel::findPublishedByPid(1, 3);
        $items = [];

        if ($news)
        {
            foreach ($news as $entry)
            {
                $item = [
                    'src' => '/'.System::getContainer()->get('huh.utils.file')->getPathFromUuid($entry->singleSRC),
                    'headline' => $entry->headline,
                    'url' => Controller::replaceInsertTags('{{news_url::'.$entry->id.'}}')
                ];
                $items[] = $item;
            }
        }

        $this->Template->items = $items;
    }


}