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
		<h1>招待承認</h1>

		<table class="table">
  			<thead>
    		<tr>
      			<th>名前</th>
      			<th>承認</th>
      			<th>非承認</th>
      			<th>日付</th>
    		</tr>
  			</thead>

  			<tbody>
  			<?php
  				foreach ($users as $user) { ?>

  				<tr>
      			<td><?php echo $user['User']['name']; ?></td>
            <td>

      			<?php
        				echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">承認</button>',
                array('action' => 'approval', $user['User']['id'],'1'),
                array('confirm' => 'Are you sure?','escape' =>false));
      			?>
            </td>
      			<td>
              <?php
                echo $this->Form->postLink(
                '<button type="button" class="btn btn-danger">非承認</button>',
                array('action' => 'unapproval', $user['User']['id']),
                array('confirm' => 'Are you sure?','escape' =>false));            
              ?>
            </td>
      			<td><?php echo $user['User']['created']; ?></td>
    			</tr>
  				
  				<?php
  				}
  				?>    	
  			</tbody>
		</table>

	</div>

</div>
