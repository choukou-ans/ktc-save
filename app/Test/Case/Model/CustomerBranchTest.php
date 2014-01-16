<?php
App::uses('CustomerBranch', 'Model');

/**
 * CustomerBranch Test Case
 *
 */
class CustomerBranchTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.customer_branch'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CustomerBranch = ClassRegistry::init('CustomerBranch');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CustomerBranch);

		parent::tearDown();
	}

}
