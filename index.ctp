<?php //echo $this->HTML->image("world.jpg") ?>

<?php //タブ------------------------------------------------------------------------?>

<div align = right>
	<ol class="breadcrumb">
			<div align = 'left'>
				<div style = 'float:left;'>
						<?php

							//いいね  
							echo $this->Facebook->like(array('layout' => 'button_count',)); 

						?>

						&nbsp;&nbsp;
						<?php
							//シェア  
							echo $this->Facebook->share('/weekend/weekends', 
																array(
																	'style' => 'link', 
																	'label' => 'シェア')
																				);  
						?>
						

				</div>
			</div>

		<li>
			<?php echo $this->Html->link("ユーザー登録", 
									array(
										'controller' => 'users',
										'action' => 'useradd')
											); ?>
		</li>
		<li>
			<?php if ($user) {?>
				ログイン中
			<?php }else{ ?>
				<?php echo $this->Html->link("ログイン", 
									array(
										'controller' => 'users',
										'action' => 'login')
											); ?>
			<?php } ?>


<?php //なぜこれができないかが不明 ?>
<!-- 			<?php if ($user) {?>
						ログイン中<?php echo $weekendData['Weekend']['user_id']; ?>
			<?php } ?>
 -->




		</li>
		<li>
			<?php echo $this->Html->link("ログアウト", 
									array(
										'controller' => 'users',
										'action' => 'logout')
											); ?>

		</li>
		<li>
		<form class="navbar-form navbar-left" role="search">
 		 	<div class="form-group">
<!-- 				<div style= "float:left; margin-right:5px;"> -->
				<?php 


        			//サーチプラグインの実装
                	echo $this->Form->Create('Weekend');

                	//キーワード検索にしたいので、文字をkeywordにする
                	echo $this->Form->input('keyword',
                                	array(
                                    	'class' => array('form-control'),
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
                                    	'class' => "btn btn-default btn-xs dropdown-toggle",
                                    	'label' => false,
                                    	// 'div' => array('style' => 'foat:right;')
                                    	 )
                               	 );

                	echo $this->Form->end();
				?>
		</form>
		</li>

	</ol>
</div>








<!-- <img data-src=”/app/webroot/img/weekendtop.png”  alt=”img” width=”100″ height=”50″ /> -->
<!-- <img src=”img/weekendtop.png”  alt=”img” width=”100″ height=”50″ /> -->
<?php echo $this->Html->image('weekendtop.png', array('width'=>'100%')); ?>



<table>
	<tr>
<!-- 		<td>
			<div style="margin-right:15px;">
				<h2><font size="10" face="ＭＳ ゴシック">Weekend</font> <small><font size="6" face="ＭＳ 明朝,平成明朝">〜週末なにする？〜</font></small></h2>
			</div>
		</td> -->
		<td>

		</td>
		
	</tr>
</table>












<?php //end------------------------------------------------------------------------?>




<!-- <ul class="nav nav-pills"> -->
<ul class="nav nav-tabs nav-justified" role="tablist">
	<br />
<!-- <ul class="nav nav-tabs nav-justified" role="tablist"> -->
<!-- <ul class="nav nav-tabs" role="tablist"> -->
		<li class="active"><a hrf="#">TOP</a></li>

		<li>
			<?php echo $this->HTML->link('投稿', 
												array(
													'controller' => 'weekends',
													'action'=>'add')
												); ?></li>





<?php
if ($user){ ?>
		<li><?php echo $this->HTML->link('お気に入り',
												array(
													'controller'=>'likes',
													'action'=>'index')); ?></li>
						<?php }else{ ?>

							<li><a><font color="black">お気に入り</font></a></li>


						<?php } ?>








		<li><?php echo $this->HTML->link('お問い合わせ',
												array(
													'controller'=>'contacts',
													'action'=>'index')
													); ?></li>

		<li><?php echo $this->HTML->link('利用規約・Q&A',
												array(
													'controller'=>'weekends',
													'action'=>'qa')
													); ?></li>
</ul>
<br />



<?php //end------------------------------------------------------------------------?>


<?php //サーチプラグイン------------------------------------------------------------------------?>

<div class="container">
<div class="row">
<div class = "col-xs-10">



<?php //情報表示------------------------------------------------------------------------?>

<div class = "container">
	<div class = "row">
						<!-- <th>ID: <?php echo $weekend['Weekend']['id']; ?></th><br /> -->
		<div class = "col-md-10">


		<?php foreach ($weekendData as $weekend): ?>			

 			<div class="thumbnail col-md-12">

 				<div style = "float:left; margin-right: 10px;">
					<?php if (isset($weekend['Image'][0])) { ?>
						<img src ="/weekend/files/image/photo_user/<?php echo $weekend['Image'][0]['dir']; ?>/thumb150_<?php echo $weekend['Image'][0]['photo_user']; ?>" class="img-thumbnail"/>
					<?php } ?>
				</div>


<!-- 					<img data-src=”images/src.jpg”  alt=”img” width=”100″ height=”50″ /> -->
			<!-- <div class="caption"> -->
				<!-- <div style = "word-wrap:break-word;"> -->
				<div style = "float:left;">
						<br />
					<!-- <div style="float:left;" class = "col-md-2"> -->
						【タイトル】<?php echo $weekend['Weekend']['title']; ?>
						<br />
					<!-- </div> -->
					<!-- <div style="float:left;" class = "col-md-6"> -->
						<!-- 場所: <?php echo $weekend['Weekend']['place']; ?> -->
						【場所】<?php echo $weekend['Category']['name']; ?>
						

						&nbsp;&nbsp;&nbsp;&nbsp;【最寄り駅】<?php echo $weekend['Weekend']['near_station']; ?>
						<br />
					<!-- </div> -->
					<!-- <div style="float:left;" class = "col-md-4"> -->
						【説明】<br />						
							<?php echo $weekend['Weekend']['description']; ?>

						<br />
						<br />
					<!-- </div> -->
					<!-- <div style="float:left;" class = "col-md-4"> -->

<!-- 					            <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-pencil"></span> <button type="button" class="btn btn-danger">delete</button>',
               												 array('action' => 'delete', $weekend['Weekend']['id']),
                											 array(
                											 	'confirm' => 'Are you sure?',
																'escape' => false));
           						 ?> -->

						
<!-- 						<?php echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span> <button type="button" class="btn btn-warning">Edit</button>', 
															array(
																'controller' => 'weekends', 
																'action' => 'edit', $weekend['Weekend']['id']), 
																array(
																	'escape' => false)); 
								?> -->



		

						<?php if ($user){ ?>
							<?php echo $this->Form->postLink('<button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-thumbs-up"></span> お気に入り追加</button>', 

															array(
																'action' => 'set_like', $weekend['Weekend']['id'], $user['id']),

															array(
																	'escape' => false));
							?>
						<?php }else{ ?>
							<?php echo '<button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-thumbs-up"></span> お気に入り追加</button> (ログインで使用可能です)' ?>			
								<?php }?>









					</div>
						
				<!-- </div> -->


			</div>

		<?php endforeach ?>

		</div>
	</div>
</div>

<?php //end------------------------------------------------------------------------?>




<?php //カテゴリーリスト------------------------------------------------------------------------?>

	</div>
	<div class = "col-md-2">
		<?php echo $this->Element('sideList'); ?>
	</div>

	
<?php //end------------------------------------------------------------------------?>

</div>
</div>




<?php //ページネーション------------------------------------------------------------------------?>

		<div align = "center">
			<div class = "pagination pagination-large">

				<li>
					<?php echo $this->Paginator->prev('前へ'); ?>
					<?php echo $this->Paginator->numbers(); ?>
					<?php echo $this->Paginator->next('次へ'); ?>
				</li> 
			</div>	
		</div>
<?php //end------------------------------------------------------------------------?>







<?php unset($weekend); ?>







