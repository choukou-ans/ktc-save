<?php
App::uses('HoleNum', 'Model');

/**
 * HoleNum Test Case
 *
 */
class HoleNumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hole_num',
		'app.hole_typy'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HoleNum = ClassRegistry::init('HoleNum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HoleNum);

		parent::tearDown();
	}

}
