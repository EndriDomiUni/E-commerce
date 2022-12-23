<?php

namespace src\model;

class Costumer
{
    private int $id;
    private string $name;
    private string $surname;

    private string $email;

    private string $password;

    /**
     * @param $id
     * @param $name
     * @param $surname
     * @param $email
     * @param $password
     */
    public function __construct($id, $name, $surname, $email, $password)
    {
        try {
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->password = $password;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    public function __toString(): string
    {
        return "id: " . $this->getId() . "</br>"
            . "name: " .$this->getName() . "</br>"
            . "surname: " .$this->getSurname() . "</br>"
            . "email: " .$this->getEmail() . "</br>"
            . "pass: " .$this->getPassword() . "</br>";
    }
}