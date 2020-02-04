<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 * @property UserType $UserType
 */
class Datafile extends AppModel
{

	function getData($filename) {

		// The nested array to hold all the arrays
		$the_big_array = array();

		// Open the file for reading
		if (($h = fopen("{$filename}", "r")) !== FALSE)
		{
			// Each line in the file is converted into an individual array that we call $data
			// The items of the array are comma separated
			while (($data = fgetcsv($h, 1000, ",")) !== FALSE)
			{
				// Each individual array is being pushed into the nested array
				$the_big_array[] = $data;
			}

			// Close the file
			fclose($h);
		}

		$headers = $the_big_array[0];
		//pr ($headers);

		//pr ($the_big_array); exit;
		$newArray = array();
		foreach( $the_big_array as $key => $array) {
			if ($key == 0) continue;
			foreach ($headers as $hk => $hv) {
				$newArray[$key][ $hv ] = $array[$hk];
			}
		}

		//clean it up
		$the_big_array = array();

		return $newArray;
	}






}
