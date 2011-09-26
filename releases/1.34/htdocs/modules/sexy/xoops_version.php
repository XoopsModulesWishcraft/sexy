<?php
/**
 * Private message module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code 
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         pm
 * @since           2.3.0
 * @author          Jan Pedersen
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id: xoops_version.php 2022 2008-08-31 02:07:17Z phppp $
 */
 
/**
 * This is a temporary solution for merging XOOPS 2.0 and 2.2 series
 * A thorough solution will be available in XOOPS 3.0
 *
 */

$modversion = array();
$modversion['name'] = _SXY_MI_NAME;
$modversion['version'] = 1.34;
$modversion['description'] = _SXY_MI_DESC;
$modversion['author'] = "Simon Roberts (simon@chronolabs.coop)";
$modversion['credits'] = "Horney People";
$modversion['license'] = "GPL";
$modversion['image'] = "images/sexy_slogo.png";
$modversion['dirname'] = "sexy";
$modversion['status'] = "stable";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/admin.php";
$modversion['adminmenu'] = "admin/menu.php";

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = "include/search.inc.php";
$modversion['search']['func'] = "sexy_search";

// Mysql file
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Table
$modversion['tables'][1] = "sexy_profile";
$modversion['tables'][2] = "sexy_pictures";
$modversion['tables'][3] = "sexy_urls";
$modversion['tables'][4] = "sexy_votes";
$modversion['tables'][5] = "sexy_prices";
$modversion['tables'][6] = "sexy_options";
$modversion['tables'][7] = "sexy_physique";
$modversion['tables'][8] = "sexy_show";
$modversion['tables'][9] = "sexy_show_notifications";
$modversion['tables'][10] = "sexy_oauth";

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['itemName'] = 'pid';
$modversion['comments']['pageName'] = 'index.php';

$modversion['hasMain'] = 1;

$module_handler =& xoops_gethandler('module');
$i=1;
if ($module_handler->getCount(new Criteria('dirname', 'sexy'))>0)
if (is_object($GLOBALS["xoopsUser"])) {

	$profile_handler =& xoops_getmodulehandler('profile', 'sexy');	
	if ($profile_handler->getCount(new Criteria('uid', $GLOBALS["xoopsUser"]->getVar('uid')))>0)			 	{
		$profiles = $profile_handler->getObjects(new Criteria('uid', $GLOBALS["xoopsUser"]->getVar('uid')), false);
		$modversion['sub'][$i]['name'] = _SXY_MD_MYPROFILE;
		$modversion['sub'][$i]['url'] = "index.php?op=profile&fct=profile&pid=".$profiles[0]->getVar('pid');
		$i++;
		$modversion['sub'][$i]['name'] = _SXY_MD_EDITPROFILE;
		$modversion['sub'][$i]['url'] = "edit.php?op=profile&pid=".$profiles[0]->getVar('pid');
		$i++;
		
		$modversion['sub'][$i]['name'] = _SXY_MD_EDITPHYSIQUE;
		$modversion['sub'][$i]['url'] = "edit.php?op=physique&pid=".$profiles[0]->getVar('pid');
		$i++;
				
		$modversion['sub'][$i]['name'] = _SXY_MD_EDITPICTURES;
		$modversion['sub'][$i]['url'] = "edit.php?op=pictures&pid=".$profiles[0]->getVar('pid');
		$i++;
		$modversion['sub'][$i]['name'] = _SXY_MD_EDITURLS;
		$modversion['sub'][$i]['url'] = "edit.php?op=urls&pid=".$profiles[0]->getVar('pid');
		$i++;
		$modversion['sub'][$i]['name'] = _SXY_MD_EDITPRICES;
		$modversion['sub'][$i]['url'] = "edit.php?op=prices&pid=".$profiles[0]->getVar('pid');
		$i++;
	} else {
		$modversion['sub'][$i]['name'] = _SXY_MD_CREATEPROFILE;
		$modversion['sub'][$i]['url'] = "create.php?op=profile";
		$i++;	
	}
}

// Templates
$modversion['templates'][1]['file'] = 'sexy_create_profile.html';
$modversion['templates'][1]['description'] = 'Create Profile Template (Form)';
$modversion['templates'][2]['file'] = 'sexy_index.html';
$modversion['templates'][2]['description'] = 'Escorts Index';
$modversion['templates'][3]['file'] = 'sexy_edit_pictures.html';
$modversion['templates'][3]['description'] = 'Escorts Picture Editing Index (Forms)';
$modversion['templates'][4]['file'] = 'sexy_edit_picture.html';
$modversion['templates'][4]['description'] = 'Escorts Picture Editing Index (Form)';
$modversion['templates'][5]['file'] = 'sexy_manage_form.html';
$modversion['templates'][5]['description'] = 'Escorts Picture Editing Table (Form)';
$modversion['templates'][6]['file'] = 'sexy_index_profile.html';
$modversion['templates'][6]['description'] = 'Escorts Index Profile';
$modversion['templates'][7]['file'] = 'sexy_edit_urls.html';
$modversion['templates'][7]['description'] = 'Escorts Edit URLS (Forms)';
$modversion['templates'][8]['file'] = 'sexy_edit_url.html';
$modversion['templates'][8]['description'] = 'Escorts Edit URL (Form)';
$modversion['templates'][9]['file'] = 'sexy_edit_prices.html';
$modversion['templates'][9]['description'] = 'Escorts Edit Prices (Forms)';
$modversion['templates'][10]['file'] = 'sexy_edit_price.html';
$modversion['templates'][10]['description'] = 'Escorts Edit Price (Form)';
$modversion['templates'][11]['file'] = 'sexy_edit_physique.html';
$modversion['templates'][11]['description'] = 'Escorts Edit Physique (Form)';
$modversion['templates'][12]['file'] = 'sexy_admin_edit_profile.html';
$modversion['templates'][12]['description'] = 'Escorts Edit (Admin)';
$modversion['templates'][13]['file'] = 'sexy_admin_edit_picture.html';
$modversion['templates'][13]['description'] = 'Escorts Edit (Admin)';
$modversion['templates'][14]['file'] = 'sexy_admin_edit_pictures.html';
$modversion['templates'][14]['description'] = 'Escorts Edit (Admin)';
$modversion['templates'][15]['file'] = 'sexy_admin_edit_url.html';
$modversion['templates'][15]['description'] = 'Escorts Edit (Admin)';
$modversion['templates'][16]['file'] = 'sexy_admin_edit_urls.html';
$modversion['templates'][16]['description'] = 'Escorts Edit (Admin)';
$modversion['templates'][17]['file'] = 'sexy_admin_sexy.html';
$modversion['templates'][17]['description'] = 'Escorts Edit (Admin)';
$modversion['templates'][18]['file'] = 'sexy_admin_edit_prices.html';
$modversion['templates'][18]['description'] = 'Escorts Edit (Admin)';
$modversion['templates'][19]['file'] = 'sexy_admin_edit_price.html';
$modversion['templates'][19]['description'] = 'Escorts Edit (Admin)';
$modversion['templates'][20]['file'] = 'sexy_admin_show.html';
$modversion['templates'][20]['description'] = 'Escorts Show List (Admin)';
$modversion['templates'][21]['file'] = 'sexy_admin_edit_show.html';
$modversion['templates'][21]['description'] = 'Escorts Edit (Admin)';

$i=1;
$modversion['blocks'][$i]['file'] = "sexy_block_shows.php";
$modversion['blocks'][$i]['name'] = 'Up and coming shows';
$modversion['blocks'][$i]['description'] = "Shows a block which has the current up and coming shows.";
$modversion['blocks'][$i]['show_func'] = "b_sexy_block_show_show";
$modversion['blocks'][$i]['edit_func'] = "b_sexy_block_show_edit";
$modversion['blocks'][$i]['options'] = "4|4";
$modversion['blocks'][$i]['template'] = 'sexy_block_show.html';

$i=1;
$modversion['config'][$i]['name'] = 'supported_areas';
$modversion['config'][$i]['title'] = "_SXY_MD_AREAS";
$modversion['config'][$i]['description'] = "_SXY_MD_AREAS_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'AU=Australia{SYD=Sydney|NWC=Newcastle|BRI=Brisbane|GLD=Gold Coast|ADL=Adelaide|MLB=Melbourne|PRT=Perth|DRW=Darwin|HBT=Hobart|CAN=Canberra/EU=Europe{AMS=Amsterdam|ALV=Andorra la Vella|ANK=Ankara|ATH=Athens|BEL=Belgrade|BER=Berlin|BEN=Bern|BRA=Bratislava|BRU=Brussels|BUC=Bucharest|BUD=Budapest|CHI=Chisinau|COP=Copenhagen|DUB=Dublin|HEL=Helsinki|KEV=Kiev|LIS=Lisbon|LJU=Ljubljana|LUX=Luxembourg|MAD=Madrid|MIN=Minsk|MON=Monaco|MOS=Moscow|CYP=Nicosia|NUU=Nuuk|OSL=Oslo|PAR=Paris|POD=Podgorica|PRA=Prague|REY=Reykjavik|RIG=Riga|ROM=Rome|SAN=San Marino|SAR=Sarajevo|SKO=Skopje|SOF=Sofia|STK=Stockholm|TAL=Tallinn|TIR=Tirana|VAD=Vaduz|VAL=Valletta|VIE=Vienna|VIL=Vilnius|WARWarsaw/US=USA{SEA=Seattle|POR=Portland|SAN=San Francisco|DEN=Denver|LAS=Las Vegas|SNT=Santa Fe|PHO=Phonenix|SND=San Diego|LOS=Los Angeles|MNP=Minneapolis|CHI=Chicago|KAN=Kansas City|STL=St. Louis|DAL=Dalas|AUS=Austin|HOU=Houston|SAT=San Antonio|NAS=Nashville|CHA=Charleston|ALT=Altanta|NEW=New Orleans|ORL=Orlando|MIA=Miami|DC=D.C.|PHI=Philadelphia|NYC=New York|PRO=Providence|BOS=Boston/CA=Canada{VAN=Vancouver|MON=Montreal|QUE=Quebec City|VIC=Victoria|CAL=Calgary|OTT=Ottawa|EDM=Edmonton|HAL=Halifax/CN=China{SHN=Shanghai|BEI=Beijing|HK=Hong Kong|TIA=Tianjin|WUH=Wuhan|GUA=Guangzhou|SHE=Shenzhen|SHY=Shenyang|CHO=Chongqing|NAN=Nanjing|HAR=Harbin|TAI=Taipei/UK=United Kingdom{BAT=Bath|BIR=Birmingham|BRA=Bradford|BAH=Brighton and Hove|BRI=Bristol|CAM=Cambridge|CAN=Canterbury|CAR=Carlisle|CHE=Chester|CHI=Chichester|COV=Coventry|DER=Derby|DUR=Durham|ELY=Ely|EXE=Exeter|GLO=Gloucester|HER=Hereford|KIN=Kingston upon Hull|LAN=Lancaster|LEE=Leeds|LEI=Leicester|LIC=Lichfield|LIN=Lincoln|LIV=Liverpool|LON=City of London|MAN=Manchester|NWC=Newcastle upon Tyne|NOR=Norwich|NOT=Nottingham|OXF=Oxford|PET=Peterborough|PLY=Plymouth|POR=Portsmouth|PRE=Preston|RIP=Ripon|SAL=Salford|SAL=Salisbury|SHE=Sheffield|SOU=Southampton|SAL=St Albans|SOT=Stoke-on-Trent|SUN=Sunderland|TRU=Truro|WAK=Wakefield|WEL=Wells|WES=Westminster|WIN=Winchester|WOL=Wolverhampton|WOR=Worcester/ASIA=Asia Pacific{AHM=Ahmedabad|DAV=Davao City|HCM=Ho Chi Minh City|JAI=Jaipur|NAG=Nagpur|PEN=Penang|MAL=Malaysia';
$i++;

$modversion['config'][$i]['name'] = 'physique_actions';
$modversion['config'][$i]['title'] = "_SXY_MD_PHYSIQUEACTIONS";
$modversion['config'][$i]['description'] = "_SXY_MD_PHYSIQUEACTIONS_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'SEX=Sex Interests{BDY=Body Contact|FOOT=Foot Play|KISS=Kissing|ORAL=Oral|ANAL=Anal|FETS=Fetish|ASK=Ask me';
$i++;

$modversion['config'][$i]['name'] = 'physique_services';
$modversion['config'][$i]['title'] = "_SXY_MD_PHYSIQUEACTIONS";
$modversion['config'][$i]['description'] = "_SXY_MD_PHYSIQUEACTIONS_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'SXY=Escort{SRD=Sexual|VIP=VIP|IND=Independent|PMP=Pimp/MAS=Massage{THR=Therapeutic|RLF=Relief/TV=Transsexual{TS=Transsexual/HSU=House{AGN=Agency Work|BRT=Brothel/DNC=Dancing{PRF=Performance|STP=Stripper/FLM=Film{PRN=Porn Star/BDSM=Bondage{FET=Fetishes|DCP=Dicipline';
$i++;

$modversion['config'][$i]['name'] = 'filesize_upload';
$modversion['config'][$i]['title'] = "_SXY_MD_FILESIZEUPLD";
$modversion['config'][$i]['description'] = "_SXY_MD_FILESIZEUPLD_DESC";
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '1950351';
$i++;

$modversion['config'][$i]['name'] = 'allowed_mimetype';
$modversion['config'][$i]['title'] = "_SXY_MD_ALLOWEDMIMETYPE";
$modversion['config'][$i]['description'] = "_SXY_MD_ALLOWEDMIMETYPE_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'image/gif|image/pjpeg|image/jpeg|image/x-png|image/png';
$i++;

$modversion['config'][$i]['name'] = 'allowed_extensions';
$modversion['config'][$i]['title'] = "_SXY_MD_ALLOWEDEXTENSIONS";
$modversion['config'][$i]['description'] = "_SXY_MD_ALLOWEDEXTENSIONS_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'gif|pjpeg|jpeg|jpg|png';
$i++;

$modversion['config'][$i]['name'] = 'upload_areas';
$modversion['config'][$i]['title'] = "_SXY_MD_UPLOADAREAS";
$modversion['config'][$i]['description'] = "_SXY_MD_UPLOADAREAS_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['options'] = array('/uploads/' => '/uploads/','/uploads/sexy/' => '/uploads/sexy/');
$modversion['config'][$i]['default'] = '/uploads/sexy/';
$i++;

$modversion['config'][$i] = array(
	'name'			=> 'thumbnail_size' ,
	'title'			=> '_SXY_MD_THUMBSIZE' ,
	'description'	=> '_SXY_MD_THUMBSIZE_DESC' ,
	'formtype'		=> 'textbox' ,
	'valuetype'		=> 'int' ,
	'default'		=> '140' ,
	'options'		=> array()
) ;

$i++;
$modversion['config'][$i] = array(
	'name'			=> 'thumbnail_rule' ,
	'title'			=> '_SXY_MD_THUMBRULE' ,
	'description'	=> '_SXY_MD_THUMBRULE_DESC' ,
	'formtype'		=> 'select' ,
	'valuetype'		=> 'text' ,
	'default'		=> 'w' ,
	'options'		=> array(
		'Calculate from Width' => 'w' , 'Calculate from Height' => 'h' , 'Calculate from Inside Box' => 'b' )
	);
	
	$i++;
$modversion['config'][$i]['name'] = 'watermark';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;

$i++;
$modversion['config'][$i]['name'] = 'watermark_trans';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_TRANSPARENCY";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_TRANSPARENCYDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '75';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_FONT";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_FONTDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_ROOT_PATH.'/uploads/sexy/watermarks/default.ttf';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_size';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_FONTSIZE";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_FONTSIZEDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '12';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_width';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_FONTWIDTH";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_FONTWIDTHDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '200';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_height';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_FONTHEIGHT";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_FONTHEIGHTDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '100';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_colour';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_FONTCOLOUR";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_FONTCOLOURDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '000000';

$i++;
$modversion['config'][$i]['name'] = 'watermark_font_angle';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_FONTANGLE";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_FONTANGLEDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '0';
$i++;
$modversion['config'][$i]['name'] = 'watermark_text';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_TEXT";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_TEXTDESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = $GLOBALS['xoopsConfig']['sitename'];

$i++;
$modversion['config'][$i]['name'] = 'watermark_image';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_IMAGE";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_IMAGEDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_ROOT_PATH.'/uploads/sexy/watermarks/default.png';

$i++;
$modversion['config'][$i]['name'] = 'watermark_position';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_POSITION";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_POSITIONDESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'BR';
$modversion['config'][$i]['options'] = array('Top Left' => 'TL', 'Top Right' => 'TR', 'Bottom Left' => 'BL', 'Bottom Right' => 'BR', 'Middle' => 'MD');

$i++;
$modversion['config'][$i]['name'] = 'watermark_mode';
$modversion['config'][$i]['title'] = "_SXY_WATERMARK_MODE";
$modversion['config'][$i]['description'] = "_SXY_WATERMARK_MODEDESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'image';
$modversion['config'][$i]['options'] = array('Image' => 'image', 'Text' => 'text');
$i++;
$modversion['config'][$i]['name'] = 'passkeyvalidfor';
$modversion['config'][$i]['title'] = "_SXY_PASSKEY_VALIDFOR";
$modversion['config'][$i]['description'] = "_SXY_PASSKEY_VALIDFORDESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 10;
$modversion['config'][$i]['options'] = array('2 minutes' => 2, '4 minutes' => 4, '6 minutes' => 6, '8 minutes' => 8, '10 minutes' => 10, '15 minutes' => 15, '20 minutes' => 20, '30 minutes' => 30, '1 Hour' => 60, '2 Hour' => 120, '4 Hour' => 240, '6 Hour' => 360, '8 Hour' => 480, '10 Hour' => 600);

xoops_load('XoopsEditorHandler');
$editor_handler = XoopsEditorHandler::getInstance();
foreach ($editor_handler->getList(false) as $id => $val)
	$options[$val] = $id;
	
$i++;
$modversion['config'][$i]['name'] = 'editor';
$modversion['config'][$i]['title'] = "_SXY_EDITOR";
$modversion['config'][$i]['description'] = "_SXY_EDITORDESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'tinymce';
$modversion['config'][$i]['options'] = $options;

$i++;
$modversion['config'][$i]['name'] = 'multisite';
$modversion['config'][$i]['title'] = "_SXY_MULTISITE";
$modversion['config'][$i]['description'] = "_SXY_MULTISITEDESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'webcams';
$modversion['config'][$i]['title'] = "_SXY_WEBCAMS";
$modversion['config'][$i]['description'] = "_SXY_WEBCAMSDESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'htaccess';
$modversion['config'][$i]['title'] = "_SXY_HTACCESS";
$modversion['config'][$i]['description'] = "_SXY_HTACCESSDESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'baseofurl';
$modversion['config'][$i]['title'] = "_SXY_HTACCESS_BASEOFURL";
$modversion['config'][$i]['description'] = "_SXY_HTACCESS_BASEOFURLDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'sexy';

$i++;
$modversion['config'][$i]['name'] = 'endofurl';
$modversion['config'][$i]['title'] = "_SXY_HTACCESS_ENDOFURL";
$modversion['config'][$i]['description'] = "_SXY_HTACCESS_ENDOFURLDESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '.html';

$i++;
$modversion['config'][$i]['name'] = 'root_tweeter';
$modversion['config'][$i]['title'] = "_SXY_ROOT_TWEETER";
$modversion['config'][$i]['description'] = "_SXY_ROOT_TWEETER_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'simonaroberts';

$i++;
$modversion['config'][$i]['name'] = 'consumer_key';
$modversion['config'][$i]['title'] = "_SXY_CONSUMER_KEY";
$modversion['config'][$i]['description'] = "_SXY_CONSUMER_KEY_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';

$i++;
$modversion['config'][$i]['name'] = 'consumer_secret';
$modversion['config'][$i]['title'] = "_SXY_CONSUMER_SECRET";
$modversion['config'][$i]['description'] = "_SXY_CONSUMER_SECRET_DESC";
$modversion['config'][$i]['formtype'] = 'password';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';

$i++;
$modversion['config'][$i]['name'] = 'request_url';
$modversion['config'][$i]['title'] = "_SXY_REQUEST_URL";
$modversion['config'][$i]['description'] = "_SXY_REQUEST_URL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'https://api.twitter.com/oauth/request_token';

$i++;
$modversion['config'][$i]['name'] = 'authorise_url';
$modversion['config'][$i]['title'] = "_SXY_AUTHORISE_URL";
$modversion['config'][$i]['description'] = "_SXY_AUTHORISE_URL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'https://api.twitter.com/oauth/authorize';

$i++;
$modversion['config'][$i]['name'] = 'access_token_url';
$modversion['config'][$i]['title'] = "_SXY_ACCESS_TOKEN_URL";
$modversion['config'][$i]['description'] = "_SXY_ACCESS_TOKEN_URL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'https://api.twitter.com/oauth/access_token';

$i++;
$modversion['config'][$i]['name'] = 'authenticate_url';
$modversion['config'][$i]['title'] = "_SXY_AUTHENTICATE_URL";
$modversion['config'][$i]['description'] = "_SXY_AUTHENTICATE_URL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'https://api.twitter.com/oauth/authenticate';

$i++;
$modversion['config'][$i]['name'] = 'callback_url';
$modversion['config'][$i]['title'] = "_SXY_CALLBACK_URL";
$modversion['config'][$i]['description'] = "_SXY_CALLBACK_URL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_URL.'/modules/twitterbomb/callback/';

$i++;
$modversion['config'][$i]['name'] = 'access_token';
$modversion['config'][$i]['title'] = "_SXY_ACCESS_TOKEN";
$modversion['config'][$i]['description'] = "_SXY_ACCESS_TOKEN_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';

$i++;
$modversion['config'][$i]['name'] = 'access_token_secret';
$modversion['config'][$i]['title'] = "_SXY_ACCESS_TOKEN_SECRET";
$modversion['config'][$i]['description'] = "_SXY_ACCESS_TOKEN_SECRET_DESC";
$modversion['config'][$i]['formtype'] = 'password';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '';

$i++;
$modversion['config'][$i]['name'] = 'crontype';
$modversion['config'][$i]['title'] = '_SXY_CRONTYPE';
$modversion['config'][$i]['description'] = '_SXY_CRONTYPE_DESC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'rss';
$modversion['config'][$i]['options'] = 	array(	_SXY_CRONTYPE_RSS => 'rss', 
												_SXY_CRONTYPE_PRELOADER => 'preloader', 
												_SXY_CRONTYPE_CRONTAB => 'crontab', 
												_SXY_CRONTYPE_SCHEDULER => 'scheduler'
										);

$i++;
$modversion['config'][$i]['name'] = 'interval_of_cron';
$modversion['config'][$i]['title'] = "_SXY_INTERVAL_OF_CRON";
$modversion['config'][$i]['description'] = "_SXY_INTERVAL_OF_CRON_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 60;


?>