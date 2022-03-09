<?php
namespace App\Model;

use Illuminate\Database\Capsule\Manager as Capsule;

class dbConnection
{

public function __construct()
{
    try {
        $this->capsule = new Capsule();
        $this->capsule->addConnection(__dbOptions );
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
        if (Capsule::getDatabaseName() == null) {
            throw new \PDOException();
        }
        $items = Capsule::table('Users')->select('id')->get();
        return$this->capsule;
    } catch (\PDOException $EX) {
        return false;
    }
}

}

?>