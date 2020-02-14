<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Author: https://www.roytuts.com
*/

class Student_model extends CI_model {
	
	private $database = 'codemongo';
	private $collection = 'students';
	private $collection_sub = 'subjects';
	private $conn;
	
	function __construct() {
		parent::__construct();
		$this->load->library('mongodb');
		$this->conn = $this->mongodb->getConn();
	}

	
	function get_student_list() {
		try {
			$filter = [];
			$query = new MongoDB\Driver\Query($filter);
			
			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}
	

	function get_subject() {
		try {
			$filter = [];
			$query = new MongoDB\Driver\Query($filter);
			
			$result = $this->conn->executeQuery($this->database.'.'.$this->collection_sub, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}
	function get_rno($_rno) {
		try {
			$filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
			$query = new MongoDB\Driver\Query($filter);
			
			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);
			
			foreach($result as $user) {
				return $user;
			}
			
			return NULL;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching user: ' . $ex->getMessage(), 500);
		}
	}
	
	function create_student($rno, $name, $subject, $marks, $physics, $chemistry, $maths ) {
		try {
			$user = array(
				'rno' => $rno,
				'name' => $name,
				'physics' => $physics,
				'chemistry' => $chemistry,
				'maths' => $maths
			);
			// print_r($user);exit;

			$filter = ['rno' => (int)$rno];
			$query = new MongoDB\Driver\Query($filter);
			
			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);
			

			foreach($result as $user) {
			
				if ($user->rno){
				$ee=$user->rno;
				$ee_id=$user->_id;
				$s1=$user->physics;
				$s2=$user->chemistry;
				$s3=$user->maths;
				break;
			};



			}
// echo $ee;exit;
			if(!$ee){
				echo "sdad";
				$query = new MongoDB\Driver\BulkWrite();
				$query->insert($user);
				
				$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);
				
				if($result == 1) {
					return TRUE;
				}


			}
			else{
					$addphysics =  $s1 + $marks;
			$addchemistry =  $s2 + $marks;
			$addmaths =  $s3 + $marks;
				try {

					$query = new MongoDB\Driver\BulkWrite();

					if($subject == 'physics'){
						//echo $addphysics;exit;
						$query->update(['_id' => new MongoDB\BSON\ObjectId($ee_id)], ['$set' => array('rno' => (int) $rno, 'physics' => (int) $addphysics )]);
					}
					if($subject == 'chemistry'){
						$query->update(['_id' => new MongoDB\BSON\ObjectId($ee_id)], ['$set' => array('rno' => (int) $rno, 'chemistry' => (int) $addchemistry )]);
					}
					if($subject == 'maths'){
						$query->update(['_id' => new MongoDB\BSON\ObjectId($ee_id)], ['$set' => array('rno' => (int) $rno, 'maths' => (int) $addmaths )]);
					}


					// $query->update(['_id' => new MongoDB\BSON\ObjectId($ee)], ['$set' => array('rno' => (int) $rno, 'physics' => (int) $addmarks )]);
					
					$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);
					
					if($result == 1) {
						return TRUE;
					}
				}
				catch(MongoDB\Driver\Exception\RuntimeException $ex) {
					show_error('Error while updating users: ' . $ex->getMessage(), 500);
				}


			} 
		}
		catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while saving users: ' . $ex->getMessage(), 500);
		}
	}
	
	function update_student($_id, $rno, $name, $subject, $marks) {

		echo $_id .'<br>';
		echo $rno .'<br>'; 
		echo $name .'<br>';
		echo $subject .'<br>';
		echo $marks .'<br>';

			// $filter = ['rno' => $rno];

			// $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
		$filter = ['rno' => (int)$rno];
		$query = new MongoDB\Driver\Query($filter);

		$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

		
		foreach($result as $user) {
			if ($user->rno){
				$ee=$user->rno;
				$s1=$user->physics;
				$s2=$user->chemistry;
				$s3=$user->maths;
				break;
			};
		}

			//update
		if($ee){
				//echo "dffsf";exit;
			$addphysics =  $s1 + $marks;
			$addchemistry =  $s2 + $marks;
			$addmaths =  $s3 + $marks;
				//echo $addmarks;exit;
			try {
				$query = new MongoDB\Driver\BulkWrite();

				if($subject == 'physics'){
					$query->update(['_id' => new MongoDB\BSON\ObjectId($_id)], ['$set' => array('rno' => (int) $rno,'name' => $name, 'physics' => (int) $addphysics )]);
				}
				if($subject == 'chemistry'){
					$query->update(['_id' => new MongoDB\BSON\ObjectId($_id)], ['$set' => array('rno' => (int) $rno,'name' => $name, 'chemistry' => (int) $addchemistry )]);
				}
				if($subject == 'maths'){
					$query->update(['_id' => new MongoDB\BSON\ObjectId($_id)], ['$set' => array('rno' => (int) $rno,'name' => $name, 'maths' => (int) $addmaths )]);
				}
				

				$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

				if($result == 1) {
					return TRUE;
				}

				return FALSE;
			} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
				show_error('Error while updating users: ' . $ex->getMessage(), 500);
			}
		}else{

		}

			//exit;



	}
	
	function delete_student($_id) {
		try {
			//echo $_id;exit();
			$query = new MongoDB\Driver\BulkWrite();
			$query->delete(['_id' => new MongoDB\BSON\ObjectId($_id)]);
			
			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);
			
			if($result == 1) {
				return TRUE;
			}
			
			return FALSE;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while deleting users: ' . $ex->getMessage(), 500);
		}
	}
	
}
?>	
