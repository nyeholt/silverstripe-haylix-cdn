<?php

/**
 * @author marcus@silverstripe.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class HaylixService {
	const PUBLIC_CONTAINER = 'public';
	const PRIVATE_CONTAINER = 'private';
	
	const CONTENT_URL = 'http://slvr72.www-cdn.s.mel.secureinf.net';
		
	static $account_name;
	static $user;
	static $key;
	
	protected $haylix;
	
	public function __construct() {
		
	}
	
	public function getHaylix() {
		if (!$this->haylix) {
			$this->haylix = new CloudStorage(self::$account_name, self::$user, self::$key);
		}
		
		return $this->haylix;
	}
}
