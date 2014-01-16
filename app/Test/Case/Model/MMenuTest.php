<?php
App::uses('MMenu', 'Model');

/**
 * MMenu Test Case
 *
 */
class MMenuTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_menu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MMenu = ClassRegistry::init('MMenu');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MMenu);

		parent::tearDown();
	}

}
