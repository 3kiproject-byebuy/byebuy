<!-- ログインボタン・ログインユーザーの表示 -->

<?php

//現在ログインしているユーザーを取得
$self = $this->Session->read('Auth.User');

if(is_null($self)){
		

	echo $this->Html->link('<button class="btn btn-mini btn-default" type="button">ログイン</button>',array('controller' => 'fbconnects','action' => 'facebook'),array('escape' => false));
	
	}else{ ?>


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
<div class="fb-like" data-href="https://dev.byebuy.com/" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
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
          link: 'http://dev.byebuy.com/byebuy',
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
<a href="/byebuy/managements/index" align="right">管理画面</a>
<ul class="nav nav-tabs" role="tablist">
	<li class="active"><a href="/byebuy/">出品中</a></li>
	<li><a href="/byebuy/wanted_lists/index">ほしい</a></li>
	<li><a href="/byebuy/watchlists/index">ウォッチリスト</a></li>
	<li><a href="/byebuy/postmanagements/index">投稿管理</a></li>
</ul>
<!-- ここまで　ナビゲーションバー ここまで　-->

