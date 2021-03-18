<?php

namespace DatingApp\Backend\Infrastructure\Repositories\PDO;

use PDOException;

abstract class AbstractPdoRepository
{
    protected \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    protected function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    protected function commit()
    {
        $this->connection->commit();
    }

    protected function rollBack()
    {
        $this->connection->rollBack();
    }
}
