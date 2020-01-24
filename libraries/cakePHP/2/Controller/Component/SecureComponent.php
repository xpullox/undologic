<?php
    //Created by undoLogic
    //MIT

    class SecureComponent extends Component {

        var $ths; //$this

        /*
         * When testing is detected in the path, require a basic password to access
         * add to app_controller in beforeFilter
         * $this->Secure->requirePasswordExcept(array('www.website.com', 'website.com'), $_SERVER, $this->Session [,1234]);
         */
        function requirePasswordExcept($exceptions, $server, $session, $password = false) {

            //pr ($exceptions);
            //exit;
            if ($password) {
                //we are using a custom password
                die ('not implented yet');
            } else {

                $passwords = array(
                    date('m').date('m'),
                    date('m')
                );

                //pr ($server['HTTP_HOST']);

                if (isset($server['HTTP_HOST'])) {

                    if (in_array($server['HTTP_HOST'], $exceptions)) {

                        //this is an exception, so let's not enforce a password
                    } else {
                        //let's ensure a password

                        if (isset($_GET['login'])) {
                            if ($_GET['login'] == 'logout') {
                                $session->write('TempAccessGiven', 'FALSE');
                                $this->showForm();
                            }
                        }

                        //this is a testing site
                        $isAllowed = $session->read('TempAccessGiven');

                        if ($isAllowed == 'TRUE') {
                            //they are allowed
                        } else {
                            //we need to see if we are allowed.
                            if (isset($_GET['login'])) {
                                if (in_array($_GET['login'], $passwords)) {
                                    //they have the right password
                                    $session->write('TempAccessGiven', 'TRUE');
                                    return 2;

                                } elseif ($_GET['login'] == 'logout') {
                                    die ('Logged OUT');
                                } else {
                                    die ('NO ACCESS: CODE not correct');
                                }
                            } else {

                                $this->showForm();

                                die ('NO ACCESS: Code Require to access this site');

                            }

                        }


                    }
                } else {
                    //no http host
                }
            }

        }

        ////public
        function forceSSL($ths) {
            $this->ths = $ths;
            if ($this->__isLocal()) {
                return FALSE; //we are local, no ssl
            } elseif (!$this->__isSSL()) {
                $this->__redirectSSL();
            }
        }

        function forceNoSSL($ths, $path = false) {
            $this->ths = $ths;
            if ($this->__isLocal()) {
                return FALSE; //we are local, no ssl
            } elseif ($this->__isSSL()) {
                $this->__redirectNoSSL($path);
            }
        }

        function __isSSL() {
            if (env('SERVER_PORT') == 443) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        function __redirectSSL() {
            $this->ths->redirect('https://' . $this->__url());
        }

        function __redirectNoSSL($path) {
            $this->ths->redirect('http://' . $this->__url($path));
        }

        function __url($path = '') {
            $path = $path ? $path : env('REQUEST_URI');
            return env('SERVER_NAME') . $path;
        }

        function __isLocal() {
            if ($_SERVER[ 'SERVER_NAME' ] == 'localhost') {
                return TRUE;
            }
            return FALSE;
        }

        function assureCorrectSubDomain($ignore, $shouldBe, $ths) {
            if ($this->__isLocal()) {
                return true;//we are local it is ok
            } else {
                if (in_array($_SERVER['HTTP_HOST'], $ignore)) {
                    //this domain is ignored
                    return true;
                } else {
                    if (in_array($_SERVER['HTTP_HOST'], $shouldBe)) {
                        return true;
                    } else {
                        //let's redirect
                        $first = reset($shouldBe);
                        $ths->redirect('http://'.$first.'/'.$ths->params->url, 301);
                    }
                }
            }
        }

        function showForm() {
            $c = '';
            $c .= '<div style="width: 300px;">';
            $c .= '<form action="" method="GET">';
            $c .= '<input name="login"/>';
            $c .= '</form>';
            $c .= '</div>';
            echo $c;
        }
    }
