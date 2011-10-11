<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

function xoops_module_update_sexy($module, $oldversion) {
	
	$sql=array();
	
	$sql[] = 'ALTER TABLE '.$GLOBALS['xoopsDB']->prefix('sexy_show_notifications') . ' ADD COLUMN `paid` int(2) DEFAULT \'0\'';
		
	foreach($sql as $question)
		if ($GLOBALS['xoopsDB']->queryF($question))
			xoops_error($question, 'Executed Successfully');

	return true;
}
?>