<?php

//Great for the scaffolding stage
Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

//when you are done with scaffolding uncomment this to setup you initial page
//Router::connect('/', array('controller' => 'pages', 'action' => 'index'));

Router::connect('/login', array(
	//'plugin' => 'system',
	'controller' => 'Users', 'action' => 'login'
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

//////// language specific - uncomment if you want to use

//    Router::connect('/:language/:controller/:action/*', array(), array(
//        'language' => '[a-z]{3}',
//
//    ));

//Router::connect('/:prefix/:controller/:action/*', array(), array(
//	//'language' => '[a-z]{3}',
//
//));

//Router::connect('/:controller/:action/*', array(), array(
//	//'language' => '[a-z]{3}',
//
//));

//Router::connect('/:language/:prefix/:controller/:action/*', array(), array(
//    'language' => '[a-z]{3}',
//
//));

//    //@todo need to figure this out to have languages on plugins
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
