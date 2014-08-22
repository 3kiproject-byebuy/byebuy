<!-- File: /app/View/Posts/index.ctp -->
<?php //debug($posts);
//デバッグモード0のとき、ブラウザに出力させない。
//debugモードの変更はcakePHP>donfig>core>core.phpでレベルを変更できる。
//debugモードが2のときは実行されたSQL文が表示される

?>

<br />
<div class ="title" align="center">
    <h1>Group</h1><BR />
</div>
 <!--タグを使いたいときはエスケープ処理-->

<div align="center">
<div id="button" style="width:60%" class="row" align="center">
    
<div class="col-xs-3">
     <?php echo $this->Html->link('<button class="btn btn-mini btn-primary" type="button" align="left"><span class="glyphicon glyphicon-star"></span>ADD</button>',array('controller' => 'groups','action' => 'add'),array('escape' => false)); 
echo '</div><div class="col-xs-3">';


            //検索フォームの作成 //何も指定しないとsubmitした時の値は自分自身に値が渡される。
           echo $this->Form->create('Group',array(
           'class'=>'form-inline','role'=>'form',));//→postcontorollerのindex functionに値が渡せる。
    
           echo $this->Form->input('keyword',array(
           'label'=>false,'class'=>'form-controll'));//このキーワードが連想配列のキーになっている。

           echo $this->Form->button('<span class="glyphicon glyphicon-search"></span>Search',array('type'=>'submit','label'=>false,'class'=>'btn btn-mini btn-default','escape'=>false));

           echo $this->Form->end();


     ?>
</div>
</div>

<table class = "table table-hover table-bordered" style = "width:60%";>
    <tr class="success">
        <th>Id</th>
        <th>Group</th>
        <th>Created</th>
        <th>Action</th>
    </tr> 

    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($groups as $group): ?>
    <tr  class="active">
        <td valign="middle"><?php echo $group['Group']['id']; ?></td>　<!--黄色の文字は連想配列のキー -->
        <td>
            <?php echo $this->Html->link($group['Group']['name'],'#'); ?>

<!--アドレスの規約　root/contoroller名/function名/ここが第一引数に自動的になる  -->
        </td>
        <td><?php echo $group['Group']['created']; ?></td>
        <td>

        <?php echo $this->Form->postLink(
                '<div style="display:inline;margin-right:5px;"><button class="btn btn-mini btn-danger" type="button">Delete</button></div>',
                array('action' => 'delete', $group['Group']['id']),
                array('confirm' => 'Are you sure?','escape' => false));//３つ目の引数　付加情報　confirm 定義済みのパラメータ。

        //postlinkを使う事によって自動的にhiddenタイプのフォームが吐き出され、ボタンを押したときにsubmitボタンを押したときと同様の動きを得られる。
        //<form action="/cakephp/posts/delete/1" name="post_53b64c45c3701215011850" id="post_53b64c45c3701215011850" style="display:none;" method="post"><div><button class="btn btn-mini btn-danger" type="button">Delete</button></div><input type="hidden" name="_method" value="POST"></form>

        //confirmタイプのメッセージボックスを出すjavascriptが吐き出される
        //<a href="#" onclick="if (confirm(&quot;Are you sure?&quot;)) { document.post_53b64c45c3701215011850.submit(); } event.returnValue = false; return false;"></a>
        //キャンセルを選択した場合ポスト送信されない。

        //ちなみに。。。Formタグはネストできない。

         echo $this->Html->link('<button class="btn btn-mini btn-success" type="button">Edit</button>',array('controller' => 'categories', 'action' => 'edit', $group['Group']['id']),array('escape' => false)); ?>

         </td>
    </tr>
    <?php endforeach; ?>

    
   <?php /*debug($post['Post']['id']);
     debug($post['Post']);
     debug($post);
     debug($post['id']);
     debug($posts);*/ ?>
     </table>
     </div>


    <?php unset($group); ?> <!--postの中身を破棄-->
</table>
