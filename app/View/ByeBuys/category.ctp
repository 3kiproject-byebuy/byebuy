
<?php 
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

	<!--　検索　ソート　商品一覧 -->
	<div class="col-md-9">
		<!--検索・ソート機能-->
		  <div class="row" align="right" style="height:30px;">
		    <div class="col-md-7" style="padding-right:0px;padding-left:30px;"><!--ソート機能-->
				<a href="/byebuy/byebuys/category/<?php echo $this->passedArgs[0];?>/sort:Selling_list.id/direction:desc" 
				class="btn btn-default btn-sm col-md-2" role="button">新着</a>
				<a href="/byebuy/byebuys/category/<?php echo $this->passedArgs[0];?>/sort:Selling_list.deadline/direction:asc"
				class="btn btn-default btn-sm col-md-2 col-md-offset-1" role="button">締め切り</a>
				<a href="/byebuy/byebuys/category/<?php echo $this->passedArgs[0];?>/sort:Selling_list.sellingproduct_price/direction:desc"
				class="btn btn-default btn-sm col-md-2 col-md-offset-1" role="button">価格が高い</a>
				<a href="/byebuy/byebuys/category/<?php echo $this->passedArgs[0];?>/sort:Selling_list.sellingproduct_price/direction:asc"
				class="btn btn-default btn-sm col-md-2 col-md-offset-1" role="button">価格が安い</a>
			</div><!--ここまで　ソート機能　ここまで-->

			<div class="col-md-5" style="padding-right:30px;padding-left:0px;"><!--検索フォーム-->
				<?php
				echo $this->Form->create('Selling_list',array(
				'class'=>'form-inline','role'=>'form','style' => 'margin-bottom:20px;'));

				echo $this->Form->input('Selling_list.keyword',array(
				'label'=>false,'class'=>'form-controll','style' => 'margin-right:10px;','div' => array('class' => 'form-group')));

				echo $this->Form->button('<span class="glyphicon glyphicon-search"></span>Search',array('type'=>'submit','label'=>false,'class'=>'btn btn-sm btn-default','escape'=>false));

				echo $this->Form->end();
				?>
		    </div><!--ここまで　検索フォーム　ここまで-->

		</div><!--row--><!--　ここまで　検索・ソート機能　ここまで-->
		
		<!--ページネーション-->
		<CENTER>
		<div class ="pagination pagination-large" style="margin-top:0px;margin-bottom:15px;">
		  <?php echo $this->Paginator->numbers();//必要なページ番号のリンクを自動的に吐き出す ?>
		</div>
		</CENTER>
		<!--ここまで　ページネーション　ここまで-->


	<div id="container2"><!--商品一覧-->

	<?php 
	if(!$products){

		echo 'このカテゴリーの商品は現在ありません。';

	}

		  foreach ($products as $product): ?>  <!--リストの中身、プロフィールの中身をサムネイル形式でループ-->

				  <div class="col-md-4 item" style="margin-bottom:15px;">
				    <div class="thumbnail">
				      
				      <a href="/byebuy/sellingLists/productdetail/<?php echo $product['Selling_list']['id'];?>"><img src="/byebuy/img/<?php echo $product['Selling_list']['img_file_name1']; ?>" alt="表示できません"></a>

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

			  	 		?><br />

			  	 		<?php
						echo '商品:';
						echo $product['Selling_list']['sellingproduct_name']; 

						/*  【締め切りの書き分け】
							締め切り-現在　=> 24h 黒字
							締め切り-現在　<= 0 掲載終了
							0 ＜　締め切りー現在　＜　24h 赤字
															*/
						$current_date = date('Y-m-d H:i:s');
						$finishFlag = 0;


				  		if($product['Selling_list']['status']==2){

		  				 	$finishFlag = 1;
		  				 }else{

							if((strtotime($product['Selling_list']['deadline']) - strtotime($current_date)) >= 86400 ){

									echo '<br />';
									echo '締め切り:';
									echo $product['Selling_list']['deadline']; 

							}

							if((strtotime($product['Selling_list']['deadline']) - strtotime($current_date)) <= 0){ ?>

								 <?php $finishFlag = 1; ?>

					 <?php  }

							if( 0 < (strtotime($product['Selling_list']['deadline']) - strtotime($current_date)) &&
								(strtotime($product['Selling_list']['deadline']) - strtotime($current_date)) < 86400){ ?>

								<font color="#ff0000"> 
								<?php
								echo '<br />';
								echo '締め切り:';
								echo $product['Selling_list']['deadline']; ?>
								</font>

					  <?php }

						}?>


						<br />
						<?php
						echo '出品者:';
						echo $product['User']['name']; ?><br /><?php 
						
						
						if(is_null($self)){  

							if($finishFlag == 1){//取引終了の場合

							echo '<span class="label label-danger">取引終了</span>';

							}

						}else{

		                    $id = $self['id'];

							echo $this->Form->create('Wacthlist');
							echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$self['id']));
							echo $this->Form->input('sellinglist_id',array('type'=>'hidden','value'=>$product['Selling_list']['id']));
							
							$flag = 0;
							foreach ($myListItems as $myListItem) {

								if($myListItem['Watchlist']['sellinglist_id']==$product['Selling_list']['id']){

									//echo 'ウォッチリストに登録済み';
									$flag = 1;
									break;		
								}
								
							}

							//ウォッチリスト登録ボタン、登録済みバッチ、取引終了バッチ表示
							//ウォッチリストに未登録かつ、取引終了前だったら
							if(($flag==0) && ($finishFlag == 0)){

							echo $this->Form->button('<b>ウォッチリストに登録</b>', 
							array('type' => 'submit','class'=>'btn btn-primary btn-xs','style'=>'margin-top:15px;', 'label' => false, 'escape' => false));

							}elseif($finishFlag == 1){//取引終了の場合

								echo '<span class="label label-danger">取引終了</span>';

							}elseif($flag==1){//登録済みの場合

								echo '<span class="label label-default">ウォッチリストに登録済み</span>';
							
							}
							
							echo $this->Form->end(); 
						}
						

						?>

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
