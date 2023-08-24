<?php
class Travel
	{
	private $conn;
	private $table_name = "travels";
	
	public $id;
	public $name;
	public $seats_available;
	
	public function __construct($db)
		{
		$this->conn = $db;
		}
	
	function read()
		{
		
		$query = "SELECT
                        a.id, a.name, a.seats_available
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
						name=:Name, seats_available=:available_seats";
					
		   
			$stmt = $this->conn->prepare($query);
		 
			
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->seats_available = htmlspecialchars(strip_tags($this->seats_available));
		 
			
			$stmt->bindParam(":Name", $this->name);
			$stmt->bindParam(":available_seats", $this->seats_available);
		 
			
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
						seats_available = :available_seats
					";
		 
			$stmt = $this->conn->prepare($query);
		 
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->seats_available = htmlspecialchars(strip_tags($this->seats_available));
		 
			
			$stmt->bindParam(":Name", $this->name);
			$stmt->bindParam(":available_seats", $this->seats_available);
		 
			
			if($stmt->execute()){
				return true;
			}
		 
			return false;
		}

		function delete(){
 
			$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
		 
			$stmt = $this->conn->prepare($query);
		 
			$this->id = htmlspecialchars(strip_tags($this->id));
		 
		 
			$stmt->bindParam(1, $this->id);
		 
			
			if($stmt->execute()) {
				return true;
			}
		 
			return false;
			 
		}	

		function filterBySeats($seatsAvailable) {
			
			$query = "SELECT
            a.id, a.name, a.seats_available
          FROM
            " . $this->table_name . " a 
          WHERE
            a.seats_available = :available_seats";

			$stmt = $this->conn->prepare($query);
		 
			$stmt->bindParam(":available_seats", $seatsAvailable);
		 
			
			if($stmt->execute()) {
				return $stmt;
			}
		 
			return false;
		}

	}
?>