<?php

	include('header.php');

	if ($snid<>0) {
		
		$notifications_handler =& xoops_getmodulehandler('notifications', 'sexy');
		$user = $notifications_handler->getUserFromToken($_GET['token']);
		
		if (!is_object($user)) {
			redirect_header(XOOPS_URL, 10, _NOPERM);
			exit(0);
		}
		
		$notification = $notifications_handler->get($snid);
		if ($user->getVar('uid')!=$notification->getVar('uid')) {
			redirect_header(XOOPS_URL, 10, _NOPERM);
			exit(0);
		}
			
		$member_handler = xoops_gethandler('member');
		
	    $user->setVar('last_login', time());
	    if (!$member_handler->insertUser($user)) {
	    }
	    // Regenrate a new session id and destroy old session
	    $GLOBALS["sess_handler"]->regenerate_id(true);
	    $_SESSION = array();
	    $_SESSION['xoopsUserId'] = $user->getVar('uid');
	    $_SESSION['xoopsUserGroups'] = $user->getGroups();
	    $user_theme = $user->getVar('theme');
	    if (in_array($user_theme, $GLOBALS['xoopsConfig']['theme_set_allowed'])) {
	        $_SESSION['xoopsUserTheme'] = $user_theme;
	    }
	
	    // Set cookie for rememberme
	    if (!empty($GLOBALS['xoopsConfig']['usercookie'])) {
	        if (!empty($_POST["rememberme"])) {
	            setcookie($GLOBALS['xoopsConfig']['usercookie'], $_SESSION['xoopsUserId'] . '-' . md5($user->getVar('pass') . XOOPS_DB_NAME . XOOPS_DB_PASS . XOOPS_DB_PREFIX), time() + 31536000, '/', XOOPS_COOKIE_DOMAIN, 0);
	        } else {
	            setcookie($GLOBALS['xoopsConfig']['usercookie'], 0, -1, '/', XOOPS_COOKIE_DOMAIN, 0);
	        }
	    }
		
	    $show_handler = xoops_getmodulehandler('show', 'sexy');
	    $show = $show_handler->get($notification->getVar('sid'));
	    
	    if ($show->getVar('when')-(60*5)>time()) {
	    	redirect_header(XOOPS_URL.'/modules/sexy/', 10, _SXY_MF_SHOW_HASNT_STARTED);
	    	exit(0);
	    }

		if ($show->getVar('when')+(60*60)<time()) {
	    	redirect_header(XOOPS_URL.'/modules/sexy/', 10, _SXY_MF_SHOW_HAS_FINISHED);
	    	exit(0);
	    }
	    
	    $profile_handler = xoops_getmodulehandler('profile', 'sexy');
	    $host_handler = xoops_getmodulehandler('host', 'webcams');
	    
	    $profile = $profile_handler->get($notification->getVar('pid'));
	    $host = $host_handler->getByHostID($profile->getVar('host_id'));
	    
	    $notification->setVar('entered', time());
	 
	    if ($notification->payWallet()) {
	    	$notifications_handler->insert($notification, true);
			redirect_header(XOOPS_URL.'/modules/webcams/?op=show&hostname='.$host->getVar('user').'&token='.md5(XOOPS_LICENSE_KEY.date('Ymdh')), 10, sprintf(_SXY_MF_SHOW_KICKING_U_TO_SHOW_WALLET_CREDITED, number_format($notification->getVar('amount')+$notification->getVar('discount'),2)));
		} else {
			$notifications_handler->insert($notification, true);
			redirect_header(XOOPS_URL.'/modules/webcams/?op=show&hostname='.$host->getVar('user').'&token='.md5(XOOPS_LICENSE_KEY.date('Ymdh')), 10, _SXY_MF_SHOW_KICKING_U_TO_WALLET_ALREADY_CREDITED);
		}
	    
	} else {
		redirect_header(XOOPS_URL, 10, _NOPERM);
	}

	exit(0);
			
?>
