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
class SexyUrls extends XoopsObject
{

    function SexyUrls($id = null)
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('pid', XOBJ_DTYPE_INT, null, true);
		$this->initVar('type', XOBJ_DTYPE_ENUM, null, false, false, false, array('link','blog','facebook','twitter','profile','bio','interest','personal','myspace','google','eworld','other'));
		$this->initVar('url', XOBJ_DTYPE_URL, null, false);
        $this->initVar('other', XOBJ_DTYPE_TXTBOX, null, false, 255);
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
class SexyUrlsHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_urls", 'SexyUrls', "id", "urls");
    }
}

?>