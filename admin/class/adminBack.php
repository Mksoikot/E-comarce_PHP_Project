<?php
    class adminBack{
        private $conn;

        public function __construct(){
            $dbhost = "localhost";
            $dbuser = "root";
            $dbpass = "";
            $dbname = "ecom";

            $this->conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

            if(!$this->conn){
                die("Database Connection Error!");
            }
            
        }
        function admin_login($data){
            $email = $data['email'];
            $password = md5($data['password']);
            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
           
        
            if(mysqli_query($this->conn,$query)){
                $result = mysqli_query($this->conn,$query);
                $admin_info = mysqli_fetch_assoc($result);


                if($admin_info){
                    header('location: dashboard.php');
                    session_start();
                    $_SESSION['id'] = $admin_info['id'];
                    $_SESSION['Email'] = $admin_info['email'];
                }else{
                    $errmsg = "Your Username Password Is Incorrect!";
                    return $errmsg;
                }
            }
        }
    }

?>
