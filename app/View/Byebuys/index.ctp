
	  <?php 
		echo $this->Element('header');
		echo $this->Element('nav');

		//現在ログインしているユーザーを取得
		$self = $this->Session->read('Auth.User');
	  ?>


		<!--ページネーション-->
			<CENTER>
			<div class ="pagination pagination-large" style="margin:0px;">
			  <?php echo $this->Paginator->numbers();//必要なページ番号のリンクを自動的に吐き出す ?>
			</div>
			</CENTER>
		<!--ここまで　ページネーション　ここまで-->

<!-- コンテンツ -->
<div class ="container" style="margin-top:10px;">
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

			<a href="/byebuy/fbconnects/facebook"><button type="button" class="btn btn-default btn-sm">出品する</button></a>

		<?php }else{

			if($self['status']==1){ ?>

			<a href="/byebuy/sellingLists/index"><button type="button" class="btn btn-default btn-sm">出品する</button></a>

			<?php
			}else{?>

			<a href="/byebuy/byebuys/login"><button type="button" class="btn btn-default btn-sm">出品する</button></a>

			<?php
			}
		}
		
		?>
		
	  </div><!--col-md-3-->
	  <!-- ここまで　カテゴリー一覧 ここまで　-->

	<!-- 商品一覧 -->
	<div class="col-md-9">
		<!-- <div class="container"> --><!--検索・ソート機能-->
		  <div class="row" align="right">
		    <div class="col-md-5 col-md-offset-2" style="padding-right:0px;"><!--ソート機能-->
			<!-- 	 <?php// echo $this->Paginator->sort('Selling_list.deadline', '締め切り');?> -->
			<a href="/byebuy/byebuys/index/sort:Selling_list.id/direction:desc" class="btn btn-default btn-sm" role="button">新着</a>
			<a href="/byebuy/byebuys/index/sort:Selling_list.deadline/direction:asc" class="btn btn-default btn-sm" role="button">締め切り</a>
			<a href="/byebuy/byebuys/index/sort:Selling_list.sellingproduct_price/direction:desc" class="btn btn-default btn-sm" role="button">価格が高い</a>
			<a href="/byebuy/byebuys/index/sort:Selling_list.sellingproduct_price/direction:asc" class="btn btn-default btn-sm" role="button">価格が安い</a>
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


	<div id="container2">
		<?php  foreach ($products as $product): ?>  <!--リストの中身、プロフィールの中身をサムネイル形式でループ-->

		  <div class="col-md-4 item" style="margin-bottom:15px;">
		    <div class="thumbnail">
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
						echo $product['Selling_list']['deadline']; ?>
						</font>

				<?php
					}else{

				echo '締め切り:';
				echo $product['Selling_list']['deadline']; 

					} ?>


				<br /><?php
				echo '出品者:';
				echo $product['User']['name']; ?><br /><?php 
				
				
				//現在ログインしているユーザーを取得
				$self = $this->Session->read('Auth.User');
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
					お気に入り', array('type' => 'submit', 'class'=>'btn btn-primary','style'=>'margin:20px;', 'label' => false, 'escape' => false));
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
