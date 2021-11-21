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
        function published_display_category(){
            $query = "SELECT * FROM category WHERE ctg_status=1";
            if(mysqli_query($this->conn , $query)){
                $return_ctg = mysqli_query($this->conn , $query);
                return $return_ctg;
            }
        }

        function published_category($id){
            $query = "UPDATE category SET ctg_status= 1 WHERE ctg_id=$id";
            mysqli_query($this->conn , $query);
        }

        function unpublished_category($id){
            $query = "UPDATE category SET ctg_status= 0 WHERE ctg_id=$id";
            mysqli_query($this->conn , $query);
        }
        function delete_category($id){
            $query = "DELETE FROM `category` WHERE ctg_id = $id";
            if(mysqli_query($this->conn , $query)){
                $msg = "Category Delete Successfully";
                return $msg;
            }
        }

        function getcatinfo_update($id){
            $query = "SELECT * FROM category WHERE ctg_id=$id";
            if(mysqli_query($this->conn, $query)){
                $cat_info = mysqli_query($this->conn, $query);
                $ct_info = mysqli_fetch_assoc($cat_info);
                return $ct_info;
            }
        }
        function update_category($receive_data){
            $ctg_name = $receive_data['u_ctg_name'];
            $ctg_dess = $receive_data['u_ctg_dess'];
            $ctg_id = $receive_data['u_ctg_id'];

            $query = "UPDATE `category` SET `ctg_name`='$ctg_name',`ctg_dess`='$ctg_dess' WHERE ctg_id ='$ctg_id'";
            if(mysqli_query($this->conn , $query)){
                $return_msg = "Category Updated Successfully";
               return $return_msg;
            }
        }
        function add_product($data){
            $pdt_name = $data['pdt_name'];
            $pdt_price = $data['pdt_price'];
            $pdt_des= $data['pdt_des'];
            $pdt_ctg = $data['pdt_ctg'];
            $pdt_img_name = $_FILES['pdt_image']['name'];
            $pdt_img_size = $_FILES['pdt_image']['size'];
            $pdt_tmp_name = $_FILES['pdt_image']['tmp_name'];
            $pdt_ext = pathinfo($pdt_img_name , PATHINFO_EXTENSION);
            $pdt_status = $data['pdt_status'];
            if($pdt_ext == 'jpg' or $pdt_ext == 'png' or $pdt_ext == 'jpeg'){
                if($pdt_img_size <= 2097152){
                    $query = "INSERT INTO products(pdt_name,pdt_price,pdt_des,pdt_ctg,pdt_image,pdt_status)VALUE('$pdt_name',$pdt_price,'$pdt_des',$pdt_ctg,'$pdt_img_name',$pdt_status)";
                    if(mysqli_query($this->conn ,$query)){
                        move_uploaded_file($pdt_tmp_name, 'upload/'.$pdt_img_name);
                        $msg="Product Added Successfully!";
                        return $msg;
                    }
                }else{
                    $mag="Your File Size Should Be less Then Equal 2.MB";
                    return $msg;
                }
            }else{
                $msg = "Your File Must be a JPG Or PNG File";
                return $msg;
            }
        }
        function display_product(){
            $query = "SELECT * FROM product_info_ctg";
            if(mysqli_query($this->conn , $query)){
                $product = mysqli_query($this->conn , $query);
                return $product;
            }
        }
        function delete_product($id){
            $query = "DELETE FROM products WHERE pdt_id= $id";
            if(mysqli_query($this->conn , $query)){
                $msg = "Product Delete Successfully";
                return $msg;
            }
        }
        function getEditproduct_info($id){
            $query = "SELECT * FROM product_info_ctg WHERE pdt_id=$id";
            if(mysqli_query($this->conn , $query)){
                $productt_info = mysqli_query($this->conn , $query);
                $pdt_data = mysqli_fetch_assoc($productt_info);
                return $pdt_data;
            }
        }
        function update_product($data){
            $pdt_id = $data['u_pdt_id'];
            $pdt_name = $data['u_pdt_name'];
            $pdt_price = $data['u_pdt_price'];
            $pdt_des= $data['u_pdt_des'];
            $pdt_ctg = $data['u_pdt_ctg'];
            $pdt_img_name = $_FILES['u_pdt_image']['name'];
            $pdt_img_size = $_FILES['u_pdt_image']['size'];
            $pdt_tmp_name = $_FILES['u_pdt_image']['tmp_name'];
            $pdt_ext = pathinfo($pdt_img_name , PATHINFO_EXTENSION);
            $pdt_status = $data['u_pdt_status'];

          

            if($pdt_ext == 'jpg' or $pdt_ext == 'png' or $pdt_ext == 'jpeg'){
                if($pdt_img_size <= 2097152){
                    $query = "UPDATE products SET pdt_name='$pdt_name',pdt_price=$pdt_price,pdt_des='$pdt_des',pdt_ctg=$pdt_ctg,pdt_image='$pdt_img_name',pdt_status=$pdt_status WHERE pdt_id='$pdt_id'";
                    if(mysqli_query($this->conn ,$query)){
                        move_uploaded_file($pdt_tmp_name, 'upload/'.$pdt_img_name);
                        $msg="Product Updated Successfully!";
                        return $msg;
                    }
                }else{
                    $mag="Your File Size Should Be less Then Equal 2.MB";
                    return $msg;
                }
            }else{
                $msg = "Your File Must be a JPG Or PNG File";
                return $msg;
            } 
        }
        function product_by_category($id){
            $query = "SELECT * FROM product_info_ctg WHERE ctg_id=$id";
            if(mysqli_query($this->conn , $query)){
                $proinfo = mysqli_query($this->conn , $query);
                return $proinfo;
            }
        }
        function product_by_id($id){
            $query = "SELECT * FROM product_info_ctg WHERE pdt_id=$id";
            if(mysqli_query($this->conn , $query)){
                $proinfo = mysqli_query($this->conn , $query);
                return $proinfo;
            }
        }
        function related_product($id){
            $query = "SELECT * FROM product_info_ctg WHERE ctg_id=$id ORDER BY pdt_id DESC LIMIT 2";
            if(mysqli_query($this->conn , $query)){
                $proinfo = mysqli_query($this->conn , $query);
                return $proinfo;
            }
        }
        function ctg_by_id($id){
            $query = "SELECT * FROM product_info_ctg WHERE ctg_id=$id";
            if(mysqli_query($this->conn , $query)){
                $proinfo = mysqli_query($this->conn , $query);
                $ctg = mysqli_fetch_assoc($proinfo);
                return $ctg;
            }
        }
        function user_register($data){
            $username = $data['user_name'];
            $fast_name = $data['user_fastname'];
            $last_name = $data['user_lastname'];
            $email = $data['user_email'];
            $password = md5($data['user_password']);
            $mobile = $data['user_mobile'];
            $user_roles = $data['user_roles'];

            $get_user_data = "SELECT * FROM user WHERE user_name= '$username' or user_email= '$email'";
            $sent_data = mysqli_query($this->conn, $get_user_data);
            $row = mysqli_num_rows($sent_data);
            if($row==1){
                $msg= "This Username Or Email Already Exist!";
                return $msg;
            }else{
               if(strlen($mobile)< 11 or strlen($mobile)> 11){
                   $msg = "Your Mobile Number Should Not Be Less Then Or Greter Then 11 Digit!";
                   return $msg;
               }else{
                $query = "INSERT INTO `user`(`user_name`, `user_fastname`, `user_lastname`, `user_email`, `user_password`, `user_mobile`, `user_roles`) VALUES ('$username','$fast_name','$last_name','$email','$password',$mobile,$user_roles)";
                if(mysqli_query($this->conn , $query)){
                    $msg= "Your Account Successfully Registererd";
                    return $msg;
                }
               }
            }
        }
        function user_login($data){
            $email = $data['user_email'];
            $password = md5($data['user_password']);
            $query = "SELECT * FROM user WHERE user_email = '$email' AND user_password = '$password'";
           
        
            if(mysqli_query($this->conn,$query)){
                $result = mysqli_query($this->conn,$query);
                $user_info = mysqli_fetch_assoc($result);


                if($user_info){
                    header('location: user_profile.php');
                    session_start();
                    $_SESSION['user_id'] = $user_info['user_id'];
                    $_SESSION['email'] = $user_info['user_email'];
                    $_SESSION['password'] = $user_info['user_password'];
                    $_SESSION['user_name'] = $user_info['user_name'];
                }else{
                    $errmsg = "Your email or Password Is Incorrect!";
                    return $errmsg;
                }
            }
                
        }
        function user_logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['email']);
            unset($_SESSION['password']);
            unset($_SESSION['user_name']);
            header('location: user_login.php');
        }
    }

?>
