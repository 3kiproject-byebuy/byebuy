
<?php 
echo $this->Element('header');
echo $this->Element('nav');

?>

<!-- コンテンツ -->
<div class ="container" style="margin-top:30px;">
	<div class="row">

	  <!-- カテゴリー一覧 -->
	  <div class="col-md-3">
		<div class="list-group">
		<?php 
		foreach ($categories as $category) {	
		echo $this->Html->link($category['Category']['category_title'],array('controller'=>'byebuys','action'=>'category',$category['Category']['id']),array('class'=>'list-group-item')); 
		}?>
		<a href="/byebuy/byebuys/index" class="list-group-item" draggable="true">すべてのカテゴリー</a>
		</div>
		<?php 
		if (is_null($self)){ ?>

		<!--なにも表示させない-->

		<?php }else{

			if($self['status']==1){ ?>

			<a href="/byebuy/sellingLists/index"><button type="button" class="btn btn-default btn-sm">出品する</button></a>

			<?php
			}else{?>

			<!--なにも表示させない-->

			<?php
			}
		}
		?>
		
	  </div><!--col-md-3-->
	  <!-- ここまで　カテゴリー一覧 ここまで　-->

	<!-- 商品一覧 -->
	<div class="col-md-9">
		<!-- <div class="container"> --><!--検索・ソート機能-->
		  <div class="row" align="right" style="height:30px;">
		    <div class="col-md-7" style="padding-right:0px;padding-left:30px;"><!--ソート機能-->
			<!-- 	 <?php// echo $this->Paginator->sort('Selling_list.deadline', '締め切り');?> -->
			<a href="/byebuy/byebuys/index/sort:Selling_list.id/direction:desc" 
			class="btn btn-default btn-sm col-md-2" role="button">新着</a>
			<a href="/byebuy/byebuys/index/sort:Selling_list.deadline/direction:asc"
			class="btn btn-default btn-sm col-md-2 col-md-offset-1" role="button">締め切り</a>
			<a href="/byebuy/byebuys/index/sort:Selling_list.sellingproduct_price/direction:desc"
			class="btn btn-default btn-sm col-md-2 col-md-offset-1" role="button">価格が高い</a>
			<a href="/byebuy/byebuys/index/sort:Selling_list.sellingproduct_price/direction:asc"
			class="btn btn-default btn-sm col-md-2 col-md-offset-1" role="button">価格が安い</a>
			</div><!--ここまで　ソート機能　ここまで-->

			<div class="col-md-5" style="padding-right:30px;padding-left:0px;"><!--検索フォーム-->
			<?php
			echo $this->Form->create('Selling_list',array(
			'class'=>'form-inline','role'=>'form','style' => 'margin-bottom:20px;'));

			echo $this->Form->input('Selling_list.keyword',array(
			'label'=>false,'class'=>'form-controll','style' => 'margin-right:10px;','div' => array('class' => 'form-group')));//このキーワードが連想配列のキーになっている。

			echo $this->Form->button('<span class="glyphicon glyphicon-search"></span>Search',array('type'=>'submit','label'=>false,'class'=>'btn btn-sm btn-default','escape'=>false));

			echo $this->Form->end();
			?>
			<!-- </div> --><!--ここまで　検索フォーム　ここまで-->
		    </div>
		</div><!--row-->
		<!--検索・ソート機能-->
				<!--ページネーション-->
			<CENTER>
			<div class ="pagination pagination-large" style="margin-top:0px;margin-bottom:15px;">
			  <?php echo $this->Paginator->numbers();//必要なページ番号のリンクを自動的に吐き出す ?>
			</div>
			</CENTER>
		<!--ここまで　ページネーション　ここまで-->
	<div id="container2">

	<?php 
	if(!$products){

		echo 'このカテゴリーの商品は現在ありません。';

	}

		  foreach ($products as $product): ?>  <!--リストの中身、プロフィールの中身をサムネイル形式でループ-->

				  <div class="col-md-4 item" style="margin-bottom:15px;">
				    <div class="thumbnail">
				      
				      <a href="/ByeBuy/seliinglists/productdetail/<?php echo $product['Selling_list']['id'];?>"><img src="/byebuy/img/<?php echo $product['Selling_list']['img_file_name1']; ?>" alt="表示できません"></a>

				      <div class="caption">
				        <h3><?php echo $product['Selling_list']['sellingproduct_name'];?></h3>

				        <div align="left">
					    <?php 

					  	echo '価格:';
					  	if($product['Selling_list']['sellingproduct_price']==0){
			  				echo '無料';
			  			}else{

			  				echo $product['Selling_list']['sellingproduct_price'];
			  				echo 'PHP';

			  			}
			  	 		?><br /><?php
						echo '商品:';
						echo $product['Selling_list']['sellingproduct_name']; ?><br /><?php

						$current_date = date('Y-m-d H:i:s');
      					//締め切り-現在　=> 24h 黒字
						// 締め切り-現在　<= 0 掲載終了
						// 0 ＜　締め切りー現在　＜　24h 赤字

						if((strtotime($product['Selling_list']['deadline']) - strtotime($current_date)) >= 86400 ){

								echo '締め切り:';
								echo $product['Selling_list']['deadline']; 

						}

						if((strtotime($product['Selling_list']['deadline']) - strtotime($current_date)) <= 0){ ?>

							  	<font color="#ff0000"> 
							  	<?php
								echo 'この商品取引は終了しました。';
								?>
								</font>

				 <?php  }

						if( 0 < (strtotime($product['Selling_list']['deadline']) - strtotime($current_date)) &&
							(strtotime($product['Selling_list']['deadline']) - strtotime($current_date)) < 86400){ ?>

								<font color="#ff0000"> 
								<?php
								echo '締め切り:';
								echo $product['Selling_list']['deadline']; ?>
								</font>

				  <?php } ?>


						<br /><?php
						echo '出品者:';
						echo $product['User']['name']; ?><br /><?php 
						
						
						if(is_null($self)){  

							//debug('セルフがからっぽ');

						}else{
		                    $id = $self['id'];

							echo $this->Form->create('Wacthlist');
							echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$self['id']));
							echo $this->Form->input('sellinglist_id',array('type'=>'hidden','value'=>$product['Selling_list']['id']));
							
							foreach ($myListItems as $myListItem) {


							if($myListItem['Watchlist']['sellinglist_id']==$product['Selling_list']['id']){

								echo 'ウォッチリストに登録済み';
								break;
								
							}
							
						}
						echo $this->Form->button('ウォッチリストに追加', array('type' => 'submit', 'class'=>'btn btn-primary', 'label' => false, 'escape' => false));
						echo $this->Form->end(); 

						}?>

				        </div>
				      </div>
				    </div>
				  </div>
		            
		<?php endforeach; ?>
</div><!--col-md-９-->
<!-- ここまで　商品一覧 ここまで-->

</div><!-- container2 -->
</div><!--row-->
</div><!--container-->
