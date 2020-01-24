<?php

/*
CREATE TABLE `LIVE_database`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `user_type_id` INT NOT NULL , `token` VARCHAR(99) NOT NULL , `first_name` VARCHAR(50) NOT NULL , `last_name` VARCHAR(50) NOT NULL , `email` VARCHAR(99) NOT NULL , `password` VARCHAR(250) NOT NULL , `expires` DATETIME NOT NULL , `last_login` DATETIME NOT NULL , `created` DATETIME NOT NULL , `modified` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
 */

    //Created by undoLogic
    //MIT
    if (0):
        //var $access;
        //USAGE: add this method to your app_controller
        //then call the method in the beforeFilter of app_controller
        function setupPermissionsForClothingPlugin() {
            $this->access = $this->Permission->verify($this->Auth->user('id'), $this->Auth->user('user_type_id'), $this->params);
            if (!$this->access[ 'granted' ]) {

                //what page were we going to
                $goingTo = $this->request->url;
                $this->Session->write('goingTo', $goingTo);

                $this->Session->setFlash($this->access[ 'message' ]);
                $this->redirect('/login');
            }
            $this->set($this->access[ 'viewUserTypeAccess' ]);
        }

        //place in bootstrap and add rows for each prefix you have in your project, then assign the user_type_id for that prefix
        Configure::write('Users.user_type_id.admin', 111);
    endif;

    class PermissionComponent extends Object {

        var $user_id;
        var $user_type_id;
        var $params;

        var $access_granted = TRUE; //by default, we are true only if we have a prefix etc, will be lock it down
        var $access_message;

        var $view_user_type_access; //these are used in the view to quickly discern if a location can be viewed by a certain group

        var $allowedLocations = array();

        function initialize() {

        }

        function beforeRender() {

        }

        function startup() {

        }

        function shutdown() {

        }

        function beforeRedirect() {

        }

        function setAllowedLocations($allowed) {

        }

        /**
         * @param $user_id
         * @param $user_type_id
         * @param $params
         *
         * @return array (granted TRUE/FALSE, access_message string to display);
         */
        function verify($user_id, $user_type_id, $params) {
            $this->user_id = $user_id;
            $this->user_type_id = $user_type_id;


           // pr ($this->user_type_id);
            $this->params = $params;


            $this->ensurePrefixAllowed();
            $this->setupViewUserTypeAccess();
            $this->allowLocations();


            return array(
                'granted' => $this->access_granted, 'message' => $this->access_message,
                'viewUserTypeAccess' => $this->view_user_type_access
            );
        }

        function setupViewUserTypeAccess() {

            if ($this->is('admin')) {
                $this->view_user_type_access[ 'isAdmin' ] = TRUE;
               // $this->view_user_type_access[ 'isStore' ] = TRUE;
                //$this->view_user_type_access[ 'isManager' ] = TRUE;
                $this->view_user_type_access[ 'isLoggedIn' ] = TRUE;
                }
            //if ($this->is('store')) {
             //   $this->view_user_type_access[ 'isStore' ] = TRUE;
               // $this->view_user_type_access[ 'isLoggedIn' ] = TRUE;
           // }
            //if ($this->is('manager')) {
               // $this->view_user_type_access[ 'isStore' ] = TRUE;
                //$this->view_user_type_access[ 'isManager' ] = TRUE;
                //$this->view_user_type_access[ 'isLoggedIn' ] = TRUE;
            //}

        }

        function allowLocations() {

            if (in_array($this->params[ 'controller' ], array(
                'users'
            ))
            ) {
                //allow all these actions
                if (in_array($this->params[ 'action' ], array(
                    'loginPage', 'login'
                ))
                ) {
                    $this->access_granted = TRUE;
                }
            }

        }

        function ensurePrefixAllowed() {

            if (isset($this->params[ 'prefix' ])) {
                if ($this->params[ 'prefix' ] == 'auto') {
                    $this->forceTrustedLocation();
                } elseif ($this->params['prefix'] == 'public') {

                } elseif ($this->params['prefix'] == 'session') {

                } elseif ($this->params['prefix'] == 'authenticate') {

                } elseif ($this->params['prefix'] == 'api') {
                    //we will secure this on each method
                } elseif ($this->params[ 'developer' ]) {
                    $this->force('admin');
                } else {
                    //default let's force
                    $this->force($this->params[ 'prefix' ]);
                }
            }

        }

        private function forceTrustedLocation() {

            if(php_sapi_name() === 'cli') {
                // You're running locally from the CLI so we assume we are secure...

            } else {
                // You're running remotely, check against list of authorized ip addresses.

                //we only allow trusted locations
                $trustedIps = Configure::read('Trusted.locations');
                if (empty($trustedIps))
                    die ("please add to bootstrap: Configure::write('Trusted.locations', array(".$_SERVER['REMOTE_ADDR']."));");
                //pr ($_SERVER);
                if (!in_array($_SERVER[ 'REMOTE_ADDR' ], $trustedIps)) {
                    echo 'You are not in a secure location:' . $_SERVER[ 'REMOTE_ADDR' ] . ', please add your location to the trusted zones';
                    die ('end');
                    //$this->redirect('/');
                    exit;
                }
            }
        }


        function getUserTypeIdForType($name) {
            $user_type_id = Configure::read('Users.user_type_id.' . $name);
            //pr ($user_type_id);
            //exit;
            //pr ($name);
            if ($user_type_id == 'manual') {


                if (!is_array($user_type_id)) {
                    return array($user_type_id);
                } else {
                    return $user_type_id;
                }



            } elseif (empty($user_type_id)) {

                die ("FATAL: Create in Bootstrap: Configure::write('Users.user_type_id.$name', #);");
            }

            if (!is_array($user_type_id)) {
                return array($user_type_id);
            } else {
                return $user_type_id;
            }

        }

        /**
         * @param $type
         * checks
         *
         * @return bool
         */
        function is($type) {



            if (!is_array($this->user_type_id)) {
                $this->user_type_id = array($this->user_type_id);
            }

            foreach ($this->user_type_id as $user_type_id) {
                if (in_array($user_type_id, $this->getUserTypeIdForType($type))
                ) {
                    return TRUE;
                } else {

                }
            }
            return false;

        }

        function hasHigherAccess($type) {
            $test_type_id = $this->getUserTypeIdForType($type);
            if (is_array($test_type_id)) {
                $test_type_id = max($test_type_id);
            }

            foreach ($this->user_type_id as $user_type_id) {
                if ($user_type_id > $test_type_id) {
                    return TRUE;
                } else {

                }
            }
            return FALSE;

        }

        /**
         * @param $type
         *
         * this will ensure the logged in user is allowed to the current group
         * or they have a access (user_type_id) that is higher
         *
         * @return bool
         */
        function force($type) {

        	//@todo remove this later for security
			if ($this->is($type)) {
				return TRUE;
			} elseif ($this->hasHigherAccess($type)) {
				return TRUE;
			} else {
				$this->access_granted = FALSE;
				$this->access_message = "Please login with ".$type . ' access';
				return FALSE;
			}
			}

    }
