<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTokensTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('Tokens');
        $table->addColumn('user_id', 'integer')
            ->addColumn('remeber_me_token', 'string')
            ->addColumn('isused', 'boolean', [
                'default' => false
            ])
            ->addForeignKey('user_id', 'Users', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}
