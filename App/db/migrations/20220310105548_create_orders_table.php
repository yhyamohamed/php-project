<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Util\Literal;

final class CreateOrdersTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('Orders');
        $table->addColumn('user_id', 'integer')
            ->addColumn('product_id', 'integer')
            ->addColumn('download_count', 'integer')
            ->addColumn('order_date', 'timestamp', [
                'timezone' => true,
                'default' => Literal::from('now()')
            ])

            ->addForeignKey('user_id', 'Users', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('product_id', 'Products', 'id', ['delete' => 'NO_ACTION', 'update' => 'CASCADE'])
            ->create();
    }
}
