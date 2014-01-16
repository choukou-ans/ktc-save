<?php
App::uses('Customer', 'Model');

/**
 * Customer Test Case
 *
 */
class CustomerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.customer',
		'app.user',
		'app.m_role',
		'app.m_tax_imputation',
		'app.m_deal_type',
		'app.bill_customer',
		'app.m_cutoff_type',
		'app.money_fraction',
		'app.tax_fraction',
		'app.m_withdrawal',
		'app.m_withdrawal_cycle',
		'app.m_fee_charge',
		'app.m_classify1',
		'app.m_classify2',
		'app.m_classify3',
		'app.m_classify4',
		'app.m_classify5',
		'app.consignor',
		'app.customer_dept',
		'app.delivery',
		'app.m_courier',
		'app.good'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Customer = ClassRegistry::init('Customer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Customer);

		parent::tearDown();
	}

}
