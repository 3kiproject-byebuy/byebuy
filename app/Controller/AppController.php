<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
	
	    public $helpers = array(
        'Session',
        'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
        'Form' => array('className' => 'BoostCake.BoostCakeForm'),
        'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
        'Js',
    );


        public $components = array('DebugKit.Toolbar',
                                    'Session',
                                    'Acl',
                                    'Auth' => array(
                                            // 'loginAction' => array(
                                            //                 'plugin' => 'facebook',
                                            //                 'controller' => 'users',
                                            //                 'action' => 'login'
                                            //                 ),
                                            // 'loginRedirect' =>  array(
                                            //                 'controller' => 'fbconnects',
                                            //                 'action' => 'showdata'
                                            //                 ),
                                            'authenticate' => array(
                                                            'all' => array('userModel' => 'User'),
                                                            'Facebook.Oauth'
                                                            )
                                            )
                                    );
        /*
	    public $components = array('DebugKit.Toolbar','Session','Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
        ));
        */

    public function beforeFilter() {

    	parent::beforeFilter();
    	$this->Auth->allow();
        //権限付与の単位。アクションごとに権限を管理＝'actions',コントローラー単位='crud'
        $this->Auth->authorize = 'Actions';
        //AuthComponentの設定
        $this->Auth->loginAction = array('controller' => 'byebuys', 'action' => 'index');
        //$this->Auth->logoutRedirect = array('controller' => 'byebuys', 'action' => 'index');
        //$this->Auth->loginRedirect = array('controller' => 'blogs', 'action' => 'admin_add');
    }
	    
}
