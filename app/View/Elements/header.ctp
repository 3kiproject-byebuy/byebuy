<!-- ログインボタン・ログインユーザーの表示 -->


<?php

if(is_null($self)){
		

	echo $this->Html->link('<button class="btn btn-mini btn-default" type="button">ログイン</button>',array('controller' => 'fbconnects','action' => 'facebook'),array('escape' => false));
	
	}else{ ?>


					<div align="right">
					<div class="media" style="margin-top:10px;">
					   <a class="pull-right" href="#">
						 <img src="https://graph.facebook.com/<?php echo $self['facebook_id']; ?>/picture?type=square" align="left" style="margin-left:10px;" class="img-circle"></a>
							<div class="media-body">
							  <h4 class="media-heading"><?php echo $self['name'];?></h4>

					</div>
					</div>

					<?php echo $this->Html->link('<button class="btn btn-mini btn-default" type="button">logout</button>',array('controller' => 'fbconnects','action' => 'logout'),array('escape' => false));
				

	}?>
<!-- ログインボタン・ログインユーザーの表示 -->

<!--いいね、シェア-->

<div class="fb-like" data-href="https://dev.ByeBuy.com/" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>

<!--ここまで　いいね、シェア　ここまで-->

<!--友達招待-->
<script language="javascript" type="text/javascript">
        // function OnButtonClick() {
        //     target = document.getElementById("output");
        //     target.innerHTML = "Penguin";

        // }
         function invite(){
         //FB.ui({method: 'apprequests', message: 'ByeBuy.comに参加してみませんか？.', data: 'tracking information for the user'});
          FB.ui({
          method: 'send',
          name: 'ByeBuy.comをお友達に知らせよう。',
          link: 'http://dev.ByeBuy.com/ByeBuy',
		  description: 'ラガージャ専用フリマサイト、ByeBuy.comに参加してみませんか？',
          });

          //});
     	}
</script>

    <input type="button" value="友達に知らせよう" onclick="invite();"/><br />
    <br />
    <div id="output"></div>
<!--ここまで　友達招待　ここまで-->


<!-- ナビゲーションバー -->
<a href="/ByeBuy/groups/index" align="right">管理画面</a>
<ul class="nav nav-tabs" role="tablist">
	<li class="active"><a href="#">出品中</a></li>
	<li><a href="#">ほしい</a></li>
	<li><a href="#">ウォッチリスト</a></li>
	<li><a href="#">投稿管理</a></li>
</ul>
<!-- ここまで　ナビゲーションバー ここまで　-->

<div style="margin:20px;">
<!--検索フォーム-->
<?php
   echo $this->Form->create('Selling_list',array(
   'class'=>'form-inline','role'=>'form',));

   echo $this->Form->input('Selling_list.keyword',array(
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

<!--ソート機能-->
 <?php
// echo $this->Paginator->sort('Selling_list.deadline', '締め切り');?>
<FORM name="form2">
<SELECT NAME="select2">
<option SELECTED> ▼ 下から選択してください　</option>
<option value="/ByeBuy/byebuys/index/sort:Selling_list.id/direction:desc">新着</option>
<option value="/ByeBuy/byebuys/index/sort:Selling_list.deadline/direction:asc">締め切り</option>
<option value="/ByeBuy/byebuys/index/sort:Selling_list.sellingproduct_price/direction:desc">価格が高い</option>
<option value="/ByeBuy/byebuys/index/sort:Selling_list.sellingproduct_price/direction:asc" draggable="true">価格が安い</option>
</SELECT> <INPUT type="button" onclick="if(document.form2.select2.value){location.href=document.form2.select2.value;}" value="Go!"></FORM>
<!--ここまで　ソート機能　ここまで-->

</div>
