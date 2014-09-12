<?php

class RefreshProductsShell extends AppShell {
    

	//SellingList,WantedListモデルを使えるようにするために宣言	//定義済み関数
	public $uses = array('Selling_list','Wanted_list');
	


    public function main() {

        // status = 0:募集中、1:掲載終了、2:取引完了 //


        /* 掲載終了の場合（掲載終了日になった時点でdel_flgたてる） */ 

        //SellingList
        $this->Selling_list->updateAll(
                                array ('Selling_list.del_flg' => 1, 'Selling_list.status' => 1),
                                array ('Selling_list.deadline <=' => date("Y-m-d H i s"), 'Selling_list.status' => 0)
                                );







        /* 取引完了(status=2)の場合（取引完了５日後にdel_flgたてる） */ 

        $delete_day = date("Y-m-d H i s", strtotime('-5 day'));

        //SellingList
        $this->Selling_list->updateAll(
                                array ('Selling_list.del_flg' => 1),
                                array ('Selling_list.tradedate <=' => $delete_day, 'Selling_list.status' => 2)
                                );

        //WantedList
        $this->Wanted_list->updateAll(
                                array ('Wanted_list.del_flg' => 1),
                                array ('Wanted_list.tradedate <=' => $delete_day,'Wanted_list.status' => 2)
                                );


        
        $this->out('Complete');
    }
	
	

}



?>