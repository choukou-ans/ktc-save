<?php
App::uses('CustomerDept', 'Model');

/**
 * CustomerDept Test Case
 *
 */
class CustomerDeptTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.customer_dept',
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
		'app.delivery',
		'app.m_courier',
		'app.goods'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CustomerDept = ClassRegistry::init('CustomerDept');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CustomerDept);

		parent::tearDown();
	}

}
