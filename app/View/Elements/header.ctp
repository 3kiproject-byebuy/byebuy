<?php
//現在ログインしているユーザーを取得
$self = $this->Session->read('Auth.User');

?>

<!--管理画面へ-->

<div class="col-md-2 col-md-offset-9" align="right" style="bottom:0px;">
<?php 

if(is_null($self)){

}else{

  if($self['group_id']==1){
  echo '<a href="/byebuy/managements/index">管理画面</a>';
  }

}

?>
</div>
<!--管理画面へ-->


<!-- facebook 関連 -->
<div class="row">

    <!--いいね、シェア-->
    <div class="col-md-2 col-md-offset-10" align="right" style="bottom:0px;">
    <script language="javascript" type="text/javascript">
     
             function invite(){
             //FB.ui({method: 'apprequests', message: 'ByeBuy.comに参加してみませんか？.', data: 'tracking information for the user'});
              FB.ui({
              method: 'send',
              name: 'ByeBuy.comをお友達に知らせよう。',
              link: 'http://geechscamp.lovepop.jp/byebuy',
              description: 'ラガージャ専用フリマサイト、ByeBuyに参加してみませんか？',
              });
          }
    </script>


    <input class="btn btn-default btn-xs" type="button" value="友達に教える" onclick="invite();"/>
    <div id="output"></div>
    </div>
    <!--ここまで　いいね、シェア　ここまで-->

    <!--友達招待-->
    <div class="col-md-3 col-md-offset-9" align="right" style="bottom:0px;">
    <div class="fb-like" data-href="https://geechscamp.lovepop.jp/byebuy" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
     </div>

    <!--ここまで　友達招待　ここまで-->

<?php
//ログイン判定、ログインボタン・ユーザーの表示
//ユーザーが未ログインの場合
//echo '<button class="btn btn-mini btn-default" type="button">login</button>';
if (is_null($self)){ 
  
    echo '<div class="col-md-3 col-md-offset-9" align="right" style="margin-top:15px;padding-left:30px;">';
    echo $this->Html->link($this->Html->image('active200.png'),array('controller' => 'fbconnects','action' => 'facebook'),array('escape' => false));
    echo '</div>';
    echo '</div>';
  

//ユーザーがログイン中の場合、ステータスを確認
 }else{

    //【ステータス１】＝ 【承認済みユーザー】 の場合
    if($self['status']==1){?>
      </div> 
      <div class="row">

        <div class="media col-md-3 col-md-offset-9" style="margin-top:10px;">
          <img src="https://graph.facebook.com/<?php echo $self['facebook_id']; ?>/picture?type=square" 
          align="left" style="margin-left:10px;" class="img-circle">
            <div class="media-body">
              <h4 class="media-heading" style="height:50px;line-height:50px;margin-left:10px;">
               <font color="#ffffff"><?php echo $self['name'];?></font>
               <?php echo $this->Html->link('<button class="btn btn-sm btn-default" type="button">logout</button>',array(
                'controller' => 'fbconnects','action' => 'logout'),array('escape' => false));?></h4>
            </div>
        </div>
      </div>

         
<?php
    //【ステータス２】または【ステータス３】＝ 【未承認ユーザー】 の場合
    }else{
      echo '<br /><div class="row" align="right">';
      echo '<div class=" col-md-3 col-md-offset-9" style="margin-top:15px;">';
      //echo '</div><br />';
      echo '<span class="label label-danger" style="margin:15px;">未承認ユーザー</span>';
      echo $this->Html->link('<button class="btn btn-sm btn-default" type="button">logout</button>',array(
                'controller' => 'fbconnects','action' => 'logout'),array('escape' => false));
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
}
?>


<!--ロゴ-->
<div align="center">
<a href="/byebuy/byebuys/index"><img src="/byebuy/img/protLogo.png"></a>
</div>

<?php 
 //echo $this->Html->image('protLogo.png');
?>
<!--ロゴ-->


<!-- ログインボタン・ログインユーザーの表示 -->
<!-- 
<div id = "tabs">
<ul class="nav nav-tabs" role="tablist">
	<li ><a href="#Selling" data-toggle="tab">出品中</a></li>
	<li><a href="#Wanted" data-toggle="tab">ほしい</a></li>
	<li><a href="#WatchList" data-toggle="tab">ウォッチリスト</a></li>
	<li><a href="#PostManagements" data-toggle="tab">投稿管理</a></li>
	<p>クリックした要素は<span>？</span>番目です</p>
</ul>


<div class="tab-content">
  <div class="tab-pane fade" id="Selling">Tab1 Content</div>
  <div class="tab-pane fade" id="Wanted">Tab2 Content</div>
  <div class="tab-pane fade" id="WatchList">Tab3 Content</div>
  <div class="tab-pane fade" id="PostManagements">Tab3 Content</div>
</div>
</div>
<script>

$("div#tabs ul li").click(function() {
  index = $("div#tabs ul li").index(this);
  
  switch(index){
  	case 0:
  		location.href="/byebuy/";
  	break;

  	case 1:
  		location.href="/byebuy/wanted_lists/index";
  		$("div#tabs ul li a:eq(2)").tab("show");
  	break;

  	case 2:
  		location.href="/byebuy/watchlists/index";
  	break;

  	case 3:
  		location.href="/byebuy/postmanagements/index";
  	break;
  }

  
})

//$("div#tabs ul li a:eq(2)").tab("show");

var obj = $("#tabs").tab();
   
obj.tab('select', 2);
 </script>
-->

<!--  
<ul class="nav nav-tabs" role="tablist">
	<li class="active"><a href="/byebuy/" data-toggle="tab">出品中</a></li>
	<li><a href="/byebuy/wanted_lists/index" data-toggle="tab">ほしい</a></li>
	<li><a href="/byebuy/watchlists/index" data-toggle="tab">ウォッチリスト</a></li>
	<li><a href="/byebuy/postmanagements/index" data-toggle="tab">投稿管理</a></li>
</ul>
-->



