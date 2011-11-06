<?php

	error_reporting(0);
	$filename = basename($_REQUEST['filename']);
	$op = $_REQUEST['op'];
	$id = intval($_REQUEST['id']);
	$pid = intval($_REQUEST['pid']);
	$key = $_REQUEST['key'];
	$passkey = $_REQUEST['passkey'];
	
	include('../../mainfile.php');
	include( $GLOBALS['xoops']->path('/modules/sexy/include/functions.php'));
	
	if (!sexy_checkpasskey($passkey)) { 
		echo 'Passkey Mismatch - '. date('Y-m-d h');
		exit(0);
	}
	
	error_reporting(0);
	
	$picture_handler =& xoops_getmodulehandler('pictures', 'sexy');
	
	if ($id>0) {
		$criteria = new Criteria('id', $id);
		$pictures = $picture_handler->getObjects($criteria);
		if (count($pictures)==0) {
			$filename = 'nopic.png';
			switch($op)
			{
			case "orginal":
				$image_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'orginal';
				break;		
			default:
			case "thumbnail":
				$image_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'thumbnails';
				break;
			case "resample":
				$image_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'resample';
				break;				
			}
		} else {
			switch($op)
			{
			case "orginal":
				$image_dir = XOOPS_ROOT_PATH . $pictures[0]->getVar('folder') . 'orginal';
				break;		
			default:
			case "thumbnail":
				$image_dir = XOOPS_ROOT_PATH . $pictures[0]->getVar('folder') . 'thumbnails';
				break;
			case "resample":
				$image_dir = XOOPS_ROOT_PATH . $pictures[0]->getVar('folder') . 'resample';
				break;
			}
			$filename = $pictures[0]->getVar('filename');
			$pictures[0]->setVar('hits', $pictures[0]->getVar('hits')+1);
			$picture_handler->insert($pictures[0], true);
		}
	} elseif ($pid>0) {
		$criteria = new Criteria('pid', $pid);
		$ttlpics = $picture_handler->getCount($criteria);
		$criteria->setStart(rand(0, $ttlpics-1));
		$criteria->setLimit(1);
		$pictures = $picture_handler->getObjects($criteria);
		if (count($pictures)!=1||$ttlpics==0) {
			$filename = 'nopic.png';
			switch($op)
			{
			case "orginal":
				$image_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'orginal';
				break;		
			default:
			case "thumbnail":
				$image_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'thumbnails';
				break;
			case "resample":
				$image_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'resample';
				break;				
			}
		} else {
			switch($op)
			{
			case "orginal":
				$image_dir = XOOPS_ROOT_PATH . $pictures[0]->getVar('folder') . 'orginal';
				break;		
			default:
			case "thumbnail":
				$image_dir = XOOPS_ROOT_PATH . $pictures[0]->getVar('folder') . 'thumbnails';
				break;
			case "resample":
				$image_dir = XOOPS_ROOT_PATH . $pictures[0]->getVar('folder') . 'resample';
				break;				
			}
			$filename = $pictures[0]->getVar('filename');
			$pictures[0]->setVar('hits', $pictures[0]->getVar('hits')+1);
			$picture_handler->insert($pictures[0], true);
		}	
	} else
		switch($op)
			{
			case "orginal":
				$image_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'orginal';
				break;		
			default:
			case "thumbnail":
				$image_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'thumbnails';
				break;
			case "resample":
				$image_dir = XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'resample';
				break;				
			}
	if ($op!='resample'){
		if (file_exists($image_dir . '/' . $filename))
			readfile($image_dir . '/' . $filename);
	} else {
		if (file_exists($image_dir . '/' . $key . '%%' . $filename))
			readfile($image_dir . '/' . $key . '%%' . $filename);
		else {
			$size = intval($_REQUEST['size']);
			sexy_resample_by_gd(XOOPS_ROOT_PATH . $GLOBALS['xoopsModuleConfig']['upload_areas'] . 'orginal/' . $filename, $image_dir, $size, $key . '%%' . $filename);
			if (file_exists($image_dir . '/' . $key . '%%' . $filename))
				readfile($image_dir . '/' . $key . '%%' . $filename);
		}			
	}		
	exit(0);
?>