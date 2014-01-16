<?php
App::uses('MEditMaster', 'Model');

/**
 * MEditMaster Test Case
 *
 */
class MEditMasterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_edit_master',
		'app.m_edit_master_role',
		'app.m_role',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MEditMaster = ClassRegistry::init('MEditMaster');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MEditMaster);

		parent::tearDown();
	}

}
