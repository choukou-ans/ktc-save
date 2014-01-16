<?php
App::uses('MClassify', 'Model');

/**
 * MClassify Test Case
 *
 */
class MClassifyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_classify'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MClassify = ClassRegistry::init('MClassify');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MClassify);

		parent::tearDown();
	}

}
