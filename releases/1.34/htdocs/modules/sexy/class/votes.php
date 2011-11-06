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
class SexyVotes extends XoopsObject
{

    function SexyVotes($id = null)
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('pid', XOBJ_DTYPE_INT, null, true);
		$this->initVar('vote', XOBJ_DTYPE_FLOAT, 0, false);
        $this->initVar('ip', XOBJ_DTYPE_TXTBOX, null, true, 64);
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
class SexyVotesHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_votes", 'SexyVotes', "id", "ip");
    }
}

?>