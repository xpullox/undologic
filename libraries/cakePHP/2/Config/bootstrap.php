<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

Configure::write('localServer', array('localhost'));
Configure::write('liveServer', array(
	'funding.quebec-elan.org',
));

Configure::write('Users.user_type_id.admin', 111);
Configure::write('Users.user_type_id.manager', 80);
Configure::write('Users.user_type_id.staff', 70);
//Configure::write('Users.user_type_id.admin', 111);
//Configure::write('Users.user_type_id.store', 3);
Configure::write('Users.user_type_id.user', 11);
Configure::write('Users.user_type_id.ajax', 1);
Configure::write('Users.user_type_id.v1', 1);






// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));


Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));
