<?php

//当降順に各記事を全てソートして配列に保存
$post_lists = array_merge($user['Selling_list'],$user['Selling_thread_list'],$user['Wanted_list'],$user['Wanted_thread_list']);
foreach($post_lists as $key => $row){
$foo[$key] = $row["created"];
}
array_multisort($foo,SORT_DESC,$post_lists);

?>
<div class="col-xs-8 col-xs-offset-4">

    <?php 
    foreach($post_lists as $post_list){ ?>

      <div class="col-xs-8 col-xs-offset-2">
        <div>
          <?php
            switch ($post_list['status']) {
              case '0': ?>
                <span class="label label-primary">
                <?php
                echo "掲載中";
                break;
              case '1': ?>
                <span class="label label-success">
                <?php
                echo "取引完了";
                break;
              case '2': ?>
                <span class="label label-defaut">
                <?php
                echo "掲載終了";
                break;
              default:
                break;
            } 
          ?>
        </span>
        </div>
        <div class="bs-component">
          <!-- <div class="panel panel-success" onclick="test();" style="cursor:pointer;"> -->
          <div class="panel panel-success">
            <div class="panel-heading">
              <?php

              //論理名が統一されていないので場合分け
              if(isset($post_list['sellingproduct_name'])){
                echo "出品商品：　".$post_list['sellingproduct_name'];
              }else if(isset($post_list['thread'])){
                echo "コメント内容";
              }else if(isset($post_list['wanteddetail'])){
                echo "欲しい記事投稿内容";
              }

              ?>
            </div>
            <div class="panel-body">

              <?php

              //論理名が統一されていないので場合分け
              if(isset($post_list['sellingproduct_name'])){ ?>
              <div class ="col-xs-4">
                <?php
                echo $this->Html->image($post_list['img_file_name1'], array('alt' => '表示できません','style' => 'height:auto; width:100px;'));
                 //echo $this->Html->image('img.jpg', array('alt' => 'CakePHP','style' => 'height:auto; width:100px;'));
                ?>
              </div>
              <div class ="col-xs-8">
              <?php
                echo $this->Form->postLink(
                $post_list["sellingproduct_detail"],
                array('controller' => 'Selling_lists','action' => 'productdetail', $post_list["id"]),array('escape' => false));
              ?>
              </div>
              <?php
              }else if(isset($post_list['thread'])){
                echo $post_list['thread'];
              }else if(isset($post_list['wanteddetail'])){
                echo $post_list['wanteddetail'];
              }

              ?>
              
            </div>
            <div class="panel-footer">

                           <?php

              //論理名が統一されていないので場合分け
              if(isset($post_list['sellingproduct_name'])){
                echo "商品名　：　".$post_list['sellingproduct_name'].'<br>';
                echo "価格　　：　".$post_list['sellingproduct_price'].'ペソ<br>';
                echo "締め切り：　".$post_list['deadline'].'<br>';
              }else if(isset($post_list['thread'])){
                echo "投稿日時：　".$post_list['created'];
              }else if(isset($post_list['wanteddetail'])){
                echo "投稿日時：　".$post_list['created'];
              }

              ?>

            </div>
          </div>
        </div>
      </div>
    

    <?php } ?>

</div>

<!-- 
<?php $this->Html->scriptStart(array('inline' => false)); ?>
function test(){

    window.location=$(this).find("a").attr("href");
    return false;

}


<?php $this->Html->scriptEnd(); ?>
 -->