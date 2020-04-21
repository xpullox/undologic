<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'index'));
	Router::connect('/add', array('rep' => true, 'controller' => 'Users', 'action' => 'add'));

Router::connect('/login', array(
	//'plugin' => 'system',
	'controller' => 'Users', 'action' => 'login'
));

Router::connect('/loginAfterLogout', array(
	//'plugin' => 'system',
	'controller' => 'Users', 'action' => 'login', true
));
Router::connect('/logout', array(
	//'plugin' => 'system',
	'user' => false,
	'controller' => 'Users', 'action' => 'logout'
));
Router::connect('/forgot', array(
	//'plugin' => 'system',
	//'plugin' => false,
	'controller' => 'users', 'action' => 'forgot'
));
Router::connect('/reset/:key', array(
	//'plugin' => 'system',
	'controller' => 'tickets', 'action' => 'reset'
), array(
		'pass' => array('key')
	)

);
Router::connect('/reset', array(
    //'plugin' => 'system',
    'controller' => 'tickets', 'action' => 'reset'
), array(
        //'pass' => array('key')
    )

);
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */


//    Router::connect('/:language/:controller/:action/*', array(), array(
//        'language' => '[a-z]{3}',
//
//    ));

//Router::connect('/:prefix/:controller/:action/*', array(), array(
//	//'language' => '[a-z]{3}',
//
//));
//
//Router::connect('/:controller/:action/*', array(), array(
//	//'language' => '[a-z]{3}',
//
//));




//Router::connect('/:language/:prefix/:controller/:action/*', array(), array(
//    'language' => '[a-z]{3}',
//
//));

//    //doesn't work yet this will be for the plugin
//    Router::connect('/:prefix/:language/:plugin/:controller/*', array(//'plugin' => ,
//        //'controller' => 'pages',
//        //'retailer' => true,
//        //'action' => 'ava444444il'
//    ), array(
//        'language' => '[a-z]{3}'
//    ));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
