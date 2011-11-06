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
		$this->initVar('entered', XOBJ_DTYPE_INT, null, false);
    }

	function getURL() {
		$user_handler = xoops_gethandler('user');
		$user = $user_handler->get($this->getVar('uid'));
		return XOOPS_URL.'/modules/sexy/logmein.php?token='.md5(XOOPS_LICENSE_KEY.$user->getVar('uid').$user->getVar('pass')).'&snid='.$this->getVar('snid');
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
}

?>