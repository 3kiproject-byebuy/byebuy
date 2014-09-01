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
		<h1>売ります記事一覧</h1>

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
      			<th>記事タイトル</th>
      			<th>ユーザー</th>
      			<th>チャットログ確認</th>
      			<th>削除</th>
            <th>更新日時</th>
    		</tr>
  			</thead>

  			<tbody>
  			<?php
  				foreach ($selling_lists as $selling_list) { ?>

  				<tr>
      			<td><?php echo $selling_list['Selling_list']['sellingproduct_name']; ?></td>
            <td>
      			<?php
            echo $selling_list['User']['name'];
      			?>
            </td>
      			<td>
              <?php
              echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">チャットログ確認</button>',
                array('action' => 'selling_lists_threads',$selling_list['Selling_list']['id']),
                array('escape' =>false));
              ?>
            </td>
      			<td>
      				<?php

              if(!$selling_list['Selling_list']['del_flg']){

                echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">削除</button>',
                array('action' => 'del_selling_lists',$selling_list['Selling_list']['id']),
                array('escape' =>false));
                          
              }else{

                echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">取り消し</button>',
                array('action' => 'del_selling_lists',$selling_list['Selling_list']['id']),
                array('escape' =>false));

              }
              ?>
      			</td>
            <td>
              <?php echo $selling_list['Selling_list']['modified']; ?>
            </td>
    			</tr>
  				
  				<?php
  				}
  				?>    	
  			</tbody>
		</table>

	</div>

</div>
