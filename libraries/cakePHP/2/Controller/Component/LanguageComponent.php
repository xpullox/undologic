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
    var $variations = array(
        'EN' => 'eng',
        'FR' => 'fre',
        'en' => 'eng',
        'fr' => 'fre',
        'eng' => 'eng',
        'fre' => 'fre',
        'en-us' => 'eng',
        'fr-ca' => 'fre',
        '1' => 'fre',
        '' => 'eng'
    );
    var $defaultLang = 'eng';

    var $debug = true;

    function debug($name) {
        if ($this->debug) {
            return $name;
        }
    }

    function reset() {
        //pr ($this->session->read('currLang'));
        //exit;
        $this->session->write('currLang', false);
    }

    function currLang() {

        $activeLang = '';

        //lowest priority
        if (!empty($this->get)) {
            $activeLang = $this->variations($this->get);
            $this->debug('get');
        }

        //if the session was saved
        $sessionLang = $this->getSessionLang();
        //pr ('ddd'.$sessionLang);exit;
        if (!empty($sessionLang)) {
            $activeLang = $sessionLang;
            $this->debug('session');
        }

        //browser currently set to
        if (!empty($this->params)) {
            $activeLang = $this->variations($this->params);
            $this->debug('activeparams');
        }

        //fall back to the browser setting
        if (empty($activeLang)) {
            $this->debug('default lang');
            return $this->defaultLang;
        } else {
            $this->debug($activeLang);
            return $activeLang;
        }


    }

    ////////////////////////////////////// setters
    function setGet($get) {
        $this->get = $this->variations($get);
    }

    function setParams($params) {
        $this->params = $this->variations($params);
    }

    function setSession($session) {
        $this->session = $session;
    }

    function setSessionLang($currlang) {
        $this->session->write('currLang', $this->variations($currlang));
    }
    function getSessionLang() {
        $sessionLang = $this->session->read('currLang');
        if (!empty($sessionLang)) {
            return $this->variations[$sessionLang];
        } else {
            return false;
        }
    }

    function setDefaultLanguage($defaultLang) {
        if (isset($this->variations[ $defaultLang ])) {
            $this->defaultLang = $this->variations[ $defaultLang ];
        }
    }

    ///////////////////////////////////getters

    private function variations($name) {
        if (isset($this->variations[ $name ])) {
            return $this->variations[ $name ];
        }
    }

}
