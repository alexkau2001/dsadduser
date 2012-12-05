<?php
/**
 * This is the main configuration file.
 *
 * Use it to configure domain info for DSAddUser.
 *
 * PHP 5
 *
 * 
 * Copyright 2012, Mark Myers. (http://emoxter.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, Mark Myers. (http://emoxter.com)
 * @link          http://github.com/marcusmyers/dsadduser
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Active Directory configuration class.
 *
 * @staticvar $default holds all the configuration info
 */

class ACTIVE_DIRECTORY {
	
	public static $default = array(
			'ou'=>'OU=CompanyUsers,DC=example,DC=local',
			
			/* 
			 * Change this to 'yes' if you want the users to change their password on first login
			 * 
			 * If you change this you must also change 'canchpwd' & 'pwdneverexpires' to yes
			 * 
			 */ 
			'mustchpwd'=>'no',
			'canchpwd'=>'no',
			'pwdneverexpires'=>'no',
			
			// Their username will appened to this value
			'hmdir'=>'\\\\fileserver\\',
			'hmdrv'=>'H:',
			'loscr'=>'login.bat',
			'upn'=>'@example.local',
			/*
			 * Optional configuration values
			 */ 
	
			// Use this if you want your users to be put into a default group
			//'memberof'=>'CN=office,OU=CompanyUsers,DC=example,DC=local',  
	
			// Use this if you want all users to have a default password that they change on first login
			// On By Default
			'password'=>'school', 
			);
	
}

/*
 * File Shares configuration class
 * 
 * @staticvar $default holds all the configuration info
 */
class FILE_SHARES {
	
	public static $default = array(
			// Drive letter where you will be storing file shares
			'dataDrive'=>'D:',
			// Folder where you will be storing users folders
			'homePath'=>'\users',
			);
	
}