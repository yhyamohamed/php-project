<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateProductsTable extends AbstractMigration
{
    
    public function change(): void
    {
        $table = $this->table('Products');
        $table->addColumn('download_file_link', 'string')
            ->addColumn('product_name', 'string')
            ->create();
    }
}
