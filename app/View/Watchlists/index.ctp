<h2>ウォッチリスト</h2>


<?php //headerのよみこみ
	//echo $this->Element('header'); ?>


<?php //startページネーション------------------------------------------------------------------------?>

<!-- 		<div align = "center">
			<div class = "pagination pagination-large">
				<li>
					<?php echo $this->Paginator->prev('前へ'); ?>
					<?php echo $this->Paginator->numbers(); ?>
					<?php echo $this->Paginator->next('次へ'); ?>
				</li> 
			</div>	
		</div> -->
<?php //endページネーション------------------------------------------------------------------------?>




<?php //start検索--------------------------------------------------------------------------------- ?>

<!-- 
<?php
	//キーワード検索にしたいので、文字をkeywordにする
    echo $this->Form->input('keyword',
                                array(
                                    'class' => array('form-control','form-inline'),
                                    'placeholder'=>'検索ワード入力',
                                    'label' => false,
                                    // 'div' => ''


                                    )
                          );

?>   
	</div>
<?php

	echo $this->Form->button('<span class="glyphicon glyphicon-search"></span>Search', 
                                array('type' => 'submit',
                                    'class' => 'btn',
                                    'label' => false,
                                    // 'div' => 'col-xs-4', array('style' => 'foat:right;')
                                    )
                                );



    echo $this->Form->end();
?>

 -->
<?php //end検索--------------------------------------------------------------------------------- ?>




<?php //startカテゴリーリスト------------------------------------------------------------------------?>


<?php //カテゴリーによりソートされたときの表示 ?>
<div class="col-md-2">
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
</div>
</div>




	
<?php //endカテゴリーリスト------------------------------------------------------------------------?>




<?php //商品一覧------------------------------------------------------------------------?>

<div class = "col-md-9">

<!-- <div class = "container well"> -->
<br />
<?php //Watchlistのデータをforeachでまわして読み取る ?>
<?php foreach($user['Watchlist'] as $watchlist): ?>
<!-- <div class="row"> -->
  <div class="col-md-4 item" style="margin-bottom:15px;">
    <div class="thumbnail">
      <img src="/byebuy/app/webroot/img/<?php echo $watchlist['Selling_list']['img_file_name1']?>"  width ='50%' height='50%'>
      <div class="caption">
        <h3>商品名: <?php echo $watchlist['Selling_list']['sellingproduct_name']; ?></h3>
        <p>価格: <?php echo $watchlist['Selling_list']['sellingproduct_price']; ?></p>

		<?php //締め切り-現在の日付が１日よりすくなかったら
			$current_date = date('Y-m-d H:i:s');
					if((strtotime($watchlist['Selling_list']['deadline']) - strtotime($current_date)) < 86400) { ?>
						
        				<p>締め切り日: 
        					<font color="#ff0000"> 
        					<?php echo $watchlist['Selling_list']['deadline']; ?>
        					</font>
        				</p>
        				
        			<?php
					}else{ ?>
						<p>締め切り日: <?php echo $watchlist['Selling_list']['deadline']; ?></p>
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










