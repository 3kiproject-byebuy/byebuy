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
	<div class="list-group col-xs-4 col-xs-offset-1">
		<h1>カテゴリ編集</h1>

		<table class="table">
  			<thead>
    		<tr>
      			<th>カテゴリ名</th>
      			<th>完了</th>
    		</tr>
  			</thead>

  			<tbody>
  				<tr>
      			<td>

              <?php
              echo $this->Form->create('managements',array('action' => 'edit_categories_add_submit','role' => 'form', 'class' => 'form-inline'));
              echo '<div class="form-group">';
              echo $this->Form->input('category_title',array('class' => 'form-control','label'=>false));
              echo '</div>';
              ?>

            </td>
            
            <td>
      			<?php
      				echo $this->Form->button('完了',array('type'=>'submit','class'=>'btn btn-primary','label'=>false,'escape' =>false));
              echo $this->Form->end();
      			?>
            </td>
      			
    			</tr>
  				    	
  			</tbody>
		</table>

	</div>

</div>
