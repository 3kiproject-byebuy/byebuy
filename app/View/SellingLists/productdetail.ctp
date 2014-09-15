


<!-- 現在のログインID取得 -->
<?php $self = $this->Session->read('Auth.User'); ?>
<?php //$self['id'] = 2; //テスト用UserID指定（ログイン済み） ?>

<!-- ナビゲーションバー -->

<ul class="nav nav-tabs nav-justified" role="tablist" style="margin-bottom:20px;">
  <br />
    <li class="active"><?php echo $this->HTML->link('<b>出品中</b>', 
                      array(
                        'controller' => 'byebuys',
                        'action'=>'index'),
                      array(
                        'escape'=>false)
                          ); ?></li>

    <li><?php echo $this->HTML->link('<font color="#ffffff"><b>ほしい</b></font>', 
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

               echo '<li>';

               echo $this->Form->postLink('<font color="#ffffff"><b>ウォッチリスト</b></font>',
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

               echo $this->Form->postLink('<font color="#ffffff"><b>投稿管理</b></font>',
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



<?php 
//商品詳細 ?>
	<br />
	<center>
		<h2>商品詳細</h2>
	</center>
	<br /><br />

	<?php 
	//①もしログインユーザーidが商品のuser_idと同一ではなかったら（ログインユーザーが出品者ではない場合） ?>
	<?php if($sellinglists[0]['Selling_list']['user_id'] !== $self['id']) { ?>

	<?php //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ここから普通の人がみたときの画面↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓?>

<?php 
//写真を画面に表示-------------------------------------------------------------------------  ?>
		<div class = "container well">
			<center>
				<?php 
				//写真①を画面に表示 ?>
				<div style="float:left; margin-left: 30px;">
					<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name1'],
																				array('width'=>'auto','height'=>'250')
												); 
					?>
					<br />
				</div>

				<?php 
				//写真②を画面に表示 ※もし写真②がない場合は非表示 ?>
				<?php if (empty($sellinglists[0]['Selling_list']['img_file_name2']) || ($sellinglists[0]['Selling_list']['img_file_name2'] == "NULL")) {

					//なにも表示しない

				 }else{ ?>

					<div style="float:left; margin-left: 30px;">
						<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name2'],
									array('width'=>'auto','height'=>'250')
									); ?>
									<br />

					</div>
				<?php } ?>

				<?php 
				//写真③ ※もし写真③がない場合は非表示?>
				<?php if (empty($sellinglists[0]['Selling_list']['img_file_name3']) || ($sellinglists[0]['Selling_list']['img_file_name3'] == "NULL")) { 

					//何も表示しない

				 }else{ ?>
					<div style="float:left; margin-left: 30px;">
						<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name3'],
																					array('width'=>'auto','height'=>'250')
													); 
						?>
						<br />
					</div>
				<?php } ?>
			</center>
			<br />
<?php 
//写真を画面に表示　終了-------------------------------------------------------------------------  
?>

				<div style="clear:both;">
				<br />
				<?php //商品名を表示 ?>
				<p>○&nbsp;タイトル: <?php echo $sellinglists[0]['Selling_list']['sellingproduct_name']; ?></p>

				<?php //商品詳細を表示 ?>
				<p>○&nbsp;商品詳細: <?php echo $sellinglists[0]['Selling_list']['sellingproduct_detail']; ?></p>

				<?php //商品カテゴリーを表示?>
				<p>○&nbsp;カテゴリー: <?php echo $sellinglists[0]['Category']['category_title']; ?></p>

				<?php //商品価格 ?>
				<p>○&nbsp;商品価格: <?php echo $sellinglists[0]['Selling_list']['sellingproduct_price']; ?> PHP</p>

				<?php //締め切り ?>
					<?php 
					//もし締め切り-現在の日付が１日よりすくなかったら
					$current_date = date('Y-m-d H:i:s');
						if((strtotime($sellinglists[0]['Selling_list']['deadline']) - strtotime($current_date)) < 86400 && (strtotime($sellinglists[0]['Selling_list']['deadline']) - strtotime($current_date)) > 0) { ?>
							
	        				<p>○&nbsp;締め切り日: 
	        					<font color="#ff0000"> 
	        					<?php echo $sellinglists[0]['Selling_list']['deadline']; ?>
	        					</font>
	        				</p>
	        				
	        			<?php 
	        			//もし締め切り日を過ぎていたら
	        			} if((strtotime($sellinglists[0]['Selling_list']['deadline']) - strtotime($current_date)) < 0 || $sellinglists[0]['Selling_list']['status'] == 2) { ?>

	        				<p>○&nbsp;締め切り: この取引は終了しました</p>

						<?php }
						//もし締め切り日が１日よりも多かったら
						if((strtotime($sellinglists[0]['Selling_list']['deadline']) - strtotime($current_date)) > 86400) { ?>
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

				</div>


	<?php
	//②もしログインユーザーでなかったらコメントを表示しない
	if (!is_null($self))
		{ ?>

		<?php 
		$current_date = date('Y-m-d H:i:s');
		//③trade_person_use_idが0、もしくは期限内だったらコメント入力を表示
		if ($sellinglists[0]['Selling_list']['trade_person_use_id'] == 0 && strtotime($sellinglists[0]['Selling_list']['deadline']) > strtotime($current_date)) { ?>


			<div align = "center">
				<h2>コメント</h2>
					
				<div class="row">
					<?php echo $this->Form->create('Selling_thread_list',array('url'=>'putcomment')); ?>
				
					<?php //コメント投稿 ?>
					<?php echo $this->Form->input('thread',
													array(
														'label' => false,
														'class'=>array('form-control','form-group'),
														// 'placeholder'=>'価格を入力してください'
												 		)
													);

					?>

					<?php //商品のidを送っている ?>
					<?php echo $this->Form->hidden('sellinglist_id',
													array(
														//'type' => 'hidden',
														'value' => $sellinglists[0]['Selling_list']['id'])
													); ?>

					<?php //userのidを送っている ?>
					<?php echo $this->Form->hidden('user_id',
													array(
														//'type' => 'hidden',
														'value' => $self['id'])
													); ?>


					<?php echo $this->Form->submit('投稿');?>
					<?php echo $this->Form->end();  ?>
				</div>

		<?php } //③trade_person_use_idが0もしくはNULLもしくは空だったらコメント入力を表示 　終了?>

		<?php //以下入力されたコメントの表示---------------?>

			<center>
		    	<dl id="acMenu">
		    	<dt>

				<?php //もしtrade_person_use_idが0だったら and　まだ締め切り日が残っていたら（取引が成立していなかったら）
				if ($sellinglists[0]['Selling_list']['trade_person_use_id'] == 0 && strtotime($sellinglists[0]['Selling_list']['deadline']) > strtotime($current_date)) 
					{ ?> 

					<?php foreach($sellingthreadlists as $threadlist): ?>

					<?php //もしコメントにひもづくsellinglist_idが商品idと一緒だったらコメントを表示 
					if ($threadlist['Selling_thread_list']['sellinglist_id'] == $sellinglists[0]['Selling_list']['id']) 
						{ ?>

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
										<?php //出品者のみが決定ボタンが押せるので非表示 ?>
<!-- 										<td>
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
										</td> -->
									</tr>
								</table>
						</h4>
						</div>
						</div>	

					<?php }	//もしコメントにひもづくsellinglist_idが商品idと一緒だったらコメントを表示 終了 ?>

					<?php endforeach; ?>

		    		</dt>
		    		</dl>
				</center>

			<?php } //もしtrade_person_use_idが0だったら（取引が成立していなかったら） 終了

			if($sellinglists[0]['Selling_list']['trade_person_use_id'] != 0 || strtotime($sellinglists[0]['Selling_list']['deadline']) < strtotime($current_date)) { //もしtrade_person_use_idが0ではなかったら（取引が成立していたら）or 取引期限が過ぎていたら ?>

				<center>
					<br />
						<?php echo 'この取引は終了しました' ?>
					<br />
					<br />
					<?php

						foreach($sellingthreadlists as $threadlist): 

							//もし商品出品者のid = ログインユーザのidだったら ※とりあえずコメントアウト
							if($sellinglists[0]['Selling_list']['user_id'] == $self['id']){

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
							} //もし商品出品者のid = ログインユーザのidだったら 終了 ※とりあえずコメントアウト
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

				<?php } //もしtrade_person_use_idが0でなかったら（取引が終了していたら） 終了?> 

				    </dt>
				    </dl>

				</center>		


			</div>
		</div><?php //<div class = "container well">の閉じ ?>

	<br /><br /><br />



	<?php //↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ここまで普通の人がみたときの画面↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑?>


	<?php } //②もしログインユーザーでなかったらコメントを表示しない 終了 ?>
	
	<?php } //①もしログインユーザーidが商品のuser_idと同一ではなかったら（ログインユーザーが出品者ではない場合） 終了?>







<?php //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ここから出品者の場合の画面(取引が完了していない場合↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓?>


<?php //もしログインユーザーidが商品のuser_idと同一だったら（ログインユーザーが出品者だった場合） ?>
<?php if($sellinglists[0]['Selling_list']['user_id'] == $self['id'] && $sellinglists[0]['Selling_list']['status'] != 2) { ?>

<?php //↓投稿者が見たとき↓ ?>

	<div class = "container well">

		<?php 
		//写真① ?>
		<div style="float:left; margin-left: 30px;">
			<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name1'],
									array('width'=>'auto','height'=>'250')
									); 
			?>
			<br />

		</div>

		<?php 
		//写真②  ※もし写真②がない場合は非表示 ?>
		<?php if (empty($sellinglists[0]['Selling_list']['img_file_name2']) || ($sellinglists[0]['Selling_list']['img_file_name2'] == "NULL")) { 
			//なにも表示しない

		 }else{ ?>
			<div style="float:left; margin-left: 30px;">
				<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name2'],
									array('width'=>'auto','height'=>'250')
									); 
				?>
				<br />

			</div>
		<?php } ?>

		<?php 
		//写真③ ※もし写真③がない場合は非表示 ?>
		<?php if (empty($sellinglists[0]['Selling_list']['img_file_name3']) || ($sellinglists[0]['Selling_list']['img_file_name3'] == "NULL")) { 
			//何も表示しない

		 }else{ ?>
			<div style="float:left; margin-left: 30px;">
				<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name3'],
									array('width'=>'auto','height'=>'250')
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
									'enctype' => 'multipart/form-data',
									 'novalidate' => true));
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


	    	echo $this->Form->input('img_file_name11',
	    								array(
											'type' => 'hidden',
											'value' => $sellinglists[0]['Selling_list']['img_file_name1']
											)
	    								);





	    	//写真②を編集
	    	echo $this->Form->input('img_file_name22',
	    								array(
											'type' => 'hidden',
											'value' => $sellinglists[0]['Selling_list']['img_file_name2']
											)
	    								);


	    	echo $this->Form->input('img_file_name2', 
	    								array(
	    									'type' => 'file', 'multiple',
	    									'label' => '写真②'
	    									)
	    	);

	    	//写真③を編集
	    	echo $this->Form->input('img_file_name33',
	    								array(
											'type' => 'hidden',
											'value' => $sellinglists[0]['Selling_list']['img_file_name3']
											)
	    								);

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
		<table>
			<tr>
				<td>
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
				</td>
				<td>
					<p>PHP</p>
				</td>
			</tr>
		</table>
	</div>


	<?php //締め切り編集 ?>
	  <?php //締め切り日を過ぎている場合 ?>			
	  <?php
	  $current_date = date('Y-m-d H:i:s');
	  if((strtotime($sellinglists[0]['Selling_list']['deadline']) >= strtotime($current_date))) { ?>
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
		<?php } //締め切り日を過ぎている場合 終了?>


	      <?php //締め切り日を過ぎている場合 ?>			
	      <?php
	       $current_date = date('Y-m-d H:i:s');
	       if((strtotime($sellinglists[0]['Selling_list']['deadline']) < strtotime($current_date))) { ?>

	        				<p>締め切り: この取引は終了しました</p>
	      <?php } ?>






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

			<?php echo $this->Form->submit(__('投稿記事内容を編集する', true), array('name'=>'hoge', 'onClick'=>"return confirm('$msg')"));?>
			<?php echo $this->Form->end();  ?>


	</div>


<?php } ?>



	<?php //↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ここまで出品者がみたときの画面(取引が完了していない場合)↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑?>







	<?php //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ここから出品者の場合の画面(取引が完了している場合)↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓?>


	<?php //もしログインユーザーidが商品のuser_idと同一（ログインユーザーが出品者だった場合）かつ、取引が完了している場合 ?>
	<?php if($sellinglists[0]['Selling_list']['user_id'] == $self['id'] && $sellinglists[0]['Selling_list']['status'] == 2) { ?>


	<?php 
	//写真を画面に表示-------------------------------------------------------------------------  ?>
		<div class = "container well">
			<center>
				<?php 
				//写真①を画面に表示 ?>
				<div style="float:left; margin-left: 30px;">
					<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name1'],
																				array('width'=>'auto','height'=>'250')
												); 
					?>
					<br />
				</div>

				<?php 
				//写真②を画面に表示 ※もし写真②がない場合は非表示 ?>
				<?php if (empty($sellinglists[0]['Selling_list']['img_file_name2']) || ($sellinglists[0]['Selling_list']['img_file_name2'] == "NULL")) {

					//なにも表示しない

				 }else{ ?>

					<div style="float:left; margin-left: 30px;">
						<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name2'],
									array('width'=>'auto','height'=>'250')
									); ?>
									<br />

					</div>
				<?php } ?>

				<?php 
				//写真③ ※もし写真③がない場合は非表示?>
				<?php if (empty($sellinglists[0]['Selling_list']['img_file_name3']) || ($sellinglists[0]['Selling_list']['img_file_name3'] == "NULL")) { 

					//何も表示しない

				 }else{ ?>
					<div style="float:left; margin-left: 30px;">
						<?php echo $this->Html->image($sellinglists[0]['Selling_list']['img_file_name3'],
																					array('width'=>'auto','height'=>'250')
													); 
						?>
						<br />
					</div>
				<?php } ?>
			</center>
			<br />
	<?php 
	//写真を画面に表示　終了-------------------------------------------------------------------------  
	?>

				<div style="clear:both;">
				<br />
				<?php //商品名を表示 ?>
				<p>○&nbsp;タイトル: <?php echo $sellinglists[0]['Selling_list']['sellingproduct_name']; ?></p>

				<?php //商品詳細を表示 ?>
				<p>○&nbsp;商品詳細: <?php echo $sellinglists[0]['Selling_list']['sellingproduct_detail']; ?></p>

				<?php //商品カテゴリーを表示?>
				<p>○&nbsp;カテゴリー: <?php echo $sellinglists[0]['Category']['category_title']; ?></p>

				<?php //商品価格 ?>
				<p>○&nbsp;商品価格: <?php echo $sellinglists[0]['Selling_list']['sellingproduct_price']; ?> PHP</p>

				<?php //締め切り ?>
					<?php 
					//もし締め切り-現在の日付が１日よりすくなかったら
					$current_date = date('Y-m-d H:i:s');
						if((strtotime($sellinglists[0]['Selling_list']['deadline']) - strtotime($current_date)) < 86400 && (strtotime($sellinglists[0]['Selling_list']['deadline']) - strtotime($current_date)) > 0) { ?>
							
	        				<p>○&nbsp;締め切り日: 
	        					<font color="#ff0000"> 
	        					<?php echo $sellinglists[0]['Selling_list']['deadline']; ?>
	        					</font>
	        				</p>
	        				
	        			<?php 
	        			//もし締め切り日を過ぎていたら
	        			} if((strtotime($sellinglists[0]['Selling_list']['deadline']) < strtotime($current_date)) || $sellinglists[0]['Selling_list']['status'] == 2) { ?>

	        				<p>○&nbsp;締め切り: この取引は終了しました</p>

						<?php }
						//もし締め切り日が１日よりも多かったら and statusが2ではなかったら
						if((strtotime($sellinglists[0]['Selling_list']['deadline']) - strtotime($current_date)) > 86400 && $sellinglists[0]['Selling_list']['status'] != 2) { ?>
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

				</div>

		<?php } ////もしログインユーザーidが商品のuser_idと同一（ログインユーザーが出品者だった場合）かつ、取引が完了している場合 終了?>



	<?php //↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ここまで出品者がみたときの画面(取引が完了している場合)↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑?>









	<?php //以下コメント関連 ?>
	<?php //-------------------------------------------- ?>

	<?php 
	//もしtrade_person_use_idが0 and 締め切りを過ぎていない and ステータスが2でなく and ログインユーザーならコメント表示
	if ($sellinglists[0]['Selling_list']['trade_person_use_id'] == 0 && strtotime($sellinglists[0]['Selling_list']['deadline']) > strtotime($current_date) && $sellinglists[0]['Selling_list']['status'] != 2 && !is_null($self)) { ?>

		<div align = "center">
			<h2>コメント</h2>

			<div class="row">
				<?php echo $this->Form->create('Selling_thread_list',
														array(
															//'type'=>'post',
															'url'=>'putcomment')); ?>
				
				<?php //コメント投稿 ?>
				<?php echo $this->Form->input('thread',
												array(
													'label'=>false,
													'class'=>array('form-control','form-group'),
													// 'placeholder'=>'価格を入力してください'
												 	)
												);

				?>

				<?php //商品のidを送っている ?>
				<?php echo $this->Form->hidden('sellinglist_id',
												array(
													//'type' => 'hidden',
													'value' => $sellinglists[0]['Selling_list']['id'])
												); ?>

				<?php //userのidを送っている ?>
				<?php echo $this->Form->hidden('user_id',
												array(
													//'type' => 'hidden',
													'value' => $sellinglists[0]['Selling_list']['user_id'])
												); ?>


				<?php echo $this->Form->submit('投稿');?>
				<?php echo $this->Form->end();  ?>
			</div>

	<?php } //もしtrade_person_use_idが0 and 締め切りを過ぎていない and ステータスが2でなく and ログインユーザーならコメント表示 終了 ?>



	<?php //以下コメントの表示---------------?>

	<center>
	    <dl id="acMenu">
	    <dt>

		<?php //もしtrade_person_use_idが0で、商品出品者=ログインユーザーだったら
		if ($sellinglists[0]['Selling_list']['trade_person_use_id'] == 0 && $sellinglists[0]['Selling_list']['user_id'] == $self['id']) { ?>

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
							<?php //もしコメントしたユーザーが自分(出品者)でなかったら「この人に決定ボタン」を表示
							if ($threadlist['Selling_thread_list']['user_id'] != $self['id']){ ?>
									<td>
										<?php //この人に決定ボタン ?>
										<?php echo $this->Form->create('Selling_list',array('url'=>'decide')); ?>

										<?php echo $this->Form->input('id', 
																			//開いている商品idにtrade_person_user_idとstatusの情報をぶちこむ(更新)
																			array(
																				'type' => 'hidden',
																				'value' => $sellinglists[0]['Selling_list']['id'])
																			); ?>
										
										<?php echo $this->Form->input('trade_person_use_id',
																			array(
																				'type' => 'hidden',
																				'value' => $threadlist['Selling_thread_list']['user_id'])
										); ?>
										<?php echo $this->Form->input('status',
																			array(
																				'type' => 'hidden',
																				'value' => 2)
										); ?>
										&nbsp;&nbsp;<?php echo $this->Form->button('この人に決定', array('type' => 'submit', 'class'=>'btn btn-primary', 'label' => false, 'escape' => false)); ?>
										<?php echo $this->Form->end();  ?>
									</td>
								  <?php } //もしコメントしたユーザーが自分(出品者)でなかったら「この人に決定ボタン」を表示 終了 ?>
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

	if($sellinglists[0]['Selling_list']['trade_person_use_id'] != 0 || strtotime($sellinglists[0]['Selling_list']['deadline']) < strtotime($current_date)) { //もしtrade_person_use_idが0ではなかったら（取引が成立していたら）or 取引期限が過ぎていたら ?>

	<center>
	<br />
		<?php echo 'この取引は終了しました' ?>
	<br />
	<br />
	<?php

		 foreach($sellingthreadlists as $threadlist): 

				//もし商品出品者のid = ログインユーザのidで、とりひきが成立していたら
				if($sellinglists[0]['Selling_list']['user_id'] == $self['id'] || $sellinglists[0]['Selling_list']['trade_person_use_id'] == 2){

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
				} //もし商品出品者のid = ログインユーザのidだったら 終了 ※とりあえずコメントアウト
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

<?php //} //もしログインユーザーidが商品のuser_idと同一だったら（ログインユーザーが出品者だった場合）?>

