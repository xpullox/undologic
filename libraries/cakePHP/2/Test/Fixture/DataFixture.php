<?php class DataFixture extends CakeTestFixture {
	//import needs to be created in your database, is the same as local
	public $import = array('table' => 'datas', 'connection' => 'import');

//	//Records can be exported from PHPMyAdmin -> export -> phpArray
//	var $records = array(
//		array('id' => '1','name' => 'name here'),
//		array('id' => '2','name' => 'name 2 goes here'),
//		//others here
//	);
}
