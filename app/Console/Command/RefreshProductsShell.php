<?php

class RefreshProductsShell extends AppShell {
    

	//SellingList,WantedListモデルを使えるようにするために宣言	//定義済み関数
	public $uses = array('SellingList','WantedList');
	


    public function main() {

        // 0:募集中、1:掲載終了、2:取引完了 //

        
        /* 掲載終了の場合（掲載終了日になった時点で商品削除） */  

        //$delete_day_finish = date("Y-m-d H i s");

        //SellingList
        //$conditions_selling_finish = array('Selling_list.deadline <=' => date("Y-m-d H i s"););
        //$this->Selling_list->deleteAll($conditions_selling_finish, false);


        $this->テーブル名->updateAll(
       array ( '更新するカラム' => 変更の値 ),
       array ( 'Selling_list.deadline <=' => date("Y-m-d H i s")));

        


        /* 取引完了(status=2)の場合（取引完了５日後に商品削除） */ 

        $delete_day = date("Y-m-d H i s", strtotime('-5 day'));

        //SellingList
        $conditions_selling_trade_done = array('Selling_list.tradedate <=' => $delete_day, 'Selling_list.status' => 2);
        $this->Selling_list->deleteAll($conditions_selling_trade_done , false);

        //WantedList
        $conditions_wanted_trade_done = array('Wanted_list.tradedate <=' => $delete_day, 'Wanted_list.status' => 2);
        $this->WantedL_list->deleteAll($conditions_wanted_trade_done , false);

        $this->out('Complete');
    }
	
	

}



?>