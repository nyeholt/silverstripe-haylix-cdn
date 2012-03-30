<?php

/**
 * Read content from haylix cdn
 *
 * @author marcus@silverstripe.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class HaylixContentReader extends ContentReader {
	
	protected $info = null;
	
	protected function getInfo() {
		if (!$this->info) {
			$haylix = $this->getHaylix();
		
			$this->info = $haylix->info_file(HaylixService::PUBLIC_CONTAINER, $this->getId());
		}
		return $this->info;
	}
	
	/**
	 *
	 * @return CloudStorage
	 */
	protected function getHaylix() {
		return singleton('HaylixService')->getHaylix();
	}

	
	public function isReadable() {
		if (!parent::isReadable()) {
			return;
		}
		
		$info = $this->getInfo();
		
		return strlen($info) > 0;
	}

	/**
	 * Get a url to this piece of content
	 * 
	 * @return string
	 */
	public function getURL() {
		return HaylixService::CONTENT_URL .'/' . HaylixService::PUBLIC_CONTAINER .'/' . $this->getId();
	}
	
	/**
	 * Read this content as a string
	 * 
	 * @return string
	 */
	public function read() {
		
	}
}
