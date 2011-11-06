<?php

	function sexyPhysiqueForm($id)
	{
		
		$physique_handler =& xoops_getmodulehandler('physique', 'sexy');
		$profile_handler =& xoops_getmodulehandler('profile', 'sexy');
		$profileprofile_handler =& xoops_getmodulehandler('profile', 'profile');

		if ($id>0)	{
			$physique = $physique_handler->get($id);
			$profile = $profile_handler->get($physique->getVar('pid'));
			$pprofile = $profileprofile_handler->get($profile->getVar('uid'));
			if (@$pprofile->getVar('Sex')=='Male')
				$male=true;
			else
				$male=false;
			
		} else {
			$physique = $physique_handler->create();
			$pprofile = $profileprofile_handler->get(@$GLOBALS['xoopsUser']->getVar('uid'));
			if (@$pprofile->getVar('Sex')=='Male')
				$male=true;
			else
				$male=false;
				
			$physique->setVar('pid', $_GET['pid']);
		}

		if ($id>0)
			$sform = new XoopsThemeForm(_SXY_FRM_EDITPHYSIQUE, 'profile', $_SERVER['REQUEST_URI'], 'post');
		else
			$sform = new XoopsThemeForm(_SXY_FRM_NEWPHYSIQUE, 'profile', $_SERVER['REQUEST_URI'], 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	

		$formobj = array();
	
		$formobj['race'] = new XoopsFormSelectPhysiqueRace(_SXY_MF_PHYSIQUE_RACE, 'race', ($physique->getVar('race')));
		$formobj['race']->setDescription(_SXY_MF_PHYSIQUE_RACE_DESC);

		$formobj['height'] = new XoopsFormSelectPhysiqueHeight(_SXY_MF_PHYSIQUE_HEIGHT, 'height', ($physique->getVar('height')));
		$formobj['height']->setDescription(_SXY_MF_PHYSIQUE_HEIGHT_DESC);
		
		$formobj['sex'] = new XoopsFormSelectPhysiqueSex(_SXY_MF_PHYSIQUE_SEX, 'sex', ($physique->getVar('sex')));
		$formobj['sex']->setDescription(_SXY_MF_PHYSIQUE_SEX_DESC);

		$formobj['weight'] = new XoopsFormSelectPhysiqueWeight(_SXY_MF_PHYSIQUE_WEIGHT, 'weight', ($physique->getVar('weight')));
		$formobj['weight']->setDescription(_SXY_MF_PHYSIQUE_WEIGHT_DESC);

		if ($male==false) {
			$formobj['dresssize'] = new XoopsFormSelectPhysiqueDressSize(_SXY_MF_PHYSIQUE_DRESSSIZE, 'dresssize', ($physique->getVar('dresssize')));
			$formobj['dresssize']->setDescription(_SXY_MF_PHYSIQUE_DRESSSIZE_DESC);

			$formobj['bust'] = new XoopsFormSelectPhysiqueBust(_SXY_MF_PHYSIQUE_BUST, 'bust', ($physique->getVar('bust')));
			$formobj['bust']->setDescription(_SXY_MF_PHYSIQUE_BUST_DESC);

		} else {
			$formobj['shirtsize'] = new XoopsFormSelectPhysiqueShirtSize(_SXY_MF_PHYSIQUE_SHIRTSIZE, 'shirtsize', ($physique->getVar('shirtsize')));
			$formobj['shirtsize']->setDescription(_SXY_MF_PHYSIQUE_SHIRTSIZE_DESC);
	
			$formobj['pantssize'] = new XoopsFormSelectPhysiquePantsSize(_SXY_MF_PHYSIQUE_PANTSSIZE, 'pantssize', ($physique->getVar('pantssize')));
			$formobj['pantssize']->setDescription(_SXY_MF_PHYSIQUE_PANTSSIZE_DESC);
			
			$formobj['penissize'] = new XoopsFormSelectPhysiquePenisSize(_SXY_MF_PHYSIQUE_PENISSIZE, 'penissize', ($physique->getVar('penissize')));
			$formobj['penissize']->setDescription(_SXY_MF_PHYSIQUE_PENISSIZE_DESC);
	
			$formobj['foreskin'] = new XoopsFormSelectPhysiqueForeskin(_SXY_MF_PHYSIQUE_FORESKIN, 'foreskin', ($physique->getVar('foreskin')));
			$formobj['foreskin']->setDescription(_SXY_MF_PHYSIQUE_FORESKIN_DESC);
		}
				
		$formobj['hair'] = new XoopsFormSelectPhysiqueHair(_SXY_MF_PHYSIQUE_HAIR, 'hair', ($physique->getVar('hair')));
		$formobj['hair']->setDescription(_SXY_MF_PHYSIQUE_HAIR_DESC);

		$formobj['eyes'] = new XoopsFormSelectPhysiqueEyes(_SXY_MF_PHYSIQUE_EYES, 'eyes', ($physique->getVar('eyes')));
		$formobj['eyes']->setDescription(_SXY_MF_PHYSIQUE_EYES_DESC);

		$formobj['bodyhair'] = new XoopsFormSelectPhysiqueBodyHair(_SXY_MF_PHYSIQUE_BODYHAIR, 'bodyhair', ($physique->getVar('bodyhair')));
		$formobj['bodyhair']->setDescription(_SXY_MF_PHYSIQUE_BODYHAIR_DESC);

		$formobj['position'] = new XoopsFormSelectPhysiquePosition(_SXY_MF_PHYSIQUE_POSITION, 'position', ($physique->getVar('position')));
		$formobj['position']->setDescription(_SXY_MF_PHYSIQUE_POSITION_DESC);

		$formobj['build'] = new XoopsFormSelectPhysiquePhysique(_SXY_MF_PHYSIQUE_PHYSIQUE, 'build', ($physique->getVar('physique')));
		$formobj['build']->setDescription(_SXY_MF_PHYSIQUE_PHYSIQUE_DESC);

		$formobj['piercings'] = new XoopsFormSelectYN(_SXY_MF_PHYSIQUE_PIERCINGS, 'piercings', $physique->getVar('piercings'));
		$formobj['piercings']->setDescription(_SXY_MF_PHYSIQUE_PIERCINGS_DESC);
		
		$formobj['tattoos'] = new XoopsFormSelectYN(_SXY_MF_PHYSIQUE_TATTOOS, 'tattoos', $physique->getVar('tattoos'));
		$formobj['tattoos']->setDescription(_SXY_MF_PHYSIQUE_TATTOOS_DESC);
				
		$formobj['drugs'] = new XoopsFormSelectYN(_SXY_MF_PHYSIQUE_DRUGS, 'drugs', $physique->getVar('drugs'));
		$formobj['drugs']->setDescription(_SXY_MF_PHYSIQUE_DRUGS_DESC);
						
		$formobj['smoking'] = new XoopsFormSelectYN(_SXY_MF_PHYSIQUE_SMOKING, 'smoking', $physique->getVar('smoking'));
		$formobj['smoking']->setDescription(_SXY_MF_PHYSIQUE_SMOKING_DESC);

		$formobj['alcohol'] = new XoopsFormSelectYN(_SXY_MF_PHYSIQUE_ALCOHOL, 'alcohol', $physique->getVar('alcohol'));
		$formobj['alcohol']->setDescription(_SXY_MF_PHYSIQUE_ALCOHOL_DESC);
						
		$formobj['actions'] = new XoopsFormCheckboxPhysiqueActions(_SXY_MF_PHYSIQUE_ACTIONS, 'actions', $physique->getVar('actions'));
		$formobj['actions']->setDescription(_SXY_MF_PHYSIQUE_ACTIONS_DESC);

		$formobj['services'] = new XoopsFormCheckboxPhysiqueServices(_SXY_MF_PHYSIQUE_SERVICES, 'services', $physique->getVar('services'));
		$formobj['services']->setDescription(_SXY_MF_PHYSIQUE_SERVICES_DESC);
												
		$formobj['pid'] = new XoopsFormHidden('pid', $physique->getVar('pid'));
		$formobj['phyid'] = new XoopsFormHidden('phyid', $physique->getVar('id'));		
		$formobj['op'] = new XoopsFormHidden('op', 'save');
		$formobj['fct'] = new XoopsFormHidden('fct', 'physique');
		$formobj['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($formobj as $id => $obj)			
			$sform->addElement($formobj[$id]);	
			
		return $sform->render();
	}

	function sexyAdminCreateShow($sid=0) {
		$show_handler =& xoops_getmodulehandler('show', 'sexy');
		
		if ($sid>0)	
			$show = $show_handler->get($sid);
		else 
			$show = $show_handler->create();

		if ($sid>0)
			$sform = new XoopsThemeForm(_SXY_FRM_EDITSHOW, 'show', $_SERVER['REQUEST_URI'], 'post');
		else
			$sform = new XoopsThemeForm(_SXY_FRM_NEWSHOW, 'show', $_SERVER['REQUEST_URI'], 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	

		$formobj = array();
		
		$formobj['name'] = new XoopsFormText(_SXY_MF_SHOWNAME, 'name', 30, 128, $show->getVar('name'));
		$formobj['name']->setDescription(_SXY_MF_SHOWNAME_DESC);

		$formobj['pid'] = new XoopsFormSelectPerson(_SXY_MF_PID, 'pid', $show->getVar('pid'));
		$formobj['pid']->setDescription(_SXY_MF_PID_DESC);

		$formobj['amount'] = new XoopsFormText(_SXY_MF_AMOUNT, 'amount', 11, 11, $show->getVar('amount'));
		$formobj['amount']->setDescription(_SXY_MF_AMOUNT_DESC);
		
		$formobj['prebook'] = new XoopsFormSelectYN(_SXY_MF_PREBOOK, 'prebook', $show->getVar('prebook'));
		$formobj['prebook']->setDescription(_SXY_MF_PREBOOK_DESC);
		
		$formobj['discount'] = new XoopsFormSelectYN(_SXY_MF_DISCOUNT, 'discount', $show->getVar('discount'));
		$formobj['discount']->setDescription(_SXY_MF_DISCOUNT_DESC);
		
		$formobj['percentage'] = new XoopsFormText(_SXY_MF_PERCENTAGE, 'percentage', 10, 10, $show->getVar('percentage'));		
		$formobj['percentage']->setDescription(_SXY_MF_PERCENTAGE_DESC);
		
		$formobj['when'] = new XoopsFormDateTime(_SXY_MF_WHEN, 'when', 15, $show->getVar('when'));
		$formobj['when']->setDescription(_SXY_MF_WHEN_DESC);

		$formobj['op'] = new XoopsFormHidden('op', 'save');
		$formobj['fct'] = new XoopsFormHidden('fct', 'show');
		$formobj['fct'] = new XoopsFormHidden('sid', $sid);
		
		$formobj['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($formobj as $id => $obj)			
			$sform->addElement($formobj[$id]);	
			
		return $sform->render();
		
	}
	
	function sexyProfileForm($pid)
	{
		
		$profile_handler =& xoops_getmodulehandler('profile', 'sexy');
		if ($pid>0)	
			$profile = $profile_handler->get($pid);
		else 
			$profile = $profile_handler->create();

		if ($pid>0)
			$sform = new XoopsThemeForm(_SXY_FRM_EDITPROFILE, 'profile', $_SERVER['REQUEST_URI'], 'post');
		else
			$sform = new XoopsThemeForm(_SXY_FRM_NEWPROFILE, 'profile', $_SERVER['REQUEST_URI'], 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	

		$formobj = array();
		$formobj['alias'] = new XoopsFormText(_SXY_MF_ALIAS, 'alias', 30, 128, $profile->getVar('alias'));
		$formobj['alias']->setDescription(_SXY_MF_ALIAS_DESC);
		
		$formobj['name'] = new XoopsFormText(_SXY_MF_NAME, 'name', 30, 128, $profile->getVar('name'));
		$formobj['name']->setDescription(_SXY_MF_NAME_DESC);

		$formobj['slogon'] = new XoopsFormText(_SXY_MF_SLOGON, 'slogon', 48, 48, $profile->getVar('slogon'));
		$formobj['slogon']->setDescription(_SXY_MF_SLOGON_DESC);

		$formobj['tags'] = new XoopsFormTag("tags", 60, 255, $pid);

		if ($GLOBALS['xoopsModuleConfig']['webcams']) {
			$formobj['bio'] = new XoopsFormTextArea(_SXY_MF_BIO, 'bio', $profile->getVar('bio'));
			$formobj['bio']->setDescription(_SXY_MF_BIO_DESC);
			
			$formobj['webcams'] = new XoopsFormSelectYN(_SXY_MF_WEBCAMS, 'webcam', $profile->getVar('webcam'));
			$formobj['webcams']->setDescription(_SXY_MF_WEBCAMS_DESC);
			if ($profile->getVar('approved')==false) {
				$formobj['webcams_username'] = new XoopsFormText(_SXY_MF_WEBCAMSUSERNAME, 'webcam_username', 30, 20, $profile->getVar('webcam_username'));
				$formobj['webcams_username']->setDescription(_SXY_MF_WEBCAMSUSERNAME_DESC);
			}
		} else {

			$editor_configs[3] = array();
			$editor_configs[3]['name'] = 'bio';
			$editor_configs[3]['value'] = $profile->getVar('bio');
			$editor_configs[3]['rows'] = $rows ? $rows : 35;
			$editor_configs[3]['cols'] = $cols ? $cols : 60;
			$editor_configs[3]['width'] = "190px";
			$editor_configs[3]['height'] = "400px";
			$editor_configs[3]['editor'] = $GLOBALS['xoopsModuleConfig']['editor'];
			
			$formobj['bio'] = new XoopsFormEditor(_SXY_MF_BIO, $editor_configs[3]['name'], $editor_configs[3]);
			$formobj['bio']->setDescription(_SXY_MF_BIO_DESC);
				
			$formobj['incall'] = new XoopsFormSelectYN(_SXY_MF_INCALL, 'incall', $profile->getVar('incall'));
			$formobj['incall']->setDescription(_SXY_MF_INCALL_DESC);
			$formobj['outcall'] = new XoopsFormSelectYN(_SXY_MF_OUTCALL, 'outcall', array($profile->getVar('outcall')));
			$formobj['outcall']->setDescription(_SXY_MF_OUTCALL_DESC);
					
			$formobj['sms'] = new XoopsFormText(_SXY_MF_SMS, 'sms', 22, 64, $profile->getVar('sms'));	
			$formobj['sms']->setDescription(_SXY_MF_SMS_DESC);
			
			$formobj['mobile'] = new XoopsFormText(_SXY_MF_MOBILE, 'mobile', 22, 64, $profile->getVar('mobile'));
			$formobj['mobile']->setDescription(_SXY_MF_MOBILE_DESC);
			
			
			$formobj['landline'] = new XoopsFormText(_SXY_MF_LANDLINE, 'landline', 22, 64, $profile->getVar('landline'));		
			$formobj['landline']->setDescription(_SXY_MF_LANDLINE_DESC);
	
			$formobj['agency'] = new XoopsFormSelectYN(_SXY_MF_AGENCY, 'agency', $profile->getVar('agency'));
			$formobj['agency']->setDescription(_SXY_MF_AGENCY_DESC);
				
		}
		$formobj['age'] = new XoopsFormText(_SXY_MF_AGE, 'age', 4, 64, $profile->getVar('age'));		
		$formobj['age']->setDescription(_SXY_MF_AGE_DESC);
		
		$formobj['sexuality'] = new XoopsFormSelectSexuality(_SXY_MF_SEXUALITY, 'sexuality', $profile->getVar('sexuality'));
		$formobj['sexuality']->setDescription(_SXY_MF_SEXUALITY_DESC);

		$editor_configs[0] = array();
		$editor_configs[0]['name'] = 'columnone';
		$editor_configs[0]['value'] = $profile->getVar('columnone');
		$editor_configs[0]['rows'] = $rows ? $rows : 35;
		$editor_configs[0]['cols'] = $cols ? $cols : 60;
		$editor_configs[0]['width'] = "190px";
		$editor_configs[0]['height'] = "400px";
		$editor_configs[0]['editor'] = $GLOBALS['xoopsModuleConfig']['editor'];
		
		$formobj['columnone'] = new XoopsFormEditor(_SXY_MF_LEFTCOLUMN, $editor_configs[0]['name'], $editor_configs[0]);
		$formobj['columnone']->setDescription(_SXY_MF_LEFTCOLUMN_DESC);

		$editor_configs[1] = array();
		$editor_configs[1]['name'] = 'columntwo';
		$editor_configs[1]['value'] = $profile->getVar('columntwo');
		$editor_configs[1]['rows'] = $rows ? $rows : 35;
		$editor_configs[1]['cols'] = $cols ? $cols : 60;
		$editor_configs[1]['width'] = "190px";
		$editor_configs[1]['height'] = "400px";
		$editor_configs[1]['editor'] = $GLOBALS['xoopsModuleConfig']['editor'];
		
		$formobj['columntwo'] = new XoopsFormEditor(_SXY_MF_RIGHTCOLUMN, $editor_configs[1]['name'], $editor_configs[1]);
		$formobj['columntwo']->setDescription(_SXY_MF_RIGHTCOLUMN_DESC);

		$editor_configs[2] = array();
		$editor_configs[2]['name'] = 'footer';
		$editor_configs[2]['value'] = $profile->getVar('footer');
		$editor_configs[2]['rows'] = $rows ? $rows : 35;
		$editor_configs[2]['cols'] = $cols ? $cols : 60;
		$editor_configs[2]['width'] = "190px";
		$editor_configs[2]['height'] = "400px";
		$editor_configs[2]['editor'] = $GLOBALS['xoopsModuleConfig']['editor'];
		
		$formobj['footer'] = new XoopsFormEditor(_SXY_MF_FOOTER, $editor_configs[2]['name'], $editor_configs[2]);
		$formobj['footer']->setDescription(_SXY_MF_FOOTER_DESC);

		$formobj['locations'] = new XoopsFormSelectLocation(_SXY_MF_LOCATIONS, 'locations', $profile->getVar('locations'), 15, true);
		$formobj['locations']->setDescription(_SXY_MF_LOCATIONS_DESC);
		
		if ($GLOBALS['xoopsModuleConfig']['multisite']) {
			$formobj['domains'] = new XoopsFormCheckBoxDomains(_SXY_MF_PROFILEDON, 'domains', $profile->getVar('domains'), '<br/>', false);
			$formobj['domains']->setDescription(_SXY_MF_PROFILEDON_DESC);
		} else {
			$formobj['domains'] = new XoopsFormHidden('domains[]', urlencode(XOOPS_URL));
		}
		
		$formobj['pid'] = new XoopsFormHidden('pid', $profile->getVar('pid'));
		$formobj['uid'] = new XoopsFormHidden('uid', $profile->getVar('uid'));
		$formobj['op'] = new XoopsFormHidden('op', 'save');
		$formobj['fct'] = new XoopsFormHidden('fct', 'profile');
		$formobj['host_id'] = new XoopsFormHidden('host_id', $_REQUEST['host_id']);
		$formobj['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($formobj as $id => $obj)			
			$sform->addElement($formobj[$id]);	
			
		return $sform->render();
	}

	function sexyUrlForm($id)
	{
		
		$urls_handler =& xoops_getmodulehandler('urls', 'sexy');
		if ($id>0)	
			$url = $urls_handler->get($id);
		else 
			$url = $urls_handler->create();

		if ($id>0)
			$sform = new XoopsThemeForm(_SXY_FRM_EDITURL, 'url', $_SERVER['REQUEST_URI'], 'post');
		else
			$sform = new XoopsThemeForm(_SXY_FRM_NEWURL, 'url', $_SERVER['REQUEST_URI'], 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	

		$formobj = array();
		$formobj['type'] = new XoopsFormSelectUrlType(_SXY_MF_TYPE, 'type', $url->getVar('type'));
		$formobj['type']->setDescription(_SXY_MF_TYPE_DESC);
		
		$formobj['other'] = new XoopsFormText(_SXY_MF_OTHER, 'other', 30, 255, $url->getVar('other'));
		$formobj['other']->setDescription(_SXY_MF_OTHER_DESC);
		
		$formobj['url'] = new XoopsFormText(_SXY_MF_URL, 'url', 60, 5000, $url->getVar('url'));
		$formobj['url']->setDescription(_SXY_MF_URL_DESC);
		
		$formobj['pid'] = new XoopsFormHidden('pid', ($url->getVar('pid')==0)?$_GET['pid']:$url->getVar('pid'));
		$formobj['urlid'] = new XoopsFormHidden('urlid', $id);

		$formobj['op'] = new XoopsFormHidden('op', 'save');
		$formobj['fct'] = new XoopsFormHidden('fct', 'url');
		$formobj['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($formobj as $id => $obj)			
			$sform->addElement($formobj[$id]);	
			
		return $sform->render();
	}

	function sexyPriceForm($id)
	{
		
		$prices_handler =& xoops_getmodulehandler('prices', 'sexy');
		if ($id>0)	
			$price = $prices_handler->get($id);
		else 
			$price = $prices_handler->create();

		if ($id>0)
			$sform = new XoopsThemeForm(_SXY_FRM_EDITPRICE, 'price', $_SERVER['REQUEST_URI'], 'post');
		else
			$sform = new XoopsThemeForm(_SXY_FRM_NEWPRICE, 'price', $_SERVER['REQUEST_URI'], 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	

		$formobj = array();
		$formobj['type'] = new XoopsFormSelectPriceType(_SXY_MF_PRICETYPE, 'type', $price->getVar('type'));
		$formobj['type']->setDescription(_SXY_MF_PRICETYPE_DESC);

		$formobj['day'] = new XoopsFormSelectPriceDay(_SXY_MF_DAY, 'day', $price->getVar('day'));
		$formobj['day']->setDescription(_SXY_MF_DAY_DESC);

		$formobj['time-start'] = new XoopsFormSelectPriceTime(_SXY_MF_TIMESTART, 'timestart', $price->getVar('time-start'));
		$formobj['time-start']->setDescription(_SXY_MF_TIMESTART_DESC);

		$formobj['time-end'] = new XoopsFormSelectPriceTime(_SXY_MF_TIMEEND, 'timeend', $price->getVar('time-end'));
		$formobj['time-end']->setDescription(_SXY_MF_TIMEEND_DESC);

		$formobj['event'] = new XoopsFormSelectPriceEvent(_SXY_MF_EVENT, 'event', $price->getVar('event'));
		$formobj['event']->setDescription(_SXY_MF_EVENT_DESC);

		$formobj['price'] = new XoopsFormText(_SXY_MF_PRICE, 'price', 10, 10, $price->getVar('price'));
		$formobj['price']->setDescription(_SXY_MF_PRICE_DESC);

		$formobj['currency'] = new XoopsFormSelectPriceCurrency(_SXY_MF_CURENCY, 'currency', $price->getVar('currency'));
		$formobj['currency']->setDescription(_SXY_MF_CURENCY_DESC);

		$editor_configs = array();
		$editor_configs['name'] = 'description';
		$editor_configs['value'] = $price->getVar('description');
		$editor_configs['rows'] = $rows ? $rows : 35;
		$editor_configs['cols'] = $cols ? $cols : 60;
		$editor_configs['width'] = "190px";
		$editor_configs['height'] = "400px";
		$editor_configs['editor'] = $GLOBALS['xoopsModuleConfig']['editor'];
		
		$formobj['description'] = new XoopsFormEditor(_SXY_DESCRIPTION, $editor_configs['name'], $editor_configs);
		
		$formobj['pid'] = new XoopsFormHidden('pid', ($price->getVar('pid')==0)?$_GET['pid']:$price->getVar('pid'));
		$formobj['priceid'] = new XoopsFormHidden('priceid', $id);

		$formobj['op'] = new XoopsFormHidden('op', 'save');
		$formobj['fct'] = new XoopsFormHidden('fct', 'price');
		$formobj['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($formobj as $id => $obj)			
			$sform->addElement($formobj[$id]);	
			
		return $sform->render();
	}


	function sexyPricesUser($pid) {

		$prices_handler =& xoops_getmodulehandler('prices', 'sexy');
		$criteria = new Criteria('pid', $pid);
		$criteria->setSort('type');
		$criteria->setOrder('ASC');
		
		$form = new XoopsThemeForm( _SXY_EDITABLEPRICES , "urls" , $_SERVER['REQUEST_URI'], 'post');
			
		$form->setExtra('enctype="multipart/form-data"');
		
		if ($ttl = $prices_handler->getCount($criteria)) {
			$start = isset($_GET['start'])?intval($_GET['start']):0;
			$limit = isset($_GET['limit'])?intval($_GET['limit']):24;
			$criteria->setStart($start);
			$criteria->setLimit($limit);
			$pgnav = new XoopsPageNav($ttl, $limit, $start, '&pid='.$_REQUEST['pid'].'&id='.$_REQUEST['id'].'&fct='.$_REQUEST['fct'].'&op='.$_REQUEST['op'].'&limit='.$_REQUEST['limit'].'&start');
			$ret = array('pagenav' => $pgnav->renderNav());
			
			if ($prices = $prices_handler->getObjects($criteria, true)) {
				foreach($prices as $id => $url) {
					$ele_tray[$id] = new XoopsFormElementTray('Edit Item: '. $id, '&nbsp;');
					$ele_tray[$id]->addElement(new XoopsFormLabel( '' , '<a href="'.XOOPS_URL.'/modules/sexy/edit.php?op=prices&fct=edit&priceid='.$id.'&pid='.$url->getVar('pid').'">'._EDIT.'</a>&nbsp;|&nbsp;<a href="'.XOOPS_URL.'/modules/sexy/edit.php?op=prices&fct=delete&priceid='.$id.'&pid='.$url->getVar('pid').'">'._DELETE.'</a>') );
					$ele_tray[$id]->setDescription('Type :'.$url->getVar('type'));
					$form->addElement($ele_tray[$id]);
				}
			}
		}
		$ret['form'] = $form->render();
		return $ret;
	}
	
	function sexyEditUploadPicture($pid=0, $id=0)
	{
	
		$pictures_handler =& xoops_getmodulehandler('pictures', 'sexy');
		if ($id>0)
			$picture = $pictures_handler->get($id);
		 else
			$picture = $pictures_handler->create();
			
		$form = new XoopsThemeForm( _SXY_PHOTOUPLOAD , "uploadphoto" , $_SERVER['REQUEST_URI'], 'post');
			
		$form->setExtra('enctype="multipart/form-data"');	
				
		$title_text = new XoopsFormText( _SXY_PHOTOTITLE , "title" , 50 , 255 , $picture->getVar('title') ) ;
			
		$editor_configs = array();
		$editor_configs['name'] = 'description';
		$editor_configs['value'] = $picture->getVar('description');
		$editor_configs['rows'] = $rows ? $rows : 35;
		$editor_configs['cols'] = $cols ? $cols : 60;
		$editor_configs['width'] = "190px";
		$editor_configs['height'] = "400px";
		$editor_configs['editor'] = $GLOBALS['xoopsModuleConfig']['editor'];
		
		$desc_tarea = new XoopsFormEditor(_SXY_PHOTODESC, $editor_configs['name'], $editor_configs);
		
		$file_form = new XoopsFormFile( _SXY_SELECTFILE , "photofile" , $myalbum_fsize ) ;
		$file_form->setExtra( "size='70'" ) ;
		

		$rotate_radio = new XoopsFormRadio( _SXY_RADIO_ROTATETITLE , 'rotate' , 'rot0' ) ;
		$rotate_radio->addOption( 'rot0' , _SXY_RADIO_ROTATE0." &nbsp; " ) ;
		$rotate_radio->addOption( 'rot90' , "<img src='images/icon_rotate90.gif' alt='"._SXY_RADIO_ROTATE90."' title='"._SXY_RADIO_ROTATE90."' /> &nbsp; " ) ;
		$rotate_radio->addOption( 'rot180' , "<img src='images/icon_rotate180.gif' alt='"._SXY_RADIO_ROTATE180."' title='"._SXY_RADIO_ROTATE180."' /> &nbsp; " ) ;
		$rotate_radio->addOption( 'rot270' , "<img src='images/icon_rotate270.gif' alt='"._SXY_RADIO_ROTATE270."' title='"._SXY_RADIO_ROTATE270."' /> &nbsp; " ) ;

		
		$op_hidden = new XoopsFormHidden( "op" , "save" ) ;
		$fct_hidden = new XoopsFormHidden( "fct" , "picture" ) ;
		$pid_hidden = new XoopsFormHidden( "pid" , $pid ) ;
		$id_hidden = new XoopsFormHidden( "id" , $id ) ;		
		
		$submit_button = new XoopsFormButton( "" , "submit" , _SUBMIT , "submit" ) ;
		$reset_button = new XoopsFormButton( "" , "reset" , _CANCEL , "reset" ) ;
		$submit_tray = new XoopsFormElementTray( '' ) ;
		$submit_tray->addElement( $submit_button ) ;
		$submit_tray->addElement( $reset_button ) ;
		
		$form->addElement( $title_text ) ;
		$form->addElement( $desc_tarea ) ;
		$form->addElement( $file_form ) ;
		$form->addElement( $rotate_radio ) ;
		$form->addElement( $op_hidden ) ;
		$form->addElement( $fct_hidden ) ;
		$form->addElement( $pid_hidden ) ;		
		$form->addElement( $id_hidden ) ;				
		$form->addElement( $submit_tray ) ;
	// $form->setRequired( $file_form ) ;

		return $form->render() ;
	}
	
	function sexyUploadPicture($pid=0)
	{
		$form = new XoopsThemeForm( _SXY_PHOTOUPLOAD , "uploadphoto" , $_SERVER['REQUEST_URI'], 'post');
			
		$form->setExtra('enctype="multipart/form-data"');	
				
		$title_text = new XoopsFormText( _SXY_PHOTOTITLE , "title" , 50 , 255 , $_POST['title'] ) ;
			
		$editor_configs = array();
		$editor_configs['name'] = 'description';
		$editor_configs['value'] = $_POST['description'];
		$editor_configs['rows'] = $rows ? $rows : 35;
		$editor_configs['cols'] = $cols ? $cols : 60;
		$editor_configs['width'] = "190px";
		$editor_configs['height'] = "400px";
		$editor_configs['editor'] = $GLOBALS['xoopsModuleConfig']['editor'];
		
		$desc_tarea = new XoopsFormEditor(_SXY_PHOTODESC, $editor_configs['name'], $editor_configs);
		
		$file_form = new XoopsFormFile( _SXY_SELECTFILE , "photofile" , $myalbum_fsize ) ;
		$file_form->setExtra( "size='70'" ) ;
		

		$rotate_radio = new XoopsFormRadio( _SXY_RADIO_ROTATETITLE , 'rotate' , 'rot0' ) ;
		$rotate_radio->addOption( 'rot0' , _SXY_RADIO_ROTATE0." &nbsp; " ) ;
		$rotate_radio->addOption( 'rot90' , "<img src='images/icon_rotate90.gif' alt='"._SXY_RADIO_ROTATE90."' title='"._SXY_RADIO_ROTATE90."' /> &nbsp; " ) ;
		$rotate_radio->addOption( 'rot180' , "<img src='images/icon_rotate180.gif' alt='"._SXY_RADIO_ROTATE180."' title='"._SXY_RADIO_ROTATE180."' /> &nbsp; " ) ;
		$rotate_radio->addOption( 'rot270' , "<img src='images/icon_rotate270.gif' alt='"._SXY_RADIO_ROTATE270."' title='"._SXY_RADIO_ROTATE270."' /> &nbsp; " ) ;

		
		$op_hidden = new XoopsFormHidden( "op" , "upload" ) ;
		$fct_hidden = new XoopsFormHidden( "fct" , "picture" ) ;
		$pid_hidden = new XoopsFormHidden( "pid" , $pid ) ;
		
		$submit_button = new XoopsFormButton( "" , "submit" , _SUBMIT , "submit" ) ;
		$reset_button = new XoopsFormButton( "" , "reset" , _CANCEL , "reset" ) ;
		$submit_tray = new XoopsFormElementTray( '' ) ;
		$submit_tray->addElement( $submit_button ) ;
		$submit_tray->addElement( $reset_button ) ;
		
		$form->addElement( $title_text ) ;
		$form->addElement( $desc_tarea ) ;
		$form->addElement( $file_form ) ;
		$form->addElement( $rotate_radio ) ;
		$form->addElement( $op_hidden ) ;
		$form->addElement( $fct_hidden ) ;
		$form->addElement( $pid_hidden ) ;		
		$form->addElement( $submit_tray ) ;
	// $form->setRequired( $file_form ) ;

		return $form->render() ;
	}
	

	function sexyURLSUser($pid) {

		$urls_handler =& xoops_getmodulehandler('urls', 'sexy');
		$criteria = new Criteria('pid', $pid);
		$criteria->setSort('type');
		$criteria->setOrder('ASC');
		
		$form = new XoopsThemeForm( _SXY_EDITABLEURLS , "urls" , $_SERVER['REQUEST_URI'], 'post');
			
		$form->setExtra('enctype="multipart/form-data"');
		
		if ($ttl = $urls_handler->getCount($criteria)) {
			$start = isset($_GET['start'])?intval($_GET['start']):0;
			$limit = isset($_GET['limit'])?intval($_GET['limit']):24;
			$criteria->setStart($start);
			$criteria->setLimit($limit);
			$pgnav = new XoopsPageNav($ttl, $limit, $start, '&pid='.$_REQUEST['pid'].'&id='.$_REQUEST['id'].'&fct='.$_REQUEST['fct'].'&op='.$_REQUEST['op'].'&limit='.$_REQUEST['limit'].'&start');
			$ret = array('pagenav' => $pgnav->renderNav());
			
			if ($urls = $urls_handler->getObjects($criteria, true)) {
				foreach($urls as $id => $url) {
					$ele_tray[$id] = new XoopsFormElementTray('Edit Item: '. $id, '&nbsp;');
					$ele_tray[$id]->addElement(new XoopsFormText( _SXY_URL , "url" , 50 , 255 , $url->getVar('url') ) );
					$ele_tray[$id]->addElement(new XoopsFormLabel( '' , '<a href="'.XOOPS_URL.'/modules/sexy/edit.php?op=urls&fct=edit&urlid='.$id.'&pid='.$url->getVar('pid').'">'._EDIT.'</a>&nbsp;|&nbsp;<a href="'.XOOPS_URL.'/modules/sexy/edit.php?op=urls&fct=delete&urlid='.$id.'&pid='.$url->getVar('pid').'">'._DELETE.'</a>') );
					$ele_tray[$id]->setDescription('Type :'.$url->getVar('type'));
					$form->addElement($ele_tray[$id]);
				}
			}
		}
		$ret['form'] = $form->render();
		return $ret;
	}
	
	function sexyPicturesUser($pid) {

		$pictures_handler =& xoops_getmodulehandler('pictures', 'sexy');
		$criteria = new Criteria('pid', $pid);

		if ($ttl = $pictures_handler->getCount($criteria)) {
			$start = isset($_GET['start'])?intval($_GET['start']):0;
			$limit = isset($_GET['limit'])?intval($_GET['limit']):24;
			$criteria->setStart($start);
			$criteria->setLimit($limit);
			$pgnav = new XoopsPageNav($ttl, $limit, $start, '&pid='.$_REQUEST['pid'].'&id='.$_REQUEST['id'].'&fct='.$_REQUEST['fct'].'&op='.$_REQUEST['op'].'&limit='.$_REQUEST['limit'].'&start');
			$ret = array('pagenav' => $pgnav->renderNav());
			$pictures = $pictures_handler->getObjects($criteria, true);
			if ($GLOBALS['xoopsModuleConfig']['thumbnail_rule']=='h')
				$ret['height']=$GLOBALS['xoopsModuleConfig']['thumbnail_size'].'px';
			else
				$ret['width=']=$GLOBALS['xoopsModuleConfig']['thumbnail_size'].'px';
				
			$ii=0;
			foreach($pictures as $id => $picture) {
				$ii++;
				$jj++;
				$ret['images'][$ii]['url'] = XOOPS_URL.'/modules/sexy/image,thumbnail,'.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).','.$id.'.'.$picture->getVar('extension');
				$ret['images'][$ii]['delete'] = XOOPS_URL .'/modules/sexy/edit.php?op=pictures&fct=delete&id='.$id.'&pid='.$pid;
				$ret['images'][$ii]['edit'] = XOOPS_URL.'/modules/sexy/edit.php?op=pictures&fct=edit&id='.$id.'&pid='.$pid;
				if ($jj==4) {
					$jj =0;
					$ret['images'][$ii]['newline'] = true;
				} else {
					$ret['images'][$ii]['newline'] = false;
				}
			}
			
			$ret['colspan']=4-$jj;
						
		}

		return $ret;
	}
	
	function sexyPicturesProfile($pid) {

		$pictures_handler =& xoops_getmodulehandler('pictures', 'sexy');
		$criteria = new Criteria('pid', $pid);
		if ($ttl = $pictures_handler->getCount($criteria)) {
			$pictures = $pictures_handler->getObjects($criteria, true);
			foreach($pictures as $id => $picture) {
				$ii++;
				$ret['images'][$ii]['id'] = md5($id);
				$ret['images'][$ii]['thumbnail'] = XOOPS_URL.'/modules/sexy/image,resample,'.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).',gallery_thumb,70,'.$id.'.'.$picture->getVar('extension');
				$ret['images'][$ii]['orginal'] = XOOPS_URL.'/modules/sexy/image,resample,'.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).',gallery_large,500,'.$id.'.'.$picture->getVar('extension');
				$ret['images'][$ii]['download'] = XOOPS_URL.'/modules/sexy/image,orginal,'.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).','.$id.'.'.$picture->getVar('extension');
				$ret['images'][$ii]['title'] = $picture->getVar('title');
				$ret['images'][$ii]['description'] = htmlspecialchars_decode($picture->getVar('description'));
			}
		}
		return $ret;
	}
	
	function sexyPicturesIndex($pid) {

		$profile_handler =& xoops_getmodulehandler('profile', 'sexy');
		$criteria = new CriteriaCompo(new Criteria('domains', '%'.urlencode(XOOPS_URL).'%', 'LIKE'));
		if (isset($GLOBALS['locationalcode']))
			$criteria->add(new Criteria('locations', '%'.$GLOBALS['locationalcode'].'%', 'LIKE'));
		$criteria->add(new Criteria('approved', true));
		$criteria->setOrder('DESC');
		$criteria->setSort('pid');
		
		if ($ttl = $profile_handler->getCount($criteria)) {
			$start = isset($_GET['start'])?intval($_GET['start']):0;
			$limit = isset($_GET['limit'])?intval($_GET['limit']):36;
			$criteria->setStart($start);
			$criteria->setLimit($limit);
			$pgnav = new XoopsPageNav($ttl, $limit, $start, 'start', (isset($_REQUEST['pid'])?'&pid='.$_REQUEST['pid']:'').(isset($_REQUEST['id'])?'&id='.$_REQUEST['id']:'').'&fct='.(isset($_REQUEST['fct'])?$_REQUEST['fct']:'default').'&op='.(isset($_REQUEST['op'])?$_REQUEST['op']:'default').'&limit='.(isset($_REQUEST['limit'])?$_REQUEST['limit']:'36'));
			$ret = array('pagenav' => $pgnav->renderNav());
			$profiles = $profile_handler->getObjects($criteria, true);
			if ($GLOBALS['xoopsModuleConfig']['thumbnail_rule']=='h')
				$ret['height']=$GLOBALS['xoopsModuleConfig']['thumbnail_size'].'px';
			else
				$ret['width=']=$GLOBALS['xoopsModuleConfig']['thumbnail_size'].'px';
				
			$ii=0;
			foreach($profiles as $id => $profile) {
				$ii++;
				$jj++;
				$ret['images'][$ii]['url'] = XOOPS_URL.'/modules/sexy/image,default,thumbnail,'.md5(XOOPS_LICENSE_KEY.date('Ymdhi')).','.$profile->getVar('pid').'.jpg';
				$ret['images'][$ii]['profile'] = XOOPS_URL .'/modules/sexy/index.php?op=profile&fct=profile&pid='.$profile->getVar('pid');
				$ret['images'][$ii]['alt'] = $profile->getVar('title');
				if ($jj==4) {
					$jj =0;
					$ret['images'][$ii]['newline'] = true;
				} else {
					$ret['images'][$ii]['newline'] = false;
				}
			}
			
			$ret['colspan']=4-$jj;
						
		}
		return $ret;
	}
?>
