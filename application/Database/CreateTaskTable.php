<?php

namespace Application\Database;

use Avolutions\Database\AbstractMigration;
use Avolutions\Database\Column;
use Avolutions\Database\ColumnType;
use Avolutions\Database\Table;

class CreateTaskTable extends AbstractMigration
{
    public int $version = 20220106124412;

    public function migrate()
    {
        $columns = [];
        $columns[] = new Column('TaskID', ColumnType::INT, 255, null, Column::NOT_NULL, true, true);
        $columns[] = new Column('CustomerID', ColumnType::INT, 255, null, Column::NOT_NULL);
        $columns[] = new Column('TaskNo', ColumnType::VARCHAR, 10, null, Column::NOT_NULL);
        $columns[] = new Column('Name', ColumnType::VARCHAR, 30, null, Column::NOT_NULL);
        $this->table('Task')->create($columns);

        $this->table('Task')->addIndex(Table::UNIQUE, ['TaskNo'], 'IX_TaskNo_Unique');
        $this->table('TimeEntry')->addForeignKeyConstraint('CustomerID', 'Customer', 'CustomerID');
    }
}