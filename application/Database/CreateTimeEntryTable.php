<?php

namespace Application\Database;

use Avolutions\Database\AbstractMigration;
use Avolutions\Database\Column;
use Avolutions\Database\ColumnType;

class CreateTimeEntryTable extends AbstractMigration
{
    public int $version = 20220106125914;

    public function migrate()
    {
        $columns = [];
        $columns[] = new Column('TimeEntryID', ColumnType::INT, 255, null, Column::NOT_NULL, true, true);
        $columns[] = new Column('CustomerID', ColumnType::INT, 255, null, Column::NOT_NULL);
        $columns[] = new Column('TaskID', ColumnType::INT, 255, null, Column::NOT_NULL);
        $columns[] = new Column('Duration', ColumnType::INT, 5, null, Column::NOT_NULL);
        $columns[] = new Column('Date', ColumnType::DATETIME, null, Column::CURRENT_TIMESTAMP);
        $columns[] = new Column('Description', ColumnType::VARCHAR, 255, null, Column::NOT_NULL);
        $this->table('TimeEntry')->create($columns);

        // TODO FK constraints
        $this->table('TimeEntry')->addForeignKeyConstraint('CustomerID', 'Customer', 'CustomerID');
        $this->table('TimeEntry')->addForeignKeyConstraint('TaskID', 'Task', 'TaskID');
    }
}