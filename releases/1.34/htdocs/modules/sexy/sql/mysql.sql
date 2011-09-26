CREATE TABLE sexy_options (                                                          
	`optn_id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,                                     
	`optn_pid` INT(13) UNSIGNED DEFAULT '0',                                                
	`optn_name` VARCHAR(128) DEFAULT NULL,                                                  
	`optn_value` VARCHAR(5000) DEFAULT NULL,                                                
	`optn_type` ENUM('int','decimal','varchar') DEFAULT NULL,                               
	`optn_area` ENUM('pictures','prices','profile','urls','votes','options') DEFAULT NULL,  
	`optn_description` VARCHAR(128) DEFAULT NULL,                                           
	PRIMARY KEY (`optn_id`),                                                                
	KEY `SORTORDER` (`optn_name`,`optn_type`,`optn_area`)                                   
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE sexy_pictures (                                             
	`id` INT(23) UNSIGNED NOT NULL AUTO_INCREMENT,                              
	`pid` INT(13) UNSIGNED NOT NULL DEFAULT '0',                                
	`title` VARCHAR(800) DEFAULT NULL,                                          
	`description` VARCHAR(5000) DEFAULT NULL,                                   
	`width` INT(6) DEFAULT NULL,                                                
	`height` INT(6) DEFAULT NULL,                                               
	`extension` VARCHAR(10) DEFAULT NULL,                                       
	`filename` VARCHAR(255) DEFAULT NULL,                                       
	`hits` MEDIUMINT(20) UNSIGNED DEFAULT '0',                                  
	`folder` ENUM('/uploads/','/uploads/sexy/') DEFAULT '/uploads/sexy/',  
	PRIMARY KEY (`id`),                                                         
	KEY `PIDGROUP` (`id`,`pid`)                                                 
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE sexy_prices (
	`id` int(23) unsigned NOT NULL AUTO_INCREMENT,
	`pid` int(13) unsigned DEFAULT NULL,
	`type` enum('Weekdays Day','Weekends Day','Weekday Evening','Weekend Evening','Weekday Night','Weekend Night','Morning Weekday','Morning Weekend') DEFAULT NULL,
	`day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') DEFAULT NULL,
	`time-start` enum('00:01 TO 04:00','04:01 TO 08:00','08:01 TO 12:00','12:01 TO 16:00','20:01 TO 24:00','01:00 TO 08:00','12:01 TO 24:00') DEFAULT NULL,
	`time-end` enum('00:01 TO 04:00','04:01 TO 08:00','08:01 TO 12:00','12:01 TO 16:00','20:01 TO 24:00','01:00 TO 08:00','12:01 TO 24:00') DEFAULT NULL,
	`event` enum('Dining','Sexual Passion','Sports','Casual Date','Discreet Affair','One on One Sex','Group Sex','Party Affair','Swinging', 'Other') DEFAULT NULL,
	`aid` int(13) DEFAULT '0',
 	 `currency` enum('AFN','ALL','DZD','USD','EUR','NOK','AOA','ARS','NZD','DKK','GBP','ZAR','MAD','CHF','XPF','AMD','AUD','AWG','AZN','BSD','BHD','XAF','BDT','BBD','BYR','BZD','XOF','BMD','BTN','INR','BOB','BOV','BAM','BWP','BRL','BND','BGN','BIF','KHR','CAD','CVE','KYD','CLP','CLF','CNY','COP','COU','KMF','CDF','CRC','HRK','CUP','CUC','CZK','DJF','DOP','EGP','SVC','ERN','EEK','ETB','FKP','FJD','GMD','GEL','GHS','GIP','GTQ','GNF','GWP','GYD','HTG','HNL','HKD','HUF','ISK','IDR','IRR','IQD','ILS','JMD','JPY','JOD','KZT','KES','KPW','KRW','KWD','KGS','LAK','LVL','LBP','LSL','LRD','LYD','LTL','MOP','MKD','MGA','MWK','MYR','MVR','MRO','MUR','MXN','MXV','MDL','MNT','MZN','MMK','NAD','NPR','ANG','NIO','NGN','OMR','PKR','PAB','PGK','PYG','PEN','PHP','PLN','QAR','RON','RUB','RWF','SHP','WST','STD','SAR','RSD','SCR','SLL','SGD','SBD','SOS','LKR','SDG','SRD','SZL','SEK','CHW','CHE','SYP','TWD','TJS','TZS','THB','TOP','TTD','TND','TRY','TMT','UGX','UAH','AED','USS','USN','UYU','UYI','UZS','VUV','VEF','VND','YER','ZMK','ZWL','XAU','XBA','XBB','XBC','XBD','XDR','XPD','XPT','XAG','XFU','XTS','XCD','XXX') DEFAULT 'USD',  
	`description` varchar(5000) DEFAULT NULL,
	`price` decimal(10,2) DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `SEARCHINDEX` (`pid`,`type`,`day`,`time-start`,`time-end`,`event`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE sexy_physique (
	`id` INT(13) UNSIGNED NOT NULL AUTO_INCREMENT,
	`pid` INT(13) UNSIGNED NOT NULL,
	`race` ENUM('Native/Aboriginal','Caucasian','Africian','Latin','Asian','Other') DEFAULT NULL,
	`height` ENUM('<5ft 0in / <152cm','5ft 0in / 152cm','5ft 1in / 155cm','5ft 2in / 157cm','5ft 3in / 160cm','5ft 4in / 162cm','5ft 5in / 165cm','5ft 6in / 167cm','5ft 7in / 170cm','5ft 8in / 172cm','5ft 9in / 175cm','5ft 10in / 177cm','5ft 11in / 180cm','6ft 0in / 183cm','6ft 1in / 186cm','6ft 2in / 188cm','6ft 3in / 190cm','6ft 4in / 193cm','6ft 5in / 195cm','6ft 6in / 198cm','>6ft 6in / >198cm') DEFAULT NULL,
	`sex` ENUM('Male','Female','Transsexual') DEFAULT NULL,
	`weight` ENUM('<99lbs / <45kg','100-109lbs / 45-49kg','110-119lbs / 49-53kg','120-129lbs / 54-58kg','130-139lbs / 59-62kg','140-149lbs / 63-67kg','150-159lbs / 68-71kg','160-169lbs / 72-76kg','170-179lbs / 77-80kg','180-189lbs / 81-85kg','190-199lbs / 86-89kg','200-209lbs / 90-95kg','210-219lbs / 96-99kg','220-229lbs / 100-105kg','230-239lbs / 106-110kg','240-249lbs / 111-115kg','250-259lbs / 116-120kg','260-269lbs / 121-125kg','270-279lbs / 126-130kg','>300lbs / >131kg') DEFAULT NULL,  
	`dresssize` ENUM('6','8','10','12','14','16','18','20','22','24','26','28') DEFAULT NULL,
	`shirtsize` ENUM('14in / 36cm','14.5in / 37cm','15in / 38cm','15.5in / 39cm','16in / 41cm','16.5in / 42cm','17in / 43cm','17.5in / 44cm','18in / 45cm','18.5in / 46cm','19in / 48cm','19.5in / 50cm','20in / 51cm') DEFAULT NULL,
	`pantssize` ENUM('28in / 71cm','29in / 73cm','30in / 76cm','31in / 79cm','32in / 81cm','33in / 84cm','34in / 86cm','35in / 89cm','36in / 91cm','37in / 94cm','38in / 97cm','39in / 99cm','40in / 101cm','41in / 104cm','42in / 107cm','43in / 109cm','44in / 112cm','45in / 114cm','46in / 117cm') DEFAULT NULL,
	`bust` ENUM('A Cup','B Cup','C Cup','D Cup','E Cup','F Cup') DEFAULT NULL,
	`hair` ENUM('Black Hair','Brown Hair','Auburn Hair','Red Hair','Blond Hair','Grey Hair','White Hair') DEFAULT NULL,
	`eyes` ENUM('Amber Eyes','Blue Eyes','Brown Eyes','Gray Eyes','Green Eyes','Hazel Eyes','Red Eyes') DEFAULT NULL,
	`bodyhair` ENUM('Smooth','Moderate','Hairy','Shaved','Waxed') DEFAULT NULL,
	`penissize` ENUM('Under 5in / 11cm','5 - 7in / 12cm - 16cm','7 - 9in / 18 - 24cm','10 - 13in / 25 - 31cm','Over 13in / 33cm') DEFAULT NULL,
	`foreskin` ENUM('Cut','Uncut') DEFAULT NULL,
	`position` ENUM('Top','Bottom','Verastile','Active','Passive','Top & Bottom','Top & Active','Bottom & Active','Top & Passive','Bottom & Passive') DEFAULT NULL,
	`physique` ENUM('Slim','Athletic','Muscular','Average','Bear','Heavy') DEFAULT NULL,
	`piercings` ENUM('Yes','No') DEFAULT NULL,
	`tattoos` ENUM('Yes','No') DEFAULT NULL,
	`drugs` ENUM('Yes','No') DEFAULT NULL,
	`smoking` ENUM('Yes','No') DEFAULT NULL,
	`alcohol` ENUM('Yes','No') DEFAULT NULL,
	`actions` MEDIUMTEXT,
	`services` MEDIUMTEXT,
	PRIMARY KEY (`id`,`pid`),
	UNIQUE KEY `id` (`id`),
	KEY `male` (`pid`,`race`,`height`,`sex`,`weight`,`shirtsize`,`pantssize`,`bust`,`hair`,`eyes`,`bodyhair`,`penissize`,`foreskin`,`position`,`physique`),
	KEY `female` (`pid`,`race`,`height`,`sex`,`weight`,`dresssize`,`bust`,`hair`,`eyes`,`position`,`physique`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE sexy_profile (                                         
	`pid` INT(13) UNSIGNED NOT NULL AUTO_INCREMENT,                        
	`approved` INT(1) DEFAULT '0',
	`webcam_uname` VARCHAR(128) DEFAULT NULL,                                      
	`host_id` INT(13) DEFAULT '0',
	`uid` INT(13) DEFAULT '0',                                             
	`alias` VARCHAR(128) DEFAULT NULL,                                     
	`name` VARCHAR(128) DEFAULT NULL,                                      
	`webcam_username` VARCHAR(20) DEFAULT NULL,                                      
	`webcam` ENUM('Yes','No') DEFAULT NULL,                                
	`incall` ENUM('Yes','No') DEFAULT NULL,                                
	`outcall` ENUM('Yes','No') DEFAULT NULL,                               
	`sms` VARCHAR(64) DEFAULT NULL,                                        
	`mobile` VARCHAR(64) DEFAULT NULL,                                     
	`landline` VARCHAR(64) DEFAULT NULL,                                   
	`agency` ENUM('Yes','No') DEFAULT NULL,                                
	`age` VARCHAR(64) DEFAULT NULL,                                        
	`sexuality` ENUM('Hetrosexual','Bisexual','Homosexual') DEFAULT NULL,  
	`domains` MEDIUMTEXT,                                                  
	`locations` MEDIUMTEXT,                                                
	`tags` VARCHAR(255) DEFAULT NULL,                                      
	`slogon` VARCHAR(64) DEFAULT NULL,                                     
	`bio` MEDIUMTEXT,                                                      
	`columnone` MEDIUMTEXT,                                                
	`columntwo` MEDIUMTEXT,                                                
	`footer` MEDIUMTEXT,                                                   
	PRIMARY KEY (`pid`),                                                   
	KEY `SEARCHIDX1` (`uid`,`incall`,`outcall`,`agency`,`sexuality`)       
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE sexy_urls (                                                                                                              
	`id` INT(13) UNSIGNED NOT NULL AUTO_INCREMENT,                                                                                           
	`pid` INT(13) UNSIGNED DEFAULT NULL,                                                                                                     
	`type` ENUM('link','blog','facebook','twitter','profile','bio','interest','personal','myspace','google','eworld','other') DEFAULT NULL,  
	`url` MEDIUMTEXT,                                                                                                                        
	`other` VARCHAR(255) DEFAULT NULL,                                                                                                       
	PRIMARY KEY (`id`),                                                                                                                      
	KEY `SEARCHTYPEINDX1` (`pid`,`type`)                                                                                                     
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE sexy_votes (                    
	`id` INT(13) UNSIGNED NOT NULL AUTO_INCREMENT,  
	`pid` INT(13) UNSIGNED DEFAULT NULL,            
	`vote` FLOAT(4,2) DEFAULT '0.00',               
	`ip` VARCHAR(64) DEFAULT NULL,                  
	PRIMARY KEY (`id`),                             
	KEY `SEARCHIDX1` (`pid`,`ip`)                   
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE sexy_show (                                         
	`sid` INT(13) UNSIGNED NOT NULL AUTO_INCREMENT,                        
	`pid` INT(13) DEFAULT '0',
	`name` VARCHAR(128) DEFAULT NULL,                                      
	`amount` DECIMAL(10,2) DEFAULT '0.00',                                
	`prebook` ENUM('Yes','No') DEFAULT NULL,                                
	`discount` ENUM('Yes','No') DEFAULT NULL,                                
	`percentage` DECIMAL(10,4) DEFAULT '0.0000',                                        
	`when` INT(13) DEFAULT '0',                                     
	PRIMARY KEY (`sid`),                                                   
	KEY `SEARCHIDX1` (`pid`,`name`(20),`prebook`,`discount`)       
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE sexy_show_notifications (                                         
	`snid` INT(26) UNSIGNED NOT NULL AUTO_INCREMENT,                        
	`pid` INT(13) DEFAULT '0',
	`sid` INT(13) DEFAULT '0',
	`uid` INT(13) DEFAULT '0',
	`user_id` INT(13) DEFAULT '0',
	`amount` DECIMAL(10,2) DEFAULT '0.00',
	`discount` DECIMAL(10,2) DEFAULT '0.00',
	`name` VARCHAR(128) DEFAULT NULL,
	`email` VARCHAR(255) DEFAULT NULL,
	`twitter` VARCHAR(64) DEFAULT NULL,
	`when` INT(13) DEFAULT '0',
	`sent` INT(2) DEFAULT '0',
	`entered` INT(13) DEFAULT '0',
	PRIMARY KEY (`snid`),                                                   
	KEY `SEARCHIDX1` (`sid`,`name`(20),`email`(20),`twitter`(20))  ,    
	KEY `SEARCHIDX2` (`pid`,`sid`,`uid`,`user_id`)       	
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE sexy_oauth (
  `oid` INT(13) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cids` VARCHAR(1000) DEFAULT NULL,
  `catids` VARCHAR(1000) DEFAULT NULL,
  `mode` ENUM('valid','invalid','expired','disabled','other') DEFAULT NULL,
  `consumer_key` VARCHAR(255) DEFAULT NULL,
  `consumer_secret` VARCHAR(255) DEFAULT NULL,
  `oauth_token` VARCHAR(255) DEFAULT NULL,
  `oauth_token_secret` VARCHAR(255) DEFAULT NULL,
  `username` VARCHAR(64) DEFAULT NULL,
  `id` VARCHAR(255) DEFAULT '0',
  `ip` VARCHAR(64) DEFAULT NULL,
  `netbios` VARCHAR(255) DEFAULT NULL,
  `uid` INT(13) UNSIGNED DEFAULT '0',
  `created` INT(13) UNSIGNED DEFAULT '0',
  `actioned` INT(13) UNSIGNED DEFAULT '0',
  `updated` INT(13) UNSIGNED DEFAULT '0',
  `tweeted` INT(13) UNSIGNED DEFAULT '0',
  `friends` INT(13) UNSIGNED DEFAULT '0',
  `mentions` INT(13) UNSIGNED DEFAULT '0',
  `tweets` INT(13) UNSIGNED DEFAULT '0',
  `calls` INT(13) UNSIGNED DEFAULT '0',
  `remaining_hits` INT(13) UNSIGNED DEFAULT '0',
  `hourly_limit` INT(13) UNSIGNED DEFAULT '0',
  `api_resets` INT(13) UNSIGNED DEFAULT '0',
  PRIMARY KEY  (`oid`),
  KEY `COMMON` (`cids`(25),`catids`(25),`mode`,`consumer_key`(15),`consumer_secret`(15),`oauth_token`(15),`oauth_token_secret`(15),`username`(15),`id`(15),`ip`(15),`netbios`(15),`uid`,`created`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;