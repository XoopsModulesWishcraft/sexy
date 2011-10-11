<?php

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class SexyCorePreload extends XoopsPreloadItem
{
	function eventCoreFooterEnd($args)
    {
    	xoops_load('xoopscache');
		if (!class_exists('XoopsCache')) {
			// XOOPS 2.4 Compliance
			xoops_load('cache');
			if (!class_exists('XoopsCache')) {
				include_once XOOPS_ROOT_PATH.'/class/cache/xoopscache.php';
			}
		}
	    $module_handler = xoops_gethandler('module');
	    $config_handler = xoops_gethandler('config');
	    $sexyMod = $module_handler->getByDirname('sexy');
	    if (is_object($sexyMod)) {
	    	$sexyConfig = $config_handler->getConfigList($sexyMod->getVar('mid'));
			switch ($sexyConfig['crontype']) {
				case 'preloader':
					if (!$read = XoopsCache::read('sexy_pause_preload_cron')) {
						XoopsCache::write('sexy_pause_preload_cron', true, $sexyConfig['interval_of_cron']);
						include(dirname(dirname(__FILE__)).'/cron/notifications.php');
					}
					break;
			}
	    }
    	
    }

    function eventCoreHeaderCacheEnd($args)
    {
    	xoops_load('xoopscache');
		if (!class_exists('XoopsCache')) {
			// XOOPS 2.4 Compliance
			xoops_load('cache');
			if (!class_exists('XoopsCache')) {
				include_once XOOPS_ROOT_PATH.'/class/cache/xoopscache.php';
			}
		}
	    $module_handler = xoops_gethandler('module');
	    $config_handler = xoops_gethandler('config');
	    $sexyMod = $module_handler->getByDirname('sexy');
	    if (is_object($sexyMod)) {
	    	$sexyConfig = $config_handler->getConfigList($sexyMod->getVar('mid'));
			switch ($sexyConfig['crontype']) {
				case 'preloader':
					if (!$read = XoopsCache::read('sexy_pause_preload_cron')) {
						XoopsCache::write('sexy_pause_preload_cron', true, $sexyConfig['interval_of_cron']);
						include(dirname(dirname(__FILE__)).'/cron/notifications.php');
					}
					break;
			}
	    }
    }
    
}
?>