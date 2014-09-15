


<!-- 現在のログインID取得 -->
<?php $self = $this->Session->read('Auth.User'); ?>
<?php //$self['id'] = 2; //テスト用UserID指定（ログイン済み） ?>

<!-- ナビゲーションバー -->

<ul class="nav nav-tabs nav-justified" role="tablist" style="margin-bottom:20px;">
  <br />
    <li><?php echo $this->HTML->link('<font color="#ffffff"><b>出品中</b></font>', 
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


<div class="container">

<center>
<h2>Q&A</h2>
</center>

<h3>Q1. ByeBuyって何ができるの？</h3>
<table>
	<tr>	
		<td>

			<img src = "/byebuy/img/irukappa.png" width = "50px" height = "auto">
		</td>
		<td>
			&nbsp;&nbsp;
		</td>
		<td>
			<div style="border-style: solid ; border-width: 1px;">
				&nbsp;自分が持っているものを人に譲ったり、売ったりすることができるよ！そして、他の人が出品している商品をもらったり買ったりすることができるよ！
			</div>
		</td>
	</tr>
</table>
<br>
<h3>Q2. ウォッチリストって何？</h3>
<table>
	<tr>	
		<td>

			<img src = "/byebuy/img/irukappa.png" width = "50px" height = "auto">
		</td>
		<td>
			&nbsp;&nbsp;
		</td>
		<td>
			<div style="border-style: solid ; border-width: 1px;">
				&nbsp;ウォッチリストはお気に入り機能のことだよ。気になる投稿記事を見つけたら「ウォッチリストに追加」を押すとウォッチリストに追加されるよ！
			</div>
		</td>
	</tr>
</table>
<br>
<h3>Q3. 出品はどうすればいいの？</h3>
<table>
	<tr>	
		<td>

			<img src = "/byebuy/img/irukappa.png" width = "50px" height = "auto">
		</td>
		<td>
			&nbsp;&nbsp;
		</td>
		<td>
			<div style="border-style: solid ; border-width: 1px;">
				&nbsp;facebookアカウントでログインすると、出品することができるよ！
			</div>
		</td>
	</tr>
</table>
<br>
<h3>Q4. 出品されている商品がほしいんだけど・・</h3>
<table>
	<tr>	
		<td>

			<img src = "/byebuy/img/irukappa.png" width = "50px" height = "auto">
		</td>
		<td>
			&nbsp;&nbsp;
		</td>
		<td>
			<div style="border-style: solid ; border-width: 1px;">
				&nbsp;出品一覧から商品をクリックして、商品詳細でコメントを残そう。出品者が返信をくれて、取引が成立すればその商品をもらえるよ！コメントを残すためにはfacebookアカウントでのログインが必要だよ！
			</div>
		</td>
	</tr>
</table>
<br>
<h3>Q5. どうやって商品を受け取るの？</h3>
<table>
	<tr>	
		<td>

			<img src = "/byebuy/img/irukappa.png" width = "50px" height = "auto">
		</td>
		<td>
			&nbsp;&nbsp;
		</td>
		<td>
			<div style="border-style: solid ; border-width: 1px;">
				&nbsp;出品者との取引が成立した場合、facebookのメッセージを通して受け取りの詳細を決めよう。商品の受け渡しは直接手渡しで行ってね。
			</div>
		</td>
	</tr>
</table>
<br><br><br>





</div>














