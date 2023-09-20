<?php
// session_start();

class User
{
    private $id;
    public $login;
    public $password;
    public $lastname;
    public $firstname;
  

    public function __construct()
    {   $this->error = "";
        try {
            $options =
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ];
            $DB_SDN = 'mysql:host=localhost;dbname=moduleconnexion';
            $DB_USER = 'root';
            $DB_PASS = '';

            //on va instancier donc créer un objet PDO
            $this->bdd = new PDO($DB_SDN, $DB_USER, $DB_PASS, $options);
        } catch (PDOException $exception) {
            echo 'ERREUR :' . $exception->getMessage();
        }
    }

    public function register($login, $password, $passwordConfirm, $lastname, $firstname)
    // Enregistré l'utilisateur en bdd
    //ici droits 1 : reprséente le user
    {
        $this->login    = $login;
        $this->password = $password;
        $this->password = $passwordConfirm;
        $this->firstname    = $firstname;
        $this->lastname = $lastname;

        $_login = htmlspecialchars($login);
        $_password = htmlspecialchars($password);
        $_passwordConfirm = htmlspecialchars($passwordConfirm);
        $_firstname = htmlspecialchars($firstname);
        $_lastname = htmlspecialchars($lastname);

        $login = trim($_login);
        $passwordConfirm = trim($_passwordConfirm);
        $password = trim($_password);
        $firstname = trim($_firstname);
        $lastname = trim($_lastname);

        if(!empty($login) && !empty($password) && !empty($passwordConfirm) && !empty($firstname) && !empty($lastname))
        {
            $infos = "SELECT * FROM user WHERE login = :login AND firstname = :firstname AND lastname = :lastname";
            $result = $this->bdd->prepare($infos);
            $result->bindvalue(':login', $login);
            $result->bindvalue(':firstname', $firstname);
            $result->bindvalue(':lastname', $lastname);
            $result->setFetchMode(PDO::FETCH_ASSOC); // j'utilise fetch_assoc pour récuperer les key d'un tableau associatif 
            $result->execute();
            $userData = $result->fetchAll();
            // var_dump($userData);

            if ((count($userData)) === 0)
            {
                if ($password == $passwordConfirm)
                {
                    $cost = ['cost' => 12];
                    $password = password_hash($password, PASSWORD_BCRYPT);


                    $query = "INSERT INTO user(login, password, lastname, firstname)
                            VALUES(:login, :password, :lastname, :firstname)";
                    $result = $this->bdd->prepare($query);
                    $result->bindvalue(':login', $login);
                    $result->bindvalue(':password', $password);
                    $result->bindvalue(':lastname', $lastname);
                    $result->bindvalue(':firstname', $firstname);
                    $result->execute(array(
                        ":login" => $login,
                        ":password" => $password,
                        ":firstname" => $firstname,
                        ":lastname" => $lastname,
                        
                    ));
                
                    header('Location: connexion.php?reg_err=success');
            }
                else
                {
                    header('Location: inscription.php?reg_err=password');
                    die();
                }
            }
            else
            {
                header('Location: inscription.php?reg_err=already');
                die();
            }
        
        }
    }

    public function connect($login, $password)
    // permet d'ouvrir une session à l'utilisateur 
    {
        $_login = htmlspecialchars($login);
        $_password = htmlspecialchars($password);

        $login = trim($_login);
        $password = trim($_password);

        if (!empty($login) && !empty($password))
        {
            $infos = "SELECT * FROM user WHERE login = :login ";
            $result = $this->bdd->prepare($infos);
            $result->setFetchMode(PDO::FETCH_ASSOC); // j'utilise fetch_assoc pour récuperer les key d'un tableau associatif 
            $result->execute(array(
                ":login" => $login,
            ));
 
            $userData = $result->fetchAll();

            if (password_verify($password, $userData[0]['password']))
            {
                // header('Location: profil.php');

                $_SESSION["user"] = $userData[0];
             

               
            }
            else
            {
                header('Location: connexion.php?login_err=password');
            
            }
        }
    }

    public function disconnect()
    {

        session_start(); // demarrage de la session
        unset($_SESSION['user']);
        unset($_SESSION['user']['id']);
        session_destroy(); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
        header('Location: connexion.php');
        die();
    }

    public function updatelogin($login)
    {
        if (isset($_SESSION['user']) && isset($login))
        {
            $this->login = $login;

            $infos2 = "SELECT * FROM user WHERE login = :login ";
            $result2 = $this->bdd->prepare($infos2);
            $result2->setFetchMode(PDO::FETCH_ASSOC);
            $result2->execute(array(
                ":login" => $login,
            ));

            $verifyLogin = $result2->fetchAll();
            // var_dump($verifyLogin);


            if (!$verifyLogin)
            {
                $update = "UPDATE user SET login= :login  WHERE id = :id ";
                $result = $this->bdd->prepare($update);

                $result->execute(array(
                    ":id" => $_SESSION['user']['id'],
                    ":login" => $login,
                ));
                
            }
            if ($login !== $_SESSION['user']['login']) {
                $update = "UPDATE user SET login= :login  WHERE id = :id ";
                $result = $this->bdd->prepare($update);
                $result->execute(array(
                    ":id" => $_SESSION['user']['id'],
                    ":login" => $login,
                ));
                $_SESSION['user']['login'] = $login;

                     $_SESSION['error'] = "<p> les informations de l'utilisateurs ont bien été modifiées.</p>";
            }
            else
            {
                $_SESSION['error'] = "<p>Vous ne pouvez pas utiliser ce login, car c'est votre login actuel.</p>";
            }
        }
        
    }

    public function updateLastname($lastname)
    {
        if (isset($_SESSION['user']) && isset($lastname))
        {
            $this->lastname = $lastname;

            $infos2 = "SELECT * FROM user WHERE lastname = :lastname ";
            $result2 = $this->bdd->prepare($infos2);
            $result2->setFetchMode(PDO::FETCH_ASSOC);
            $result2->execute(array(
                ":lastname" => $lastname,
            ));

            $verifyLastname = $result2->fetchAll();


            if (!$verifyLastname)
            {
                $update = "UPDATE user SET lastname= :lastname  WHERE id = :id ";
                $result = $this->bdd->prepare($update);

                $result->execute(array(
                    ":id" => $_SESSION['user']['id'],
                    ":lastname" => $lastname,
                ));
            }
            if ($lastname !== $_SESSION['user']['lastname']) {
                $update = "UPDATE user SET lastname= :lastname  WHERE id = :id ";
                $result = $this->bdd->prepare($update);
                $result->execute(array(
                    ":id" => $_SESSION['user']['id'],
                    ":lastname" => $lastname,
                ));
                $_SESSION['user']['lastname'] = $lastname;

                     $_SESSION['error-lastname'] = "<p> les informations de l'utilisateurs ont bien été modifiées.</p>";
            }
            else
            {
                $_SESSION['error-lastname'] = "<p>Vous ne pouvez pas utiliser ce lastname, car c'est votre lastname actuel ou c'est vide.</p>";
            }
        }
        
    }


    public function updatepassword($password, $passwordConfirm)
    {


            if ($password == $passwordConfirm)
            {
                $cryptedpass = password_hash($passwordConfirm, PASSWORD_BCRYPT);
                $update = "UPDATE user SET password= :password WHERE id = :id ";
                $result = $this->bdd->prepare($update);

                $result->execute(array(
                    ":id" => $_SESSION['user']['id'],
                    ":password" => $cryptedpass,
                ));
                $_SESSION['error'] = "les informations de l'utilisateurs ont bien été modifiées";
            }
            else
            {
                $_SESSION['error'] = "Les mots de passes doivent être identiques.";
            }
        }
    
        
    // public function getAllInfos()
    public function getAllInfos($id)
    {
        $this->id = $id;
        // var_dump($id);
        $query = "SELECT * FROM user WHERE id = ?";
        $result = $this->bdd->prepare($query);
        // $result->bindValue(":id", $id);
        // var_dump($result);

        // $result->execute(array($_SESSION['user']['id']));
        $result->execute([$id]);
        // var_dump($result);

        $getAllInf = $result->fetch(PDO::FETCH_ASSOC);
        // var_dump($getAllInf);

        return $getAllInf;
    }

    public function getAllInfosById($byId) 
    {
        // var_dump($id);
        $query = "SELECT * FROM user WHERE id = ?";
        $result = $this->bdd->prepare($query);

        $result->execute([$byId]);
        // var_dump($result);

        $getAllInfId = $result->fetch(PDO::FETCH_ASSOC);
        return $getAllInfId;
        // var_dump($getAllInfId);
    }

    //CRUD ADMIN
    public function getUserAdmin() 
    {
        $query = "SELECT * 
                    FROM `user` 
                    INNER JOIN droits ON user.id = droits.id_droits";
        $result = $this->bdd->prepare($query);

        $result->execute();
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getUserAdminByID($id)
    {   
        $query = "SELECT * 
                    FROM `user` 
                    INNER JOIN droits ON user.id = droits.id_droits 
                    WHERE user.id = ?";
        $result = $this->bdd->prepare($query);

        $result->execute([$id]);
        // var_dump($result);

        $res = $result->fetch(PDO::FETCH_ASSOC);

        return $res;
    }
    
    public function updateUser($login, $lastname, $id)
    {   
        $this->login = $login;
        $this->lastname = $lastname;  
        $this->id = $id;

        $query = "UPDATE user 
                    SET login = ?, lastname = ?, id = ? 
                    WHERE id = ? ";
        $result = $this->bdd->prepare($query);
        // id_droits

        $result->execute([$login, $lastname, $id]);
    }

    public function deleteUser($id)
    {   
        $this->id = $id;
        $sql ="DELETE 
                FROM user
                WHERE id = ?";
        // On prépare la requête
        $request = $this->bdd->prepare($sql);
        // On exécute
        $request->execute([$id]);
    }
}   

$user = new User();