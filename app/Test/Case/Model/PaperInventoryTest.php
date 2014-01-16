<?php
App::uses('PaperInventory', 'Model');

/**
 * PaperInventory Test Case
 *
 */
class PaperInventoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.paper_inventory'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PaperInventory = ClassRegistry::init('PaperInventory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PaperInventory);

		parent::tearDown();
	}

}
