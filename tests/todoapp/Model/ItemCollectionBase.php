<?php

namespace TodoApp\Model;


use Maghead\Runtime\Collection;

class ItemCollectionBase
    extends Collection
{

    const SCHEMA_PROXY_CLASS = 'TodoApp\\Model\\ItemSchemaProxy';

    const MODEL_CLASS = 'TodoApp\\Model\\Item';

    const TABLE = 'items';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    public static function createRepo($write, $read)
    {
        return new \TodoApp\Model\ItemRepoBase($write, $read);
    }

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \TodoApp\Model\ItemSchemaProxy;
    }
}
