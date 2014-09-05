<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class Selling_list extends AppModel {

    public $name = 'Selling_list';

    //サーチプラグインのサーチbehaviorを遣いますという宣言
    //定義済み変数 使用するbehabiorを設定するためだけのやつ
    public $actsAs = array('Search.Searchable');

    //指定したフィールドをlike演算子で検索する valueを指定すると完全一致検索
    //サーチプラグイン特有の定義済み変数
    public $filterArgs = array(
        'keyword' => array('type'=>'like','field'=>array('Selling_list.sellingproduct_name'))
        );

    public $belongsTo = array(
        //categoryにはモデル名を書く。
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            ),
        'Category' => array(
                'className' => 'Category',
                'foreignKey' => 'category_id'
            ),
        );
    

 //バリデーション　開始-----------------------------------------------------------------------
    public $validate = array(
        //商品名のバリデート
        'sellingproduct_name' => array(
            array(
                'rule' => 'notEmpty',
                'message' => '商品名を入力してください',
            ),
            array(
                'rule' => array('maxLength', 20),
                'message' => '商品名は20文字以内で入力してください。'
            ),

        ),

        //商品価格のバリデート
        'sellingproduct_price' => array(
            array(
                'rule' => 'numeric',
                'required' => true,
                'message' => '　商品価格は数字で入力してください',
                'allowEmpty' => false             // 空白許可
            ),

            array(
                'rule' => 'notEmpty',
                'message' => '　商品価格を入力してください

                ',
            ),

            array(
                'rule' => array('maxLength', 20),
                'message' => '　商品価格が長過ぎます\n'
            ),

        ),

        //商品詳細のバリデート
        'sellingproduct_detail' => array(
            array(
                'rule' => 'notEmpty',
                'message' => '商品詳細を入力してください',
            ),

            array(
                'rule' => array('maxLength', 200),
                'message' => '商品詳細が長過ぎます。200文字以内で入力してください。'
            ),

        ),

        //写真①のバリデート
        'img_file_name1' => array(
            // ルール：uploadError => errorを検証
            'upload-file' => array( 
                'rule' => array( 'uploadError'),
                'message' => array( '画像をアップしてください')
            ),
        ),

        //写真アップのバリデート
        'image' => array(
            // ルール：uploadError => errorを検証
            'upload-file' => array( 
                'rule' => array( 'uploadError'),
                'message' => array( '画像をアップしてください')
            ),
        ),


        // ルール：fileSize => filesizeでファイルサイズを検証(2GBまで)
        'size' => array(
            'maxFileSize' => array( 
                'rule' => array('fileSize', '<=', '5MB'),  // 10M以下
                'message' => array( '画像サイズが大きすぎます')
            ),
            'minFileSize' => array( 
                'rule' => array('fileSize', '>',  0),    // 0バイトより大
                'message' => array( '画像サイズが小さすぎます')
            ),
        ),

);

//バリデーション　終了-----------------------------------------------------------------------



//イメージビヘイビア　開始-----------------------------------------------------------------------

// var $actsAs = array(
//     'Image'=>array(
//       'fields'=>array(
//         'img_file_name1'=>array(
//           'thumbnail'=>array('create'=>true),
//           'resize'=>array(
//             'width'=>'50',
//             'height'=>'50',
//             'aspect'=>true,
//             'allow_enlarge'=>true,
//         ),
//         'versions'=>array(
//             array(
//               'prefix'=>'small',
//               'width'=>'20',
//               'height'=>'20',
//               'aspect'=>true,
//               'allow_enlarge'=>true,
//             ),
//           )
//         )
//       )
//     )
//   );

//イメージビヘイビア　終了-----------------------------------------------------------------------












    

}

?>