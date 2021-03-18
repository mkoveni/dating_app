<?php

namespace DatingApp\Backend\Infrastructure\Repositories\PDO;

use DatingApp\Backend\Domain\Entities\User;
use DatingApp\Backend\Domain\Repositories\UserRepository;
use PDO;
use PDOException;

class PdoUserRepository extends AbstractPdoRepository implements UserRepository
{
    public function __construct(PDO $connection)
    {
        parent::__construct($connection);
    }

    function findById(string $id): ?User
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE id=:id LIMIT 1");

        $statement->bindValue(':id', $id);

        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);

        $statement->execute();

        return $statement->fetch();
    }

    function findByEmail(string $email): ?User
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");

        $statement->bindValue(':email', $email);

        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);

        $statement->execute();

        return $statement->fetch();
    }

    function save(User $user): bool
    {
        $result = false;

        try {

            $this->beginTransaction();

            $statement = $this->connection->prepare("INSERT INTO users (name,password, email) VALUES (:name, :password,:email)");
            $statement->bindValue(':name', $user->getName());
            $statement->bindValue(':email', $user->getEmail());
            $statement->bindValue(':password', $user->getPassword());

            $result =  (bool) $statement->execute();

            $this->commit();
        } catch (PDOException $e) {
            $this->rollBack();
            throw $e;
        }

        return $result;
    }
}
