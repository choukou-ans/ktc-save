<?php
App::uses('MFraction', 'Model');

/**
 * MFraction Test Case
 *
 */
class MFractionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_fraction'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MFraction = ClassRegistry::init('MFraction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MFraction);

		parent::tearDown();
	}

}
