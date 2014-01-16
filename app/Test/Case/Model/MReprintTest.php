<?php
App::uses('MReprint', 'Model');

/**
 * MReprint Test Case
 *
 */
class MReprintTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_reprint'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MReprint = ClassRegistry::init('MReprint');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MReprint);

		parent::tearDown();
	}

}
