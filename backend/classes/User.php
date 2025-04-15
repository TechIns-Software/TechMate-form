<?php

namespace TechMateForm;

class User
{
    private int $id;
    private string $username;
    private string $password;

    /**
     * @param int $id
     * @param string $username
     * @param string $password
     */
    public function __construct(int $id, string $username, string $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public static function login($conn, $username, $password): int
    {
        $user = self::getUserByUsername($conn, $username);
        if ($user && self::checkPassword($password, $user->password)) {
            return $user->id;
        }
        return -1;
    }

    public static function getUserByUsername($conn, $username): ?User
    {
        $sql = "SELECT * FROM User WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            return new User($result['id'], $result['username'], $result['password']);
        }
        return null;
    }

    public static function createUser($conn, $username, $password)
    {
        $sql = "INSERT INTO User (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $passwordHashed = self::hashPassword($password);
        $stmt->bind_param('ss', $username, $passwordHashed);
        $stmt->execute();
        return $stmt->insert_id;
    }
    public static function hashPassword($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private static function checkPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}
