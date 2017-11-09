<?php
// controllers.php


class controllers extends model {


    //$model = new model();
    public function list_action()
    {
        //$posts = $this->get_all_posts();//TODO: get all posts
       // require 'templates/list.tpl.php';
       require './user/templates/homepage.tpl.php';
    }

    public function show_action($id)
    {
        $post = $this->get_post($id);//TODO: get post by id
        $comments = $this->get_comment($id);
        require 'templates/show.tpl.php';
    }

    public function register() 
    {
        include 'templates/register.tpl.php';
    }

    public function login() {

        //include 'templates/login.tpl.php';
        header('Location: http://blog/stage-5/index.php/Login');
    }

    public function loginTemplate() 
    {
        include 'templates/login.tpl.php';
    }

    public function RegisterUser($name,$email, $password) 
    {
        $status = $this->adduser($name,$email, $password);
        return $status;
    }

    public function LoginUser($name, $password) {
        $val = $this->checkUser($name, $password);
        return $val;
    }

    public function logout() {

        //destroy session variables
        session_destroy();
        $this->login();
    }

    public function LoginAction($name, $password) {

        $login = $this->checkUser($name, $password);
        
        if(!empty($login)) {
            $_SESSION['user_id'] = $login['id'];
            $_SESSION['username'] = $login['username'];
            $_SESSION['taget_image_path'] = $login['image_path'];
            
            //if login show posts
            //$this->list_action();
            header('Location: http://blog/stage-5/');
        }
        else
        {
            $this->login();
        }
    }

    //Image Upload
    public function ImageUpload() {

        //need to rename the image as the row entry to the table
        $image_name = $this->GetImageName();

        //$status = '';
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["uploadimage"]["name"]);
        
        //gets the extension of file
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $target_file = $target_dir . $image_name . "." . $imageFileType;

        $uploadOk = 1;
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["uploadimage"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } 
            else {
            
                //echo "File is not an image.";
                $status = "<br>File is not an image.";
                $uploadOk = 0;
            }
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            
            //echo "Sorry, file already exists.";
            $status .= "<br>Sorry, file already exists.";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["uploadimage"]["size"] > 500000) {
            
            //echo "Sorry, your file is too large.";
            $status .= "<br>Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $status .= "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            
            //echo "Sorry, your file was not uploaded.";
            $status .= "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        
            // if everything is ok, try to upload file
        } 
        else {
            if (move_uploaded_file($_FILES["uploadimage"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["uploadimage"]["name"]). " has been uploaded.";
                
                //$status .= "<br>The file ". basename( $_FILES["uploadimage"]["name"]). " has been uploaded.";
            } 
            else {
                
                //echo "Sorry, there was an error uploading your file.";
                $status .= "Sorry, there was an error uploading your file.";
            }
        }
        
        //target file path
        $_SESSION['taget_image_path'] = $target_file;

        return $status;
    }

    //perform RegisterAction()
    public function RegisterAction() {
    
        /*
        **  working code which uploads the image with the expected insertion row id
        **  then insert the row in the db
        **
        //fileupload
        $status = ImageUpload();
        
        //if error status exists
        if(!empty($status)) {
            $content = $status;
        
            //call layout template
            include 'templates/layout.tpl.php';
        }

        //if image is uploaded then register the user
        //and redirect to login page
        else {
            
            RegisterUser($_POST['name'], $_POST['email'], $_POST['password']);
            login();
        }
        */ 
        /*
            **  new update
            **  insert row then upload image with that row id name
            **
        */
    
        //target file path
        $_SESSION['taget_image_path'] = NULL;

        $register_status = $this->RegisterUser($_POST['name'], $_POST['email'], $_POST['password']);

        //check insertion status
        if($register_status == false) {
            $content = "<br> ERROR REGISTERING THE USER<br><brPLEASE RE REGISTER";
            include 'templates/layout.tpl.php';
        }
        else {
            //fileupload
            $status = $this->ImageUpload();

            //update image path
            $this->UpdateUser($_POST['name'], $_POST['password']);
            
            //if error status exists
            if(!empty($status)) {
                $content = $status;
            
                //call layout template
                include 'templates/layout.tpl.php';
            }
            else {
                $this->login();
            }
        }
    }

    public function comment_action() {
        $this->register_comment();
    }
}

