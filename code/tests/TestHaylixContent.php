<?php

/**
 *
 * @author marcus@silverstripe.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class TestHaylixContent extends SapphireTest {
	
	public function testWriteContent() {
		$writer = new HaylixContentWriter(null);
		
		$writer->write(new FileContentReader(__FILE__), 'test_file.php');
		$id = $writer->getContentId();

		$this->assertNotNull($id);
		$this->assertTrue(strpos($id, 'test_file.php') > 0);
		$this->assertTrue(strpos($id, 'Haylix:') === 0);
		var_export($id);
	}
}
