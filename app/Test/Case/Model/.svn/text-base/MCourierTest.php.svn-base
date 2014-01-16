<?php
App::uses('MCourier', 'Model');

/**
 * MCourier Test Case
 *
 */
class MCourierTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_courier',
		'app.delivery',
		'app.customer',
		'app.user',
		'app.m_role',
		'app.m_edit_master_role',
		'app.m_edit_master',
		'app.m_menu_role',
		'app.m_menu',
		'app.user_customer_map',
		'app.m_tax_imputation',
		'app.m_deal_type',
		'app.m_cutoff_type',
		'app.m_withdrawal',
		'app.m_withdrawal_cycle',
		'app.m_fee_charge',
		'app.consignor',
		'app.customer_dept',
		'app.goods'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MCourier = ClassRegistry::init('MCourier');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MCourier);

		parent::tearDown();
	}

}
