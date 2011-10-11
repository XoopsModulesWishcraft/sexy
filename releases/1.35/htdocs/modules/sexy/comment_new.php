<?php
//  ------------------------------------------------------------------------ //
// Author: Ben Brown                                                         //
// Site: http://xoops.thehandcoders.com                                      //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

include '../../mainfile.php';
$com_itemid = isset($_GET['com_itemid']) ? intval($_GET['com_itemid']) : 0;
if ($com_itemid > 0) {
	// Get link title
	$sql = "SELECT alias FROM " . $xoopsDB->prefix('sexy_profiles') . " WHERE pid=" . $com_itemid . "";
	$result = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($result);
    $com_replytitle = _RE.$row['alias'];
    include XOOPS_ROOT_PATH.'/include/comment_new.php';
}
?>
