<?php

class RefreshProductsShell extends AppShell {
    

	//SellingList,WantedListモデルを使えるようにするために宣言	//定義済み関数
	public $uses = array('SellingList','WantedList');
	


    public function main() {

        /* 掲載終了(st_flg=1)の場合 */  

        $delete_day_finish = date("Y-m-d H i s");

        //SellingList
        $conditions_selling_finish = array('SellingList.deadline <=' => $delete_day_finish);
        $this->SellingList->deleteAll($conditions_selling_finish, false);

        


        /* 取引完了(st_flag=2)の場合 */ 

        $delete_day_trade_done = date("Y-m-d H i s", strtotime('-5 day'));

        //SellingList
        $conditions_selling_trade_done = array('SellingList.trade_date <=' => $delete_day_trade_done, 'SellingList.st_flg' => 2);
        $this->SellingList->deleteAll($conditions_selling_trade_done , false);

        //WantedList
        $conditions_wanted_trade_done = array('WantedList.trade_date <=' => $delete_day_trade_done, 'WantedList.st_flg' => 2);
        $this->WantedList->deleteAll($conditions_wanted_trade_done , false);

        $this->out('Complete');
    }
	
	

}



?>