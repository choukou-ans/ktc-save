<?php
App::uses('MProcess', 'Model');

/**
 * MProcess Test Case
 *
 */
class MProcessTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_process'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MProcess = ClassRegistry::init('MProcess');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MProcess);

		parent::tearDown();
	}

}
