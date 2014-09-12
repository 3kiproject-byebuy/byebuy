<div id="result" class="col-xs-12 text-center"></div>

<div class="col-xs-12 text-center jumbotron">
	<h1>ByeBuy管理画面</h1>
</div>

<!-- サイドメニュー -->
<div class="col-xs-12">
	<div class="panel panel-default col-xs-3 panel-warning">
<?php
    echo $this->element('sidemenu');
?>
	</div>

<!-- メインコンテンツ -->
	<div class="list-group col-xs-8 col-xs-offset-1">
		<h1>ユーザー情報</h1>

<?php
  echo $this->Form->create('Search',array('role' => 'form', 'class' => 'form-inline'));
  echo '<div class="form-group">';
  echo $this->Form->input('name',array('class' => 'form-control','label'=>false));
  echo '</div>';
  echo $this->Form->button('<span class="glyphicon glyphicon-search">検索</span>',array('type'=>'submit','class'=>'btn btn-primary','label'=>false,'escape' =>false));
  echo $this->Form->end();
?>

		<table class="table">
  			<thead>
    		<tr>
      			<th>名前</th>
      			<th>ログインロック</th>
      			<th>強制退会</th>
      			<th>権限付与</th>
    		</tr>
  			</thead>

  			<tbody>
  			<?php
  				foreach ($users as $user) { ?>

  				<tr>
      			<td><?php echo $user['User']['name']; ?></td>
            <td>

      			<?php
      			if(!$user['User']['block_flg']){
      				echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">ロック</button>',
                array('action' => 'lock_unlock', $user['User']['id']),
                array('confirm' => 'Are you sure?','escape' =>false));
      			}else{
      				echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">解除</button>',
                array('action' => 'lock_unlock', $user['User']['id']),
                array('confirm' => 'Are you sure?','escape' =>false));
      			}
      			?>
            </td>
      			<td>
              <?php
            if(!$user['User']['del_flg']){
              echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">強制退会</button>',
                array('action' => 'withdrawal', $user['User']['id']),
                array('confirm' => 'Are you sure?','escape' =>false));
            }else{
              echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">取り消し</button>',
                array('action' => 'withdrawal', $user['User']['id']),
                array('confirm' => 'Are you sure?','escape' =>false));
            }
            ?>
            </td>
      			<td>
      				<div class="btn-group">
  						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    					<?php if($user['User']['group_id'] == 1){
    						echo "管理者";
    					}else{
    						echo "一般";
    					}
    					?>
    					<span class="caret"></span>
  						</button>
  						<ul class="dropdown-menu" role="menu">
    						<li>
                  <?php echo $this->Form->postLink(
                '管理者',
                array('action' => 'give_authority', $user['User']['id'],'1'),
                array('confirm' => 'Are you sure?','escape' =>false)); ?>
                </li>
    						<li>
                  <?php echo $this->Form->postLink(
                '一般',
                array('action' => 'give_authority', $user['User']['id'],'2'),
                array('confirm' => 'Are you sure?','escape' =>false)); ?>
                </li>
  						</ul>
					</div>
      			</td>
    			</tr>
  				
  				<?php
  				}
  				?>    	
  			</tbody>
		</table>

	</div>

</div>



<?php $this->Html->scriptStart(array('inline' => false)); ?>

var i = 0;

window.onload = function(){
window.document.onkeydown = function(evt){
if (evt){
var kc = evt.keyCode;
}else{
var kc = event.keyCode;
}
var chr = String.fromCharCode(kc);

    switch (i){
  case 0:
    if(kc==38){
    i++;
    }else{
    i=0
    };
    break;
  case 1:
    if(kc==38){
    i++;
    }else{
    i=0
    };
    break;
  case 2:
    if(kc==40){
    i++;
    }else{
    i=0
    };
    break;
  case 3:
    if(kc==40){
    i++;
    }else{
    i=0
    };
    break;
  case 4:
    if(kc==37){
    i++;
    }else{
    i=0
    };
    break;
  case 5:
    if(kc==39){
    i++;
    }else{
    i=0
    };
    break;
  case 6:
    if(kc==37){
    i++;
    }else{
    i=0
    };
    break;
  case 7:
    if(kc==39){
    i++;
    }else{
    i=0
    };
    break;
  default:
    i=0;
    break;
}

if(i==8){
  document.getElementById("result").innerHTML += '<img src="/byebuy/img/irukappa.png" alt="表示できません">';
  i=0;
}

}
}

<?php $this->Html->scriptEnd(); ?>

