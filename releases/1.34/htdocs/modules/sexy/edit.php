<?php
	require('header.php');

	if (!is_object($GLOBALS["xoopsUser"])) {
		redirect_header('index.php', 7, _SXY_NEEDTOBELOGGEDIN);
		exit(0);
	}
	
	$profile_handler =& xoops_getmodulehandler('profile', 'sexy');
	$criteria = new CriteriaCompo(new Criteria('pid', $pid));
	$criteria->add(new Criteria('uid', $GLOBALS["xoopsUser"]->getVar('uid')));
	if (!$profile_handler->getCount($criteria))
	{
		redirect_header('index.php', 7, _SXY_DONOTOWNITEM);
		exit(0);
	}
	
	switch($op) {
	case "save":
		switch($fct){
		case "price":
		
			$prices_handler =& xoops_getmodulehandler('prices', 'sexy');
			if (intval($priceid)>0)
				$cost = $prices_handler->get($priceid);
			else
				$cost = $prices_handler->create();

			$cost->setVar('type', $type );
			$cost->setVar('day', $day );
			$cost->setVar('time-start', $timestart );
			$cost->setVar('time-end', $timeend );
			$cost->setVar('event', $event );
			$cost->setVar('currency', $currency );
			$cost->setVar('price', $price );
			$cost->setVar('description', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $description))) );
			$cost->setVar('pid', $pid );
			
			if ($prices_handler->insert($cost, true))
				redirect_header('edit.php?op=prices&pid='.$pid, 7, _SXY_DATASAVEDSUCCESSFULLY);
			else
				redirect_header('index.php', 7, _SXY_DATASAVEDUNSUCCESSFULLY);
		
			exit(0);
			break;
		case "url":
		
			$urls_handler =& xoops_getmodulehandler('urls', 'sexy');
			if (intval($urlid)>0)
				$ourl = $urls_handler->get($urlid);
			else
				$ourl = $urls_handler->create();

			$ourl->setVar('type', $type );
			$ourl->setVar('other', $other );
			$ourl->setVar('title', $title );
			$ourl->setVar('url', $url );
			$ourl->setVar('pid', $pid );
			
			if ($urls_handler->insert($ourl, true))
				redirect_header('edit.php?op=urls&pid='.$pid, 7, _SXY_DATASAVEDSUCCESSFULLY);
			else
				redirect_header('index.php', 7, _SXY_DATASAVEDUNSUCCESSFULLY);
		
			exit(0);
			break;
						
		case "profile":
			$profile_handler =& xoops_getmodulehandler('profile', 'sexy');

			if ($pid)
				$profile = $profile_handler->get($pid);
			else
				$profile = $profile_handler->create();
				
			$profile->setVar('alias', $alias );
			$profile->setVar('name', $name );
			if (isset($webcam_username))
				$profile->setVar('webcam_username', $webcam_username );
			$profile->setVar('webcam', $webcam );
			$profile->setVar('incall', $incall );
			$profile->setVar('outcall', $outcall );
			$profile->setVar('sms', $sms );
			$profile->setVar('mobile', $mobile );
			$profile->setVar('landline', $landline );
			$profile->setVar('agency', $agency );
			$profile->setVar('tags', $tags );
			$profile->setVar('age', $age );
			$profile->setVar('sexuality', $sexuality );
			$profile->setVar('domains', $domains );
			$profile->setVar('locations', $locations );
			$profile->setVar('slogon', $slogon );
			$profile->setVar('bio', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $bio))) );
			$profile->setVar('columnone', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $columnone))) );
			$profile->setVar('columntwo', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $columntwo))) );
			$profile->setVar('footer', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $footer))) );		
			$profile->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid') );

			if ($profile_handler->insert($profile, true)){
				$tag_handler = xoops_getmodulehandler('tag', 'tag');
				$tag_handler->updateByItem($tags, $profile->getVar('pid'), $xoopsModule->getVar("dirname"), $cid = 0);
				redirect_header('index.php', 7, _SXY_DATASAVEDSUCCESSFULLY);
			} else
				redirect_header('index.php', 7, _SXY_DATASAVEDUNSUCCESSFULLY);
		
			exit(0);
			break;
		case "physique":
			$physique_handler =& xoops_getmodulehandler('physique', 'sexy');

			if ($phyid)
				$physique = $physique_handler->get($phyid);
			else
				$physique = $physique_handler->create();
				
			$physique->setVar('pid', $pid );
			$physique->setVar('race', $race );
			$physique->setVar('height', $height );
			$physique->setVar('sex', $sex );
			$physique->setVar('weight', $weight );
			$physique->setVar('dresssize', $dresssize );
			$physique->setVar('shirtsize', $shirtsize );
			$physique->setVar('pantssize', $pantssize );
			$physique->setVar('bust', $bust );
			$physique->setVar('hair', $hair );
			$physique->setVar('eyes', $eyes );
			$physique->setVar('bodyhair', $bodyhair );
			$physique->setVar('penissize', $penissize );
			$physique->setVar('foreskin', $foreskin );
			$physique->setVar('position', $position );
			$physique->setVar('physique', $build );
			$physique->setVar('piercings', $piercings );
			$physique->setVar('tattoos', $tattoos );		
			$physique->setVar('drugs', $drugs );
			$physique->setVar('smoking', $smoking );		
			$physique->setVar('alcohol', $alcohol );
			$physique->setVar('actions', $actions );		
			$physique->setVar('services', $services );

			if ($physique_handler->insert($physique, true)){
				if ($_REQUEST['sexy_create']==true) {
					redirect_header('edit.php?op=pictures&pid='.$pid, 7, _SXY_DATASAVEDSUCCESSFULLY);
				} else {
					redirect_header('index.php', 7, _SXY_DATASAVEDSUCCESSFULLY);	
				}
			} else
				redirect_header('index.php', 7, _SXY_DATASAVEDUNSUCCESSFULLY);
		
			exit(0);
			break;

		case "picture":

			$picture_handler =& xoops_getmodulehandler('pictures', 'sexy');
			$picture = $picture_handler->get($id);			

			include_once( $GLOBALS['xoops']->path('/modules/sexy/class/myuploader.php') );
			
			$photo_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'orginal';
			$thumb_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'thumbnails';
			$path='';
			if (!is_dir($photo_dir))
				foreach(explode('/', $photo_dir) as $folder) {
					$path .= '/' . $folder;
					mkdir($path, 0777);
				}

			$path='';
			if (!is_dir($thumb_dir))
				foreach(explode('/', $thumb_dir) as $folder) {
					$path .= '/' . $folder;
					mkdir($path, 0777);
				}				
				
			// Check if upload file name specified
			$field = @$_POST["xoops_upload_file"][0] ;
			if( empty( $field ) || $field == "" ) {

			}
			$field = @$_POST['xoops_upload_file'][0] ;

			if( $_FILES[$field]['name'] == '' ) {
				// No photo uploaded
		
				if( trim( $title ) === "" ) {
					$title = 'no title' ;
				}
		
				$tmp_name = md5(time().rand(0,10000));
				
			} else if( $_FILES[$field]['tmp_name'] == "" ) {
				// Fail to upload (wrong file name etc.)
				redirect_header( 'edit.php?op=pictures&pid='.$pid , 2 , _SXY_FILEERROR ) ;
				exit ;
		
			} else {
				$uploader = new MyXoopsMediaUploader( $photo_dir , explode('|', $GLOBALS['xoopsModuleConfig']['allowed_mimetype']) , $GLOBALS['xoopsModuleConfig']['filesize_upload'] , null , null , explode('|', $GLOBALS['xoopsModuleConfig']['allowed_extensions']) ) ;
				
				$uploader->setPrefix( 'tmp_' . time() . '_' . $pid . '_' ) ;
				if( $uploader->fetchMedia( $field ) && $uploader->upload() ) {
					// Succeed to upload
		
					// The original file name will be the title if title is empty
					if( trim( $title ) === "" ) {
						$title = $uploader->getMediaName() ;
					}
		
					$tmp_name = $uploader->getSavedFileName() ;
					$date = time() ;
					$ext = substr( strrchr( $tmp_name , '.' ) , 1 ) ;
					$picture->setVar('extension', $ext);

					$picture->setVar('filename', md5($tmp_name).'.'.$ext);
					sexy_modify_photo_by_gd( "$photo_dir/$tmp_name" , "$photo_dir/".md5($tmp_name).".$ext" ) ;
					list( $width , $height , $type ) = getimagesize( "$photo_dir/".md5($tmp_name).".$ext" ) ;
					$picture->setVar('folder', $GLOBALS['xoopsModuleConfig']['upload_areas']);			
					$picture->setVar('width', $width);
					$picture->setVar('height', $height);
					@$picture_handler->insert($picture, true);			
		
					if( ! sexy_create_thumb_by_gd( "$photo_dir/".md5($tmp_name).".$ext" , $thumb_dir, md5($tmp_name) , $ext ) ) {
						redirect_header( 'edit.php?op=pictures&pid='.$pid , 2 , _SXY_ERRORCREATINGTHUMB) ;
						exit ;
					}

				} else {
					// Fail to upload (sizeover etc.)
					include(XOOPS_ROOT_PATH."/header.php");
		
					echo $uploader->getErrors();
					@unlink( $uploader->getSavedDestination() ) ;
		
					include( XOOPS_ROOT_PATH . "/footer.php" ) ;
					exit ;
				}
			}


			$picture->setVar('title', $title);
			$picture->setVar('description', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $description))) );
			@$picture_handler->insert($picture, true);			
			redirect_header( 'edit.php?op=pictures&pid='.$pid , 6 , _SXY_DATASAVEDSUCCESSFULLY) ;
			exit ;
		
			break;
		}
	case "upload":
		switch($fct){
		case "picture":
	
			include_once( $GLOBALS['xoops']->path('/modules/sexy/class/myuploader.php') );
			
			$photo_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'orginal';
			$thumb_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'thumbnails';
			$path='';
			if (!is_dir($photo_dir))
				foreach(explode('/', $photo_dir) as $folder) {
					$path .= '/' . $folder;
					mkdir($path, 0777);
				}

			$path='';
			if (!is_dir($thumb_dir))
				foreach(explode('/', $thumb_dir) as $folder) {
					$path .= '/' . $folder;
					mkdir($path, 0777);
				}				
				
			// Check if upload file name specified
			$field = @$_POST["xoops_upload_file"][0] ;
			if( empty( $field ) || $field == "" ) {
				die( "UPLOAD error: file name not specified" ) ;
			}
			$field = @$_POST['xoops_upload_file'][0] ;

			if( $_FILES[$field]['name'] == '' ) {
				// No photo uploaded
		
				if( trim( $title ) === "" ) {
					$title = 'no title' ;
				}
		
				$tmp_name = md5(time().rand(0,10000));
				
			} else if( $_FILES[$field]['tmp_name'] == "" ) {
				// Fail to upload (wrong file name etc.)
				redirect_header( 'edit.php?op=pictures&pid='.$pid , 2 , _SXY_FILEERROR ) ;
				exit ;
		
			} else {
				$uploader = new MyXoopsMediaUploader( $photo_dir , explode('|', $GLOBALS['xoopsModuleConfig']['allowed_mimetype']) , $GLOBALS['xoopsModuleConfig']['filesize_upload'] , null , null , explode('|', $GLOBALS['xoopsModuleConfig']['allowed_extensions']) ) ;
				
				$uploader->setPrefix( 'tmp_' . time() . '_' . $pid . '_' ) ;
				if( $uploader->fetchMedia( $field ) && $uploader->upload() ) {
					// Succeed to upload
		
					// The original file name will be the title if title is empty
					if( trim( $title ) === "" ) {
						$title = $uploader->getMediaName() ;
					}
		
					$tmp_name = $uploader->getSavedFileName() ;
		
				} else {
					// Fail to upload (sizeover etc.)
					include(XOOPS_ROOT_PATH."/header.php");
		
					echo $uploader->getErrors();
					@unlink( $uploader->getSavedDestination() ) ;
		
					include( XOOPS_ROOT_PATH . "/footer.php" ) ;
					exit ;
				}
			}

			if( ! is_readable( "$photo_dir/$tmp_name" ) ) {
				redirect_header( 'edit.php?op=pictures&pid='.$pid , 2 , _SXY_FILEREADERROR ) ;
				exit ;
			}

			$date = time() ;
			$ext = substr( strrchr( $tmp_name , '.' ) , 1 ) ;

			$picture_handler =& xoops_getmodulehandler('pictures', 'sexy');
			$picture = $picture_handler->create();			
			$picture->setVar('title', $title);
			$picture->setVar('pid', $pid);			
			$picture->setVar('description', str_replace('<br /><br />', '', str_replace('<p><br />', '<p>', str_replace('</p><br />', '</p>', $description))) );
			$picture->setVar('extension', $ext);
			$picture->setVar('filename', md5($tmp_name).'.'.$ext);
			$picture->setVar('folder', $GLOBALS['xoopsModuleConfig']['upload_areas']);			
			sexy_modify_photo_by_gd( "$photo_dir/$tmp_name" , "$photo_dir/".md5($tmp_name).".$ext" ) ;
			list( $width , $height , $type ) = getimagesize( "$photo_dir/".md5($tmp_name).".$ext" ) ;
			$picture->setVar('width', $width);
			$picture->setVar('height', $height);
			@$picture_handler->insert($picture, true);			

			if( ! sexy_create_thumb_by_gd( "$photo_dir/".md5($tmp_name).".$ext" , $thumb_dir, md5($tmp_name) , $ext ) ) {
				redirect_header( 'edit.php?op=pictures&pid='.$pid , 2 , _SXY_ERRORCREATINGTHUMB) ;
				exit ;
			}

			redirect_header( 'edit.php?op=pictures&pid='.$pid , 2 , _SXY_UPLOADALLOK) ;
			exit ;

			break;
		}
		break;
	case "urls":
		switch($fct){
		case "delete":
			if (empty($_POST['confirmed'])) {
				include_once $GLOBALS['xoops']->path('/header.php');
				xoops_confirm(array('confirmed' => true, 'urlid' => $urlid, 'pid' => $pid, 'op' => $op, 'fct' => $fct), $_SERVER['REQUEST_URI'], _SXY_CONFIRM_DELETEURL);
				include_once $GLOBALS['xoops']->path('/footer.php');				
				exit(0);
			}
			$sql = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix('sexy_urls').' WHERE `id` = "'.$urlid.'"';
			if ($GLOBALS['xoopsDB']->queryF($sql)) {
				redirect_header( 'edit.php?op=urls&pid='.$pid , 6 , _SXY_DATADELETEDSUCCESSFULLY) ;				
			} else {
				redirect_header( 'edit.php?op=urls&pid='.$pid , 6 , _SXY_DATADELETEDUNSUCCESSFULLY) ;				
			}
			break;
		case "edit":
			$xoopsOption['template_main'] = 'sexy_edit_url.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			$GLOBALS['xoopsTpl']->assign('form_url_edit', sexyUrlForm($urlid));	
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
		default:
			$xoopsOption['template_main'] = 'sexy_edit_urls.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			$GLOBALS['xoopsTpl']->assign('form_url_new', sexyUrlForm($id));	
			$GLOBALS['xoopsTpl']->assign('form_url_list', sexyURLSUser($pid));				
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
		}
		break;
	case "prices":
		switch($fct){
		case "delete":
			if (empty($_POST['confirmed'])) {
				include_once $GLOBALS['xoops']->path('/header.php');
				xoops_confirm(array('confirmed' => true, 'priceid' => $priceid, 'pid' => $pid, 'op' => $op, 'fct' => $fct), $_SERVER['REQUEST_URI'], _SXY_CONFIRM_DELETEPRICE);
				include_once $GLOBALS['xoops']->path('/footer.php');				
				exit(0);
			}
			$sql = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix('sexy_prices').' WHERE `id` = "'.$priceid.'"';
			if ($GLOBALS['xoopsDB']->queryF($sql)) {
				redirect_header( 'edit.php?op=urls&pid='.$pid , 6 , _SXY_DATADELETEDSUCCESSFULLY) ;				
			} else {
				redirect_header( 'edit.php?op=urls&pid='.$pid , 6 , _SXY_DATADELETEDUNSUCCESSFULLY) ;				
			}
			break;
		case "edit":
			$xoopsOption['template_main'] = 'sexy_edit_price.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			$GLOBALS['xoopsTpl']->assign('form_price_edit', sexyPriceForm($priceid));	
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
		default:

			$xoopsOption['template_main'] = 'sexy_edit_prices.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			$GLOBALS['xoopsTpl']->assign('form_price_new', sexyPriceForm($priceid));	
			$GLOBALS['xoopsTpl']->assign('form_price_list', sexyPricesUser($pid));				
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
		}
		break;

	default:
	case "profile":	
		switch($fct){
		default:
			$xoopsOption['template_main'] = 'sexy_create_profile.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			$GLOBALS['xoopsTpl']->assign('profile_form', sexyProfileForm($pid));	
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
		}
	case "physique":	
		switch($fct){
		default:
			$xoopsOption['template_main'] = 'sexy_edit_physique.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			
			$physique_handler =& xoops_getmodulehandler('physique', 'sexy');
			$criteria = new Criteria('pid', $pid);
			if (@$physique_handler->getCount($criteria)==0)
				$GLOBALS['xoopsTpl']->assign('physique_form', sexyPhysiqueForm(0));	
			else {
				if ($physiques = $physique_handler->getObjects($criteria))
					$GLOBALS['xoopsTpl']->assign('physique_form', sexyPhysiqueForm($physiques[0]->getVar('id')));	
			}
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
		}		
	case "pictures":
		switch($fct){
		case "edit":
			$xoopsOption['template_main'] = 'sexy_edit_picture.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			$GLOBALS['xoopsTpl']->assign('image_upload_form', sexyEditUploadPicture($pid, $_GET['id']));	
			$GLOBALS['xoopsTpl']->assign('passkey', md5(XOOPS_LICENSE_KEY.date('Ymdhi')));
			$GLOBALS['xoopsTpl']->assign('id', $_GET['id']);	
			include_once $GLOBALS['xoops']->path('/footer.php');		
			exit(0);
		
		case "delete":
			if (empty($_POST['confirmed'])) {
				include_once $GLOBALS['xoops']->path('/header.php');
				xoops_confirm(array('confirmed' => true, 'picid' => $_GET['id'], 'pid' => $pid, 'op' => $op, 'fct' => $fct), $_SERVER['REQUEST_URI'], _SXY_CONFIRM_DELETEPICTURE);
				include_once $GLOBALS['xoops']->path('/footer.php');				
				exit(0);
			}
			
			$pictures_handler =& xoops_getmodulehandler('pictures', 'sexy');
			$picture = $pictures_handler->get($picid);

			unlink(XOOPS_ROOT_PATH.$picture->getVar('folder').'thumbnails/'.$picture->getVar('filename'));
			unlink(XOOPS_ROOT_PATH.$picture->getVar('folder').'orginal/'.$picture->getVar('filename'));
			unlink(XOOPS_ROOT_PATH.$picture->getVar('folder').'resample/gallery_large%%'.$picture->getVar('filename'));
			unlink(XOOPS_ROOT_PATH.$picture->getVar('folder').'resample/gallery_thumb%%'.$picture->getVar('filename'));
			
			$sql = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix('sexy_pictures').' WHERE `id` = "'.$picid.'"';
		
			if ($GLOBALS['xoopsDB']->queryF($sql)) {
				redirect_header( 'edit.php?op=pictures&pid='.$pid , 6 , _SXY_DATADELETEDSUCCESSFULLY) ;				
			} else {
				redirect_header( 'edit.php?op=pictures&pid='.$pid , 6 , _SXY_DATADELETEDUNSUCCESSFULLY) ;				
			}
			break;		
		default:
			$xoopsOption['template_main'] = 'sexy_edit_pictures.html';
			include_once $GLOBALS['xoops']->path('/header.php');
			$GLOBALS['xoopsTpl']->assign('image_upload_form', sexyUploadPicture($pid));	

			$return = sexyPicturesUser($pid);
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
		break;
	}
?>