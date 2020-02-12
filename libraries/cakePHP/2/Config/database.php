<?php

if (isset($_ENV['DATABASE_NAME'])) { //DOCKER

    class DATABASE_CONFIG {

        public $LIVE = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => 'db',
            'login' => 'root',
            'password' => 'undologic',
            'database' => 'LIVE_database',
            'prefix' => '',
            'encoding' => 'utf8',
        );

        public $test = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => 'db',
            //'host' => 'localhost',
            'login' => 'root',
            'password' => 'undologic',
            'database' => 'test_automation',
            'encoding' => 'utf8',
        );

        public $import = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => 'db',
            //'host' => 'localhost',
            'login' => 'root',
            'password' => 'undologic',
            'database' => 'LIVE_database',
            'encoding' => 'utf8',
        );
    }

} else { //LIVE

    class DATABASE_CONFIG
    {

        public $LIVE = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => 'db',
            'login' => 'root',
            'password' => 'undologic',
            'database' => 'LIVE_database',
            'prefix' => '',
            'encoding' => 'utf8',
        );

        public $test = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => 'db',
            //'host' => 'localhost',
            'login' => 'root',
            'password' => 'undologic',
            'database' => 'test_automation',
            'encoding' => 'utf8',
        );

        public $import = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => 'db',
            //'host' => 'localhost',
            'login' => 'root',
            'password' => 'undologic',
            'database' => 'LIVE_database',
            'encoding' => 'utf8',
        );
    }
}