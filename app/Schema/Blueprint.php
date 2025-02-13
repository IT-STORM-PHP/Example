<?php

namespace App\Schema;

class Blueprint
{
    private string $table;
    private array $columns = [];
    private ?string $primaryKey = null;
    private array $foreignKeys = [];

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function id()
    {
        $this->primaryKey = 'id';
        $this->columns[] = "`id` INT AUTO_INCREMENT PRIMARY KEY";
    }

    public function string(string $column, int $length = 255)
    {
        $this->columns[] = "`$column` VARCHAR($length) NOT NULL";
    }

    public function integer(string $column)
    {
        $this->columns[] = "`$column` INT NOT NULL";
    }

    public function timestamps()
    {
        $this->columns[] = "`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        $this->columns[] = "`updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
    }

    public function foreign(string $column, string $references, string $onTable)
    {
        $this->foreignKeys[] = "FOREIGN KEY (`$column`) REFERENCES `$onTable`(`$references`)";
    }

    public function getSQL(): string
    {
        $columnsSQL = implode(", ", $this->columns);
        $foreignKeysSQL = !empty($this->foreignKeys) ? ", " . implode(", ", $this->foreignKeys) : "";
        return "CREATE TABLE `{$this->table}` ($columnsSQL $foreignKeysSQL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    }

    public function dropSQL(): string
    {
        return "DROP TABLE IF EXISTS `{$this->table}`;";
    }
}
