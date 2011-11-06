<?php
/*
Module: Objects

Version: 1.88

Description: Object manager for WHMCS Billing

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Frilogg

License: See docs - End User Licence.pdf
*/
$adminmenu=array();
$i=1;
$adminmenu[$i]['title'] = _SXY_MI_MAININDEX;
$adminmenu[$i]['icon'] = "images/icons/mainindex.png";
$adminmenu[$i]['link'] = "admin/admin.php";
$i++;
$adminmenu[$i]['title'] = _SXY_MI_CREATESHOW;
$adminmenu[$i]['icon'] = "images/icons/createshow.png";
$adminmenu[$i]['link'] = "admin/admin.php?op=show&fct=create";
?>