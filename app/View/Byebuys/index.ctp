
<!-- ログインボタン・ログインユーザーの表示 -->

<?php


if(is_array($self) && empty($self)){  
		

		echo $this->Html->link('<div style="text-align:right;"><button class="btn btn-mini btn-default" type="button">ログイン</button></div>',array('controller' => 'fbconnects','action' => 'facebook'),array('escape' => false));
		
		}else{ ?>

		<div align="right">
		<div class="media" style="margin-top:10px;">
		   <a class="pull-right" href="#">
			 <img src="https://graph.facebook.com/<?php echo $self['User']['facebook_id']; ?>/picture?type=square" align="left" style="margin-left:10px;" class="img-circle"></a>
				<div class="media-body">
				  <h4 class="media-heading"><?php echo $self['User']['name'];?></h4>
	
		</div>
		</div>
		<?php
		echo $this->Html->link('<div style="text-align:right;"><button class="btn btn-mini btn-default" type="button">logout</button></div>',array('controller' => 'fbconnects','action' => 'logout'),array('escape' => false));

		 } ?>

<!-- ここまで　ログインボタン・ログインユーザーの表示　ここまで -->

<!-- ナビゲーションバー -->

<a href="#" align="right">投稿管理</a>
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#">出品中</a></li>
  <li><a href="#">ほしい</a></li>
  <li><a href="#">ウォッチリスト</a></li>
  <li><a href="#">投稿管理</a></li>
</ul>


<!-- ここまで　ナビゲーションバー ここまで　-->


<!--検索フォーム-->
<?php
       echo $this->Form->create('Selling_list',array(
       'class'=>'form-inline','role'=>'form',));//→postcontorollerのindex functionに値が渡せる。

       echo $this->Form->input('keyword',array(
       'label'=>false,'class'=>'form-controll'));//このキーワードが連想配列のキーになっている。

       echo $this->Form->button('<span class="glyphicon glyphicon-search"></span>Search',array('type'=>'submit','label'=>false,'class'=>'btn btn-mini btn-default','escape'=>false));

       echo $this->Form->end();
?>
<!--ここまで　検索フォーム　ここまで-->

<!--ページネーション-->

<div class ="pagination pagination-large">

        <?php echo $this->Paginator->numbers();
        //必要なページ番号のリンクを自動的に吐き出す ?>
</div>

<!--ここまで　ページネーション　ここまで-->


<!-- コンテンツ -->

<div class ="container" align="center" style="margin:20px;margin-top:50px;">
	<div class="row">

	  <!-- カテゴリー一覧 -->
	  <div class="col-md-3">
		<div class="list-group">
		<a href="#" class="list-group-item disabled">
		Cras justo odio
		</a>
		<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
		<a href="#" class="list-group-item">Morbi leo risus</a>
		<a href="#" class="list-group-item">Porta ac consectetur ac</a>
		<a href="#" class="list-group-item">Vestibulum at eros</a>
		</div>
	  </div><!--col-md-3-->
	  <!-- ここまで　カテゴリー一覧 ここまで　-->

	<!-- 商品一覧 -->
	<div class="col-md-9">
	<div id="container2">

		<?php  foreach ($products as $product): ?>  <!--リストの中身、プロフィールの中身をサムネイル形式でループ-->

				  <div class="col-md-4 item" style="margin-bottom:15px;">
				    <div class="thumbnail">
				      <img data-src="holder.js/300x300" alt="...">
				      <div class="caption">
				        <h3><?php echo $product['Selling_list']['sellingproduct_name'];?></h3>

				        <div align="left">
					    <?php 

					  	echo '価格:';
					  	echo $product['Selling_list']['sellingproduct_price']; ?>PHP<br /><?php
						echo '商品:';
						echo $product['Selling_list']['sellingproduct_name']; ?><br /><?php
						echo '締め切り:';
						echo $product['Selling_list']['deadline']; ?><br /><?php
						echo '出品者:';
						echo $product['User']['name']; ?><br /><?php 
						
						
						if(is_array($self) && empty($self)){  

							debug('セルフがからっぽ');

						}else{
							debug('セルフあり');

		                    debug($self['User']['id']);
		                    debug($product['Selling_list']['id']);
		                    $id = $self['User']['id'];

							echo $this->Form->create('Wacthlist');
							echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$self['User']['id']));
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


 <!-- <img src="/wannadoList/img/loginBtn.png" alt=""> -->
