<?php
App::uses('MTax', 'Model');

/**
 * MTax Test Case
 *
 */
class MTaxTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_tax'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MTax = ClassRegistry::init('MTax');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MTax);

		parent::tearDown();
	}

}
