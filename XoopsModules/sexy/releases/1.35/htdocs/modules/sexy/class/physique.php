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
class SexyPhysique extends XoopsObject
{

    function SexyPhysique($id = null)
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('pid', XOBJ_DTYPE_INT, null, true);
		$this->initVar('race', XOBJ_DTYPE_ENUM, null, false, false, false, array('Native/Aboriginal','Caucasian','Africian','Latin','Asian','Other'));
		$this->initVar('height', XOBJ_DTYPE_ENUM, null, false, false, false, array('<5ft 0in / <152cm','5ft 0in / 152cm','5ft 1in / 155cm','5ft 2in / 157cm','5ft 3in / 160cm','5ft 4in / 162cm','5ft 5in / 165cm','5ft 6in / 167cm','5ft 7in / 170cm','5ft 8in / 172cm','5ft 9in / 175cm','5ft 10in / 177cm','5ft 11in / 180cm','6ft 0in / 183cm','6ft 1in / 186cm','6ft 2in / 188cm','6ft 3in / 190cm','6ft 4in / 193cm','6ft 5in / 195cm','6ft 6in / 198cm','>6ft 6in / >198cm'));
		$this->initVar('sex', XOBJ_DTYPE_ENUM, null, false, false, false, array('Male','Female','Transsexual'));
		$this->initVar('weight', XOBJ_DTYPE_ENUM, null, false, false, false, array('<99lbs / <45kg','100-109lbs / 45-49kg','110-119lbs / 49-53kg','120-129lbs / 54-58kg','130-139lbs / 59-62kg','140-149lbs / 63-67kg','150-159lbs / 68-71kg','160-169lbs / 72-76kg','170-179lbs / 77-80kg','180-189lbs / 81-85kg','190-199lbs / 86-89kg','200-209lbs / 90-95kg','210-219lbs / 96-99kg','220-229lbs / 100-105kg','230-239lbs / 106-110kg','240-249lbs / 111-115kg','250-259lbs / 116-120kg','260-269lbs / 121-125kg','270-279lbs / 126-130kg','>300lbs / >131kg'));
		$this->initVar('dresssize', XOBJ_DTYPE_ENUM, null, false, false, false, array('6','8','10','12','14','16','18','20','22','24','26','28'));
		$this->initVar('shirtsize', XOBJ_DTYPE_ENUM, null, false, false, false, array('14in / 36cm','14.5in / 37cm','15in / 38cm','15.5in / 39cm','16in / 41cm','16.5in / 42cm','17in / 43cm','17.5in / 44cm','18in / 45cm','18.5in / 46cm','19in / 48cm','19.5in / 50cm','20in / 51cm'));
		$this->initVar('pantssize', XOBJ_DTYPE_ENUM, null, false, false, false, array('28in / 71cm','29in / 73cm','30in / 76cm','31in / 79cm','32in / 81cm','33in / 84cm','34in / 86cm','35in / 89cm','36in / 91cm','37in / 94cm','38in / 97cm','39in / 99cm','40in / 101cm','41in / 104cm','42in / 107cm','43in / 109cm','44in / 112cm','45in / 114cm','46in / 117cm'));
		$this->initVar('bust', XOBJ_DTYPE_ENUM, null, false, false, false, array('A Cup','B Cup','C Cup','D Cup','E Cup','F Cup'));
		$this->initVar('hair', XOBJ_DTYPE_ENUM, null, false, false, false, array('Black Hair','Brown Hair','Auburn Hair','Red Hair','Blond Hair','Grey Hair','White Hair'));
		$this->initVar('eyes', XOBJ_DTYPE_ENUM, null, false, false, false, array('Amber Eyes','Blue Eyes','Brown Eyes','Gray Eyes','Green Eyes','Hazel Eyes','Red Eyes'));
		$this->initVar('bodyhair', XOBJ_DTYPE_ENUM, null, false, false, false, array('Smooth','Moderate','Hairy','Shaved','Waxed'));
		$this->initVar('penissize', XOBJ_DTYPE_ENUM, null, false, false, false, array('Under 5in / 11cm','5 - 7in / 12cm - 16cm','7 - 9in / 18 - 24cm','10 - 13in / 25 - 31cm','Over 13in / 33cm'));
		$this->initVar('foreskin', XOBJ_DTYPE_ENUM, null, false, false, false, array('Cut','Uncut'));
		$this->initVar('position', XOBJ_DTYPE_ENUM, null, false, false, false, array('Top','Bottom','Verastile','Active','Passive','Top & Bottom','Top & Active','Bottom & Active','Top & Passive','Bottom & Passive'));
		$this->initVar('physique', XOBJ_DTYPE_ENUM, null, false, false, false, array('Slim','Athletic','Muscular','Average','Bear','Heavy'));
		$this->initVar('piercings', XOBJ_DTYPE_ENUM, null, false, false, false, array('Yes','No'));
		$this->initVar('tattoos', XOBJ_DTYPE_ENUM, null, false, false, false, array('Yes','No'));
		$this->initVar('drugs', XOBJ_DTYPE_ENUM, null, false, false, false, array('Yes','No'));
		$this->initVar('smoking', XOBJ_DTYPE_ENUM, null, false, false, false, array('Yes','No'));
		$this->initVar('alcohol', XOBJ_DTYPE_ENUM, null, false, false, false, array('Yes','No'));
		$this->initVar('actions', XOBJ_DTYPE_ARRAY, null, false);		
		$this->initVar('services', XOBJ_DTYPE_ARRAY, null, false);
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
class SexyPhysiqueHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, "sexy_physique", 'SexyPhysique', "id", "services");
    }
}

?>