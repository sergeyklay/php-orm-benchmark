<?php declare(strict_types = 1);

namespace OrmBench\Dms;

use Dms\Core\Persistence\Db\Mapping\Definition\Orm\OrmDefinition;
use Dms\Core\Persistence\Db\Mapping\Orm;
use OrmBench\Dms\Infrastructure\Persistence\BlogOrm;

/**
 * The application's orm.
 */
class AppOrm extends Orm
{
    /**
     * Defines the object mappers registered in the orm.
     *
     * @param OrmDefinition $orm
     *
     * @return void
     */
    protected function define(OrmDefinition $orm)
    {
        $orm->enableLazyLoading();

        // $orm->encompass(DmsOrm::inDefaultNamespace());

        $orm->encompass(new BlogOrm($this->iocContainer));
    }
}
