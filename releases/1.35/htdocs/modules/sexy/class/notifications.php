<?php
// $Autho: wishcraft $

if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}
/**
 * Class for compunds
 * @author Simon Roberts <simon@xoops.org>
 * @copyright copyright (c) 2009-2003 XOOPS.org
 * @package kernel
 */
class SexyNotifications extends XoopsObject
{

    function SexyNotifications($id = null)
    {
        $this->initVar('snid', XOBJ_DTYPE_INT, null, false);
    	$this->initVar('sid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('pid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('uid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('user_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('amount', XOBJ_DTYPE_DECIMAL, null, false);
        $this->initVar('discount', XOBJ_DTYPE_DECIMAL, null, false);
        $this->initVar('name', XOBJ_DTYPE_TXTBOX, null, true, 128);
        $this->initVar('email', XOBJ_DTYPE_TXTBOX, null, true, 255);
        $this->initVar('twitter', XOBJ_DTYPE_TXTBOX, null, true, 64);
		$this->initVar('when', XOBJ_DTYPE_INT, null, false);
		$this->initVar('sent', XOBJ_DTYPE_INT, null, false);
		$this->initVar('paid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('entered', XOBJ_DTYPE_INT, null, false);
    }

	function getURL() {
		$user_handler = xoops_gethandler('user');
		$user = $user_handler->get($this->getVar('uid'));
		return XOOPS_URL.'/modules/sexy/logmein.php?token='.md5(XOOPS_LICENSE_KEY.$user->getVar('uid').$user->getVar('pass')).'&snid='.$this->getVar('snid');
    }
    
    function payWallet() {
    	if ($this->getVar('paid')==false) {
    		include_once $GLOBALS['xoops']->path('/modules/webcams/class/global.php');
			$GLOBALS['webcamsModule'] = $module_handler->getByDirname('webcams');
			$GLOBALS['webcamsModuleConfig'] = $config_handler->getConfigList($GLOBALS['webcamsModule']->getVar('mid'));
			
			$params = '&action=user_update';
			$params .= '&account_id='.$GLOBALS['webcamsModuleConfig']['account_id'];
			$params .= '&gateway_pass='.$GLOBALS['webcamsModuleConfig']['gateway_pass'];
			$params .= '&user_id='.$this->getVar('user_id');
			$params .= '&add_amount='.($this->getVar('amount')+$this->getVar('discount'));
			$result = sendPost($GLOBALS['webcamsModuleConfig']['gateway_ip'],$params,true);		//use ssl	
			
			$sql = "UPDATE `" . $GLOBALS['xoopsUser']->prefix('sexy_show_notifications') . '` SET `paid` = "1" WHERE `snid` = "' . $this->getVar('snid').'"';
			$GLOBALS['xoopsUser']->queryF($sql);
			$this->setVar('paid', true);
			return true;
    	}
    	return false;
    }
}


/**
* XOOPS policies handler class.
* This class is responsible for providing data access mechanisms to the data source
* of XOOPS user class objects.
*
* @author  Simon Roberts <simon@chronolabs.coop>
* @package kernel
*/
class SexyNotificationsHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_show_notifications", 'SexyNotifications', "snid", "name");
    }
    
    function getUserFromToken($token='') {
    	$sql = "SELECT `uid` FROM ".$GLOBALS['xoopsDB']->prefix('users')." WHERE md5(concat('".XOOPS_LICENSE_KEY."', `uid`, `pass`)) = '".$token."'";
    	if ($result = $GLOBALS['xoopsDB']->queryF($sql)){
    		list($uid) = $GLOBALS['xoopsDB']->fetchRow($result);
    	}
    	if ($uid<>0) {
    		$user_handler = xoops_gethandler('user');
    		return $user_handler->get($uid);
    	} 
    	return false;
    }
     
}

?>