
<div align ="center">


<div class="jumbotron">
  <h1>Wannado List</h1>
  <p>
	What do you wanna do ?<br />
	your life is limited!<br />
</p>

<?php

 echo $this->Html->link('<img src="/wannadoList/img/loginBtn.png" alt="">',array('controller' => 'fbconnects','action' => 'facebook'),array('escape' => false)); ?><br />

 <?php

 echo $this->Html->link('ふつうにろぐいん',array('controller' => 'fbconnects','action' => 'showdata'),array('escape' => false)); ?>


</div>






<!--
'<button class="btn btn-mini btn-primary" type="button" align="left"><span class="glyphicon glyphicon-star"></span>Facebookでログイン</button>'
-->
</div>