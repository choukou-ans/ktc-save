<?php
App::uses('DeliveryNote', 'Model');

/**
 * DeliveryNote Test Case
 *
 */
class DeliveryNoteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.delivery_note',
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
		'app.m_classify',
		'app.consignor_map',
		'app.consignor_list',
		'app.customer_dept',
		'app.delivery',
		'app.m_courier',
		'app.estimate',
		'app.goods',
		'app.spec',
		'app.m_process',
		'app.m_paper_size',
		'app.m_paper',
		'app.paper_inventory',
		'app.spec_detail',
		'app.part',
		'app.m_print_price',
		'app.bookbinding',
		'app.fold',
		'app.inventory_type',
		'app.m_reprint',
		'app.hole_type',
		'app.m_product_paper_size',
		'app.m_split',
		'app.spec_outsource',
		'app.outsource',
		'app.delivery_note_detail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DeliveryNote = ClassRegistry::init('DeliveryNote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DeliveryNote);

		parent::tearDown();
	}

}
