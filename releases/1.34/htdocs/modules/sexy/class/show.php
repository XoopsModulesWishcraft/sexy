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
class SexyShow extends XoopsObject
{

    function SexyShow($id = null)
    {
        $this->initVar('sid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('pid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('name', XOBJ_DTYPE_TXTBOX, null, false, 128);
        $this->initVar('amount', XOBJ_DTYPE_DECIMAL, null, false);
		$this->initVar('prebook', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, array('Yes','No'));
        $this->initVar('discount', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, array('Yes','No'));
		$this->initVar('percentage', XOBJ_DTYPE_DECIMAL, 0, false);		
		$this->initVar('when', XOBJ_DTYPE_INT, time(), false, 64);
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
class SexyShowHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_show", 'SexyShow', "sid", "name");
    }
}

?>