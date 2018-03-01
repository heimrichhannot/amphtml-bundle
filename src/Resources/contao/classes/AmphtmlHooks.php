<?php

/**
 * Amphtml for Contao Open Source CMS
 *
 * Copyright (C) 2016 pdir / digital agentur <develop@pdir.de>
 *
 * @package    amphtml
 * @link       https://github.com/pdir/amphtml-bundle
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @author Philipp Seibt <seibt@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Configures the Amphtml hooks.
 *
 */

namespace Pdir;

use Contao\System;
use Contao\ThemeModel;

class AmphtmlHooks extends \Controller
{
    /*
     * if amp is set, load the given layout from page root
     */
    public function ampGetPageLayout($objPage, &$objLayout, $objPty)
    {
        $amphtml = (int) \PageModel::findByPk($objPage->rootId)->amphtml;
        if($amphtml == 1)
        {
            $page = \PageModel::findByPk($objPage->id);
            $strUrl = \Controller::generateFrontendUrl($page->row());
            if ($amphtml && $page !== null)
            {
                $objLayout->head .= '<link rel="amphtml" href="' . $strUrl . '?amp" />';
            }

            if(isset($_GET['amp']))
            {
                $ampLayout = (int) \PageModel::findByPk($objPage->rootId)->ampLayout;
                $ampUseInLayout = \PageModel::findByPk($objPage->rootId)->ampUseInLayout;
                $objLayout = \LayoutModel::findById($ampLayout);
//                $theme = ThemeModel::findByPk($objLayout->pid);

                // enable or disable columns in layout
                $desMod = deserialize($objLayout->modules);
                for($i = 0; $i <= count($desMod); $i++)
                {
                    if( stristr($ampUseInLayout,"head") && $desMod[$i]['col'] == "header" )
                    {
                        $desMod[$i]['enable'] = '1';
                    }
                    else if( !stristr($ampUseInLayout,"head") && $desMod[$i]['col'] == "header" )
                    {
                        $desMod[$i]['enable'] = '0';
                    }
                    if( stristr($ampUseInLayout,"footer") && $desMod[$i]['col'] == "footer" )
                    {
                        $desMod[$i]['enable'] = '1';
                    }
                    else if( !stristr($ampUseInLayout,"footer") && $desMod[$i]['col'] == "footer" )
                    {
                        $desMod[$i]['enable'] = '0';
                    }
                    if( stristr($ampUseInLayout,"left") && $desMod[$i]['col'] == "left" )
                    {
                        $desMod[$i]['enable'] = '1';
                    }
                    else if( !stristr($ampUseInLayout,"left") && $desMod[$i]['col'] == "left" )
                    {
                        $desMod[$i]['enable'] = '0';
                    }
                    if( stristr($ampUseInLayout,"right") && $desMod[$i]['col'] == "right" )
                    {
                        $desMod[$i]['enable'] = '1';
                    }
                    else if( !stristr($ampUseInLayout,"right") && $desMod[$i]['col'] == "right" )
                    {
                        $desMod[$i]['enable'] = '0';
                    }
                } $objLayout->modules = serialize($desMod);

                // load inline css from file or use user custom
                if(file_exists("../files/themes/amphtml/amphtml_custom.css"))
                {
                    $amphtmlCss = file_get_contents("http://".$_SERVER['HTTP_HOST']."/files/themes/amphtml/amphtml_custom.css");
                }
                else
                {
                    $amphtmlCss = file_get_contents("http://".$_SERVER['HTTP_HOST']."/files/themes/amphtml/amphtml.css");
                }
                $objLayout->head = "<style amp-custom>".$amphtmlCss."</style>";
                $objLayout->head .= '<link rel="canonical" href="'.str_replace('?amp', '', $strUrl).'" />';

                unset($GLOBALS['TL_HOOKS']['generatePage']);
            }
        }
    }

    /*
     * if amp is set, add amp param to all urls
     */
    public function ampGenerateFrontendUrl($arrRow, $strParams, $strUrl)
    {
        if(isset($_GET['amp']))
        {
            return $strUrl = '/'.$strUrl . '?amp';
        }
        return $strUrl;
    }

    /**
     * @param string $strBuffer
     * @return string
     */
    public function unbindDynamicScriptTags($strBuffer)
    {
        if(isset($_GET['amp']))
        {
            $search  = array('[[TL_HEAD]]', '[[TL_CSS]]');
            $replace = array('', '');
            return str_replace($search, $replace, $strBuffer);
        }

        return $strBuffer;
    }
}