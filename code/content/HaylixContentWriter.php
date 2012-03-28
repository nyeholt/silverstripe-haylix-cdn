<?php

include_once dirname(dirname(__FILE__)).'/thirdparty/haylix.php';

/**
 * @author marcus@silverstripe.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class HaylixContentWriter extends ContentWriter {
	
	const PUBLIC_CONTAINER = 'public';
	const PRIVATE_CONTAINER = 'private';
	
	static $account_name;
	static $user;
	static $key;
	
	protected $haylix;
	
	protected function getHaylix() {
		if (!$this->haylix) {
			$this->haylix = new CloudStorage(self::$account_name, self::$user, self::$key);
		}
		
		return $this->haylix;
	}
	
	/**
	 * Write content to haylix storage
	 *
	 * @param mixed $content 
	 * @param string $name
	 *				The name that is used to refer to this piece of content, 
	 *				if needed
	 */
	public function write($content = null, $name = '') {
		$this->getHaylix()->add_container(self::PUBLIC_CONTAINER);
		$this->getHaylix()->public_container(self::PUBLIC_CONTAINER);
		
		$reader = $this->getReaderWrapper($content);
		
		if (!$this->id) {
			if (!$name) {
				throw new Exception("Cannot write a file without a name");
			}
			$this->id = md5($name . microtime(true)) . '/' . $name;
		}
		
		$result = $this->getHaylix()->upload_data(self::PUBLIC_CONTAINER, $reader->read(), $this->id);
		if ($result < 0) {
			throw new Exception("Failed uploading to haylix");
		}
		
		print_r($this->getHaylix()->info_container(self::PUBLIC_CONTAINER));
	}
}
