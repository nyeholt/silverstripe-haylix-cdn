<?php

/**
 * Read content from haylix cdn
 *
 * @author marcus@silverstripe.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class HaylixContentReader extends ContentReader {
	
	protected $info = null;
	
	public $publicContainer = 'public';
	
	/**
	 * @var CloudStorage
	 */
	public $haylix;
	
	protected function getHaylix() {
		return $this->haylix;
	}
	
	protected function getInfo() {
		if (!$this->info) {
			$haylix = $this->getHaylix();
		
			$this->info = $haylix->info_file($this->publicContainer, $this->getId());
		}
		return $this->info;
	}
	
	public function isReadable() {
		if (!parent::isReadable()) {
			return;
		}
		
		$info = $this->getInfo();
		
		return strlen($info) > 0;
	}
	
	public function urlStub() {
		return sprintf('http://%s.www-cdn.s.mel.secureinf.net', $this->haylix->account);
	}

	/**
	 * Get a url to this piece of content
	 * 
	 * @return string
	 */
	public function getURL() {
		return $this->urlStub() .'/' . $this->publicContainer .'/' . $this->getId();
	}
	
	/**
	 * Read this content as a string
	 * 
	 * @return string
	 */
	public function read() {
		
	}
}
