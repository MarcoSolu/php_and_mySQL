<?php
class Country
	{
	private $conn;
	private $table_name = "countries";
	
	public $id;
	public $name;
	public $travel_name;
	
	public function __construct($db)
		{
		$this->conn = $db;
		}
	
	function read()
		{
		
		$query = "SELECT
                        a.id, a.name, a.travel_name
                    FROM
                   " . $this->table_name . " a ";
		$stmt = $this->conn->prepare($query);
		
		$stmt->execute();
		return $stmt;
		}
		
		function create(){
   
			$query = "INSERT INTO
						" . $this->table_name . "
					SET
						name=:Name, travel_name=:name_travel";
					
		   
			$stmt = $this->conn->prepare($query);
		 
			
			$this->name = htmlspecialchars(strip_tags($this->name));
		 
			
			$stmt->bindParam(":Name", $this->name);
			$stmt->bindParam(":name_travel", $this->travel_name);
		 
			
			if($stmt->execute()){
				return true;
			}
		 
			return false;
			 
		}
		
		function update(){
 
			$query = "UPDATE
						" . $this->table_name . "
					SET
						name = :Name,
						travel_name = :name_travel
					WHERE
						id = :ID";
		 
			$stmt = $this->conn->prepare($query);
			
			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->travel_name = htmlspecialchars(strip_tags($this->travel_name));
		 
			$stmt->bindParam(":ID", $this->id);
			$stmt->bindParam(":Name", $this->name);
			$stmt->bindParam(":name_travel", $this->travel_name);
		 
			
			if($stmt->execute()){
				return true;
			}
		 
			return false;
		}

		function delete(){
 
			$query = "DELETE FROM " . $this->table_name . " WHERE name = ?";
		 
			$stmt = $this->conn->prepare($query);
		 
			$this->name = htmlspecialchars(strip_tags($this->name));
		 
		 
			$stmt->bindParam(1, $this->name);
		 
			
			if($stmt->execute()){
				return true;
			}
		 
			return false;
			 
		}	 

		function filterByCountry($travelNAME) {
			$query = "SELECT
            a.id, a.name, a.travel_name
          FROM
            " . $this->table_name . " a 
          WHERE
            a.travel_name = :name_travel";

			$stmt = $this->conn->prepare($query);
		 
			$stmt->bindParam(":name_travel", $travelNAME);
		 
			
			if($stmt->execute()) {
				return $stmt;
			}
		 
			return false;
		}

	}
?>