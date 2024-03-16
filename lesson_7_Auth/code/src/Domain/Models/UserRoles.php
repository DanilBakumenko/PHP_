<?php

namespace Geekbrains\Application1\Domain\Models;

class UserRoles
{
    protected array $roles;

    public function __construct()
    {
        $this->roles[] = 'user';

        if (isset($_SESSION['id_user'])) {
            $rolesSql = "SELECT * FROM user_roles WHERE id_user = :id";

            $handler = Application::$storage->get()->prepare($rolesSql);
            $handler->execute(['id' => $_SESSION['id_user']]);
            $result = $handler->fetchAll();

            if (!empty($result)) {
                foreach ($result as $role) {
                    $this->roles[] = $role['role'];
                }
            }
        }

    }

    public function getRoles(): array
    {
        return $this->roles;
    }


}