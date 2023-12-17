<?php

/**
 * Authentication Class
 */
class Authentication
{

    /**
     * @var Database
     */
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public  function isLoggedIn(){

        $loginString = Generate::_generateLoginString();
        $currentString = Session::getSession("login_fingerprint");
        if(Session::getSession('user_id') == null ){
            return false;
        }
        if (Session::getSession("isLoggedIn")){
            return true;
        }
        if($currentString != null && $currentString == $loginString){
            return true;
        } else  {
            Session::destroySession();
            return false;
        }

    }



    /**
     * User login function
     * @param string $username User's username
     * @param string $password User's password
     * @return void TRUE if okay, FALSE otherwise
     **/
    public function userLogin(string $username, string $password)
    {

        $username = trim($username);
        $password = trim($password);



        try {

            $sql = "SELECT * FROM `users` WHERE `username` = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);

            if ($stmt->execute()){
                if($stmt->rowCount() > 0) {

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    /** @var string $hashed_password **/
                    $hashed_password = $row['password'];


                    if(password_verify($password, $hashed_password)){


                        /** Log in the user */
                        Session::setSession("user_id", $row['user_id']);
                        Session::setSession("isLoggedIn", true);
                        Session::setSession("login_fingerprint", Generate::_generateLoginString());

                        echo "true";

                    } else {
                        echo "Password is incorrect";
                    }

                } else {
                    echo "No username found";
                }
            } else {
                echo "Error occurred while logging in.";
            }

        } catch (Exception $e){
            echo "Error: " . $e;
        }

    }


}