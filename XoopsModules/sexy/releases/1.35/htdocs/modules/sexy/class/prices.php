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
class SexyPrices extends XoopsObject
{

    function SexyPrices($id = null)
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('pid', XOBJ_DTYPE_INT, null, true);
		$this->initVar('type', XOBJ_DTYPE_ENUM, null, false, false, false, array('Weekdays Day','Weekends Day','Weekday Evening','Weekend Evening','Weekday Night','Weekend Night','Morning Weekday','Morning Weekend'));
		$this->initVar('day', XOBJ_DTYPE_ENUM, null, false, false, false, array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'));
		$this->initVar('time-start', XOBJ_DTYPE_ENUM, null, false, false, false, array('00:01 TO 04:00','04:01 TO 08:00','08:01 TO 12:00','12:01 TO 16:00','20:01 TO 24:00','01:00 TO 08:00','08:01 TO 12:00','12:01 TO 24:00'));
		$this->initVar('time-end', XOBJ_DTYPE_ENUM, null, false, false, false, array('00:01 TO 04:00','04:01 TO 08:00','08:01 TO 12:00','12:01 TO 16:00','20:01 TO 24:00','01:00 TO 08:00','08:01 TO 12:00','12:01 TO 24:00'));
		$this->initVar('event', XOBJ_DTYPE_ENUM, null, false, false, false, array('Dining','Sexual Passion','Sports','Casual Date','Discreet Affair','One on One Sex','Group Sex','Party Affair','Swinging', 'Other'));
		$this->initVar('currency', XOBJ_DTYPE_ENUM, 'USD', false, false, false, array('AFN','EUR','ALL','DZD','USD','EUR','AOA','XCD','XCD','ARS','AMD','AWG','AUD','EUR','AZN','BSD','BHD','BDT','BBD','BYR','EUR','BZD','XOF','BMD','INR','BTN','BOB','BOV','BAM','BWP','NOK','BRL','USD','BND','BGN','XOF','BIF','KHR','XAF','CAD','CVE','KYD','XAF','XAF','CLP','CLF','CNY','AUD','AUD','COP','COU','KMF','XAF','CDF','NZD','CRC','XOF','HRK','CUP','CUC','EUR','CZK','DKK','DJF','XCD','DOP','USD','EGP','SVC','USD','XAF','ERN','EEK','ETB','FKP','DKK','FJD','EUR','EUR','EUR','XPF','EUR','XAF','GMD','GEL','EUR','GHS','GIP','EUR','DKK','XCD','EUR','USD','GTQ','GBP','GNF','GWP','XOF','GYD','HTG','USD','AUD','EUR','HNL','HKD','HUF','ISK','INR','IDR','IRR','IQD','EUR','ILS','EUR','JMD','JPY','GBP','JOD','KZT','KES','AUD','KPW','KRW','KWD','KGS','LAK','LVL','LBP','ZAR','LSL','LRD','LYD','CHF','LTL','EUR','MOP','MKD','MGA','MWK','MYR','MVR','XOF','EUR','USD','EUR','MRO','MUR','EUR','MXN','MXV','USD','MDL','EUR','MNT','EUR','XCD','MAD','MZN','MMK','ZAR','NAD','AUD','NPR','EUR','ANG','XPF','NZD','NIO','XOF','NGN','NZD','AUD','USD','NOK','OMR','PKR','USD','PAB','USD','PGK','PYG','PEN','PHP','NZD','PLN','EUR','USD','QAR','EUR','RON','RUB','RWF','EUR','SHP','XCD','XCD','EUR','EUR','XCD','WST','EUR','STD','SAR','XOF','RSD','SCR','SLL','SGD','EUR','EUR','SBD','SOS','ZAR','EUR','LKR','SDG','SRD','NOK','SZL','SEK','CHF','CHW','CHE','SYP','TWD','TJS','TZS','THB','USD','XOF','NZD','TOP','TTD','TND','TRY','TMT','USD','AUD','UGX','UAH','AED','GBP','USD','USS','USN','USD','UYU','UYI','UZS','VUV','VEF','VND','USD','USD','XPF','MAD','YER','ZMK','ZWL','XAU','XBA','XBB','XBC','XBD','XDR','XPD','XPT','XAG','XFU','XTS','XXX'));
		$this->initVar('description', XOBJ_DTYPE_TXTAREA, null, true, 5000);
        $this->initVar('price', XOBJ_DTYPE_DECIMAL, 0, true);
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
class SexyPricesHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_prices", 'SexyPrices', "id", "price");
    }
}

?>