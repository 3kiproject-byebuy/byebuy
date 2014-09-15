<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php //echo $cakeDescription ?>
        <?php echo $title_for_layout; ?>
    </title>
    <?php

        echo $this->Html->meta('icon');
        echo $this->Html->css('cake.generic'); //これを読んでおかないとスタイルが変になる。

        // jQuery CDN
        echo $this->Html->script('//code.jquery.com/jquery-1.10.2.min.js');
        //echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
        echo $this->Html->script('jquery.masonry.min.js');

        // Twitter Bootstrap 3.0 CDN　ここにアイコン用のアドレスを読んでおかないとブートスラップのアイコンス変えない。
        echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css');
        echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap-glyphicons.css');
        echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>

<!--topページの商品サムネイルを綺麗に敷き詰めるためのプラグインに必要なファンクション-->
		<script>
		  $(function(){
		    $('#container2').masonry({
		      itemSelector: '.item',
		      isAnimated: true
		    });
		  });

		</script>
<!--topページの商品サムネイルを綺麗に敷き詰めるためのプラグインに必要なファンクション-->

<style text/css>

body {
    background: #ffffff;
    color: #999999;
    font-family:'lucida grande',verdana,helvetica,arial,sans-serif;
    /*font-size:90%;*/
    margin: 0;
}

h2 {
    /*background:#fff;*/
    color: #999999;
    font-family:'Gill Sans','lucida grande', helvetica, arial, sans-serif;
    /*font-size: 190%;*/
}

h4 {
    /*background:#fff;*/
    color: #999999;
    font-family:'Gill Sans','lucida grande', helvetica, arial, sans-serif;
    /*font-size: 190%;*/
}

.nav{margin-bottom:0;padding-left:0;list-style:none;background-color:#25B5F3;}
.nav>li{position:relative;display:block}
.nav>li>a{position:relative;display:block;padding:10px 15px}
.nav>li>a:hover,
.nav>li>a:focus{text-decoration:none;background-color:#23ADE8}



</style>

 

</head>
<body>

<!--facebookとの接続に必要なjavascriptのイニシャライズ-->
<div id="fb-root"></div>
 <script>
      window.fbAsyncInit = function()
      {
        FB.init({
          appId      : '{279683735571945}',
          xfbml      : true,
          version    : 'v2.0',
          status  : true, // check login status
          cookie  : true, // enable cookies to allow the server to access the session
          xfbml   : true, // parse XFBML
          oauth   : true
        });

        FB.Event.subscribe('auth.login', function()
        {
            window.location.reload();
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         // js.src = "//connect.facebook.net/en_US/sdk.js";
         js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&appId=279683735571945&version=v2.0";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
<!--facebookとの接続に必要なjavascriptのイニシャライズ-->

	<div id="container">

        <div id="header" class="jumbotron" style="background-color:#25B5F3;margin:0px;padding-top:1px;">
        
        <?php echo $this->Element('header');?>

        </div>
		<div id="content">
		
			<?php echo $this->Session->flash(); ?>

        <div style="margin:0px;background-color:#ffffff;">
			    <?php echo $this->fetch('content'); ?>
        </div>
    </div>
	
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank','escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
