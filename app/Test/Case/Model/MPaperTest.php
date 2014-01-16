<?php
App::uses('MPaper', 'Model');

/**
 * MPaper Test Case
 *
 */
class MPaperTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_paper',
		'app.m_paper_size',
		'app.m_print_price',
		'app.paper_inventory',
		'app.spec',
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
		'app.delivery',
		'app.m_courier',
		'app.goods',
		'app.m_process',
		'app.bookbinding',
		'app.fold',
		'app.inventory_type',
		'app.m_reprint',
		'app.hole_type',
		'app.m_product_paper_size',
		'app.m_split',
		'app.spec_detail',
		'app.part',
		'app.spec_outsource',
		'app.outsource'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MPaper = ClassRegistry::init('MPaper');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MPaper);

		parent::tearDown();
	}

}
