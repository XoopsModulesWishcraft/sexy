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
	
    function toArray() {
    	$ret = parent::toArray();
    	$ret['number']['amount'] = number_format($this->getVar('amount'), 2);
    	$ret['number']['percentage'] = number_format($this->getVar('percentage'), 2);
    	$ret['number']['discount'] = number_format($this->getVar('amount')*($this->getVar('percentage')/100), 2);
    	$ret['number']['total'] = number_format($this->getVar('amount')-($this->getVar('amount')*($this->getVar('percentage')/100)), 2);
    	$ret['number']['grand'] = $this->getVar('amount')-($this->getVar('amount')*($this->getVar('percentage')/100));
    	$diff = $this->getVar('when') - time();
    	if ($diff>0) {
    		$diffcom = explode('.', $diff/3600);
    		$ret['time']['hours'] = $diffcom[0];
    		$ret['time']['minutes'] = floor(doubleval('0.'.$diffcom[1])*60);
    		if ($this->getVar('prebook')=='Yes'||$diff<(3600*1.5)) {
    			$ret['able_for_booking'] = true;
    		} else {
    			$ret['able_for_booking'] = false;
    		}
    	} else {
    		$ret['able_for_booking'] = false;
    	}
    	$ret['date']['when'] = date(_DATESTRING, $this->getVar('when'));
    	
    	$profile_handler =& xoops_getmodulehandler('profile', 'sexy');
		$profile = $profile_handler->get($this->getVar('pid'));
		foreach(explode(' ', $this->getVar('name') . ' ' . $profile->getVar('alias') . ' ' . $profile->getVar('pid') . ' ' . $this->getVar('sid')) as $strip) {
			$ret['cat'] .= strtoupper(substr($strip, 0, 1));
		}
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
class SexyShowHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_show", 'SexyShow', "sid", "name");
    }
    
    function existingUnpaidInvoice($sid, $pid, $uid, $user_id) {
    	$invoice_handler = xoops_getmodulehandler('invoice', 'xpayment');
    	$criteria = new Criteria('key', "$sid|$pid|$uid|$user_id");
    	if (!$invoice_handler->getCount($criteria))
    		return false;
    	$invoices = $invoice_handler->getObjects($criteria, false);
    	if (is_object($invoices[0]))
    		if ($invoices[0]->getVar('mode')=='UNPAID') 
    			return $invoices[0]->getURL();
    		else 
    			return false;
    	else 
    		return false;
    }
    
	function existingClosedInvoice($sid, $pid, $uid, $user_id) {
    	$invoice_handler = xoops_getmodulehandler('invoice', 'xpayment');
    	$criteria = new Criteria('key', "$sid|$pid|$uid|$user_id");
    	if (!$invoice_handler->getCount($criteria))
    		return false;
    	$invoices = $invoice_handler->getObjects($criteria, false);
    	if (is_object($invoices[0]))
    		if ($invoices[0]->getVar('mode')!='UNPAID') 
    			return true;
    		else 
    			return false;
    	else 
    		return false;
    }
}

?>