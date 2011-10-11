<?php

	if (!function_exists('xoops_sef')) {
		function xoops_sef($datab, $char ='-')
		{
			$datab = urldecode(strtolower($datab));
			$datab = urlencode($datab);
			$datab = str_replace(urlencode('æ'),'ae',$datab);
			$datab = str_replace(urlencode('ø'),'oe',$datab);
			$datab = str_replace(urlencode('å'),'aa',$datab);
			$replacement_chars = array(' ', '|', '=', '\\', '+', '-', '_', '{', '}', ']', '[', '\'', '"', ';', ':', '?', '>', '<', '.', ',', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '`', '~', ' ', '', '¡', '¦', '§', '¨', '©', 'ª', '«', '¬', '®', '­', '¯', '°', '±', '²', '³', '´', 'µ', '¶', '·', '¸', '¹', 'º', '»', '¼', '½', '¾', '¿');
			$return_data = str_replace($replacement_chars,$char,urldecode($datab));
			#print $return_data."<BR><BR>";
			switch ($char) {
			default:
				return urldecode($return_data);
				break;
			case "-";
				return urlencode($return_data);
				break;
			}
		}
	}

	if (!function_exists("sexy_getuser_id")) {
		function sexy_getuser_id()
		{
			if (is_object($GLOBALS['xoopsUser']))
				$ret['uid'] = $GLOBALS['xoopsUser']->getVar('uid');
			else 
				$ret['uid'] = 0;
		
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
				$ret['ip']  = $_SERVER["HTTP_X_FORWARDED_FOR"];
				$ip = $_SERVER["HTTP_X_FORWARDED_FOR"].':'.$_SERVER["REMOTE_ADDR"];
				$net = gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
			} else { 
				$ret['ip']  =  $_SERVER["REMOTE_ADDR"];
				$ip = $_SERVER["REMOTE_ADDR"];
				$net = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
			}
			$ret['netbios'] = $net;
			
			$module_handler = xoops_gethandler('module');
			$config_handler = xoops_gethandler('config');
			$xoModule = $module_handler->getByDirname('sexy');
			$xoConfig = $config_handler->getConfigList($xoModule->getVar('mid'));
			
			$ret['md5'] = md5(XOOPS_LICENSE_KEY . $xoConfig['salt'] . $ret['ip'] . $ret['netbios'] . $ret['uid']);	
			return $ret;
		}
	}

	function sexy_checkpasskey($key) {
	
		$minseed = strtotime(date('Y-m-d h:i'));
		$diff = intval((intval($GLOBALS['xoopsModuleConfig']['passkeyvalidfor'])/2)*60);
		for($step=($minseed-$diff);$step<($minseed+$diff);$step++) 
			if ($key==md5(XOOPS_LICENSE_KEY.date('Ymdhi', $step)))
				return true;
		return false;
		
	}

	function sexy_LocationArray()
	{
		$ret = array();
		foreach(explode('/',$GLOBALS['xoopsModuleConfig']['supported_areas']) as $id => $countries){
			$data = explode('{',$countries);
			list($countrycode, $countryname) = explode('=', $data[0]);
			foreach(explode('|', $data[1]) as $id => $state) {
				list($statecode, $statename) = explode('=', $state);
				$ret[$statecode.'.'.$countrycode] = ucfirst($countryname) . ' - ' . ucfirst($statename);
			}
		}
		return $ret;
	}
	
	function sexy_ActionsArray()
	{
		$ret = array();
		foreach(explode('/',$GLOBALS['xoopsModuleConfig']['physique_actions']) as $id => $actions){
			$data = explode('{',$actions);
			list($code, $name) = explode('=', $data[0]);
			foreach(explode('|', $data[1]) as $id => $function) {
				list($scode, $sname) = explode('=', $function);
				$ret[$scode.'.'.$code] = ucfirst($name) . ' - ' . ucfirst($sname);
			}
		}
		return $ret;
	}
	
	function sexy_ServicesArray()
	{
		$ret = array();
		foreach(explode('/',$GLOBALS['xoopsModuleConfig']['physique_services']) as $id => $actions){
			$data = explode('{',$actions);
			list($code, $name) = explode('=', $data[0]);
			foreach(explode('|', $data[1]) as $id => $function) {
				list($scode, $sname) = explode('=', $function);
				$ret[$scode.'.'.$code] = ucfirst($name) . ' - ' . ucfirst($sname);
			}
		}
		return $ret;
	}
	
	function sexy_create_thumb_by_gd( $src_path , $thumbs_dir, $node , $ext )
	{	
		if (!$GLOBALS['xoopsModuleConfig']['wideimage']){
			copy($src_path, "$thumbs_dir/$node.$ext");
		} else {
			require_once $GLOBALS['xoops']->path('Frameworks/wideimage/WideImage.php');
			$resize = true;
	
			$img = WideImage::load($src_path);
			
			list( $new_w , $new_h ) = sexy_get_thumbnail_wh( $img->getWidth() , $img->getHeight() ) ;
			$result = $img->resize($new_w, $new_h, 'inside');
			$result->saveToFile("$thumbs_dir/$node.$ext");
		}
		return true;
	}
	
	function sexy_resample_by_gd( $src_path , $resample_dir, $thumb_width, $filename )
	{

		if (!$GLOBALS['xoopsModuleConfig']['wideimage']){
			copy($src_path, "$resample_dir/$filename");
		} else {
			require_once $GLOBALS['xoops']->path('Frameworks/wideimage/WideImage.php');
	
			$img = WideImage::load($src_path);
			
			$width = $img->getWidth();
			$height = $img->getHeight();
			
			$new_w=$thumb_width;
			$new_h=$height*($new_w/$width);		
	
			$result = $img->resize($new_w, $new_h, 'inside');
			$result->saveToFile("$resample_dir/$filename");

		}
		
		return true;
	}
	
	function sexy_get_thumbnail_wh( $width , $height )
	{

		global $xoopsModuleConfig;
	
		switch( $xoopsModuleConfig['thumbnail_rule'] ) {
			case 'w' :
				$new_w = $xoopsModuleConfig['thumbnail_size'] ;
				$scale = $width / $new_w ;
				$new_h = intval( round( $height / $scale ) ) ;
				break ;
			case 'h' :
				$new_h = $xoopsModuleConfig['thumbnail_size'] ;
				$scale = $height / $new_h ;
				$new_w = intval( round( $width / $scale ) ) ;
				break ;
			case 'b' :
				if( $width > $height ) {
					$new_w = $xoopsModuleConfig['thumbnail_size'] ;
					$scale = $width / $new_w ; 
					$new_h = intval( round( $height / $scale ) ) ;
				} else {
					$new_h = $xoopsModuleConfig['thumbnail_size'] ;
					$scale = $height / $new_h ; 
					$new_w = intval( round( $width / $scale ) ) ;
				}
				break ;
			default :
				$new_w = $xoopsModuleConfig['thumbnail_size'] ;
				$new_h = $xoopsModuleConfig['thumbnail_size'] ;
				break ;
		}
	
		return array( $new_w , $new_h ) ;
	}
	
	// Modifying Original Photo by GD
	function sexy_modify_photo_by_gd( $src_path , $dst_path )
	{
		if ($GLOBALS['xoopsModuleConfig']['wideimage']){
			require_once $GLOBALS['xoops']->path('Frameworks/wideimage/WideImage.php');
	
			if( ! is_readable( $src_path ) ) return 0 ;
	
			$img = WideImage::load($src_path);	
	
			if( isset( $_POST['rotate'] ) ) 
			switch( $_POST['rotate'] ) {
				case 'rot270' :
					if( ! isset( $dst_img ) || ! is_resource( $dst_img ) ) $dst_img = $src_img ;
					// patch for 4.3.1 bug
					$img = $img->rotate(270);
					break ;
				case 'rot180' :
					if( ! isset( $dst_img ) || ! is_resource( $dst_img ) ) $dst_img = $src_img ;
					$img = $img->rotate(180);
					break ;
				case 'rot90' :
					if( ! isset( $dst_img ) || ! is_resource( $dst_img ) ) $dst_img = $src_img ;
					$img = $img->rotate(90);
					break ;
				default :
				case 'rot0' :
					break ;
			}
			
			$width = $img->getWidth();
			$height = $img->getHeight();
		
			if ($GLOBALS['xoopsModuleConfig']['watermark']){
				switch($GLOBALS['xoopsModuleConfig']['watermark_mode']) {
				case 'text':
					$watermark = WideImage::createTrueColorImage ($GLOBALS['xoopsModuleConfig']['watermark_font_width'], $GLOBALS['xoopsModuleConfig']['watermark_font_height']); 				
					$fontage = new WideImage_Font_TTF($GLOBALS['xoopsModuleConfig']['watermark_font'], $GLOBALS['xoopsModuleConfig']['watermark_font_size'], $GLOBALS['xoopsModuleConfig']['watermark_font_colour']);
					$fontage->writeText($watermark, 4, 4, $GLOBALS['xoopsModuleConfig']['watermark_font_text'], $GLOBALS['xoopsModuleConfig']['watermark_font_angle']);
					break;
				case 'image':
				default:
					$watermark = WideImage::load($GLOBALS['xoopsModuleConfig']['watermark_image']); 				
					break;
				}
	
				$watermark_width = $watermark->getWidth();
				$watermark_height = $watermark->getHeight();
				switch($GLOBALS['xoopsModuleConfig']['watermark_position']) {
				case 'TL':
					$img = $img->merge($watermark, 10, 10, $GLOBALS['xoopsModuleConfig']['watermark_trans']); 				
					break;
				case 'TR':
					$img = $img->merge($watermark, $width-($watermark_width+10), 10, $GLOBALS['xoopsModuleConfig']['watermark_trans']); 				
					break;
				case 'BL':
					$img = $img->merge($watermark, 10, $height-($watermark_height+10), $GLOBALS['xoopsModuleConfig']['watermark_trans']); 				
					break;
				default:
				case 'BR':
					$img = $img->merge($watermark, ($width-($watermark_width+10)), ($height-($watermark_height+10)), $GLOBALS['xoopsModuleConfig']['watermark_trans']); 				
					break;
				case 'MD':
					$img = $img->merge($watermark, (($width/2)-($watermark_width/2)), ($height/2)-($watermark_height/2), $GLOBALS['xoopsModuleConfig']['watermark_trans']); 				
					break;
				}			
			}	
	
			
			$img->saveToFile("$dst_path");
		
		}
		
		if( ! is_readable( $dst_path ) ) {
			// didn't exec convert, rename it.
			@rename( $src_path , $dst_path ) ;
			return 2 ;
		} else {
			@unlink( $src_path ) ;
			return 1 ;
		}
	}

?>