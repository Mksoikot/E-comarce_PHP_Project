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
        function add_category($data){
            $ctg_name = $data['ctg_name'];
            $ctg_dess = $data['ctg_dess'];
            $ctg_status = $data['ctg_status'];

            $query = "INSERT INTO `category`(`ctg_name`, `ctg_dess`, `ctg_status`) VALUES ('$ctg_name','$ctg_dess','$ctg_status')";

            if(mysqli_query($this->conn , $query)){
                $message = "Category Added Successfully.";
                return $message;
            }else{
                $message = "Category Not Added"; 
                return $message;
            }
        }
        function display_category(){
            $query = "SELECT * FROM category";
            if(mysqli_query($this->conn , $query)){
                $return_ctg = mysqli_query($this->conn , $query);
                return $return_ctg;
            }
        }
    }

?>
