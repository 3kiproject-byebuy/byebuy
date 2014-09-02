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


<?php $login_user_id = 4; ?>

		<div class="col-md-12 text-center"> 
    		<h1 style="display:inline;margin-bottom:15px;">欲しいものを投稿する</h1>
		
    	<!-- 欲しいもの投稿ボタン -->
			<?php 
				echo $this->Form->create('WantedList',array('url' => 'addWantedList')); //'url'=> 'addWantedList'によりaddWantedListファンクションに飛ばす
				echo $this->Form->input('user_id',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>$login_user_id));//user_id保存
        echo $this->Form->input('wanteddetail',array('label'=>false,'class'=>'form-control'));
        echo $this->Form->button('投稿', array('type'=>'submit','class'=>'btn btn-default btn-xs','label'=>false,'escape'=>false));
        echo $this->Form->end();
      ?>
      <!-- 欲しいもの投稿ボタン -->

    </div><!--class="col-xs-12"-->

        	
        <table border="2" bordercolor="#cccccc" width="100%" align="center">
        	<tr>
        		<td align="center">みんなの欲しいもの投稿一覧</td>
        	</tr>
    	</table>




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

                    if($wanted_list['User']['id']== $login_user_id && $wanted_list['Wanted_list']['status'] == 2){

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

                          <!-- (DBから取得したID==現在のログインID)かつ(status　!= 取引完了)かつ(ThreadListのUseID != 現在のログインID)の場合、'この人に決める'ボタン表示 -->
                          <?php
                           if($wanted_list['User']['id']== $login_user_id && $wanted_list['Wanted_list']['status'] != 2 && $wanted_thread['user_id'] != $login_user_id){
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
            if($wanted_list['Wanted_list']['status'] != 2){//ステータスが2(取引完了）以外のときコメントボタンを表示
						echo $this->Form->create('Wanted_thread_list',array('url' => 'addComment'),array('class'=>'form-inline','role'=>'form')); //'url'=> 'addComment'によりaddCommentファンクションに飛ばす
						echo $this->Form->input('user_id',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>$login_user_id));//user_id保存
						echo $this->Form->input('wantedlist_id',array('type'=>'hidden','label'=>false,'class'=>'form-control','value'=>$wanted_list['Wanted_list']['id']));//wantedlist_id保存
            echo $this->Form->input('thread',array('label'=>false,'class'=>'form-control'));
            echo $this->Form->button('コメント', array('type'=>'submit','class'=>'btn btn-default btn-xs','label'=>false,'escape'=>false));
            echo $this->Form->end();
          }
        	?>
    			
        </li>
    </dd>
    		</div><!-- class="media-body" -->
		</div><!--class="media"-->

  </dl>
  </center> 	
	<?php }?><!-- foreach ($WantedLists as $wantedList) -->
	
  





	