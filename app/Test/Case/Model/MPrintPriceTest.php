<?php
App::uses('MPrintPrice', 'Model');

/**
 * MPrintPrice Test Case
 *
 */
class MPrintPriceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_print_price',
		'app.m_paper_size',
		'app.m_paper'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MPrintPrice = ClassRegistry::init('MPrintPrice');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MPrintPrice);

		parent::tearDown();
	}

}
