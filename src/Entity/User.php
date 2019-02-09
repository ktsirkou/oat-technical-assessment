<?php declare(strict_types=1);

namespace kstirkou\OAT\Entity;

use JsonSerializable;

/**
 * Class User
 *
 * @package kstisrkou\OAT\Entity
 */
class User implements  JsonSerializable {

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $pictures;

    /**
     * @var string
     */
    private $address;

    /**
     * User constructor.
     *
     * @param string $login
     * @param string $password
     * @param string $title
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $gender
     * @param string $pictures
     * @param string $address
     */
    public function __construct(
        $login,
        $password,
        $title,
        $firstName,
        $lastName,
        $email,
        $gender,
        $pictures,
        $address
    )
    {
        $this->login     = $login;
        $this->title     = $title;
        $this->password  = $password;
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->gender    = $gender;
        $this->email     = $email;
        $this->pictures  = $pictures;
        $this->address   = $address;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return User
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return User
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return User
     */
    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPictures(): string
    {
        return $this->pictures;
    }

    /**
     * @param string $pictures
     * @return User
     */
    public function setPictures(string $pictures): self
    {
        $this->pictures = $pictures;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return User
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(): array
    {
        return [
            'login'     => $this->getLogin(),
            'title'     => $this->getTitle(),
            'firstname' => $this->getFirstName(),
            'lastname'  => $this->getLastName(),
            'gender'    => $this->getGender(),
            'email'     => $this->getEmail(),
            'picture'   => $this->getPictures(),
            'address'   => $this->getAddress(),
        ];
    }
}