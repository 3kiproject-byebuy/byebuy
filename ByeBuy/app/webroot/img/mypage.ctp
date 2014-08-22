<div align="center">
<div class = "container">
	<div style="width:940px;
				height:300px;
				padding:30px;
				margin-bottom:20px;
				">


	<div class ="row">

		<div class="col-sm-4">
		<a href="/wannadoList/fbconnects/showdata"><img src="/wannadoList/img/lists_g.png" alt=""></a>
		<?php //$this->Html->link('<img src="/wannadoList/img/lists_g.png" alt="">',array('controller' => 'fbconnects','action' => 'showdata'),array('escape'=> false)); ?>
		<br /><h5>Lists</h5></div>
		<div class="col-sm-4" style="padding-top:50px;"><h3>My List</h3></div>
		<div class="col-sm-4"><?php echo $this->html->image('like.png_g'); ?><br /><h5>Likes</h5></div>
		<!--<?php //echo $this->html->image('mylist.png'); ?><br /><h5>My List</h5></div>-->

	</div><!--row-->
	</div>
</div>

<div class ="container">
	<div class="row" style="width:940px;">

<?php 
echo $id;
echo $this->Form->create('Wishlist');
echo $this->Form->input('number',array('type'=>'hidden','value'=>1));
echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$id));
echo $this->Form->input('name',array('escape'=>false, 'label'=>false));
echo $this->Form->button('<span class ="glyphicon glyphicon-pencil"></span>
Save', array('type' => 'submit', 'class'=>'btn btn-default', 'label' => false, 'escape' => false));

//フォームの閉じタグを生成しているだけで.第一引数に文字を指定するとsubmitボタンが出てくるが、それははあくまでオプション
echo $this->Form->end();

?>



<!-- <div class="panel panel-default">
  <div class="panel-body">
   
  </div>
</div> -->



<ul class="list-group">
<?php foreach ($mylists as $mylist): ?>
  <li class="list-group-item col-sm-12" ><h3><?php echo $mylist['Wishlist']['name']; ?></h3></li>
<?php endforeach; ?>
</ul>

	</div><!--row-->
</div><!--container-->
</div><!--Center-->







<?php echo $this->Html->link('<button class="btn btn-mini btn-primary" type="button" align="left"><span class="glyphicon glyphicon-star"></span>ログアウト</button>',array('controller' => 'fbconnects','action' => 'logout'),array('escape' => false)); 

?>