<h2>商品詳細</h2>
<br />


<?php //foreach($sellinglists as $sellinglist): ?>


<?php //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ここから普通の人がみたときの画面↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓?>

<div class = "container well">
	<center>
		<?php //写真① ?>
		<div style="float:left; margin-left: 30px;">
			<?php echo $this->Html->image($sellinglists[0]['SellingList']['img_file_name1'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />
<!-- 								<center>[写真①]</center> -->
		</div>

		<?php //写真② ?>
		<?php //もし写真②がない場合は非表示 ?>
		<?php //$sellinglists['SellingList']['img_file_name2'] = ""; ?>
		<?php if (empty($sellinglists[0]['SellingList']['img_file_name2']) || ($sellinglists[0]['SellingList']['img_file_name2'] == "NULL")) { ?>
		<?php }else{ ?>
			<div style="float:left; margin-left: 30px;">
				<?php echo $this->Html->image($sellinglists[0]['SellingList']['img_file_name2'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />
<!-- 								<center>[写真②]</center> -->
			</div>
		<?php } ?>

		<?php //写真③ ?>
		<?php //もし写真③がない場合は非表示 ?>
		<?php //$sellinglists['SellingList']['img_file_name3'] = ""; ?>
		<?php if (empty($sellinglists[0]['SellingList']['img_file_name3']) || ($sellinglists[0]['SellingList']['img_file_name3'] == "NULL")) { ?>
		<?php }else{ ?>
			<div style="float:left; margin-left: 30px;">
				<?php echo $this->Html->image($sellinglists[0]['SellingList']['img_file_name3'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />
<!-- 								<center>[写真③]</center> -->
			</div>
		<?php } ?>
	</center>
<br />
<br />


<!-- 
<p><?php echo $this->Html->image($sellinglists['SellingList']['img_file_name1']); ?></p> -->

<div style="clear:both;">
	<?php //商品名 ?>
	<p>タイトル: <?php echo $sellinglists[0]['SellingList']['sellingproduct_name']; ?></p>

	<?php //商品詳細 ?>
	<p>商品詳細: <?php echo $sellinglists[0]['SellingList']['sellingproduct_detail']; ?></p>

	<?php //商品カテゴリー ?>
	<p>カテゴリー: <?php echo $sellinglists[0]['Category']['category_title']; ?></p>

	<?php //商品価格 ?>
	<p>商品価格: <?php echo $sellinglists[0]['SellingList']['sellingproduct_price']; ?></p>

	<?php //締め切り ?>
	<p>締め切り日: <?php echo $sellinglists[0]['SellingList']['deadline']; ?></p>

	<?php //endforeach ?>
</div>


<?php //--------------------------------------------?>


<div align = "center">
	<h2>コメント</h2>
		<?php echo $this->Form->create('SellingThreadList'); ?>

	<div class="row">
		<!-- <div class="col-xs-6"> -->
		<?php //コメント投稿 ?>
		<?php echo $this->Form->input('thread',
										array(
											// 'label'=>'商品価格&nbsp;&nbsp;',
											'class'=>array('form-control','form-group'),
											// 'placeholder'=>'価格を入力してください'
											 )
										);

		?>

		<?php //商品のidを送っている ?>
		<?php echo $this->Form->hidden('sellinglist_id',
									array('value' => $sellinglists[0]['SellingList']['id'])
									); ?>

		<?php echo $this->Form->submit('投稿');?>
		<?php echo $this->Form->end();  ?>
	</div>


<?php //以下コメントの表示?>

<center>
    <dl id="acMenu">
    <dt>

	<?php foreach($sellingthreadlists as $threadlist): ?>

		<?php //もしコメントにひもづくsellinglist_idが商品idと一緒だったら ?>
		<?php //もしログインユーザーのidが、コメントしているユーザー、もしくは出品しているユーザーだったら ?>
		<?php if ($threadlist['SellingThreadList']['sellinglist_id'] == $sellinglists[0]['SellingList']['id']) {?>

        	<div class="media">
  						<a class="pull-left" href="#">
    						<img class="media-object img-circle" src="https://graph.facebook.com/<?php echo $threadlist['User']['facebook_id']; ?>/picture?type=square" alt="No image">
  						</a>
  			<div class="media-body">

    			<h4 class="media-heading">
						<table width="100%">
                			<tr>
                				<td>
   						     		<div style="float:left"><?php echo $threadlist['User']['name']; ?></div><!-- ユーザー名 -->
    					     		<div style="float:right"><?php echo $threadlist['SellingThreadList']['created']; ?></div><!-- 投稿日時 -->
								</td>	
                			</tr>

    			


				<?php　//スレッド内容の呼び出し ?>
							<tr>
								<td style="border: 2px solid #cccccc" align="left">
    							 	<?php echo $threadlist['SellingThreadList']['thread']; ?><!-- 欲しいもの詳細表示 -->
								</td>
							</tr>
						</table>
				</h4>
			</div>
			
		</div>	

		<?php } ?>

	<?php endforeach; ?>

    </dt>
    </dl>
</center>		


</div>


</div>



<br /><br /><br />



<?php //↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ここまで普通の人がみたときの画面↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑?>






<?php //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ここから出品者の場合の画面↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓?>


<?php
//もしログインユーザーidが商品のuser_idと同一だったら
//if ($user == $sellinglists['SellingList']['user_id']){ ?>


↓投稿者が見たとき↓


<div class = "container well">

	<?php //写真① ?>
	<div style="float:left; margin-left: 30px;">
		<?php echo $this->Html->image($sellinglists[0]['SellingList']['img_file_name1'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />
<!-- 								<center>[写真①]</center> -->
	</div>

	<?php //写真② ?>
	<?php //もし写真②がない場合は非表示 ?>
	<?php if (empty($sellinglists[0]['SellingList']['img_file_name2']) || ($sellinglists[0]['SellingList']['img_file_name2'] == "NULL")) { ?>
	<?php }else{ ?>
		<div style="float:left; margin-left: 30px;">
			<?php echo $this->Html->image($sellinglists[0]['SellingList']['img_file_name2'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />
<!-- 								<center>[写真②]</center> -->
		</div>
	<?php } ?>

	<?php //写真③ ?>
	<?php //もし写真③がない場合は非表示 ?>
	<?php if (empty($sellinglists[0]['SellingList']['img_file_name3']) || ($sellinglists[0]['SellingList']['img_file_name3'] == "NULL")) { ?>
	<?php }else{ ?>
		<div style="float:left; margin-left: 30px;">
			<?php echo $this->Html->image($sellinglists[0]['SellingList']['img_file_name3'],
								array('width'=>'100%','height'=>'250')
								); 

								?>
								<br />
<!-- 								<center>[写真②]</center> -->
		</div>
	<?php } ?>

<br />
<br />

<div style="clear:both;">
	<?php 
		echo $this->Form->create('SellingList', 
							array('type'=>'file','enctype' => 'multipart/form-data'));
 	?>

	<?php
		//写真①を編集
    	echo $this->Form->input('img_file_name1', 
    								array(
    									'type' => 'file', 'multiple',
    									'label' => '写真①'
    									)
    	);

    	//写真②を編集
    	echo $this->Form->input('img_file_name2', 
    								array(
    									'type' => 'file', 'multiple',
    									'label' => '写真②'
    									)
    	);

    	//写真③を編集
  		echo $this->Form->input('img_file_name3', 
    								array(
    									'type' => 'file', 'multiple',
    									'label' => '写真③'
    									)
    	);
	?>

<br />

<?php //echo $this->Form->hidden('user_id'); ?>

<?php //商品内容アップ------------------------------  ?>
<?php //商品タイトル----- ?>
<div class="row">
	<div class="col-xs-6">

		<?php　//商品名編集 ?>
		<?php echo $this->Form->input('sellingproduct_name', 
										array(
											'label' => '商品名',
											'class'=>array('form-control','form-group'),
											'placeholder'=>'商品名を入力してください')
										);
		?>
	</div>
</div>

<div class="row">
	<div class="col-xs-6">
		<?php　//商品詳細編集 ?>
		<?php echo $this->Form->input('sellingproduct_detail',
										array(
											'rows' => '3', 
											'label'=>'商品詳細',
											'class'=>array('form-control','form-group'),
											'placeholder'=>'商品詳細を入力してください')
										);
		?>
	</div>
</div>

<br />

		<?php //カテゴリー編集 ?>
		<?php echo $this->Form->input('category_id',
											array(			
												'type'=>'select',						
												'label'=>'カテゴリー&nbsp;&nbsp;',
												'options'=>$categories
												)
											);

		?>

<br />


<div class="row">
<!-- <div class="col-xs-2"> -->
	<?php //商品価格編集　?>
	<?php echo $this->Form->input('sellingproduct_price',
										array(
											'label'=>'&nbsp&nbsp&nbsp&nbsp商品価格&nbsp;&nbsp;',
											'type' => 'text',
											'class'=>
												array(
													//'form-control',
													'form-group'
													),
											// 'placeholder'=>'価格を入力してください'
											 )
										);

	?> 
<!-- </div> -->
</div>

		<?php //echo $this->Form->checkbox('sellingproduct_price.チェックボックス',
										//array('checked' => true)
										//);

		?>
		<?php //echo $this->Form->label(' 無料で出品'); ?>


		<?php //締め切り編集 ?>
		<?php echo $this->Form->input('deadline',
										array(
											'label'=>'締め切り日&nbsp;&nbsp;',

											// 'class'=>
											// array(
											// 	// 'form-control',
											// 	//'form-group'),
											// //'placeholder'=>'締め切り日を入力してください'
											'monthNames' => false,
    										'maxYear' => date('Y') + 10,
    										//'minYear' => date('Y')  10,
    										'separator' => array('&nbsp;月&nbsp;', '&nbsp;日&nbsp;', '&nbsp;年&nbsp;&nbsp;'),
											 )
										);
		?>


<br />
		<?php //投稿ボタンを押したときに表示される確認 ?>
		<?php
			$msg = __('商品を投稿します。よろしいですか？', true);
		?>

		<?php echo $this->Form->submit(__('投稿', true), array('name'=>'hoge', 'onClick'=>"return confirm('$msg')"));?>
		<?php echo $this->Form->end();  ?>


</div>



<?php //↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ここまで出品者がみたときの画面↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑?>


<?php //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ここからコメント↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓?>


<div align = "center">
	<h2>コメント</h2>
		<?php echo $this->Form->create('SellingThreadList'); ?>

	<div class="row">
		<!-- <div class="col-xs-6"> -->
		<?php //コメント投稿 ?>
		<?php echo $this->Form->input('thread',
										array(
											// 'label'=>'商品価格&nbsp;&nbsp;',
											'class'=>array('form-control','form-group'),
											// 'placeholder'=>'価格を入力してください'
											 )
										);

		?>

		<?php //商品のidを送っている ?>
		<?php echo $this->Form->hidden('sellinglist_id',
									array('value' => $sellinglists[0]['SellingList']['id'])
									); ?>

		<?php echo $this->Form->submit('投稿');?>
		<?php echo $this->Form->end();  ?>
	</div>


<?php //以下コメントの表示?>

<center>
    <dl id="acMenu">
    <dt>

	<?php foreach($sellingthreadlists as $threadlist): ?>

		<?php //もしコメントにひもづくsellinglist_idが商品idと一緒だったら ?>
		<?php //もしログインユーザーのidが、コメントしているユーザー、もしくは出品しているユーザーだったら ?>
		<?php if ($threadlist['SellingThreadList']['sellinglist_id'] == $sellinglists[0]['SellingList']['id']) {?>

        	<div class="media">
  						<a class="pull-left" href="#">
    						<img class="media-object img-circle" src="https://graph.facebook.com/<?php echo $threadlist['User']['facebook_id']; ?>/picture?type=square" alt="No image">
  						</a>
  			<div class="media-body">

    			<h4 class="media-heading">
						<table width="100%">
                			<tr>
                				<td>
   						     		<div style="float:left"><?php echo $threadlist['User']['name']; ?></div><!-- ユーザー名 -->
    					     		<div style="float:right"><?php echo $threadlist['SellingThreadList']['created']; ?></div><!-- 投稿日時 -->
								</td>	
                			</tr>

    			


				<?php　//スレッド内容の呼び出し ?>
							<tr>
								<td style="border: 2px solid #cccccc" align="left">
    							 	<?php echo $threadlist['SellingThreadList']['thread']; ?><!-- 欲しいもの詳細表示 -->
								</td>
							</tr>
						</table>
				</h4>
			</div>
			
		</div>	

		<?php } ?>


		<?php //この人に決定ボタン ?>
		





	<?php endforeach; ?>

    </dt>
    </dl>
</center>	



</div>

</div>

<?php //}//ログインユーザー条件終了 ?>














