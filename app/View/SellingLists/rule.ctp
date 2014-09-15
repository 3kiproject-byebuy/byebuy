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




<div class="container">
<center>
<h2>利用規約</h2>
</center>
<br />

以下の利用規約をご確認の上ByeBuyをご利用ください。<br />
本サービスの利用にあたり、本規約の全てに同意していただくことが必要です。<br />
<br />
■利用規約<br />
●「ByeBuy」とは？<br />
「ByeBuy」は、自分の所有物を商品として他の人に譲る又は売る、他の人の商品をもらう又は購入することができるフリーマーケット形式のサービスです。<br />

<br />
●利用に際して<br />
・当サイト利用による個人間のトラブル、その他トラブルに関しては、運営は一切責任を負いかねます。<br />
・公序良俗に反する行為や閲覧者に不快感を与える行為、そのような内容を含む投稿を禁止します。<br />
・犯罪行為に結びつく内容の投稿を禁止します。<br />
・違法、または公序良俗に反する内容の投稿を禁止します。<br />
・自己及び第三者のプライバシーを侵害する内容の投稿を禁止します。<br />
・猥褻、児童ポルノ、または、幼児虐待にあたる内容の投稿を禁止します。<br />
・管理・運営に支障が出る行為や妨害する内容の投稿を禁止します。<br />
・法令に違反する内容の投稿を禁止します。<br />
・運営が不適切だと判断した内容の投稿を削除する場合があります。<br />
<br />
<br />
<br />
<br />

<!-- ●利用料金について<br />
すべて無料でご利用いただけます。<br />
<br /><br /> -->


<?php //↓-------------------利用規約とQ&Aとcopyrightの記述----------------------↓ ?>

<center>
<table>
  <tr>
    <td>
      <div>
        <?php echo $this->HTML->link('利用規約', 
                                      array(
                                        'controller' => 'sellingLists',
                                        'action'=>'rule'),
                                    array(
                                          'escape'=>false)
                                        
                                      );
        ?>
      </div>
    </td>
    <td>
      &nbsp;&nbsp;&nbsp;
    </td>
    <td>
      <div>
        <?php echo $this->HTML->link('Q&A', 
                                   array(
                                        'controller' => 'sellingLists',
                                        'action'=>'qa'),
                                    array(
                                          'escape'=>false)
                                            
                                   );
        ?>
      </div>
    </td>
  </tr>
</table>  
      <p>copyright(c)2014 geechsasia. All rights reserved.</p>

</center>
<?php //↑-------------------利用規約とQ&Aとcopyrightの記述----------------------↑ ?>



















