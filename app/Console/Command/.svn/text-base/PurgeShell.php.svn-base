<?php
class PurgeShell extends AppShell {
	public $uses = array('Token');


    public function main() {
    	$oneMonthAgo = date("Y-m-d H:i:s",strtotime("-1 month"));
        $this->Token->deleteAll(array('Token.created <' => $oneMonthAgo), false);
    }
}
