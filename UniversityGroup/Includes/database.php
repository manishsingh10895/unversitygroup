<?php
    abstract class Database 
    {
       const password = "0e906ce5";
       const username = "bf7745de719eef";
       const database = "azurewebdatabase";
       const port =3306;
       const host = "ap-cdbr-azure-southeast-a.cloudapp.net";
       public $connection = null;
       public function Connect()
       {
            $this->connection = new mysqli(Database::host,
            Database::username,Database::password,"",Database::port);
            if($this->connection==false)
            {
                die("Can't connect to database");
            }
            else{
                if(!$this->connection->select_db(Database::database))
                {
                    die("Can't select database");
                }
                else{
                    echo "Connection succeded";
                }
            }
        }
    }

    class UserDatabase extends Database
    {
        public function __construct(){
            parent::Connect();
        }

        public function CheckIfUserExists($userEmail)
        {
            $this->query = "select email from users where email='{$userEmail}';";
            $result = $this->connection->query($this->query,MYSQLI_STORE_RESULT);
            //$result->num_rows;
            //print_r($result);
            if(!$result)
            {
                die("Cannot execute query".mysql_error());
            }
            else 
            {
                if($result->num_rows==0)
                    return false;
                else 
                    return true;
            }
        }

        public function InsertUserDetails($fname,$lname,$email,$password,$regTime)
        {
            
            $encPass = $password;
            $this->query = "INSERT into users(firstname,lastname,email,"
                    . "password,registration_time) VALUES('$fname','$lname','$email','$encPass','{$regTime}');";
            if($this->connection->query($this->query))
                echo "Success";
            else
                die("Cannot insert data: ".mysql_error ().$this->connection->sqlstate);
        }
        
        public function getUserByEmail($email)
        {
            
            echo "{$email}"."<br/>";
            $query = "SELECT user_id,firstname,lastname FROM users WHERE username='{$email}';";
            $result = $this->connection->query($query);
            if($result)
            {
                print_r($result);
                if($result->num_rows==1)
                {
                    echo "Num rows = 1";
                    $user = $result->fetch_row();
                    print_r($user);
                    return $user;
                }
                else 
                    echo "Num rows != 1"."<br/>";
            }
            else 
            {
                echo "Result, not good".$this->connection->error."<br/>";
                return false;
            }
        }

        public function getUserById($id)
        {
            $query = "Select firstName,lastName,username from users where user_id = {$id};";
            $result = $this->connection->query($query);
            if($result)
            {
                if($result->num_rows==1)
                {
                    $user = $result->fetch_row();
                    return $user;
                }
            }
            else 
                return false;
        }


    }
?>