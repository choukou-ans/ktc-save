<?php
App::uses('MPrepareFee', 'Model');

/**
 * MPrepareFee Test Case
 *
 */
class MPrepareFeeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_prepare_fee',
		'app.color_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MPrepareFee = ClassRegistry::init('MPrepareFee');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MPrepareFee);

		parent::tearDown();
	}

}
