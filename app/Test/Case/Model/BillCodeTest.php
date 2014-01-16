<?php
App::uses('BillCode', 'Model');

/**
 * BillCode Test Case
 *
 */
class BillCodeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bill_code'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BillCode = ClassRegistry::init('BillCode');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BillCode);

		parent::tearDown();
	}

}
