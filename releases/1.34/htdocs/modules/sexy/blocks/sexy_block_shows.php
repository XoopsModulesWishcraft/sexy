<?php

function b_sexy_block_show_show( $options )
{
	if (empty($options[0]))
		return false;

	if (empty($options[1]))
		return false;	
					
	$show_handler =& xoops_getmodulehandler('show', 'sexy');
	$profile_handler =& xoops_getmodulehandler('profile', 'sexy');
	$criteria = new Criteria('`when`',time(), '>');
	$criteria->setSort(`when`);
	$criteria->setOrder('ASC');
	$criteria->setLimit($options[0]);

	$module_handler = xoops_gethandler('module');
	$config_handler = xoops_gethandler('config');
	$mod = $module_handler->getByDirname('sexy');
	$modConfig = $config_handler->getConfigList($mod->getVar('mid'));

	$xPaymentmod = $module_handler->getByDirname('xpayment');
	if (is_object($xPaymentmod))
		$xPaymentmodConfig = $config_handler->getConfigList($xPaymentmod->getVar('mid'));
		
	if ($shows = $show_handler->getObjects($criteria)) {
		$block = array();
		foreach($shows as $sid => $show) {
			if ($show->getVar('pid')>0) {
				$i++;
				if ($i % $options[1])
					$block[$sid]['column'] = true;
				else 
					$block[$sid]['column'] = false;
					
				$profile = $profile_handler->getVar($show->getVar('pid')); 
				if ($modConfig['thumbnail_rule']=='h')
					$block[$sid]['scale']='height="'.$modConfig['thumbnail_size'].'px"';
				else
					$block[$sid]['scale']='width="'.$modConfig['thumbnail_size'].'px"';
				
				$block[$sid]['image']['url'] = XOOPS_URL.'/modules/sexy/image,default,thumbnail,'.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).','.$profile->getVar('pid').'.jpg';
				$block[$sid]['image']['profile'] = XOOPS_URL .'/modules/sexy/index.php?op=profile&fct=profile&pid='.$profile->getVar('pid');
				$block[$sid]['image']['alt'] = $profile->getVar('alias');
				$block[$sid]['name'] = $show->getVar('name');
				$block[$sid]['amount'] = $show->getVar('amount');
				$block[$sid]['currency'] = $xPaymentmodConfig['currency'];
				$block[$sid]['discount'] = floor($show->getVar('discount')).'%';
				$block[$sid]['sid'] = $show->getVar('sid');
				$block[$sid]['pid'] = $show->getVar('pid');
				$block[$sid]['when'] = date(_DATESTRING, $show->getVar('when'));
				$block[$sid]['minutes'] = floor(($show->getVar('when')-time()-(floor(($show->getVar('when')-time())/(60*60)))*(60*60))/60);
				$block[$sid]['hours'] = floor(($show->getVar('when')-time()-(floor(($show->getVar('when')-time())/60)*60))/(60*60));
				
				if (is_object($GLOBALS['xoopsUser'])&&$modConfig['webcams']) {
					$pivot_handler =& xoops_getmodulehandler('pivot', 'webcams');
					$pivot = $pivot_handler->getObjects($pivot_handler->getPivotCriteria(), false);
					$block[$sid]['uid'] = $GLOBALS['xoopsUser']->getVar('uid');
					if ($pivot->getVar('type')=='user') {
						$handler =& xoops_getmodulehandler($pivot->getVar('type'), 'webcams');
						$user = $handler->get($pivot->getVar('id')); 
						$block[$sid]['user_id'] = $user->getVar('user_id');
						if ($show->getVar('prebook')=='Yes') {
							$block[$sid]['prebook'] = true;
						} else {
							$block[$sid]['prebook'] = false;
						}
						if ($show->getVar('discount')=='Yes') {
							$discount_handler =& xoops_getmodulehandler('discount', 'xpayment');
							$criteria = new Criteria('email', $GLOBALS['xoopsUser']->getVar('email'));
							$discounts = $discount_handler->getObjects($criteria, false);
							if (is_object($discounts[0])) {
								$block[$sid]['code'] = $discounts[0]->getVar('code');
							} else {
								$block[$sid]['code'] = $discount_handler->sendDiscountCode($GLOBALS['xoopsUser']->getVar('email'), $show->getVar('when'), 1, $show->getVar('discount'), $GLOBALS['xoopsUser']->getVar('uid'), false);
							}
						} else {
							$block[$sid]['code'] = false;
						}		
					}
				} else {
					$block[$sid]['prebook'] = false;
					$block[$sid]['code'] = '';					
				}
			}
		}
		return $block ;
	}
	return false;
}


function b_sexy_block_show_edit( $options )
{
	include_once($GLOBALS['xoops']->path('/modules/sexy/include/sexy.formobjects.php'));

	$limit = new XoopsFormText('', 'options[]', 5,5,$options[0]);
	$form = ""._BL_SXY_LIMIT."&nbsp;".$limit->render();
	$columns = new XoopsFormText('', 'options[]', 5,5,$options[1]);
	$form .= "<br/>"._BL_SXY_COLUMNS."&nbsp;".$columns->render();
	
	return $form ;
}

?>