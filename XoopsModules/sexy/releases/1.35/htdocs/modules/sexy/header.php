<?php

	require (dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR.'mainfile.php');
	
	include ($GLOBALS['xoops']->path('/modules/sexy/include/functions.php'));
	include ($GLOBALS['xoops']->path('/modules/sexy/include/sexy.formobjects.php'));
	include ($GLOBALS['xoops']->path('/modules/sexy/include/sexy.forms.php'));
	
	$op = !isset($_REQUEST['op'])?'default':strip_tags(trim($_REQUEST['op']));
	$fct = !isset($_REQUEST['fct'])?'default':strip_tags(trim($_REQUEST['fct']));
	$pid = !isset($_REQUEST['pid'])?0:intval(strip_tags(trim($_REQUEST['pid'])));
	$id = !isset($_REQUEST['id'])?0:intval(strip_tags(trim($_REQUEST['id'])));
	$sid = !isset($_REQUEST['sid'])?0:intval(strip_tags(trim($_REQUEST['sid'])));
	$snid = !isset($_REQUEST['snid'])?0:intval(strip_tags(trim($_REQUEST['snid'])));
	
	foreach($_GET as $id => $val)
		${$id} = $val;
		
	foreach($_POST as $id => $val)
		${$id} = $val;		

?>