<?php
//現在ログインしているユーザーを取得
$self = $this->Session->read('Auth.User');

?>
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



<!-- <CENTER>
<div class="container">
<div class="row">
<div class="col-md-2 col-md-offset-2"><a href="/byebuy/byebuys/index/"><h1>出品中</h1></a></div>
<div class="col-md-2"><a href="/byebuy/wanted_lists/index"><h1>ほしい</h1></a></div>
<div class="col-md-2"><a href="/byebuy/watchlists/index"><h1>ウォッチリスト</h1></a></div>
<div class="col-md-2"><a href="/byebuy/postmanagements/index"><h1>投稿管理</h1></a></div>
</div>
</div>
</div>
</CENTER> -->
<?php
	// echo $this->Form->button('出品中', array('class'=>'btn btn-default btn-xs','label'=>false,'escape'=>false, 'onclick' => "location.href='/byebuy/'"));
	// echo $this->Form->button('ほしい', array('class'=>'btn btn-default btn-xs','label'=>false,'escape'=>false, 'onclick' => "location.href='/byebuy/wanted_lists/index'"));
	// echo $this->Form->button('ウォッチリスト', array('class'=>'btn btn-default btn-xs','label'=>false,'escape'=>false, 'onclick' => "location.href='/byebuy/watchlists/index'"));
	// echo $this->Form->button('投稿管理', array('class'=>'btn btn-default btn-xs','label'=>false,'escape'=>false, 'onclick' => "location.href='/byebuy/postmanagements/index'"));
?>

<!-- ここまで　ナビゲーションバー ここまで　-->


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



