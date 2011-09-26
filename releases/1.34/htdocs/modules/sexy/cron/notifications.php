<?php

	require ('header.php');
	
	$notifications_handler = xoops_getmodulehandler('notifications', 'sexy');
	$show_handler = xoops_getmodulehandler('show', 'sexy');
	$profile_handler = xoops_getmodulehandler('profile', 'sexy');
	
    $module_handler = xoops_gethandler('module');
	$config_handler = xoops_gethandler('config');
	$GLOBALS['xoopsModule'] = $module_handler->getByDirname('sexy');
	$GLOBALS['xoopsModuleConfig'] = $config_handler->getConfigList($GLOBALS['xoopsModule']->getVar('mid'));
	
	if ($GLOBALS['xoopsModuleConfig']['webcams']) {
		include_once $GLOBALS['xoops']->path('/modules/webcams/class/global.php');
		$GLOBALS['webcamsModule'] = $module_handler->getByDirname('webcams');
		$GLOBALS['webcamsModuleConfig'] = $config_handler->getConfigList($GLOBALS['webcamsModule']->getVar('mid'));
	}
	
	$criteria = new CriteriaCompo(new Criteria('`when`', time(), '<'));
	$criteria->add(new Criteria('`sent`', '0', '='));
	$criteria->setSort('`pid`');

	$notifications = $notifications_handler->getObjects($criteria, false);
	
	xoops_load('xoopsmailer');
	xoops_loadLanguage('main','sexy');
	$tweet = array();
	
	foreach($notifications as $nid=>$notification) {
		if ($GLOBALS['xoopsModuleConfig']['webcams']) {
			$params = '&action=user_update';
			$params .= '&account_id='.$GLOBALS['webcamsModuleConfig']['account_id'];
			$params .= '&gateway_pass='.$GLOBALS['webcamsModuleConfig']['gateway_pass'];
			$params .= '&user_id='.$notification->getVar('user_id');
			$params .= '&add_amount='.number_format($notification->getVar('amount')+$notification->getVar('discount'), 2);
			$result = sendPost($GLOBALS['webcamsModuleConfig']['gateway_ip'],$params,true);		//use ssl	
		}
		
		$show = $show_handler->get($notification->getVar('sid'));
		$profile = $profile_handler->get($notification->getVar('pid'));
		
		$xoopsMailer =& getMailer();
		$xoopsMailer->setHTML(true);
		$xoopsMailer->setTemplateDir($GLOBALS['xoops']->path('/modules/sexy/language/'.$GLOBALS['xoopsConfig']['language'].'/mail_templates/'));
		$xoopsMailer->setTemplate('sexy_reminder.tpl');
		$xoopsMailer->setSubject(str_replace('%show', $show->getVar('name')), str_replace('%person', $profile->getVar('alias'), constant('_SXY_EMAIL_REMINDER_SUBJECT')));
		
		$xoopsMailer->assign('SHOW', $show->getVar('name'));
		$xoopsMailer->assign('URL', $notification->getURL());
		$xoopsMailer->assign('PERSON', $profile->getVar('alias'));
		$xoopsMailer->assign('CREDIT', number_format($notification->getVar('amount')+$notification->getVar('discount'), 2));
		$xoopsMailer->assign('STARTS', date(_DATESTRING, $show->getVar('when')));
		$xoopsMailer->assign('NOW', date(_DATESTRING, time()));
		$xoopsMailer->assign('MINUTES', floor(($show->getVar('when')-time())/60));
		$xoopsMailer->assign('NAME', $notification->getVar('name'));
		$xoopsMailer->assign('EMAIL', $notification->getVar('email'));
		$xoopsMailer->assign("SITEURL", XOOPS_URL);
		$xoopsMailer->assign("SITENAME", $GLOBALS['xoopsConfig']['sitename']);
		
		$xoopsMailer->setToEmails($notification->getVar('email'));
		@$xoopsMailer->send();
			
		if (strlen($notification->getVar('twitter'))>0)
			$tweet[$notification->getVar('sid')][$notification->getVar('twitter')] = $notification->getVar('twitter');
			
		$notification->setVar('sent', true);
		$notifications_handler->insert($notification);
	}
	
	if (count($tweet)>0&&!empty($tweet)) {
		$oauth_handler = xoops_getmodulehandler('oauth', 'sexy');
		$oauth = $oauth_handler->getRootOauth(true);
		if (is_object($oauth)) {
			foreach($tweet as $sid => $twitters) {
				$show = $show_handler->get($sid);
				$profile = $profile_handler->get($show->getVar('pid'));
				$i=0;
				foreach($twitters as $key=>$tweeter) {
					$i++;
					$str .= '@'.$tweeter.' ';
					if ($i==3) {
						$i=0;
						$oauth->sendTweet($str . str_replace('%person', $profile->getVar('alias'), str_replace('%site', $GLOBALS['xoopsConfig']['sitename'], _SXY_TWITTER_MSG)), XOOPS_URL);
						$str = '';
					}
				}
				if ($i<3&&$i!=0) {
					$oauth->sendTweet($str.str_replace('%person', $profile->getVar('alias'), str_replace('%site', $GLOBALS['xoopsConfig']['sitename'], _SXY_TWITTER_MSG)), XOOPS_URL);
					$str = '';
				} 
			}
		}
	}
	
?>