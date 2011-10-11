<?php

	include('header.php');

	if (!is_object($GLOBALS['xoopsUser'])) {
		redirect_header(XOOPS_URL.'/user.php', 10, _SXY_MF_BOOK_NO_PERM);
		exit(0);
	}
	
	if ($sid<>0) {
		$op = 'show';
		$fct = 'webcams';
	}
	
	switch($op){
	default:
	case "show":
		switch ($fct) {
		case "webcams":
		default:	
			$user_handler =& xoops_gethandler('user');
			$user_profile_handler =& xoops_getmodulehandler('profile', 'profile');
			$user = $user_handler->get($GLOBALS['xoopsUser']->getVar('uid'));
			$user_profile = $user_profile_handler->get($GLOBALS['xoopsUser']->getVar('uid'));
			
			$show_handler =& xoops_getmodulehandler('show', 'sexy');
			$show = $show_handler->get($sid);
			
			$profile_handler =& xoops_getmodulehandler('profile', 'sexy');
			$profile = $profile_handler->get($show->getVar('pid'));
		
			$pivot_handler =& xoops_getmodulehandler('pivot', 'webcams');
			$pivot = $pivot_handler->getObjects($pivot_handler->getPivotCriteria(), false);
			$webcam_handler =& xoops_getmodulehandler($pivot->getVar('type'), 'webcams');
			$webcam = $webcam_handler->get($pivot->getVar('id'));

			if ($url = $show_handler->existingUnpaidInvoice($show->getVar('sid'), $show->getVar('pid'), $GLOBALS['xoopsUser']->getVar('uid'), $webcam->getVar('user_id'))) {
				redirect_header($url, 10, _SXY_MF_BOOK_INVOICE_EXISTS);
				exit(0);
			}
			
			$url = XOOPS_URL."/".$GLOBALS['xoopsModuleConfig']['baseofurl']."/".xoops_sef($profile->getVar('sexuality'))."/".xoops_sef($profile->getVar('alias'))."/book,".$sid.$GLOBALS['xoopsModuleConfig']['endofurl'];
			if (!strpos($url, $_SERVER['REQUEST_URI'])&&$GLOBALS['xoopsModuleConfig']['htaccess']) {
				header( "HTTP/1.1 301 Moved Permanently" ); 
				header( "Location: ".$url);
				exit;
			}
			
			$xoopsOption['template_main'] = 'sexy_book_show.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			if (is_object($user_profile))
				$GLOBALS['xoopsTpl']->assign('user', array_merge($user_profile->toArray(), $user->toArray()));
			else 
				$GLOBALS['xoopsTpl']->assign('user', $user->toArray());
			
			$GLOBALS['xoopsTpl']->assign('already', $show_handler->existingClosedInvoice($show->getVar('sid'), $show->getVar('pid'), $GLOBALS['xoopsUser']->getVar('uid'), $webcam->getVar('user_id')));
			$GLOBALS['xoopsTpl']->assign('show', $show->toArray());
			$GLOBALS['xoopsTpl']->assign('webcam', $webcam->toArray());
			
			$module_handler = xoops_gethandler('module');
        	$config_handler = xoops_gethandler('config');
        	$xoModule = $module_handler->getByDirname('xpayment');
        	$xoConfig = $config_handler->getConfigList($xoModule->getVar('mid'));

        	$GLOBALS['xoopsTpl']->assign('currency', $xoConfig['currency']);
        
			$GLOBALS['xoTheme']->addScript(XOOPS_URL.'/browse.php?Frameworks/jquery/jquery.js');
			$GLOBALS['xoTheme']->addScript(XOOPS_URL.'/modules/sexy/js/jquery.galleriffic.js');
			$GLOBALS['xoTheme']->addScript(XOOPS_URL.'/modules/sexy/js/jquery.history.js');
			$GLOBALS['xoTheme']->addScript(XOOPS_URL.'/modules/sexy/js/jquery.opacityrollover.js');

			$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL.'/modules/sexy/css/galleriffic-3.css');
			
			$return = sexyPicturesProfile($show->getVar('pid'));
			$GLOBALS['xoopsTpl']->assign('images', $return['images']);			

			if (file_exists(XOOPS_ROOT_PATH."/modules/tag/include/tagbar.php")) {
				include_once XOOPS_ROOT_PATH."/modules/tag/include/tagbar.php";
				$xoopsTpl->assign('tagbar', tagBar($show->getVar('pid'), $catid = 0));
			}
			
			$urls_handler =& xoops_getmodulehandler('urls', 'sexy');
			$criteria = new Criteria('pid', $show->getVar('pid'));
			$criteria->setSort('type');
			$criteria->setOrder('DESC');
			if ($urls = $urls_handler->getObjects($criteria, true)) 
				foreach($urls as $urlid => $url) {
					$url = $url->toArray();
					$purl = parse_url($url['url']);
					$url['title'] = $purl['host'];
					$GLOBALS['xoopsTpl']->append('urls', $url);	
				}
			$prices_handler =& xoops_getmodulehandler('prices', 'sexy');
			if ($prices = $prices_handler->getObjects($criteria, true)) 
				foreach($prices as $priceid => $price) 
					$GLOBALS['xoopsTpl']->append('prices', $price->toArray());	
									
			$profile_handler =& xoops_getmodulehandler('profile', 'sexy');
			$profile_profile_handler =& xoops_getmodulehandler('profile', 'profile');
			
			$locations = array();
			
			if ($GLOBALS['xoopsModuleConfig']['multisite']) {
	 			$module_handler =& xoops_getmodulehandler('module','multisite');
				$domains_handler =& xoops_getmodulehandler('domain', 'multisite');
				
				$critera_z = new CriteriaCompo(new Criteria('dom_catid', XOOPS_DOMAIN));
				$critera_z->add(new Criteria('dom_name', 'domain')) ;
				$critera_z->setSort('dom_name');
				$domains = $domains_handler->getDomains($critera_z);
				$sprint = str_replace($_SERVER['HTTP_HOST'], '%s', strtolower(XOOPS_URL));
				$sprint = str_replace(array('http://','https://','HTTP://','HTTPS://'), '%s', $sprint);
				if($alldomains==true)
					$domain_list['all'] = _ALL_DOMAINS;
		
				foreach($domains as $domain)
				{	
					$critera_y = new CriteriaCompo();
					$critera_y->add(new Criteria('dom_pid', $domain->getVar('dom_id')));
					$critera_y->add(new Criteria('dom_name', 'sitename')) ;
					$critera_y->setSort('dom_name');
					$domains_y = $domains_handler->getDomains($critera_y);
		
					if ($justaddr==false)
					{
						if (!$domains_handler->getDomainCount($critera_y)){
							$domain_list[urlencode(sprintf($sprint ,"http://",$domain->getVar('dom_value')))] = sprintf($sprint ,"http://",$domain->getVar('dom_value'));
							if ($https==true)
								$domain_list[urlencode(sprintf($sprint ,"https://",$domain->getVar('dom_value')))] = sprintf($sprint ,"https://",$domain->getVar('dom_value'));
						} else {
							$domain_list[urlencode(sprintf($sprint ,"http://",$domain->getVar('dom_value')))] = "".$domains_y[0]->getVar('dom_value');				
							if ($https==true)
								$domain_list[urlencode(sprintf($sprint ,"https://",$domain->getVar('dom_value')))] = "(secure) - ".$domains_y[0]->getVar('dom_value');
						}
					} else {
						if (!$domains_handler->getDomainCount($critera_y)){
							$domain_list[$domain->getVar('dom_value')] = sprintf($sprint ,"http://",$domain->getVar('dom_value'));
							if ($https==true)
								$domain_list[$domain->getVar('dom_value')] = sprintf($sprint ,"https://",$domain->getVar('dom_value'));
						} else {
							$domain_list[$domain->getVar('dom_value')] = "".$domains_y[0]->getVar('dom_value');				
							if ($https==true)
								$domain_list[$domain->getVar('dom_value')] = "(secure) - ".$domains_y[0]->getVar('dom_value');
						}
					}
				}	
			}

			$profile = $profile_handler->get($show->getVar('pid'));
			$profile_array = $profile->toArray();
			$profile_array['bio'] = str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', htmlspecialchars_decode($profile_array['bio']))));
			$profile_array['columnone'] = str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', htmlspecialchars_decode($profile_array['columnone']))));
			$profile_array['columntwo'] = str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', htmlspecialchars_decode($profile_array['columntwo']))));
			$profile_array['footer'] = str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', htmlspecialchars_decode($profile_array['footer']))));
			
			$GLOBALS['xoopsTpl']->assign('profile', $profile_array);

			$actions_list = sexy_ActionsArray($show->getVar('pid'));
			$services_list = sexy_ServicesArray($show->getVar('pid'));			
			$physique_handler =& xoops_getmodulehandler('physique', 'sexy');
			$criteria = new Criteria('pid', $show->getVar('pid'));
			if (@$physique_handler->getCount($criteria)!=0)
				if ($physiques = $physique_handler->getObjects($criteria)) {
					$physique = $physiques[0]->toArray();
					foreach($physiques[0]->getVar('services') as $id => $service)
						$physique['services_txt'] .= $services_list[$service] . ', ';
					$physique['services_txt']  = @substr($physique['services_txt'] , 0, strlen($physique['services_txt'] )-2);
					foreach($physiques[0]->getVar('actions') as $id => $action)
						$physique['actions_txt'] .= $actions_list[$action] . ', ';
					$physique['actions_txt']  = @substr($physique['actions_txt'] , 0, strlen($physique['actions_txt'] )-2);						
					$GLOBALS['xoopsTpl']->assign('physique', $physique);
				}		
			
			$uu=0;
			if (is_array($profile->getVar('domains')))
				foreach($profile->getVar('domains') as $id => $value) {
					$uu++;
					$location['domains'][$uu]['url'] = urldecode($value);
					$location['domains'][$uu]['name'] = $domain_list[$value];
				}
			
			$location_list = sexy_LocationArray($show->getVar('pid'));
			$uu=0;
			if (is_array($profile->getVar('locations')))
				foreach($profile->getVar('locations') as $id => $value) {
					$uu++;
					$location['locations'][$uu]['code'] = $value;
					$location['locations'][$uu]['name'] = $location_list[$value];
				}
			
			$GLOBALS['xoopsTpl']->assign('locations', $location);
			
			$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', implode(' - ', $profile_profile->getVar('type')) . $profile->getVar('alias') . ' - ' . ucfirst($profile_profile->getVar('sex')) . ' - Book Show');
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
			break;
		}
		break;	
	}
?>
