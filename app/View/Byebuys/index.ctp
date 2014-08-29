<?php 
echo $this->Element('header');
?>


<!-- コンテンツ -->
<div class ="container" style="margin-top:50px;">
	<div class="row">

	  <!-- カテゴリー一覧 -->
	  <div class="col-md-3">
		<div class="list-group">
		<?php 
		foreach ($categories as $category) {	
		echo $this->Html->link($category['Category']['category_title'],array('controller'=>'byebuys','action'=>'category',$category['Category']['id']),array('class'=>'list-group-item')); 
		}?>
		<a href="/ByeBuy/byebuys/index" class="list-group-item" draggable="true">すべてのカテゴリー</a>
		</div>
	  </div><!--col-md-3-->
	  <!-- ここまで　カテゴリー一覧 ここまで　-->

	<!-- 商品一覧 -->
	<div class="col-md-9">
	<div id="container2">

	　
		<?php  foreach ($products as $product): ?>  <!--リストの中身、プロフィールの中身をサムネイル形式でループ-->

		  <div class="col-md-4 item" style="margin-bottom:15px;">
		    <div class="thumbnail">
		      <!-- <img data-src="ByeBuy/app/webroot/img/cake.icon.png" alt="表示できません" class="col-md-12"> -->

		      <a href="/ByeBuy/seliinglists/productdetail/<?php echo $product['Selling_list']['id'];?>"><img src="/ByeBuy/img/<?php echo $product['Selling_list']['img_file_name1']; ?>" alt="表示できません"></a>

		      <div class="caption">
		        <h3><?php echo $product['Selling_list']['sellingproduct_name'];?></h3>

		        <div align="left">
			    <?php 

			  	echo '価格:';
			  	echo $product['Selling_list']['sellingproduct_price']; ?>PHP<br /><?php
				echo '商品:';
				echo $product['Selling_list']['sellingproduct_name']; ?><br /><?php

				$current_date = date('Y-m-d H:i:s');
					if((strtotime($product['Selling_list']['deadline']) - strtotime($current_date)) < 86400){ ?>

					<font color="#ff0000"> 
					<?php
					echo '締め切り:';
				echo $product['Selling_list']['deadline'];
				?>
				</font>

				<?php
					}else{

				echo '締め切り:';
				echo $product['Selling_list']['deadline']; 

					} ?>


				<br /><?php
				echo '出品者:';
				echo $product['User']['name']; ?><br /><?php 
				
				
				if(is_null($self)){  

					//debug('セルフがからっぽ');

				}else{

                    //debug($self['id']);
                    //debug($product['Selling_list']['id']);
                    $id = $self['id'];

					echo $this->Form->create('Watchlist',array('url'=>'favorite'));
					echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$self['id']));
					echo $this->Form->input('sellinglist_id',array('type'=>'hidden','value'=>$product['Selling_list']['id']));
					//echo $this->Html->Html('<p align="right"><button class="btn btn-mini btn-default" type="submit">ウォッチリスト</button></p>',array('escape' => false,'label'=>false));
					echo $this->Form->button('<span class ="glyphicon glyphicon-pencil"></span>
お気に入り', array('type' => 'submit', 'class'=>'btn btn-primary', 'label' => false, 'escape' => false));
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
