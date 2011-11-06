<?php

	include('header.php');
	
	if ($pid<>0) {
		$op = 'profile';
		$fct = 'profile';
	} else {
		if (!isset($start))
			$start = 0;
		if (!isset($limit))
			$limit = 16;
		if (!isset($op))
			$op = 'default';
		if (!isset($fct))
			$fct = 'default';
	}
	
	switch($op){
	case "profile":
		switch ($fct) {
		case "profile":
		default:	
		
			if (strpos($_SERVER['REQUEST_URI'], 'odules/'&&$GLOBALS['xoopsModuleConfig']['htaccess'])>0) {
				$profile_handler =& xoops_getmodulehandler('profile', 'sexy');
				$profile = $profile_handler->get($pid);
				header( "HTTP/1.1 301 Moved Permanently" ); 
				header( "Location: ".XOOPS_URL."/".$GLOBALS['xoopsModuleConfig']['baseurl']."/".xoops_sef($profile->getVar('sexuality'))."/".xoops_sef($profile->getVar('alias'))."/profile,".$pid).$GLOBALS['xoopsModuleConfig']['endofurl'];
				exit;
			}
			
			$xoopsOption['template_main'] = 'sexy_index_profile.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			$GLOBALS['xoTheme']->addScript(XOOPS_URL.'/browse.php?Frameworks/jquery/jquery.js');
			$GLOBALS['xoTheme']->addScript(XOOPS_URL.'/modules/sexy/js/jquery.galleriffic.js');
			$GLOBALS['xoTheme']->addScript(XOOPS_URL.'/modules/sexy/js/jquery.history.js');
			$GLOBALS['xoTheme']->addScript(XOOPS_URL.'/modules/sexy/js/jquery.opacityrollover.js');

			$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL.'/modules/sexy/css/galleriffic-3.css');
			
			$return = sexyPicturesProfile($pid);
			$GLOBALS['xoopsTpl']->assign('images', $return['images']);			

			if (file_exists(XOOPS_ROOT_PATH."/modules/tag/include/tagbar.php")) {
				include_once XOOPS_ROOT_PATH."/modules/tag/include/tagbar.php";
				$xoopsTpl->assign('tagbar', tagBar($pid, $catid = 0));
			}
			
			$urls_handler =& xoops_getmodulehandler('urls', 'sexy');
			$criteria = new Criteria('pid', $pid);
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

			$profile = $profile_handler->get($pid);
			$profile_array = $profile->toArray();
			$profile_array['bio'] = str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', htmlspecialchars_decode($profile_array['bio']))));
			$profile_array['columnone'] = str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', htmlspecialchars_decode($profile_array['columnone']))));
			$profile_array['columntwo'] = str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', htmlspecialchars_decode($profile_array['columntwo']))));
			$profile_array['footer'] = str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', htmlspecialchars_decode($profile_array['footer']))));
			
			$GLOBALS['xoopsTpl']->assign('profile', $profile_array);

			$actions_list = sexy_ActionsArray($pid);
			$services_list = sexy_ServicesArray($pid);			
			$physique_handler =& xoops_getmodulehandler('physique', 'sexy');
			$criteria = new Criteria('pid', $pid);
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
			
			$location_list = sexy_LocationArray($pid);
			$uu=0;
			if (is_array($profile->getVar('locations')))
				foreach($profile->getVar('locations') as $id => $value) {
					$uu++;
					$location['locations'][$uu]['code'] = $value;
					$location['locations'][$uu]['name'] = $location_list[$value];
				}
			
			$GLOBALS['xoopsTpl']->assign('locations', $location);
			
			$profile_profile = $profile_profile_handler->get($profile->getVar('uid'));
			$GLOBALS['xoopsTpl']->assign('profile_profile', $profile_profile->toArray());
			$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', implode(' - ', $profile_profile->getVar('type')) . $profile->getVar('alias') . ' - ' . $profile_profile->getVar('Sex') . ' Escort ( '. $profile->getVar('sexuality'). ' )');
			include XOOPS_ROOT_PATH.'/include/comment_view.php';
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
			break;
		}
		break;	
	default:

		if (strpos($_SERVER['REQUEST_URI'], 'odules/')>0&&$GLOBALS['xoopsModuleConfig']['htaccess']) {
			header( "HTTP/1.1 301 Moved Permanently" ); 
			header( "Location: ".XOOPS_URL."/".$GLOBALS['xoopsModuleConfig']['baseofurl']."/index,".$op.','.$fct.','.$start.','.$limit.$GLOBALS['xoopsModuleConfig']['endofurl']);
			exit;
		}
		
		$xoopsOption['template_main'] = 'sexy_index.html';
		include_once $GLOBALS['xoops']->path('/header.php');
		
		$return = sexyPicturesIndex($pid);
			
		$GLOBALS['xoopsTpl']->assign('images', $return['images']);
		$GLOBALS['xoopsTpl']->assign('pagenav', $return['pagenav']);			
		if (isset($return['width'])) 
			$GLOBALS['xoopsTpl']->assign('pictures_extra', "width=\"".$return['width'].'"');
		else
			$GLOBALS['xoopsTpl']->assign('pictures_extra', "height=\"".$return['height'].'"');
		$GLOBALS['xoopsTpl']->assign('colspan', $return['colspan']);
	
		include_once $GLOBALS['xoops']->path('/footer.php');		
		exit(0);
	}
?>
