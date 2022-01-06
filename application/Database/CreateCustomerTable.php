<?php

namespace Application\Database;

use Avolutions\Database\AbstractMigration;
use Avolutions\Database\Column;
use Avolutions\Database\ColumnType;
use Avolutions\Database\Table;

class CreateCustomerTable extends AbstractMigration
{
    public int $version = 20220106122320;

    public function migrate()
    {
        $columns = [];
        $columns[] = new Column('CustomerID', ColumnType::INT, 255, null, Column::NOT_NULL, true, true);
        $columns[] = new Column('CustomerNo', ColumnType::INT, 10, null, Column::NOT_NULL);
        $columns[] = new Column('Name', ColumnType::VARCHAR, 30, null, Column::NOT_NULL);
        $this->table('Customer')->create($columns);

        $this->table('Customer')->addIndex(Table::UNIQUE, ['CustomerNo'], 'IX_CustomerNo_Unique');
    }
}