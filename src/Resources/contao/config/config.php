<?php
/**
 * Hooks
 */

$GLOBALS['TL_HOOKS']['getPageLayout'][]            = array('\Pdir\AmphtmlHooks', 'ampGetPageLayout');
$GLOBALS['TL_HOOKS']['generateFrontendUrl'][]      = array('\Pdir\AmphtmlHooks', 'ampGenerateFrontendUrl');
$GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'][] = array('\Pdir\AmphtmlHooks', 'unbindDynamicScriptTags');
$GLOBALS['TL_HOOKS']['getFrontendModule'][]        = [
    \Pdir\AmphtmlBundle\EventListener\ControllerHookListener::class,
    'getFrontendModule'
];

$GLOBALS['FE_MOD']['amp'][\Pdir\AmphtmlBundle\Module\ModuleAmpCarouselNews::NAME] = Pdir\AmphtmlBundle\Module\ModuleAmpCarouselNews::class;