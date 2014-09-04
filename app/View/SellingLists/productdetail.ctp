<?php echo $this->Element('header'); ?>



<ul class="nav nav-tabs nav-justified" role="tablist" style="margin-top:20px;margin-bottom:20px;">
  <br />
    <li class="active"><?php echo $this->HTML->link('<b>出品中</b>', 
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
                          
    <li><?php echo $this->HTML->link('<b>ウォッチリスト</b>',
                        array(
                          'controller'=>'watchlists',
                          'action'=>'index'),
                        array(
                            'escape'=>false)
                          ); ?></li>


    <li><?php echo $this->HTML->link('<b>投稿管理</b>',
                        array(
                          'controller'=>'postmanagements',
                          'action'=>'index'),
                        array(
                            'escape'=>false)
                          ); ?></li>
</ul>

<br />
<h2>商品詳細</h2>
<br />

<br />
<br />


<?php //もしログインユーザーidが商品のuser_idと同一ではなかったら（ログインユーザーが出品者ではない場合） ?>
<?php if($sellinglists[0]['Selling_list']['user_id'] !== $self['id']) { ?>

<?php //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ここから普通の人がみたときの画面↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓?>

<div class = "container well">
	<center>
		<?php //写真①を表示 ?>
		<div style="float:left; margin-left: 30px;">
			<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name1'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />

		</div>

		<?php //写真②を表示 ※もし写真②がない場合は非表示 ?>
		<?php //$sellinglists['SellingList']['img_file_name2'] = ""; ?>
		<?php if (empty($sellinglists[0]['Selling_list']['img_file_name2']) || ($sellinglists[0]['Selling_list']['img_file_name2'] == "NULL")) { ?>
		<?php }else{ ?>
			<div style="float:left; margin-left: 30px;">
				<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name2'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />

			</div>
		<?php } ?>

		<?php //写真③ ※もし写真③がない場合は非表示?>
		<?php //$sellinglists['SellingList']['img_file_name3'] = ""; ?>
		<?php if (empty($sellinglists[0]['Selling_list']['img_file_name3']) || ($sellinglists[0]['Selling_list']['img_file_name3'] == "NULL")) { ?>
		<?php }else{ ?>
			<div style="float:left; margin-left: 30px;">
				<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name3'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />

			</div>
		<?php } ?>
	</center>
<br />


<!-- 
<p><?php echo $this->Html->image($sellinglists['SellingList']['img_file_name1']); ?></p> -->

<div style="clear:both;">
	<br />
	<?php //商品名を表示 ?>
	<p>○&nbsp;タイトル: <?php echo $sellinglists[0]['Selling_list']['sellingproduct_name']; ?></p>

	<?php //商品詳細を表示 ?>
	<p>○&nbsp;商品詳細: <?php echo $sellinglists[0]['Selling_list']['sellingproduct_detail']; ?></p>

	<?php //商品カテゴリーを表示?>
	<p>○&nbsp;カテゴリー: <?php echo $sellinglists[0]['Category']['category_title']; ?></p>

	<?php //商品価格 ?>
	<p>○&nbsp;商品価格: <?php echo $sellinglists[0]['Selling_list']['sellingproduct_price']; ?></p>

	<?php //締め切り ?>
		<?php //締め切り-現在の日付が１日よりすくなかったら
			$current_date = date('Y-m-d H:i:s');
					if((strtotime($sellinglists[0]['Selling_list']['deadline']) - strtotime($current_date)) < 86400) { ?>
						
        				<p>○&nbsp;締め切り日: 
        					<font color="#ff0000"> 
        					<?php echo $sellinglists[0]['Selling_list']['deadline']; ?>
        					</font>
        				</p>
        				
        			<?php
					}else{ ?>
						<p>○&nbsp;締め切り日: <?php echo $sellinglists[0]['Selling_list']['deadline']; ?></p>
					<?php } ?>


	<?php //出品者 ?>
	<p>○&nbsp;出品者: </p>
	<table>
		<tr>
			<td>
				&nbsp;&nbsp;
			</td>
			<td>
				<img class="media-object img-circle" src="https://graph.facebook.com/<?php echo $sellinglists[0]['User']['facebook_id']; ?>/picture?type=square" alt="No image">
			</td>
			<td>
				&nbsp;&nbsp;<?php echo $sellinglists[0]['User']['name']; ?>
			</td>
		</tr>
	</table>


	<?php //endforeach ?>
</div>


<?php //--------------------------------------------?>



<?php 
//もしtrade_person_use_idが0ではなかったらコメント入力を表示しない
if ($sellinglists[0]['Selling_list']['trade_person_use_id'] == 0) { ?>

	<div align = "center">
		<h2>コメント</h2>
			<?php echo $this->Form->create('Selling_thread_list'); ?>

		<div class="row">
			
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
											array('value' => $sellinglists[0]['Selling_list']['id'])
											); ?>

			<?php echo $this->Form->submit('投稿');?>
			<?php echo $this->Form->end();  ?>
		</div>

<?php } //もしtrade_person_use_idが0ではなかったらコメント入力を表示しない 終了 ?>



<?php //以下コメントの表示---------------?>

<center>
    <dl id="acMenu">
    <dt>

	<?php //もしtrade_person_use_idが0だったら
	if ($sellinglists[0]['Selling_list']['trade_person_use_id'] == 0) { ?>

		<?php foreach($sellingthreadlists as $threadlist): ?>

		<?php //もしコメントにひもづくsellinglist_idが商品idと一緒だったら ?>
		<?php if ($threadlist['Selling_thread_list']['sellinglist_id'] == $sellinglists[0]['Selling_list']['id']) {?>

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
    					     		<div style="float:right"><?php echo $threadlist['Selling_thread_list']['created']; ?></div><!-- 投稿日時 -->
								</td>	
                			</tr>

    			
				<?php //スレッド内容の呼び出し ?>
							<tr>
								<td style="border: 2px solid #cccccc" align="left">
    							 	<?php echo $threadlist['Selling_thread_list']['thread']; ?>
								</td>
								<td>
									<?php //この人に決定ボタン ?>
									<?php echo $this->Form->create('Selling_list',
																		array('url'=>'decide')
																		); ?>

									<?php echo $this->Form->input('id', 
																		//開いている商品idにtrade_person_user_idとstatusの情報をぶちこむ(更新)
																		array(
																			'type' => 'hidden',
																			'value' => $sellinglists[0]['Selling_list']['id'])
																		); ?>
									
									<?php echo $this->Form->hidden('trade_person_use_id',
																		array('value' => $threadlist['Selling_thread_list']['user_id'])
									); ?>
									<?php echo $this->Form->hidden('status',
																		array('value' => 2)
									); ?>
									&nbsp;&nbsp;<?php echo $this->Form->button('この人に決定', array('type' => 'submit', 'class'=>'btn btn-primary', 'label' => false, 'escape' => false)); ?>
									<?php echo $this->Form->end();  ?>
								</td>
							</tr>
						</table>
				</h4>
			</div>
			</div>	

	<?php }	//もしコメントにひもづくsellinglist_idが商品idと一緒だったら 終了 ?>


	<?php endforeach; ?>

    </dt>
    </dl>
</center>


<?php } //もしtrade_person_use_idが0だったら 終了

//if ($sellinglists[0]['Selling_list']['trade_person_use_id'] !== 0) 

else { //もしtrade_person_use_idが0ではなかったら ?>

<center>
<br />
	<?php echo 'この取引は終了しました' ?>
<br />
<br />
<?php

	 foreach($sellingthreadlists as $threadlist): 

			//もし商品出品者のid = ログインユーザのidだったら ※とりあえずコメントアウト
			//if($sellinglists[0]['Selling_list']['user_id'] == $user['User']['id']){

				//Selling_listのtrade_person_use_idの名前と写真を表示する
				if($sellinglists[0]['Selling_list']['trade_person_use_id'] == $threadlist['User']['id']) {

					//取引が成立したユーザー名を変数に格納
					$trade_user_name = $threadlist['User']['name'];
					//取引が成立したユーザーのfacebookidURLを変数に格納
					$trade_user_url = "https://www.facebook.com/".$threadlist['User']['facebook_id'];
					echo $trade_user_name."さんとの取引が成立しました！<br />";
					echo "facebookメッセージを送って詳細を決めましょう！<br />";
					echo "<A Href="."\"".$trade_user_url."\"target=\"_blank\">".$trade_user_name."</A>";
                    break;

				} //Selling_listのtrade_person_use_idの名前と写真を表示する 終了
			//} /もし商品出品者のid = ログインユーザのidだったら 終了 ※とりあえずコメントアウト
	endforeach;

?>

<br />
<br />

<?php echo '会話履歴' ?>

<?php //以下コメントの表示?>

    <dl id="acMenu">
    <dt>

	<?php foreach($sellingthreadlists as $threadlist): ?>

		<?php //もしコメントにひもづくsellinglist_idが商品idと一緒だったら ?>
		<?php //もしログインユーザーのidが、コメントしているユーザー、もしくは出品しているユーザーだったら ?>
		<?php if ($threadlist['Selling_thread_list']['sellinglist_id'] == $sellinglists[0]['Selling_list']['id']) {?>

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
    					     		<div style="float:right"><?php echo $threadlist['Selling_thread_list']['created']; ?></div><!-- 投稿日時 -->
								</td>	
                			</tr>

							<?php //スレッド内容の呼び出し ?>
							<tr>
								<td style="border: 2px solid #cccccc" align="left">
    							 	<?php echo $threadlist['Selling_thread_list']['thread']; ?>
								</td>
							</tr>
						</table>
				</h4>
			</div>
			</div>	


	  <?php } //もしコメントにひもづくsellinglist_idが商品idと一緒だったら 終了?> 

	<?php endforeach; ?>


<?php } //もしtrade_person_use_idが0でなかったら 終了?> 


    </dt>
    </dl>

</center>		


</div>
</div>

<br /><br /><br />



<?php //↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ここまで普通の人がみたときの画面↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑?>


<?php } //もしログインユーザーidが商品のuser_idと同一だったら（ログインユーザーが出品者だった場合）?>





<?php //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ここから出品者の場合の画面↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓?>


<?php //もしログインユーザーidが商品のuser_idと同一だったら（ログインユーザーが出品者だった場合） ?>
<?php if($sellinglists[0]['Selling_list']['user_id'] == $self['id']) { ?>

↓投稿者が見たとき↓


<div class = "container well">

	<?php //写真① ?>
	<div style="float:left; margin-left: 30px;">
		<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name1'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />

	</div>

	<?php //写真②  ※もし写真②がない場合は非表示 ?>
	<?php if (empty($sellinglists[0]['Selling_list']['img_file_name2']) || ($sellinglists[0]['Selling_list']['img_file_name2'] == "NULL")) { ?>
	<?php }else{ ?>
		<div style="float:left; margin-left: 30px;">
			<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name2'],
								array('width'=>'100%','height'=>'250')
								); ?>
								<br />

		</div>
	<?php } ?>

	<?php //写真③ ※もし写真③がない場合は非表示 ?>
	<?php if (empty($sellinglists[0]['Selling_list']['img_file_name3']) || ($sellinglists[0]['Selling_list']['img_file_name3'] == "NULL")) { ?>
	<?php }else{ ?>
		<div style="float:left; margin-left: 30px;">
			<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name3'],
								array('width'=>'100%','height'=>'250')
								); 

								?>
								<br />

		</div>
	<?php } ?>

<br />
<br />

<div style="clear:both;">
	<?php 
		echo $this->Form->create('Selling_list', 
							array(
								'url'=>'edit',
								'type'=>'file',
								'enctype' => 'multipart/form-data'));
 	?>

 	<?php echo $this->Form->input('id', 
									//開いている商品idにtrade_person_user_idとstatusの情報をぶちこむ(更新)
									array(
										'type' => 'hidden',
										'value' => $sellinglists[0]['Selling_list']['id']
										)
								); 
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

		<?php //商品名編集 ?>
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
		<?php //商品詳細編集 ?>
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
	<?php //商品価格編集 ?>
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



	<?php //出品者 ?>
	<p>出品者: </p>
	<table>
		<tr>
			<td>
				<img class="media-object img-circle" src="https://graph.facebook.com/<?php echo $sellinglists[0]['User']['facebook_id']; ?>/picture?type=square" alt="No image">
			</td>
			<td>
				&nbsp;&nbsp;<?php echo $sellinglists[0]['User']['name']; ?>
			</td>
		</tr>
	</table>






<br />
		<?php //投稿ボタンを押したときに表示される確認 ?>
		<?php
			$msg = __($sellinglists[0]['Selling_list']['sellingproduct_name'].'商品を編集します。よろしいですか？', true);
		?>

		<?php echo $this->Form->submit(__('編集', true), array('name'=>'hoge', 'onClick'=>"return confirm('$msg')"));?>
		<?php echo $this->Form->end();  ?>


</div>



<?php //↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ここまで出品者がみたときの画面↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑?>






<?php //以下コメント関連 ?>
<?php //-------------------------------------------- ?>

<?php 
//もしtrade_person_use_idが0ではなかったらコメント入力を表示しない
if ($sellinglists[0]['Selling_list']['trade_person_use_id'] == 0) { ?>

	<div align = "center">
		<h2>コメント</h2>
			<?php echo $this->Form->create('Selling_thread_list'); ?>

		<div class="row">
			
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
											array('value' => $sellinglists[0]['Selling_list']['id'])
											); ?>

			<?php echo $this->Form->submit('投稿');?>
			<?php echo $this->Form->end();  ?>
		</div>

<?php } //もしtrade_person_use_idが0ではなかったらコメント入力を表示しない 終了 ?>



<?php //以下コメントの表示---------------?>

<center>
    <dl id="acMenu">
    <dt>

	<?php //もしtrade_person_use_idが0だったら
	if ($sellinglists[0]['Selling_list']['trade_person_use_id'] == 0) { ?>

		<?php foreach($sellingthreadlists as $threadlist): ?>

		<?php //もしコメントにひもづくsellinglist_idが商品idと一緒だったら ?>
		<?php if ($threadlist['Selling_thread_list']['sellinglist_id'] == $sellinglists[0]['Selling_list']['id']) {?>

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
    					     		<div style="float:right"><?php echo $threadlist['Selling_thread_list']['created']; ?></div><!-- 投稿日時 -->
								</td>	
                			</tr>

    			
				<?php //スレッド内容の呼び出し ?>
							<tr>
								<td style="border: 2px solid #cccccc" align="left">
    							 	<?php echo $threadlist['Selling_thread_list']['thread']; ?>
								</td>
								<td>
									<?php //この人に決定ボタン ?>
									<?php echo $this->Form->create('Selling_list',
																		array('url'=>'decide')
																		); ?>

									<?php echo $this->Form->input('id', 
																		//開いている商品idにtrade_person_user_idとstatusの情報をぶちこむ(更新)
																		array(
																			'type' => 'hidden',
																			'value' => $sellinglists[0]['Selling_list']['id'])
																		); ?>
									
									<?php echo $this->Form->hidden('trade_person_use_id',
																		array('value' => $threadlist['Selling_thread_list']['user_id'])
									); ?>
									<?php echo $this->Form->hidden('status',
																		array('value' => 2)
									); ?>
									&nbsp;&nbsp;<?php echo $this->Form->button('この人に決定', array('type' => 'submit', 'class'=>'btn btn-primary', 'label' => false, 'escape' => false)); ?>
									<?php echo $this->Form->end();  ?>
								</td>
							</tr>
						</table>
				</h4>
			</div>
			</div>	

	<?php }	//もしコメントにひもづくsellinglist_idが商品idと一緒だったら 終了 ?>


	<?php endforeach; ?>

    </dt>
    </dl>
</center>


<?php } //もしtrade_person_use_idが0だったら 終了

//if ($sellinglists[0]['Selling_list']['trade_person_use_id'] !== 0) 

else { //もしtrade_person_use_idが0ではなかったら ?>

<center>
<br />
	<?php echo 'この取引は終了しました' ?>
<br />
<br />
<?php

	 foreach($sellingthreadlists as $threadlist): 

			//もし商品出品者のid = ログインユーザのidだったら ※とりあえずコメントアウト
			//if($sellinglists[0]['Selling_list']['user_id'] == $user['User']['id']){

				//Selling_listのtrade_person_use_idの名前と写真を表示する
				if($sellinglists[0]['Selling_list']['trade_person_use_id'] == $threadlist['User']['id']) {

					//取引が成立したユーザー名を変数に格納
					$trade_user_name = $threadlist['User']['name'];
					//取引が成立したユーザーのfacebookidURLを変数に格納
					$trade_user_url = "https://www.facebook.com/".$threadlist['User']['facebook_id'];
					echo $trade_user_name."さんとの取引が成立しました！<br />";
					echo "facebookメッセージを送って詳細を決めましょう！<br />";
					echo "<A Href="."\"".$trade_user_url."\"target=\"_blank\">".$trade_user_name."</A>";
                    break;

				} //Selling_listのtrade_person_use_idの名前と写真を表示する 終了
			//} /もし商品出品者のid = ログインユーザのidだったら 終了 ※とりあえずコメントアウト
	endforeach;

?>

<br />
<br />

<?php echo '会話履歴' ?>

<?php //以下コメントの表示?>

    <dl id="acMenu">
    <dt>

	<?php foreach($sellingthreadlists as $threadlist): ?>

		<?php //もしコメントにひもづくsellinglist_idが商品idと一緒だったら ?>
		<?php //もしログインユーザーのidが、コメントしているユーザー、もしくは出品しているユーザーだったら ?>
		<?php if ($threadlist['Selling_thread_list']['sellinglist_id'] == $sellinglists[0]['Selling_list']['id']) {?>

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
    					     		<div style="float:right"><?php echo $threadlist['Selling_thread_list']['created']; ?></div><!-- 投稿日時 -->
								</td>	
                			</tr>

							<?php //スレッド内容の呼び出し ?>
							<tr>
								<td style="border: 2px solid #cccccc" align="left">
    							 	<?php echo $threadlist['Selling_thread_list']['thread']; ?>
								</td>
							</tr>
						</table>
				</h4>
			</div>
			</div>	


	  <?php } //もしコメントにひもづくsellinglist_idが商品idと一緒だったら 終了?> 

	<?php endforeach; ?>


<?php } //もしtrade_person_use_idが0でなかったら 終了?> 


    </dt>
    </dl>

</center>		


</div>
</div>

<br /><br /><br />

<?php //-------------------------------------------- ?>

<?php } //もしログインユーザーidが商品のuser_idと同一だったら（ログインユーザーが出品者だった場合）?>

