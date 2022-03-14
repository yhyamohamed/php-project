<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{

    public function change(): void
    {

        $table = $this->table('Users');
        $table->addColumn('Email', 'string')
            ->addColumn('password', 'string')
            ->addIndex('email', ['unique' => true])
            ->create();
    }
}
