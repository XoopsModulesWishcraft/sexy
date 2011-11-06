<?php

	
	function PaidSexyHook($invoice) {

		$profile_handler = xoops_getmodulehandler('profile', 'profile');
		$show_handler = xoops_getmodulehandler('show', 'sexy');
		$user_handler = xoops_gethandler('user');
		$notifications_handler = xoops_getmodulehandler('notifications', 'sexy');
		
		$key = explode('|', $invoice->getVar('key'));

		$notification = $notifications_handler->create();
		
		$notification->setVar('sid', $key[0]);
		$notification->setVar('pid', $key[1]);
		$notification->setVar('uid', $key[2]);
		$notification->setVar('user_id', $key[3]);
		
		$show = $show_handler->get($key[0]);
		$profile =  $profile_handler->get($key[2]);
		$user = $user_handler->getVar($key[2]);
		
		if (is_object($profile))
			$notification->setVar('twitter', $profile->getVar('twitter'));
			
		if (is_object($user)) {
			$notification->setVar('name', (strlen($user->getVar('name'))>0?$user->getVar('name'):$user->getVar('uname')));
			$notification->setVar('email', $user->getVar('email'));
		}
		
		if (is_object($show)) {
			$notification->setVar('when', $show->getVar('when')-60*30);
		}
		
		$notification->setVar('amount', $invoice->getVar('grand'));
		$notification->setVar('discount', $invoice->getVar('discount_amount'));
		
		$notifications_handler->insert($notification, true);
		
		include_once $GLOBALS['xoops']->path('/modules/xpayment/plugin/xpayment.php');		
		return PaidXPaymentHook($invoice);
	
	}
	
	function UnpaidSexyHook($invoice) {
		include_once $GLOBALS['xoops']->path('/modules/xpayment/plugin/xpayment.php');
		return UnpaidXPaymentHook($invoice);		
	}
	
	function CancelSexyHook($invoice) {
		include_once $GLOBALS['xoops']->path('/modules/xpayment/plugin/xpayment.php');
		return CancelXPaymentHook($invoice);
	}
	
?>