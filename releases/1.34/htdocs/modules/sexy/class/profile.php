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
class SexyProfile extends XoopsObject
{

    function SexyProfile($id = null)
    {
        $this->initVar('pid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('approved', XOBJ_DTYPE_INT, null, true);
        $this->initVar('uid', XOBJ_DTYPE_INT, null, true);
        $this->initVar('host_id', XOBJ_DTYPE_INT, null, true);
		$this->initVar('alias', XOBJ_DTYPE_TXTBOX, null, true, 128);
        $this->initVar('name', XOBJ_DTYPE_TXTBOX, null, true, 128);
        $this->initVar('user', XOBJ_DTYPE_TXTBOX, null, true, 20);
		$this->initVar('webcam', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, array('Yes','No'));
        $this->initVar('incall', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, array('Yes','No'));
		$this->initVar('outcall', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, array('Yes','No'));		
		$this->initVar('sms', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('mobile', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('landline', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('agency', XOBJ_DTYPE_ENUM, 'Yes', false, false, false, array('Yes','No'));
		$this->initVar('age', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('sexuality', XOBJ_DTYPE_ENUM, null, false, false, false, array('Hetrosexual','Bisexual','Homosexual'));		
		$this->initVar('domains', XOBJ_DTYPE_ARRAY, array(0=>urlencode(XOOPS_URL)));
		$this->initVar('locations', XOBJ_DTYPE_ARRAY, array());	
		$this->initVar('tags', XOBJ_DTYPE_TXTBOX, null, false, 255);	
		$this->initVar('slogon', XOBJ_DTYPE_TXTBOX, null, false, 64);
		$this->initVar('bio', XOBJ_DTYPE_OTHER, null, false);
		$this->initVar('columnone', XOBJ_DTYPE_OTHER, null, false);
		$this->initVar('columntwo', XOBJ_DTYPE_OTHER, null, false);
		$this->initVar('footer', XOBJ_DTYPE_OTHER, null, false);
    }
	
	function outputCardHTML ()
	{
		$ret .='<h2>'.$this->getVar('alias').' - Escort ('.$this->getVar('sexuality'). ') - '.$this->getVar('age').' years</h2>';
       	$ret .='<h3>Contact Details</h2>';
        $ret .='<ul style="list-style:square;">';
        $ret .='<li><strong>Incall:</strong>&nbsp;'.$this->getVar('incall').'</li>';
        $ret .='<li><strong>Outcall:</strong>&nbsp;'.$this->getVar('outcall').'</li>';
		$ret .='<li><strong>SMS:</strong>&nbsp;'.$this->getVar('sms').'</li>';
        $ret .='<li><strong>Mobile:</strong>&nbsp;'.$this->getVar('mobile').'</li>';
        $ret .='<li><strong>Landline:</strong>&nbsp;'.$this->getVar('landline').'</li>';
        $ret .='</ul>';
		return $ret;
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
class SexyProfileHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_profile", 'SexyProfile', "pid", "alias");
    }
    
    function insert($object, $force=true) {
    	$module_handler =& xoops_gethandler( 'module' );
		$config_handler =& xoops_gethandler( 'config' );
		$xoModule =& $module_handler->getByDirname('sexy');
		$xoModuleConfig = $config_handler->getConfigsByCat(0, $xoModule->getVar('mid'));

		if ($object->var['approved']['changed']==true&&$xoModuleConfig['webcams']) {
			$host_handler = xoops_getmodulehandler('host', 'webcams');
			$host = $host_handler->get($object->getVar('host_id'));
			$host->setVar('user', $object->getVar('user'));
			if (is_object($host)) {
				if ($object->getVar('approved')==true) {
					$host->setVar('status', 'approved');					
				} else {
					$host->setVar('status', 'closed');
				}
				$host_handler->insert($host, true);
			}	
		}
		
		return parent::insert($object, $force);
    }
}

?>