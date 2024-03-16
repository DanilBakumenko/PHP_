<?php

namespace Geekbrains\Application1\Domain\Models;

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Infrastructure\Storage;

class User {
    private ?int $idUser;
    private ?string $userName;

    private ?string $userLastName;
    private ?int $userBirthday;

    private static string $storageAddress = '/storage/birthdays.txt';

    public function __construct(string $name = null, string $lastName = null, int $birthday = null, int $idUser = null){
        $this->userName = $name;
        $this->userLastName = $lastName;
        $this->userBirthday = $birthday;
        $this->idUser = $idUser;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setName(string $userName) : void {
        $this->userName = $userName;
    }

    public function setLastName(string $userLastName) : void {
        $this->userLastName = $userLastName;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserLastName(): string {
        return $this->userLastName;
    }

    public function getUserBirthday(): int {
        return $this->userBirthday;
    }

    public function setBirthdayFromString(string $birthdayString) : void {
        $this->userBirthday = strtotime($birthdayString);
    }

    public static function getAllUsersFromStorage(): array {
        $sql = "SELECT * FROM users";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute();
        $result = $handler->fetchAll();

        $users = [];

        foreach($result as $item){
            $user = new User($item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp'],$item['id_user']);
            $users[] = $user;
        }
        return $users;
    }

    public static function  getUserFromStorage(int $id_user)
    {
        $sql = "SELECT * FROM users WHERE id_user = :id_user";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id_user' => $id_user]);

        $result = $handler->fetch() ;

        return new User($result['user_name'], $result['user_lastname'], $result['user_birthday_timestamp'],$result['id_user']);
    }

    public function updateUser(array $userDataArray): void{
        $sql = "UPDATE users SET ";

        foreach($userDataArray as $key => $value) {
            $sql .= $key ." = :".$key;

            if(next($userDataArray)) {
                $sql .= ",";
            }

        }
                echo $sql."<br>";
        $sql .= " WHERE users.id_user = ".$this->getIdUser();

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute($userDataArray);
    }

    public function setIdUser(?int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public static function validateRequestData(): bool{
        $result = true;
        
        if(!(
            isset($_POST['name']) && !preg_match('/(<.*)|(.*>)|(^$)/',$_POST['name']) &&
            isset($_POST['lastname']) && !preg_match('/(<.*)|(.*>)|(^$)/',$_POST['lastname']) &&
            isset($_POST['birthday']) && !empty($_POST['birthday'])
        )){
            $result = false;
        }

        if(!preg_match('/^(\d{2}-\d{2}-\d{4})$/', $_POST['birthday'])){
            $result =  false;
        }

        if(!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']){
            $result = false;
        }

        return $result;
    }

    public function setParamsFromRequestData(): void {
        $this->userName = htmlspecialchars($_POST['name']);
        $this->userLastName = htmlspecialchars($_POST['lastname']);
        $this->setBirthdayFromString($_POST['birthday']); 
    }

    public function saveToStorage(){
        $sql = "INSERT INTO users(user_name, user_lastname, user_birthday_timestamp,login) VALUES (:user_name, :user_lastname, :user_birthday,:login)";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'user_name' => $this->userName,
            'user_lastname' => $this->userLastName,
            'user_birthday' => $this->userBirthday,
            'login' => 'user'
        ]);
    }

    public static function deleteFromStorage(int $user_id) : void {
        $sql = "DELETE FROM users WHERE id_user = :id_user";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id_user' => $user_id]);
    }

    public static function exists(int $id): bool{
        $sql = "SELECT count(id_user) as user_count FROM users WHERE id_user = :id_user";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'id_user' => $id
        ]);

        $result = $handler->fetchAll();

        if(count($result) > 0 && $result[0]['user_count'] > 0){
            return true;
        }
        else{
            return false;
        }
    }
}

