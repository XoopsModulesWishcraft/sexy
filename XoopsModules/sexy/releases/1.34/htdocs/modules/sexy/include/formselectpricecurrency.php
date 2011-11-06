<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 *  Xoops Form Class Elements
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         class
 * @package         kernel
 * @subpackage      form
 * @author          Kazumi Ono <onokazu@xoops.org>
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @author          John Neill <catzwolf@xoops.org>
 * @version         $Id$
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');

xoops_load('XoopsFormElement');

/**
 * A select field
 *
 * @author 		Kazumi Ono <onokazu@xoops.org>
 * @author 		Taiwen Jiang <phppp@users.sourceforge.net>
 * @author 		John Neill <catzwolf@xoops.org>
 * @copyright   The XOOPS Project http://sourceforge.net/projects/xoops/
 * @package 	kernel
 * @subpackage 	form
 * @access 		public
 */
class XoopsFormSelectPriceCurrency extends XoopsFormElement
{
    /**
     * Options
     *
     * @var array
     * @access private
     */
    var $_options = array();

    /**
     * Allow multiple selections?
     *
     * @var bool
     * @access private
     */
    var $_multiple = false;

    /**
     * Number of rows. "1" makes a dropdown list.
     *
     * @var int
     * @access private
     */
    var $_size;

    /**
     * Pre-selcted values
     *
     * @var array
     * @access private
     */
    var $_value = array();

    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name "name" attribute
     * @param mixed $value Pre-selected value (or array of them).
     * @param int $size Number or rows. "1" makes a drop-down-list
     * @param bool $multiple Allow multiple selections?
     */
    function XoopsFormSelectPriceCurrency($caption, $name, $value = null, $size = 1, $multiple = false)
    {
        $this->setCaption($caption);
        $this->setName($name);
        $this->_multiple = $multiple;
        $this->_size = intval($size);
		$this->addOption('', '-----------');
		@$this->addOption('AFN', 'Afghani');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('ALL', 'Lek');
		@$this->addOption('DZD', 'Algerian Dinar');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('AOA', 'Kwanza');
		@$this->addOption('XCD', 'East Caribbean Dollar');
		@$this->addOption('XCD', 'East Caribbean Dollar');
		@$this->addOption('ARS', 'Argentine Peso');
		@$this->addOption('AMD', 'Armenian Dram');
		@$this->addOption('AWG', 'Aruban Guilder');
		@$this->addOption('AUD', 'Australian Dollar');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('AZN', 'Azerbaijanian Manat');
		@$this->addOption('BSD', 'Bahamian Dollar');
		@$this->addOption('BHD', 'Bahraini Dinar');
		@$this->addOption('BDT', 'Taka');
		@$this->addOption('BBD', 'Barbados Dollar');
		@$this->addOption('BYR', 'Belarussian Ruble');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('BZD', 'Belize Dollar');
		@$this->addOption('XOF', 'CFA Franc BCEAO †');
		@$this->addOption('BMD', 'Bermudian Dollar (customarily known as Bermuda Dollar)');
		@$this->addOption('INR', 'Indian Rupee');
		@$this->addOption('BTN', 'Ngultrum');
		@$this->addOption('BOB', 'Boliviano');
		@$this->addOption('BOV', 'Mvdol');
		@$this->addOption('BAM', 'Convertible Marks');
		@$this->addOption('BWP', 'Pula');
		@$this->addOption('NOK', 'Norwegian Krone');
		@$this->addOption('BRL', 'Brazilian Real');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('BND', 'Brunei Dollar');
		@$this->addOption('BGN', 'Bulgarian Lev');
		@$this->addOption('XOF', 'CFA Franc BCEAO †');
		@$this->addOption('BIF', 'Burundi Franc');
		@$this->addOption('KHR', 'Riel');
		@$this->addOption('XAF', 'CFA Franc BEAC ‡');
		@$this->addOption('CAD', 'Canadian Dollar');
		@$this->addOption('CVE', 'Cape Verde Escudo');
		@$this->addOption('KYD', 'Cayman Islands Dollar');
		@$this->addOption('XAF', 'CFA Franc BEAC ‡');
		@$this->addOption('XAF', 'CFA Franc BEAC ‡');
		@$this->addOption('CLP', 'Chilean Peso');
		@$this->addOption('CLF', 'Unidades de fomento');
		@$this->addOption('CNY', 'Yuan Renminbi');
		@$this->addOption('AUD', 'Australian Dollar');
		@$this->addOption('AUD', 'Australian Dollar');
		@$this->addOption('COP', 'Colombian Peso');
		@$this->addOption('COU', 'Unidad de Valor Real');
		@$this->addOption('KMF', 'Comoro Franc');
		@$this->addOption('XAF', 'CFA Franc BEAC ‡');
		@$this->addOption('CDF', 'Congolese Franc');
		@$this->addOption('NZD', 'New Zealand Dollar');
		@$this->addOption('CRC', 'Costa Rican Colon');
		@$this->addOption('XOF', 'CFA Franc BCEAO †');
		@$this->addOption('HRK', 'Croatian Kuna');
		@$this->addOption('CUP', 'Cuban Peso');
		@$this->addOption('CUC', 'Peso Convertible');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('CZK', 'Czech Koruna');
		@$this->addOption('DKK', 'Danish Krone');
		@$this->addOption('DJF', 'Djibouti Franc');
		@$this->addOption('XCD', 'East Caribbean Dollar');
		@$this->addOption('DOP', 'Dominican Peso');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('EGP', 'Egyptian Pound');
		@$this->addOption('SVC', 'El Salvador Colon');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('XAF', 'CFA Franc BEAC ‡');
		@$this->addOption('ERN', 'Nakfa');
		@$this->addOption('EEK', 'Kroon');
		@$this->addOption('ETB', 'Ethiopian Birr');
		@$this->addOption('FKP', 'Falkland Islands Pound');
		@$this->addOption('DKK', 'Danish Krone');
		@$this->addOption('FJD', 'Fiji Dollar');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('XPF', 'CFP Franc');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('XAF', 'CFA Franc BEAC ‡');
		@$this->addOption('GMD', 'Dalasi');
		@$this->addOption('GEL', 'Lari');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('GHS', 'Cedi');
		@$this->addOption('GIP', 'Gibraltar Pound');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('DKK', 'Danish Krone');
		@$this->addOption('XCD', 'East Caribbean Dollar');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('GTQ', 'Quetzal');
		@$this->addOption('GBP', 'Pound Sterling');
		@$this->addOption('GNF', 'Guinea Franc');
		@$this->addOption('GWP', 'Guinea-Bissau Peso');
		@$this->addOption('XOF', 'CFA Franc BCEAO †');
		@$this->addOption('GYD', 'Guyana Dollar');
		@$this->addOption('HTG', 'Gourde');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('AUD', 'Australian Dollar');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('HNL', 'Lempira');
		@$this->addOption('HKD', 'Hong Kong Dollar');
		@$this->addOption('HUF', 'Forint');
		@$this->addOption('ISK', 'Iceland Krona');
		@$this->addOption('INR', 'Indian Rupee');
		@$this->addOption('IDR', 'Rupiah');
		@$this->addOption('IRR', 'Iranian Rial');
		@$this->addOption('IQD', 'Iraqi Dinar');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('ILS', 'New Israeli Sheqel');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('JMD', 'Jamaican Dollar');
		@$this->addOption('JPY', 'Yen');
		@$this->addOption('GBP', 'Pound Sterling');
		@$this->addOption('JOD', 'Jordanian Dinar');
		@$this->addOption('KZT', 'Tenge');
		@$this->addOption('KES', 'Kenyan Shilling');
		@$this->addOption('AUD', 'Australian Dollar');
		@$this->addOption('KPW', 'North Korean Won');
		@$this->addOption('KRW', 'Won');
		@$this->addOption('KWD', 'Kuwaiti Dinar');
		@$this->addOption('KGS', 'Som');
		@$this->addOption('LAK', 'Kip');
		@$this->addOption('LVL', 'Latvian Lats');
		@$this->addOption('LBP', 'Lebanese Pound');
		@$this->addOption('ZAR', 'Rand');
		@$this->addOption('LSL', 'Loti');
		@$this->addOption('LRD', 'Liberian Dollar');
		@$this->addOption('LYD', 'Libyan Dinar');
		@$this->addOption('CHF', 'Swiss Franc');
		@$this->addOption('LTL', 'Lithuanian Litas');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('MOP', 'Pataca');
		@$this->addOption('MKD', 'Denar');
		@$this->addOption('MGA', 'Malagasy Ariary');
		@$this->addOption('MWK', 'Kwacha');
		@$this->addOption('MYR', 'Malaysian Ringgit');
		@$this->addOption('MVR', 'Rufiyaa');
		@$this->addOption('XOF', 'CFA Franc BCEAO †');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('MRO', 'Ouguiya');
		@$this->addOption('MUR', 'Mauritius Rupee');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('MXN', 'Mexican Peso');
		@$this->addOption('MXV', 'Mexican Unidad de Inversion (UDI)');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('MDL', 'Moldovan Leu');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('MNT', 'Tugrik');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('XCD', 'East Caribbean Dollar');
		@$this->addOption('MAD', 'Moroccan Dirham');
		@$this->addOption('MZN', 'Metical');
		@$this->addOption('MMK', 'Kyat');
		@$this->addOption('ZAR', 'Rand');
		@$this->addOption('NAD', 'Namibia Dollar');
		@$this->addOption('AUD', 'Australian Dollar');
		@$this->addOption('NPR', 'Nepalese Rupee');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('ANG', 'Netherlands Antillian Guilder');
		@$this->addOption('XPF', 'CFP Franc');
		@$this->addOption('NZD', 'New Zealand Dollar');
		@$this->addOption('NIO', 'Cordoba Oro');
		@$this->addOption('XOF', 'CFA Franc BCEAO †');
		@$this->addOption('NGN', 'Naira');
		@$this->addOption('NZD', 'New Zealand Dollar');
		@$this->addOption('AUD', 'Australian Dollar');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('NOK', 'Norwegian Krone');
		@$this->addOption('OMR', 'Rial Omani');
		@$this->addOption('PKR', 'Pakistan Rupee');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('PAB', 'Balboa');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('PGK', 'Kina');
		@$this->addOption('PYG', 'Guarani');
		@$this->addOption('PEN', 'Nuevo Sol');
		@$this->addOption('PHP', 'Philippine Peso');
		@$this->addOption('NZD', 'New Zealand Dollar');
		@$this->addOption('PLN', 'Zloty');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('QAR', 'Qatari Rial');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('RON', 'New Leu');
		@$this->addOption('RUB', 'Russian Ruble');
		@$this->addOption('RWF', 'Rwanda Franc');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('SHP', 'Saint Helena Pound');
		@$this->addOption('XCD', 'East Caribbean Dollar');
		@$this->addOption('XCD', 'East Caribbean Dollar');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('XCD', 'East Caribbean Dollar');
		@$this->addOption('WST', 'Tala');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('STD', 'Dobra');
		@$this->addOption('SAR', 'Saudi Riyal');
		@$this->addOption('XOF', 'CFA Franc BCEAO †');
		@$this->addOption('RSD', 'Serbian Dinar');
		@$this->addOption('SCR', 'Seychelles Rupee');
		@$this->addOption('SLL', 'Leone');
		@$this->addOption('SGD', 'Singapore Dollar');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('SBD', 'Solomon Islands Dollar');
		@$this->addOption('SOS', 'Somali Shilling');
		@$this->addOption('ZAR', 'Rand');
		@$this->addOption('EUR', 'Euro');
		@$this->addOption('LKR', 'Sri Lanka Rupee');
		@$this->addOption('SDG', 'Sudanese Pound');
		@$this->addOption('SRD', 'Surinam Dollar');
		@$this->addOption('NOK', 'Norwegian Krone');
		@$this->addOption('SZL', 'Lilangeni');
		@$this->addOption('SEK', 'Swedish Krona');
		@$this->addOption('CHF', 'Swiss Franc');
		@$this->addOption('CHW', 'WIR Franc');
		@$this->addOption('CHE', 'WIR Euro');
		@$this->addOption('SYP', 'Syrian Pound');
		@$this->addOption('TWD', 'New Taiwan Dollar');
		@$this->addOption('TJS', 'Somoni');
		@$this->addOption('TZS', 'Tanzanian Shilling');
		@$this->addOption('THB', 'Baht');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('XOF', 'CFA Franc BCEAO †');
		@$this->addOption('NZD', 'New Zealand Dollar');
		@$this->addOption('TOP', 'Pa\'anga');
		@$this->addOption('TTD', 'Trinidad and Tobago Dollar');
		@$this->addOption('TND', 'Tunisian Dinar');
		@$this->addOption('TRY', 'Turkish Lira');
		@$this->addOption('TMT', 'Manat');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('AUD', 'Australian Dollar');
		@$this->addOption('UGX', 'Uganda Shilling');
		@$this->addOption('UAH', 'Hryvnia');
		@$this->addOption('AED', 'UAE Dirham');
		@$this->addOption('GBP', 'Pound Sterling');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('USS', 'US Dollar (Same day)');
		@$this->addOption('USN', 'US Dollar (Next day)');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('UYU', 'Peso Uruguayo');
		@$this->addOption('UYI', 'Uruguay Peso en Unidades Indexadas');
		@$this->addOption('UZS', 'Uzbekistan Sum');
		@$this->addOption('VUV', 'Vatu');
		@$this->addOption('VEF', 'Bolivar Fuerte');
		@$this->addOption('VND', 'Dong');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('USD', 'US Dollar');
		@$this->addOption('XPF', 'CFP Franc');
		@$this->addOption('MAD', 'Moroccan Dirham');
		@$this->addOption('YER', 'Yemeni Rial');
		@$this->addOption('ZMK', 'Zambian Kwacha');
		@$this->addOption('ZWL', 'Zimbabwe Dollar');
		@$this->addOption('XAU', 'Gold');
		@$this->addOption('XBA', 'Bond Markets Units European Composite Unit (EURCO)');
		@$this->addOption('XBB', 'European Monetary Unit (E.M.U.-6)');
		@$this->addOption('XBC', 'European Unit of Account 9(E.U.A.-9)');
		@$this->addOption('XBD', 'European Unit of Account 17(E.U.A.-17)');
		@$this->addOption('XDR', 'SDR');
		@$this->addOption('XPD', 'Palladium');
		@$this->addOption('XPT', 'Platinum');
		@$this->addOption('XAG', 'Silver');
		@$this->addOption('XFU', 'UIC-Franc');
        if (isset($value)) {
            $this->setValue($value);
        }
    }

    /**
     * Are multiple selections allowed?
     *
     * @return bool
     */
    function isMultiple()
    {
        return $this->_multiple;
    }

    /**
     * Get the size
     *
     * @return int
     */
    function getSize()
    {
        return $this->_size;
    }

    /**
     * Get an array of pre-selected values
     *
     * @param bool $encode To sanitizer the text?
     * @return array
     */
    function getValue($encode = false)
    {
        if (! $encode) {
            return $this->_value;
        }
        $value = array();
        foreach($this->_value as $val) {
            $value[] = $val ? htmlspecialchars($val, ENT_QUOTES) : $val;
        }
        return $value;
    }

    /**
     * Set pre-selected values
     *
     * @param  $value mixed
     */
    function setValue($value)
    {
        if (is_array($value)) {
            foreach($value as $v) {
                $this->_value[] = $v;
            }
        } elseif (isset($value)) {
            $this->_value[] = $value;
        }
    }

    /**
     * Add an option
     *
     * @param string $value "value" attribute
     * @param string $name "name" attribute
     */
    function addOption($value, $name = '')
    {
        if ($name != '') {
            $this->_options[$value] = $name;
        } else {
            $this->_options[$value] = $value;
        }
    }

    /**
     * Add multiple options
     *
     * @param array $options Associative array of value->name pairs
     */
    function addOptionArray($options)
    {
        if (is_array($options)) {
            foreach($options as $k => $v) {
                $this->addOption($k, $v);
            }
        }
    }

    /**
     * Get an array with all the options
     *
     * Note: both name and value should be sanitized. However for backward compatibility, only value is sanitized for now.
     *
     * @param int $encode To sanitizer the text? potential values: 0 - skip; 1 - only for value; 2 - for both value and name
     * @return array Associative array of value->name pairs
     */
    function getOptions($encode = false)
    {
        if (! $encode) {
            return $this->_options;
        }
        $value = array();
        foreach($this->_options as $val => $name) {
            $value[$encode ? htmlspecialchars($val, ENT_QUOTES) : $val] = ($encode > 1) ? htmlspecialchars($name, ENT_QUOTES) : $name;
        }
        return $value;
    }

    /**
     * Prepare HTML for output
     *
     * @return string HTML
     */
    function render()
    {
        $ele_name = $this->getName();
		$ele_title = $this->getTitle();
        $ele_value = $this->getValue();
        $ele_options = $this->getOptions();
        $ret = '<select size="' . $this->getSize() . '"' . $this->getExtra();
        if ($this->isMultiple() != false) {
            $ret .= ' name="' . $ele_name . '[]" id="' . $ele_name . '" title="'. $ele_title. '" multiple="multiple">' ;
        } else {
            $ret .= ' name="' . $ele_name . '" id="' . $ele_name . '" title="'. $ele_title. '">' ;
        }
        foreach($ele_options as $value => $name) {
            $ret .= '<option value="' . htmlspecialchars($value, ENT_QUOTES) . '"';
            if (count($ele_value) > 0 && in_array($value, $ele_value)) {
                $ret .= ' selected="selected"';
            }
            $ret .= '>' . $name . '</option>' ;
        }
        $ret .= '</select>';
        return $ret;
    }

    /**
     * Render custom javascript validation code
     *
     * @seealso XoopsForm::renderValidationJS
     */
    function renderValidationJS()
    {
        // render custom validation code if any
        if (! empty($this->customValidationCode)) {
            return implode("\n", $this->customValidationCode);
            // generate validation code if required
        } elseif ($this->isRequired()) {
            $eltname = $this->getName();
            $eltcaption = $this->getCaption();
            $eltmsg = empty($eltcaption) ? sprintf(_FORM_ENTER, $eltname) : sprintf(_FORM_ENTER, $eltcaption);
            $eltmsg = str_replace('"', '\"', stripslashes($eltmsg));
            return "\nvar hasSelected = false; var selectBox = myform.{$eltname};" . "for (i = 0; i < selectBox.options.length; i++ ) { if (selectBox.options[i].selected == true) { hasSelected = true; break; } }" . "if (!hasSelected) { window.alert(\"{$eltmsg}\"); selectBox.focus(); return false; }";
        }
        return '';
    }
}

?>