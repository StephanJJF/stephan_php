<?php
namespace App\authentication;

use App\database\Sqlite;

class DataSqliteAuthentication {
    private $password = null;
    private $username = null;
    private $status = false;
    private $roleReference = null;
    private $errorMessage = null;
    public $role = null;
    private $dataBase = null;

    public function __construct (string $password, string $username, string $roleReference="user", string $dataBase = "..\db\data.sqlite") {
        $this->password = $password;
        $this->username = $username; 
        $this->roleReference = $roleReference;
        $this->dataBase = $dataBase;
    }
    private function authenticate():void {
        $pdo = new Sqlite($this->dataBase);
        $usernameData = $pdo->queryResult("SELECT username FROM users");
        foreach ($usernameData as $user) {
            $userNameArray[] = $user["username"];
        }
        if (in_array($this->username, $userNameArray)) {
            $userData = $pdo->queryParamResult("SELECT * FROM users WHERE username = :u", ["u" => $this->username]);
            $passwordReference = $userData[0]["password"];
            $role = $userData[0]["role"];
            $this->role = $role;
            if ($role === "admin") {
                $this->roleReference = $role;
            }
            if (password_verify($this->password, $passwordReference) && $role === $this->roleReference) {
                $this->status = true;
            } else  {
                $this->errorMessage = "nom d'utilisateur ou mot de passe invalide";
    
            }
        } else {
            $this->errorMessage = "nom d'utilisateur ou mot de passe invalide";
        }
    }
    public function getStatus (): bool {
        $this->authenticate();
        return $this->status;
    }
    public function getErrorMeassage () {
        return $this->errorMessage;
    }

}