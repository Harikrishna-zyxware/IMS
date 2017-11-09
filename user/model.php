<?php

// model.php
//require_once 'database.php';

class model extends database {

    public function get_all_posts()
    {
        //TODO: fetch all posts from the db and close the database connection.
        /* $link = $this->open_database_connection();

        $result = $link->query('SELECT * FROM post');
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $posts[] = $row;
        }

        // code part using single query ()

        $this->close_database_connection($link);
        return $posts; */

        /* $query = "SELECT * FROM post";
        $posts = $this->query_execute($query, NULL);
        return $posts; */

        //optimized code
        $posts = $this->prepare("SELECT" , "*", "post", NULL)
                    ->fetch();
        return $posts;
    }

    public function get_post($id)
    {
        //TODO: fetch a post by id from the db and close the database connection.
        /*  $link = open_database_connection();
        $result = $link->prepare("SELECT * FROM post
        WHERE id = :id");
        $result->bindParam(':id', $id);
        $result->execute();
        $post = $result->fetch(PDO::FETCH_ASSOC);
        $this->close_database_connection($link);
        return $post; */

        /* $query = "SELECT * FROM post"
        . " WHERE id = :id";
        
        //parse_str(":id=$id", $values);
        $values = array(':id' => $id);
        $posts = $this->query_execute($query, $values);
        return $posts[0]; */

        //optimized code
        $values = array('id' => $id);
        $post = $this->prepare("SELECT" , "*", "post", $values)
                    ->bind($values)
                    ->execute()
                    ->fetch();

        return $post[0];
    }

    public function get_comment($id) {
        $query = "SELECT *, users.username AS uname FROM `comment`"
        . " JOIN users ON comment.user_id = users.id"
        . " WHERE post_id = :id";
        $values = array('id' => $id);
        $comments = $this->query_execute($query, $values);
        return $comments;
    }

    //adding data to user database table
    public function addUser($name, $email, $password)
    {
        /* $link = $this->open_database_connection();
        $password = sha1($password);
        $result = $link->prepare("INSERT INTO `users`
        (`username`, `email`, `password`, `image_path`) 
        VALUES (:name, :email, :password, :path)");
        $result->bindParam(':name',$name); 
        $result->bindParam(':email',$email); 
        $result->bindParam(':password',$password);
        $result->bindParam(':path', $_SESSION['taget_image_path']);
        
        // $password = sha1($password);
        $t = $result->execute();

        //set image name
        $_SESSION['image_name'] = $link->lastInsertId();
        $this->close_database_connection($link);
        return $t; */


        /* $query = "INSERT INTO `users`(`username`, `email`, `password`, `image_path`)" 
        . " VALUES (:name, :email, :password, :path)";
        $values = array(':name' => $name,
            ':email' => $email,
            ':password' => sha1($password),
            ':path' => $_SESSION['taget_image_path']
        );
        $posts = $this->query_execute($query, $values);
        $_SESSION['image_name'] = $this->lastId;
        return $this->t; */

        //optimized code
        $values = array('username' => $name,
            'email' => $email,
            'password' => sha1($password),
            'image_path' => $_SESSION['taget_image_path']
        );
        $obj = $this->prepare("INSERT", NULL, 'users', $values)
                    ->bind($values)
                    ->execute();
        $_SESSION['image_name'] = $obj->last_insert_id(); //calling last inert id()seperately
        return $obj->t;         
    }

    public function register_comment() {

        $values = array('user_id' => $_SESSION['user_id'],
            'comment' => $_POST['comment_text'],
            'date' => date("Y-m-d"),
            'post_id' => $_POST['post_id']
        );
        $obj = $this->prepare("INSERT", NULL, 'comment', $values)
                    ->bind($values)
                    ->execute();
    }

    //checking user with user database table
    public function checkUser($name, $password)
    {
        /* $link = $this->open_database_connection();

        $password = sha1($password);
        
        $result = $link->prepare("SELECT * FROM `users` WHERE username = :name AND password = :password");
        $result->bindParam(':name',$name); 
        $result->bindParam(':password', $password);
        
        //debug
        $t = $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $this->close_database_connection($link);
        if($password === $row['password']) {
            return $row;
        } else {
            return NULL;
        } */
        $password = sha1($password);
        $query = "SELECT * FROM `users`" 
        . " WHERE `username` = :name AND `password` = :password";
        
        //parse_str(":name=$name&:password=$password", $values);
        $values = array(':name' => $name,
            ':password' => $password
        );
        $posts = $this->query_execute($query, $values);
        return $posts[0];
    }

    //GetImageName()
    // i.e fetch the last inserted id and add one to it
    //it will be the image name
    public function GetImageName() {
        return $_SESSION['image_name'];
    }

    //update image path
    public function UpdateUser($name, $password) {
       /*  $link = $this->open_database_connection();
        $password = sha1($password);
        $result = $link->prepare("UPDATE `users` SET `image_path`=:val 
        WHERE `username`=:user AND `password`=:pass");
        $result->bindParam(':val', $_SESSION['taget_image_path']);
        $result->bindParam(':user', $name);
        $result->bindParam(':pass', $password);

        $t = $result->execute();
        $this->close_database_connection($link); */
        $query = "UPDATE `users` SET `image_path`=:val "
        . " WHERE `username`=:user AND `password`=:pass";
        $values = array(':val' => $_SESSION['taget_image_path'],
            ':user' => $name,
            ':pass' => sha1($password)
        );
        $posts = $this->query_execute($query, $values);
    }
}
