<?php


class DbManager {

	//Database configuration
	private $dbhost = 'localhost';
	private $dbport = '27017';
	private $conn;
	private $dbname = 'php_mongo';
	private $collection = "user";

	
	function __construct(){
        //Connecting to MongoDB
		try {
			//Establish database connection
			$this->conn = new MongoDB\Driver\Manager('mongodb://'.$this->dbhost.':'.$this->dbport);
			echo "connected successfully";
		}catch (MongoDBDriverExceptionException $e) {
			echo $e->getMessage();
			echo nl2br("n");
		}
	}

	function getConnection() {
		return $this->conn;
	}



	function insert(){

		$user1 = array(
			'_id' => 2 ,
			'first_name' => 'Aditya',
			'last_name' => 'Done',
			'tags' => array('developer','admin')

		);


		try{

			$single_insert = new MongoDB\Driver\BulkWrite();
			$single_insert->insert($user1);

			$this->conn->executeBulkWrite("$this->dbname.$this->collection", $single_insert);
			echo "data inserted";

		}catch (MongoDB\Driver\Exception\Exception $e) {
			echo "Exception:", $e->getMessage(), "\n";
			echo "On line:", $e->getLine(), "\n";
		}
	}


	function readData(){

		try{

			$filter = ['first_name' => 'Aditya'];
			$option = [];
			$read = new MongoDB\Driver\Query( $option);
			$single_user = $this->conn->executeQuery("$this->dbname.$this->collection", $read);

			echo nl2br("\nSingle user:\n");

			foreach ($single_user as $user) {
				echo nl2br($user->first_name.' '.$user->last_name.' has following roles:' . "\n");
				foreach ($user->tags as $tag) {
					echo nl2br($tag . "\n");
				}
			}

		}catch (MongoDB\Driver\Exception\Exception $e) {
			echo "Exception:", $e->getMessage(), "\n";
			echo "On line:", $e->getLine(), "\n";
		}
	}

	function updateData(){

		$single_update = new MongoDB\Driver\BulkWrite();
		$single_update->update(
			['_id' => 2],
			['$set' => ['first_name' => 'Akash', 'last_name' => 'Sarkar']],
			['multi' => false, 'upsert' => false]
		);
		$result = $this->conn->executeBulkWrite("$this->dbname.$this->collection", $single_update);

		if($result) {
			echo nl2br("Record updated successfully \n");
		}
	}

	function deleteData(){

		try{
			$delete = new MongoDB\Driver\BulkWrite();
			$delete->delete(
				['first_name' => 'Anant'],
				['limit' => 1]
			);

			$result = $this->conn->executeBulkWrite("$this->dbname.$this->collection", $delete);

			if($result) {
				echo nl2br("Record deleted successfully \n");
			}

		}catch (MongoDB\Driver\Exception\Exception $e) {
			echo "Exception:", $e->getMessage(), "\n";
			echo "On line:", $e->getLine(), "\n";
		}
	}

	function insetMultipleRecord(){

		$user1 = array(
			'_id' => 3,
			'first_name' => 'Anant',
			'last_name' => 'Roy',
			'tags' => array('Analyst','master')
		);

		$user2 = array(
			'_id' => 4 ,
			'first_name' => 'Mahesh',
			'last_name' => 'Chatterjee',
			'tags' => array('sales' , 'product')
		);

		$inserts = new MongoDB\Driver\BulkWrite();
		$inserts->insert($user1);
		$inserts->insert($user2);

		$this->conn->executeBulkWrite("$this->dbname.$this->collection", $inserts);
			echo  "<br>  Inserted Multiple Record";
	}

	function updateMultiple(){

		$updates = new MongoDB\Driver\BulkWrite();
		$updates->update(
			['last_name' => 'Roy'],
			['$set' => ['first_name' => 'Anant', 'last_name' => 'Shinde']],
			['multi' => true, 'upsert' => false]
		);
		$updates->update(
			['last_name' => 'Chatterjee'],
			['$set' => ['first_name' => 'Mahesh', 'last_name' => 'Sarkar']],
			['multi' => true, 'upsert' => false]
		);
		$result = $this->conn->executeBulkWrite("$this->dbname.$this->collection", $updates);
		echo "<br>" . "Multiple data updated";
	}

}

$a = new DbManager();

$a->getConnection();
//$a->insert();

$a->readData();

//$a->updateData();
//$a->deleteData();

//$a->insertMultipleRecord();

//$a->updateMultiple();







?>