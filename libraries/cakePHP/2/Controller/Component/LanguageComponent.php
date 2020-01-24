<?php
    //Created by undoLogic
    //MIT

    App::uses('Component', 'Controller');

    /**
     * Class LanguageComponent
     * usage
     * in app_controller

    READ INSTRUCTIONS
    system/language.txt

    add to core
    Configure::write('Config.language', 'eng');

    $components = array('System.Language');

    function setupLanguage() {
    //language stuff
    //does get info exist, this will be priority
    if (isset($_GET[ 'Lang' ])) {
    $this->Language->setGet($_GET[ 'Lang' ]);
    }
    //if there params of what language we should be using
    if (isset($this->params[ 'language' ])) {
    $this->Language->setParams($this->params[ 'language' ]);
    }
    //or we are going to check out session of cookie for a already selected language
    $this->Language->setSession($this->Session);
    $this->Language->setCookie($this->Cookie);
    //and fall back to the default if not set yet
    $this->Language->setDefaultLanguage(Configure::read('Config.language'));
    $currLang = $this->Language->currLang();

    switch ($currLang) {
    case 'fre':
    $this->set('langFR', TRUE);
    $this->set('lang', 'fr');
    $this->set('currLang', $currLang);
    $this->Cookie->write('currLang', 'fre', NULL, '+350 day');
    Configure::write('Config.language', 'fre');
    break;

    default:
    $this->set('lang', 'en');
    $this->set('langEN', TRUE);
    $this->set('currLang', $currLang);
    $this->Cookie->write('currLang', 'eng', NULL, '+350 day');
    Configure::write('Config.language', 'eng');
    }
    }
     *
     */
    class LanguageComponent extends Component {

        var $get = FALSE;
        var $params = FALSE;
        var $session = FALSE;
        var $cookie = FALSE;
        var $variations = array(
            'EN' => 'eng',
            'FR' => 'fre',
            'en' => 'eng',
            'fr' => 'fre',
            'eng' => 'eng',
            'fre' => 'fre',
            '1' => 'fre',
            '' => 'eng'
        );
        var $defaultLang = FALSE;

        ////////////////////////////////////// setters
        function setGet($get) {
            $this->get = $get;
        }

        function setParams($params) {
            $this->params = $params;
        }

        function setSession($session) {
            $this->session = $session;
        }

        function setCookie($cookie) {
            $this->cookie = $cookie;
        }

        function setCurrLang($currlang) {
            $this->session->write('currLang', $this->variations($currlang));
            if ($this->cookie) {
                $this->cookie->write('currLang', $this->variations($currlang));
            }
        }

        function setDefaultLanguage($defaultLang) {

            $this->defaultLang = $this->variations[ $defaultLang ];
        }

        ///////////////////////////////////getters
        function getCurrLang() {
            if ($this->cookie) {
                $cookieLang = $this->cookie->read('currLang');
                if (!isset($this->variations[ $cookieLang ])) {
                    $cookieLang = false;
                }
            } else {
                $cookieLang = false;
            }
            $sessionLang = $this->session->read('currLang');

            if ($cookieLang) {
                return $this->variations[$cookieLang];
            } elseif ($sessionLang) {
                return $this->variations[$sessionLang];
            } else {
                return $this->defaultLang;
            }
        }

        function currLang() {


            if ($this->get) {
                return $this->variations($this->get);
            }
            elseif ($this->params) {
                return $this->variations($this->params);
            }
            //            elseif ($this->session) {
            //                return $this->variations($this->session);
            //            }
            //            elseif ($this->cookie) {
            //                return $this->variations($this->cookie);
            //            }
            return $this->getCurrLang();
        }

        private function variations($name) {
            if (isset($this->variations[ $name ])) {
                return $this->variations[ $name ];
            } else {


                //default lang
                return 'eng';

                pr ($name);
                pr ($this->variations);
                die ('variation in language component missing: ' . $name);
            }
        }

    }