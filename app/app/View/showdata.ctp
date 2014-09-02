<div align="center">
<div class = "container">
	<div style="width:940px;
				height:300px;
				padding:30px;
				margin-bottom:20px;
				">

	 <div class ="row">


		<div class="col-sm-4"><?php echo $this->html->image('search_g.png'); ?><br /><h5>Search Lists</h5></div>
		<div class="col-sm-4" style="padding-top:50px;"><h3>If you can dream it,<br />You can do it.<br /></h3><h4>-Walt Disney-</h4></div>
		<div class="col-sm-4">
		<?php echo $this->Form->postLink('<img src="/wannadoList/img/mylist_g.png" alt="">',array('controller' => 'fbconnects','action' => 'mypage'),array('escape'=> false,$id)); ?>


		<br /><h5>My List</h5></div>

	<!--<?php //echo $this->html->image('mylist.png'); ?><br /><h5>My List</h5></div>-->

	 </div><!--row-->
	</div><!--container-->
</div><!--幅940を指定-->



<div class ="container">
	<div class="row" style="width:940px;">
	<div id="container">

<?php  foreach ($profiles as $profile): ?>  <!--リストの中身、プロフィールの中身をサムネイル形式でループ-->

		  <div class="col-sm-6 col-md-3 item">
		    <div class="thumbnail">
		      
		      	<div class="media" style="margin-top:10px;">
					  <a class="pull-left" href="#">
					    <img src="https://graph.facebook.com/<?php echo $profile['User']['facebook_id']; ?>/picture??type=square" align="left" style="margin-left:10px;" class="img-circle">
					  </a>
					  <div class="media-body">
					    <h4 class="media-heading">
					    <?php echo $this->Form->postLink($profile['User']['name'],array('action'=>'view',$profile['Profile']['user_id']),array('escape'=>false));?></h4>
					    <?php echo $profile['Profile']['occupation']; ?>/
					    <?php echo $profile['Profile']['generation']; ?>/
					    <?php echo $profile['Profile']['gender'];?>
					  </div>
				</div>

		      <div class="caption">
		      <?php 
		      	foreach ($profile['Wishlist'] as $listcontent) { ?>
		      	<h2><?php echo $listcontent['name'];?></h2>
		      <?php
		      	break;
		      	}
		      	//endforeach;
		 	  ?>		          
		         
		          <!--<p><a href="#" class="btn btn-default" role="button">Button</a></p>-->

		      </div>
		    </div>
		  </div>
            
<?php endforeach; ?>

</div><!--id container-->
</div><!--row-->
</div><!--container-->
</div><!--align Center-->

<?php 
echo $this->Html->link('<button class="btn btn-mini btn-primary" type="button" align="left"><span class="glyphicon glyphicon-star"></span>ログアウト</button>',array('controller' => 'fbconnects','action' => 'logout'),array('escape' => false));


?>