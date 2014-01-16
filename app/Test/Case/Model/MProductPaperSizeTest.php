<?php
App::uses('MProductPaperSize', 'Model');

/**
 * MProductPaperSize Test Case
 *
 */
class MProductPaperSizeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.m_product_paper_size',
		'app.m_split',
		'app.m_paper_size',
		'app.m_paper',
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
		'app.spec_detail',
		'app.part',
		'app.spec_outsource',
		'app.outsource',
		'app.m_print_price'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MProductPaperSize = ClassRegistry::init('MProductPaperSize');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MProductPaperSize);

		parent::tearDown();
	}

}
