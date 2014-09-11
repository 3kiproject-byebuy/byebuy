

<?php //headerのよみこみ
	echo $this->Element('header'); 
//現在ログインしているユーザーを取得
$self = $this->Session->read('Auth.User');

?>
<!-- ナビゲーションバー -->

<ul class="nav nav-tabs nav-justified" role="tablist" style="margin-top:20px;margin-bottom:20px;">
  <br />
    <li><?php echo $this->HTML->link('<b>出品中</b>', 
                      array(
                        'controller' => 'byebuys',
                        'action'=>'index'),
                      array(
                        'escape'=>false)
                          ); ?></li>

    <li><?php echo $this->HTML->link('<b>ほしい</b>', 
                          array(
                            'controller' => 'wanted_lists',
                            'action'=>'index'),
                          array(
                            'escape'=>false)
                          ); ?></li>
                          
    <?php
          //ユーザーが未ログインの場合
          if (is_null($self)){ 
            
              //なにも表示させない

          //ユーザーがログイン中の場合、ステータスを確認
           }else{

              //【ステータス１】＝ 【承認済みユーザー】 の場合
              if($self['status']==1){

               echo '<li class="active">';

               echo $this->Form->postLink('<b>ウォッチリスト</b>',
                    array(
                      'controller'=>'watchlists',
                      'action'=>'index',
                      $self['id']),
                    array(
                        'escape'=>false)
                      ); 

               echo '</li>';

              //【ステータス２】または【ステータス３】＝ 【未承認ユーザー】 の場合
              }else{

                  //なにも表示させない

            }
          }?>


    <?php
          //ユーザーが未ログインの場合
          if (is_null($self)){ 

            //なにも表示させない

          //ユーザーがログイン中の場合、ステータスを確認
           }else{

              //【ステータス１】＝ 【承認済みユーザー】 の場合
              if($self['status']==1){

               echo '<li>';

               echo $this->Form->postLink('<b>投稿管理</b>',
                    array(
                      'controller'=>'postmanagements',
                      'action'=>'index',
                       $self['id']),
                    array(
                        'escape'=>false)
                      ); 

               echo '</li>';

              //【ステータス２】または【ステータス３】＝ 【未承認ユーザー】 の場合
              }else{

                  //なにも表示させない
                
            }

          }?>
</ul>

<!--ここまで　ナビゲーションバー　ここまで-->

<?php //startページネーション------------------------------------------------------------------------?>

		<div align = "center">
			<div class = "pagination pagination-large">
				<li>
					<?php echo $this->Paginator->prev('前へ'); ?>
					<?php echo $this->Paginator->numbers(); ?>
					<?php echo $this->Paginator->next('次へ'); ?>
				</li> 
			</div>	
		</div>

<?php //endページネーション------------------------------------------------------------------------?>




<?php //start検索--------------------------------------------------------------------------------- ?>
<?php
	//キーワード検索にしたいので、文字をkeywordにする
    // echo $this->Form->input('keyword',
    //                             array(
    //                                 'class' => array('form-control','form-inline'),
    //                                 'placeholder'=>'検索ワード入力',
    //                                 'label' => false,
    //                                 // 'div' => ''


    //                                 )
    //                       );

?>   

<?php

	// echo $this->Form->button('<span class="glyphicon glyphicon-search"></span>Search', 
 //                                array('type' => 'submit',
 //                                    'class' => 'btn',
 //                                    'label' => false,
 //                                    // 'div' => 'col-xs-4', array('style' => 'foat:right;')
 //                                    )
 //                                );



 //    echo $this->Form->end();
?>


<?php //end検索--------------------------------------------------------------------------------- ?>




<?php //startカテゴリーリスト------------------------------------------------------------------------?>


<?php //カテゴリーによりソートされたときの表示 ?>
<div class="col-md-3">
<div class = "list-group">
	<?php foreach ($categories as $category): ?>
<?php //↓カテゴリー件数表示処理↓------------------- ?>
<!-- 	<span class = "badge">
		<?php echo $category['Category']['count']; ?>
	</span> -->
<?php //↑カテゴリー件数表示処理↑-------------------　?>
			<?php echo $this->Html->link($category['Category']['category_title'],
											array(
												'controller'=>'watchlists',
												'action'=>'category_index',
												$category['Category']['id']),
													array('class'=>'list-group-item')
												); 
		
	?>
	<?php endforeach; ?>
  <?php echo $this->Form->postLink('すべてのカテゴリー', array(
                                                        'controller'=>'watchlists',
                                                        'action'=>'index',$self['id']),
                                                      array('class'=>'list-group-item'));
                                                        ?>
</div>
</div>




	
<?php //endカテゴリーリスト------------------------------------------------------------------------?>




<?php //商品一覧------------------------------------------------------------------------?>

<div class = "col-md-9">
<div id="container2">

  <?php 
  if(!$watchlists){

    echo 'このカテゴリーの商品は現在ありません。';

  }?>

<?php //Watchlistのデータをforeachでまわして読み取る ?>
<?php foreach($watchlists as $watchlist): ?>
<!-- <div class="row"> -->
  <div class="col-md-4 item" style="margin-bottom:15px;">
    <div class="thumbnail">
     <a href="/byebuy/SellingLists/productdetail/<?php echo $watchlist['Selling_list']['id'];?>">
      <img src="/byebuy/app/webroot/img/<?php echo $watchlist['Selling_list']['img_file_name1']?>"></a>
      <div class="caption">
        <h3>商品名: <?php echo $watchlist['Selling_list']['sellingproduct_name']; ?></h3>
        <p>価格: <?php if($watchlist['Selling_list']['sellingproduct_price']==0){
            echo '無料';
          }else{

            echo $watchlist['Selling_list']['sellingproduct_price'];
            echo 'PHP';

          }
           ?><br /></p>
           
        <?php
        $current_date = date('Y-m-d H:i:s');
        //締め切り-現在　=> 24h 黒字
        // 締め切り-現在　<= 0 掲載終了
        // 0 ＜　締め切りー現在　＜　24h 赤字

        if((strtotime($watchlist['Selling_list']['deadline']) - strtotime($current_date)) >= 86400 ){

            echo '締め切り:';
            echo $watchlist['Selling_list']['deadline']; 

        }

        if((strtotime($watchlist['Selling_list']['deadline']) - strtotime($current_date)) <= 0){ ?>

              <font color="#ff0000"> 
              <?php
            echo 'この商品取引は終了しました。';
            ?>
            </font>

    <?php  }

        if( 0 < (strtotime($watchlist['Selling_list']['deadline']) - strtotime($current_date)) &&
          (strtotime($watchlist['Selling_list']['deadline']) - strtotime($current_date)) < 86400){ ?>

            <font color="#ff0000"> 
            <?php
            echo '締め切り:';
            echo $watchlist['Selling_list']['deadline']; ?>
            </font>

        <?php } ?>

        <p>出品者: <?php echo $watchlist['User']['name']; ?></p>
      </div>
    </div>
<!--   </div> -->
</div>
<?php endforeach; ?>



<!-- </div>  -->

</div>


<?php //end商品一覧------------------------------------------------------------------------?>










