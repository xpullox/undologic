<?php
    class Translate_ven extends Object {

        var $helpers = array();

        var $currLang;

        var $softWareLang = 'eng';

        var $translateTable = array();

        var $file = false;

        var $rawCSV = false;

        public function setFileLocation($file) {
            $this->file = $file;
        }

        public function createCSV() {
            if (file_exists($this->file)) {
                //it is exits do nothing
            } else {
                //create
                $handle = fopen($this->file, "w");
                $this->saveFile(array('eng','spa','fra'));
            }
        }
        /**
         * @param $term
         * using the current language as specified in the app controller language
         * returns the correct term
         */
        public function word($termOrg) {


            if (!$this->file) {
                $this->file = APP.'Locale'.DS.'translate.csv';
            }

            $this->createCSV();

            $term = strtolower($termOrg);

            $this->setupLang();
            //pr ($this->softWareLang .' '.$this->currLang); exit;
            if ($this->softWareLang == $this->currLang) {
                return $termOrg;
            }

            $this->loadFile();
            //pr ($term);exit;
            //if our debug is set to 2 OR is setup server
            //add to our CSV file
            if ($this->shouldWeUpdateCsv()) {
                $this->ensureTermAdded($term);
            }

            //pr ($this->translateTable);exit;

            if (isset($this->translateTable[ $term ][$this->currLang])) {
                return $this->translateTable[ $term ][$this->currLang];
            } else {
                return $termOrg;//maybe hit a translation service here
            }
        }

        public function getRawCsv() {
            return array_map('str_getcsv', file($this->file));
        }

        private function loadFile(){

            if (!$this->rawCSV) {
                $this->rawCSV = array_map('str_getcsv', file($this->file));
                $keys = $this->rawCSV[0];
                foreach ($this->rawCSV as $index => $each) {

                    foreach ($keys as $keyIndex => $key) {

                        if (!isset($this->translateTable[ $each[0]])) {
                            $this->translateTable[ $each[0] ] = array();
                        }
                        if (!isset($this->translateTable[ $each[0]][ $keys [$keyIndex] ])) {
                            $this->translateTable[ $each[0] ][ $keys [$keyIndex] ] = array();
                        }

                        if (!isset($each[$keyIndex])) {
                            $this->translateTable
                            [ $each[0] ]
                            [ $keys[ $keyIndex ] ] =
                               'UNKNOWN';
                        } else {
                            $this->translateTable
                            [ $each[0] ]
                            [ $keys[ $keyIndex ] ] =
                                $each[$keyIndex];
                        }




                    }
                }
            } else {
                //already loaded
                return false;
            }

        }
        private function saveFile($line, $term = false) {

            if ($term) {
                //mark our translate table so we don't save again
                $this->translateTable[ $term ] = array();
            }

            $handle = fopen($this->file, "a");
            fputcsv($handle, $line); # $line is an array of string values here
            fclose($handle);
        }

        private function ensureTermAdded($term) {
            //get the csv

            //pr ($this->translateTable[ $term ]);
            //pr ($term);

            //pr ('trans');
            //pr ($this->translateTable);

            if (isset($this->translateTable[ $term ])) {
                //already have it
                //echo 'have it ';
                return true;
            } else {
                //echo 'save - ';
                $line = array($term,$term,$term);
                $this->saveFile($line, $term);
            }
        }

        private function shouldWeUpdateCsv() {
            $shouldWe = false;

            $debug = Configure::read('debug');
            if ($debug == 2) {
                $shouldWe = true;
            }

            if (!isset($_SERVER['HTTP_HOST'])) {
                //we are command line
                $_SERVER['HTTP_HOST'] = '';

            }
            $host = $_SERVER['HTTP_HOST'];

            $allowed = array('localhost', 'setup.updatecase.com');

            if (in_array($host, $allowed)) {
                $shouldWe = true;
            }

            return $shouldWe;
        }

        private function setupLang() {


            $currLang = Configure::read('currLang');

            //pr ($currLang);exit;
            if ($currLang == 'spa') {
                $this->currLang = 'spa';
            } elseif ($currLang == 'fre') {
                $this->currLang = 'fre';
            } else {
                $this->currLang = 'eng';
            }
        }

        private function getTermFromCSV() {
            //load csv
            //scan for the english term
            //return the term in the other language
            //if that term doesn't exist
        }





        /**
         * need all these since we are extending vendors from components / helpers
         */

        function beforeRender() {

        }

        function initialize() {

        }
        function startup() {

        }
        function shutdown() {

        }
        function beforeRenderFile() {

        }
        function afterRenderFile() {

        }
        function afterRender() {

        }
        function beforeLayout() {

        }
        function afterLayout() {

        }
        function beforeRedirect() {

        }
    }
