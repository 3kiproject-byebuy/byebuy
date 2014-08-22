<!-- File: /app/View/Posts/edit.ctp -->

<h1>Edit Group</h1>
<?php
echo $this->Form->create('Group');
echo $this->Form->input('name');
echo $this->Form->input('id', array('type' => 'hidden'));//更新処理のときに必要
//次のページ値を渡したいけど表示させたくない時に使用する
//<input type="hidden" name="data[Post][id]" value="1" id="PostId">
//idがわたらないとどこを書き換えたらいいか分からなくなる。

echo $this->Form->end('Save Group');
?>