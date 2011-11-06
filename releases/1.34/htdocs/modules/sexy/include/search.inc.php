<?php
// $Id$
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License 2.0 as published by //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
//  Author: wishcraft (S.F.C., sales@chronolabs.org.au)                      //
//  URL: http://www.chronolabs.org.au/forums/X-Forum/0,17,0,0,100,0,DESC,0   //
//  Project: X-Forum 4                                                       //
//  ------------------------------------------------------------------------ //
if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}

function &escorts_search($queryarray, $andor, $limit, $offset, $userid)
{
	global $xoopsDB, $xoopsConfig, $myts, $xoopsUser;
	static $allowedForums, $xforumConfig;

	$uid = (is_object($xoopsUser)&&$xoopsUser->isactive())?$xoopsUser->getVar('uid'):0;

 	$sql = 'SELECT DISTINCT p.uid,p.pid, p.alias, p.age, p.sexuality';
    $sql .= '
            FROM '.$xoopsDB->prefix('escorts_profile').' p,
            '.$xoopsDB->prefix('escorts_pictures').' pt,
			'.$xoopsDB->prefix('escorts_prices').' pr';
    $sql .= ' WHERE pt.pid=p.pid AND pr.pid = p.pid';

    $isUser=false;
	if ( is_numeric($userid) && $userid != 0 ) {
		$sql .= " AND p.uid=".$userid." ";
    	$isUser=true;
	}else
    // TODO
    if (is_array($userid) && count($userid) > 0) {
		$userid = array_map('intval', $userid);
        $sql .= " AND p.uid IN (".implode(',', $userid).") ";
    	$isUser=true;
    }

	$count = count($queryarray);
	if ( is_array($queryarray) && $count > 0) {
	   $sql .= " AND (((pt.title LIKE '%$queryarray[0]%')";
	   for($i=1;$i<$count;$i++){
		   $sql .= " $andor ";
		   $sql .= "(pt.title LIKE '%$queryarray[$i]%')";
	   }
	   $sql .= ") ";
	   $sql .= " OR ((pt.description LIKE '%$queryarray[0]%')";
	   for($i=1;$i<$count;$i++){
		   $sql .= " $andor ";
		   $sql .= "(pt.description LIKE '%$queryarray[$i]%')";
	   }
	   $sql .= ") ";
	   $sql .= " OR ((pr.currency LIKE '%$queryarray[0]%')";
	   for($i=1;$i<$count;$i++){
		   $sql .= " $andor ";
		   $sql .= "(pr.currency LIKE '%$queryarray[$i]%')";
	   }
	   $sql .= ") ";
	   $sql .= " OR ((pr.description LIKE '%$queryarray[0]%')";
	   for($i=1;$i<$count;$i++){
		   $sql .= " $andor ";
		   $sql .= "(pr.description LIKE '%$queryarray[$i]%')";
	   }
	   $sql .= ") ";			   
	   $sql .= " OR ((p.age LIKE '%$queryarray[0]%')";
	   for($i=1;$i<$count;$i++){
		   $sql .= " $andor ";
		   $sql .= "(p.age LIKE '%$queryarray[$i]%')";
	   }
	   $sql .= ") ";			   
	   $sql .= " OR ((p.sexuality LIKE '%$queryarray[0]%')";
	   for($i=1;$i<$count;$i++){
		   $sql .= " $andor ";
		   $sql .= "(p.sexuality LIKE '%$queryarray[$i]%')";
	   }
	   $sql .= ") ";			   
	   $sql .= " OR ((p.alias LIKE '%$queryarray[0]%')";
	   for($i=1;$i<$count;$i++){
		   $sql .= " $andor ";
		   $sql .= "(p.alias LIKE '%$queryarray[$i]%')";
	   }
	   $sql .= ")) ";

	}

	$sql .= $subquery;
	$result = $xoopsDB->query($sql,$limit,$offset);
	$ret = array();
	$users = array();
	$i = 0;
 	while($myrow = $xoopsDB->fetchArray($result)){
        $ret[$i]['link'] = XOOPS_URL.'/escorts/'.xoops_sef($myrow['sexuality'])."/".xoops_sef(xoops_convert_decode($myrow['alias']))."/profile,".$myrow['pid'];
		$ret[$i]['title'] = xoops_convert_decode($myrow['alias']) . ' - '. $myrow['age'] . ' years (' . $myrow['sexuality'] . ')';
		$ret[$i]['time'] = time();
		$ret[$i]['uid'] = $myrow['uid'];
		$i++;
	}

	return $ret;
}
?>