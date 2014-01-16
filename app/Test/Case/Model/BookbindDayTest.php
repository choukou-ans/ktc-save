<?php
App::uses('BookbindDay', 'Model');

/**
 * BookbindDay Test Case
 *
 */
class BookbindDayTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bookbind_day'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BookbindDay = ClassRegistry::init('BookbindDay');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BookbindDay);

		parent::tearDown();
	}

}
