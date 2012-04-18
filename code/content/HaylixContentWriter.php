<?php

include_once dirname(dirname(__FILE__)).'/thirdparty/haylix.php';

/**
 * @author marcus@silverstripe.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class HaylixContentWriter extends ContentWriter {
	
	
	protected function getHaylix() {
		return singleton('HaylixService')->getHaylix();
	}
	
	public function nameToId($name) {
		return md5($name) . '-' . basename($name);
	}
	
	/**
	 * Write content to haylix storage
	 *
	 * @param mixed $content 
	 * @param string $name
	 *				The name that is used to refer to this piece of content, 
	 *				if needed
	 */
	public function write($content = null, $fullname = '') {
		$this->getHaylix()->add_container(HaylixService::PUBLIC_CONTAINER);
		$this->getHaylix()->public_container(HaylixService::PUBLIC_CONTAINER);
		
		$reader = $this->getReaderWrapper($content);
		
		$name = basename($fullname);
		
		if (!$this->id) {
			if (!$name) {
				throw new Exception("Cannot write a file without a name");
			}
			$this->id = $this->nameToId($fullname);
		}

		$type = null;
		if (class_exists('HTTP')) {
			$type = HTTP::getMimeType($name);
		}
		$result = $this->getHaylix()->upload_data(HaylixService::PUBLIC_CONTAINER, $reader->read(), $this->id, $type);
		if ($result < 0) {
			throw new Exception("Failed uploading to haylix");
		}

		// print_r($this->getHaylix()->info_container(HaylixService::PUBLIC_CONTAINER));
	}
}
