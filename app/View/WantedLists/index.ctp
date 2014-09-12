<!-- File: /app/View/WantedLists/index.ctp -->

<Style Type="text/css">
#acMenu dt{
    display:block;
    width:90%;
    line-height:50px;
    text-align:center;
    cursor:pointer;
    }
#acMenu dd{
    width:90%;
    line-height:50px;
    text-align:center;
    display:none;
    }
li{
  margin-left:20px;
}
</Style>

<script>
    $(function(){
        $("#acMenu dt").on("click", function() {
            $(this).next().slideToggle();
        });
    });
</script>

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

    <li class="active"><?php echo $this->HTML->link('<b>ほしい</b>', 
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

		
    <center>

    		<h1 style="font-size:150%; margin-top:60px; margin-bottom:40px;">欲しいものを投稿する</h1>
      
    	<!-- 欲しいもの投稿ボタン -->
			<?php
      if(is_null($self)){//未ログインの場合

        //何も表示させない

      }else{//ログイン済み
      
				echo $this->Form->create('Wanted_list',array('url' => 'addWantedList')); //'url'=> 'addWantedList'によりaddWantedListファンクションに飛ばす
				echo $this->Form->input('user_id',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>$self['id']));//user_id保存
        echo $this->Form->input('wanteddetail',array('type'=>'textarea','rows' => '3','label'=>false,'class'=>'form-control', 'style'=>'width:80%;height:80px;','required'=>true));//'required'=>false：required属性
        echo $this->Form->button('投稿', array('type'=>'submit','class'=>'btn btn-default btn-mini','label'=>false,'escape'=>false, 'style'=>'width:150px; margin-top:20px; margin-bottom:40px;'));
        echo $this->Form->end();

      } 
      ?>
      <!-- 欲しいもの投稿ボタン -->

    </center>
    
        	
        <table border="2" bordercolor="#cccccc" width="90%" align="center" style="margin-bottom:40px;font-size:12pt;">
        	<tr>
        		<td align="center">みんなの欲しいもの投稿一覧</td>
        	</tr>
    	</table>

<center>
    <div class="pagination pagination-large">    
        <?php echo $this->Paginator->numbers(); ?>
    </div>
    <p>
      <?php echo "コメント部分をクリックすると今までのコメント一覧が出てきてコメント投稿も出来るよ！"; ?>
    </p>
</center>



    <!-- 投稿表示 -->
    <?php foreach ($Wanted_lists as $wanted_list){ ?>
    <center>
    <dl id="acMenu">
    <dt>
        <div class="media">

  						<a class="pull-left" href="#">
    						<img class="media-object img-circle" src="https://graph.facebook.com/<?php echo $wanted_list['User']['facebook_id']; ?>/picture?type=square" alt="No image">
  						</a>
  			<div class="media-body">
    				<h4 class="media-heading">
              <table width="100%">
                <tr>
                  <td>
   						     <div style="float:left"><?php echo $wanted_list['User']['name']; ?></div><!-- ユーザー名 -->
    					     <div style="float:right"><?php echo $wanted_list['Wanted_list']['created']; ?></div><!-- 投稿日時 -->	
                </tr>
              </td>
    				</h4>
				        
                <tr>
                  <td style="border: 2px solid #cccccc" align="left">

    							 <?php echo $wanted_list['Wanted_list']['wanteddetail']; ?><!-- 欲しいもの詳細表示 -->
<?php //if(自分のID == DBから取得したIDの場合、編集ボタン表示)?>
                  </td>
                </tr>

                <tr>
                  <td align="center">

                    <!-- //取引成立した場合、欲しいもの詳細の下にコメントを表示 -->
                    <?php

                    if($wanted_list['User']['id'] == $self['id'] && $wanted_list['Wanted_list']['status'] == 2){

                      foreach($Users as $user){

                        if($wanted_list['Wanted_list']['trade_person_user_id'] == $user['User']['id']){

                          $trade_user_name = $user['User']['name'];
                          $trade_user_url = "https://www.facebook.com/".$user['User']['facebook_id'];
                          echo $trade_user_name."さんとの取引が成立しました！</br>";
                          echo "facebookメッセージを送って詳細を決めましょう！</br>";
                          echo "<A Href="."\"".$trade_user_url."\"target=\"_blank\">".$trade_user_name."</A>";
                          break;

                        }

                      }

                    }elseif($wanted_list['Wanted_list']['status'] == 2) {

                      echo "この商品は取引が終了しました。";

                    }

                    ?>
                  </td>
                </tr>
              </table>	
    </dt>
    <dd>

  <div style="width:95%; height:2px; background-color:#cccccc; margin:40px;"></div>


              <!-- Thread -->
        			<?php foreach ($wanted_list['Wanted_thread_list'] as $wanted_thread){ ?>

        <li style="display:block">

    				<div class="media">
  									<a class="pull-left" href="#">
    									<img class="media-object img-circle" src="https://graph.facebook.com/<?php echo $wanted_thread['User']['facebook_id']; ?>/picture?type=square" alt="No image">
  									</a>
  							<div class="media-body">
  								<h4 class="media-heading">
                    <table width="100%">
                      <tr>
                        <td>
   									      <div style="float:left"><?php echo $wanted_thread['User']['name']; ?></div><!-- ユーザー名 -->
    								      <div style="float:right"><?php echo $wanted_thread['created']; ?></div><!-- 投稿日時 -->
                        </td>
                      </tr>
    							</h4>

                       <tr>
                        <td style="border: 2px solid #cccccc" align="left">
    							       <?php echo $wanted_thread['thread']; ?>
                        </td>
                        <td align="left">

                          <!-- 'この人に決める'ボタン -->
                          <!-- (DBから取得したID==現在のログインID)かつ(status　!= 取引完了)かつ(ThreadListのUseID != 現在のログインID)の場合、ボタン表示 -->
                          <?php
                           if($wanted_list['User']['id']== $self['id'] && $wanted_list['Wanted_list']['status'] != 2 && $wanted_thread['user_id'] != $self['id']){
                            echo $this->Form->create('Wanted_list',array('url'=>'decide'),array('class'=>'form-inline','role'=>'form')); //'url'=> 'decide'によりdecideファンクションに飛ばす
                            echo $this->Form->input('id',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>$wanted_list['Wanted_list']['id']));//WantedListのidを送信
                            echo $this->Form->input('tradedate',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>date('Y-m-d H:i:s')));//tradedate（交渉成立日時）の保存
                            echo $this->Form->input('trade_person_user_id',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>$wanted_thread['User']['id']));//trade_person_user_id（交渉成立相手）の保存
                            echo $this->Form->input('status',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>'2'));//ステータスの保存
                            echo $this->Form->button('この人に決める',array('type'=>'submit','class'=>'btn btn-default btn-xs','label'=>false,'escape'=>false));
                            echo $this->Form->end();
                            }
                          ?>

                        </td>
                      </tr>
                    </table>
  							</div><!--class="media-body"-->
  					
  					</div><!--class="media"-->
        </li>
  					<?php }?>


        <li style="display:block">
          
       		<!-- コメントボタン -->
					<?php
          if(is_null($self)){//未ログインの場合

              //何も表示させない

            }else{//ログイン済み

            if($wanted_list['Wanted_list']['status'] != 2){//ステータスが2(取引完了）以外のときコメントボタンを表示
						  echo $this->Form->create('Wanted_thread_list',array('url' => 'addComment'),array('class'=>'form-inline','role'=>'form')); //'url'=> 'addComment'によりaddCommentファンクションに飛ばす
						  echo $this->Form->input('user_id',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>$self['id']));//user_id保存
						  echo $this->Form->input('wantedlist_id',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>$wanted_list['Wanted_list']['id']));//wantedlist_id保存
              echo $this->Form->input('thread',array('label'=>false,'class'=>'form-control','required'=>true));
              echo $this->Form->button('コメント', array('type'=>'submit','class'=>'btn btn-default btn-xs','label'=>false,'escape'=>false));
              echo $this->Form->end();
            }
          }
        	?>
    			
        </li>
    </dd>
    		</div><!-- class="media-body" -->
		</div><!--class="media"-->

  </dl>

  </center> 	
	<?php }?><!-- foreach ($WantedLists as $wantedList) -->

  <center>
    <div class="pagination pagination-large">    
        <?php echo $this->Paginator->numbers(); ?>
    </div>
</center>
	
  





	