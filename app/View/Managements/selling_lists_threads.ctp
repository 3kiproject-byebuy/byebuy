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
      			<th>名前</th>
      			<th>内容</th>
      			<th>日時</th>
      			<th>ブロックする</th>
    		</tr>
  			</thead>

  			<tbody>
  			<?php
  				foreach ($selling_thread_lists as $selling_thread_list) { ?>

  				<tr>
      			<td><?php echo $selling_thread_list['User']['name']; ?></td>
            <td>
      			<?php echo $selling_thread_list['Selling_thread_list']['thread']; ?>
            </td>
      			<td>
            <?php echo $selling_thread_list['Selling_thread_list']['created']; ?>
            </td>
      			<td>
      				<?php
            if(!$selling_thread_list['User']['block_flg']){
              echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">ロック</button>',
                array('action' => '/lock_unlock', $selling_thread_list['User']['id']),
                array('confirm' => 'Are you sure?','escape' =>false));
            }else{
              echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">解除</button>',
                array('action' => '/lock_unlock', $selling_thread_list['User']['id']),
                array('confirm' => 'Are you sure?','escape' =>false));
            }
            ?>
      			</td> 				
  				<?php
  				}
  				?>    	
  			</tbody>
		</table>

	</div>

</div>
