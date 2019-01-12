<?php

class Produto
{
        //DB Stuff
    private $conn;
    private $table = 'produtos';

        //Produto Properties
    public $id;
    public $prod;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }


        //GET: get all Produtos
    public function get()
    {
        $query = 'SELECT id, produto as prod FROM ' . $this->table;

            //Prepare Statement
        $stmt = $this->conn->prepare($query);

            //Execute Query
        $stmt->execute();

        return $stmt;
    }   
        
        
        //GET: get single produto
    public function get_single()
    {
        $query = 'SELECT id, produto as prod FROM ' . $this->table . ' WHERE id = ?';

        //Prepare Statement
        $stmt = $this->conn->prepare($query);


        //BIND id
        $stmt->bindParam(1, $this->id);

        //Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set Properties
        $this->prod = $row["prod"];

        return $stmt;
    }  

    //Create produto
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET produto = :produto;';
        
        //Prepare Statement
        $stmt = $this->conn->prepare($query);
        
        
        //Clean data
        $this->prod = htmlspecialchars(strip_tags($this->prod));
        

        //BIND PARAM
        $stmt->bindParam(':produto', $this->prod);

        //Execute Query
        if ($stmt->execute()) {
            return true;
        };

        //ERROR MSG
        printf("ERROR: %s.\n", $stmt->error);

        return false;
    }


    //Update produto
    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' SET produto = :produto WHERE id = :id;';
        
        //Prepare Statement
        $stmt = $this->conn->prepare($query);
        
        
        //Clean data
        $this->prod = htmlspecialchars(strip_tags($this->prod));
        $this->id = htmlspecialchars(strip_tags($this->id));
        

        //BIND PARAM
        $stmt->bindParam(':produto', $this->prod);
        $stmt->bindParam(':id', $this->id);

        //Execute Query
        if ($stmt->execute()) {
            return true;
        };

        //ERROR MSG
        printf("ERROR: %s.\n", $stmt->error);

        return false;
    }

    //Delete produto
    public function delete()
    {

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id;';

        //Prepare Statement
        $stmt = $this->conn->prepare($query);

          //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
          
  
          //BIND PARAM
        $stmt->bindParam(':id', $this->id);

        //Execute Query
        if ($stmt->execute()) {
            return true;
        };

        //ERROR MSG
        printf("ERROR: %s.\n", $stmt->error);

        return false;
    }
}