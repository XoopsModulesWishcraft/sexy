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
class SexyOptions extends XoopsObject
{

    function SexyOptions($id = null)
    {
        $this->initVar('optn_id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('optn_pid', XOBJ_DTYPE_INT, null, true);
		$this->initVar('optn_name', XOBJ_DTYPE_TXTBOX, null, true, 128);
        $this->initVar('optn_value', XOBJ_DTYPE_OTHER, null, true, 5000);
		$this->initVar('optn_type', XOBJ_DTYPE_ENUM, 'varchar', false, false, false, array('int','decimal','varchar'));
		$this->initVar('optn_area', XOBJ_DTYPE_ENUM, null, false, false, false , array('pictures','prices','profile','urls','votes','options'));
		$this->initVar('optn_description', XOBJ_DTYPE_TXTBOX, null, false, 128);
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
class SexyOptionsHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_options", 'SexyOptions', "optn_id", "optn_name");
    }
}

?>