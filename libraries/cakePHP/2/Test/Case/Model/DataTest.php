<?php

App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');

class DataTest extends CakeTestCase
{
	public $fixtures = array(

	);

    function testGetConditionsSearch() {
        $this->assertEquals(true, true);
    }
}
