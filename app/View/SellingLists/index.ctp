<?php echo $this->Element('header'); ?>


<!-- 現在のログインID取得 -->
<?php $self = $this->Session->read('Auth.User'); ?>
<?php //$self['id'] = 2; //テスト用UserID指定（ログイン済み） ?>

<!-- ナビゲーションバー -->
<ul class="nav nav-tabs nav-justified" role="tablist" style="margin-top:20px;margin-bottom:20px;">
  <br />
    <li><?php echo $this->HTML->link('<b>出品中</b>', 
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
                          
    <?php
          //ユーザーが未ログインの場合
          if (is_null($self)){ 
            
              //なにも表示させない

          //ユーザーがログイン中の場合、ステータスを確認
           }else{

              //【ステータス１】＝ 【承認済みユーザー】 の場合
              if($self['status']==1){

               echo '<li>';

               echo $this->HTML->link('<b>ウォッチリスト</b>',
                    array(
                      'controller'=>'sellingLists',
                      'action'=>'index'),
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

               echo $this->HTML->link('<b>投稿管理</b>',
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
if(is_null($self)){ ?>
<center>
	<br />
	商品を投稿するにはログインしてください
	<br />
</center>

<?php }else { ?>
<center>
  <h2>商品を投稿する</h2>
</center>

<div class = "container well">
<br />


<?php 
	echo $this->Form->create('Selling_list', 
							array('type'=>'file','enctype' => 'multipart/form-data'));
 ?>

<?php //投稿者のユーザーidを送る ?>
<?php echo $this->Form->input('user_id',
 							array(
 								'type' => 'hidden',
 								'value' => $self['id'])
 							);
 ?>

<?php //画像アップ------------------------------  ?>
<?php
    echo $this->Form->input('img_file_name1', 
									array(
    									'type' => 'file', 'multiple',
    									'label' => '写真①'
    									)
    	);
    echo $this->Form->input('img_file_name2', 
    								array(
    									'type' => 'file', 'multiple',
    									'label' => '写真②'
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
		<?php echo $this->Form->input('sellingproduct_name', 
										array(
											'label' => '商品名',
											'class'=>array('form-control','form-group'),
											'placeholder'=>'商品名を入力してください')
										);
		?>
	</div>
</div>


<?php //商品詳細----- ?>
<div class="row">
	<div class="col-xs-6">
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

<?php //カテゴリー----- ?>
<?php //foreach($categories as $category): ?>

<?php echo $this->Form->input('category_id',
										array(			
											'type'=>'select',						
											'label'=>'カテゴリー&nbsp;&nbsp;',
											'options'=>$categories
											)
										);

?>
<?php //endforeach; ?>




<br />

<?php //商品価格----- ?>
<div class="row">
	<table>
		<tr>
			<td>
				<!-- <div class="col-xs-2"> -->
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
				<p>&nbsp;PHP</p>
			</td>
			<td>
				<p>&nbsp;&nbsp;※価格は数字で入力してください(無料の場合は0と入力してください)</p>
			</td>
		</tr>
	</table>
</div>

<?php //echo $this->Form->checkbox('sellingproduct_price.チェックボックス',
										//array('checked' => true)
										//);

?>
<?php //echo $this->Form->label(' 無料で出品'); ?>


<?php //締め切り----- ?>
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

<?php
$msg = __('商品を投稿します。よろしいですか？', true);
?>


<?php echo $this->Form->submit(__('投稿', true), array('name'=>'hoge', 'onClick'=>"return confirm('$msg')"));?>
<?php echo $this->Form->end();  ?>

</div>


<?php } ?>




