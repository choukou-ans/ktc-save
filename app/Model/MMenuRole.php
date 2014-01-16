<?php
class MMenuRole extends AppModel {
	public $name = 'MMenuRole';
    public $useTable = 'm_menu_roles';
    
    public $belongsTo = array(
        'MMenu' => array(
            'className' => 'MMenu',
            'foreignKey' => 'm_menu_id'
        )
    );
    
}
?>
