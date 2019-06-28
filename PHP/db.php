<?php
	class DB {
		private $db_connection;
		
		function __construct(){
			$this->db_connection = mysqli_connect("localhost", "root", "", "hyppighed_skostorrelser") or die(mysqli_error());
			mysqli_set_charset($this->db_connection,"utf8");
		}
		
		public function getDb() {
			return $this->db_connection;
		}
		
	}
?>