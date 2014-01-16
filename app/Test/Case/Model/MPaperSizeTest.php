<?php
App::uses('MPaperSize', 'Model');

/**
 * MPaperSize Test Case
 *
 */
class MPaperSizeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_paper_size',
		'app.m_paper',
		'app.m_print_price'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MPaperSize = ClassRegistry::init('MPaperSize');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MPaperSize);

		parent::tearDown();
	}

}
