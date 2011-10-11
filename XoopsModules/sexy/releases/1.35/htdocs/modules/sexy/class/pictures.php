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
class SexyPictures extends XoopsObject
{

    function SexyPictures($id = null)
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('pid', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, null, true, 800);
		$this->initVar('description', XOBJ_DTYPE_TXTBOX, null, true, 5000);
		$this->initVar('width', XOBJ_DTYPE_INT, 0);
		$this->initVar('height', XOBJ_DTYPE_INT, 0);
		$this->initVar('extension', XOBJ_DTYPE_TXTBOX, 10);
		$this->initVar('filename', XOBJ_DTYPE_TXTBOX, null, true, 128);
        $this->initVar('hits', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('folder', XOBJ_DTYPE_ENUM, '/uploads/sexy/', false, false, false, array('/uploads','/uploads/sexy/'));
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
class SexyPicturesHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_pictures", 'SexyPictures', "id", "filename");
    }
}

?>