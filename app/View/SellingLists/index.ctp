<h2>商品を投稿する</h2>

<div class = "container well">
<br />


<?php 
	echo $this->Form->create('SellingList', 
							array('type'=>'file','enctype' => 'multipart/form-data'));
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
<!-- </div> -->
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







