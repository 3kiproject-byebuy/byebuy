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
		<h1>カテゴリ編集</h1>

		<table class="table">
  			<thead>
    		<tr>
      			<th>カテゴリ</th>
      			<th>修正</th>
      			<th>削除</th>
      			<th>更新日時</th>
    		</tr>
  			</thead>

  			<tbody>
  			<?php
  				foreach ($categories as $category) { ?>

  				<tr>
      			<td><?php echo $category['Category']['category_title']; ?></td>
            <td>
      			<?php
      				echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">修正</button>',
                array('action' => 'edit_categories_mod', $category['Category']['id']),
                array('escape' =>false));
      			?>
            </td>
      			<td>
              <?php
            if(!$category['Category']['del_flg']){
              echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">削除</button>',
                array('action' => 'delete_categories', $category['Category']['id']),
                array('confirm' => 'Are you sure?','escape' =>false));
            }else{
              echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">取り消し</button>',
                array('action' => 'delete_categories', $category['Category']['id']),
                array('confirm' => 'Are you sure?','escape' =>false));
            }
            ?>
            </td>
      			<td>
              <?php echo $category['Category']['modified']; ?>
      			</td>
    			</tr>
  				
  				<?php
  				}
  				?>
          <tr>
            <td>
              <?php
              echo $this->HTML->link(
                '<button type="button" class="btn btn-danger">追加</button>',
                array('action' => 'edit_categories_add'),
                array('escape' =>false));
              ?>
            </td>
            <td>
            </td>
            
            <td>
            </td>

            <td>
            </td>
          </tr>
  			</tbody>
		</table>
                

	</div>

</div>
