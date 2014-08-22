<!-- File: /app/View/Posts/add.ctp -->
<div class ="container" align="center">

<div class ="page-header">
<h1>Add Group</h1></div>
<div class ="well" style="width:60%">
<!--
ここで、FormHelperを使って、HTMLフォームの開始タグを生成している。
 $this->Form->create() が生成したHTMLは次のようになる。

 <form id="PostAddForm" method="post" action="/posts/add">

-->

<?php
//createの第一引数はモデル名。指定したモデル名のモデルからデータを引っ張ってこれる。
echo $this->Form->create('Group',array(
	'role' => 'form',
	//'class' => 'form-group',
	//'div' => 'form-group'
	));
//<form action="/cakephp/Posts/add/" id="PostAddForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>が生成される。
//actionを省略して書くと自分のページがアクション先になる。
//この（'Post')はモデル名　ここでPostモデルを指定することで
//以下のタイトルやbodyなどがPostモデルに紐づいていることが分かる。


echo $this->Form->input('name',
                              array(
                                  
                                   'label' => ' <span class="glyphicon glyphicon-pencil"></span> カテゴリー名',
                                   'class' => array('form-control' ,'form-group'), //
                                   'placeholder' => 'カテゴリー名を入力してください。'
                                   // 'class' => form-control
                                   ));
//<div class="input text"><label for="PostTitle">Title</label><input name="data[Post][title]" maxlength="50" type="text" id="PostTitle"/></div>

//<div class="input textarea"><label for="PostBody">Body</label><textarea name="data[Post][body]" rows="3" cols="30" id="PostBody"></textarea></div>
//rows 行数を指定することで複数行であることを判断し自動的にテキストエリアを生成する
//arrayの中にrows以外にも色んなパラメーターを指定できる

echo $this->Form->button('<span class ="glyphicon glyphicon-heart"></span>
Save Group', array('type' => 'submit', 'class'=>'btn btn-primary', 'label' => false, 'escape' => false));

//フォームの閉じタグを生成しているだけで.第一引数に文字を指定するとsubmitボタンが出てくるが、それははあくまでオプション
echo $this->Form->end();
//<div class="submit"><input  type="submit" value="Save Post"/></div></form>
//('Save Post')という名前,任意の名前のsubmitボタンが生成される。


?>

