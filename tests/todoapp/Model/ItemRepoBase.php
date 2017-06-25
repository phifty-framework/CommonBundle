<?php

namespace TodoApp\Model;


use Maghead\Schema\SchemaLoader;
use Maghead\Runtime\Result;
use Maghead\Runtime\Model;
use Maghead\Runtime\Inflator;
use Magsql\Bind;
use Magsql\ArgumentArray;
use PDO;
use Magsql\Universal\Query\InsertQuery;
use Maghead\Runtime\Repo;

class ItemRepoBase
    extends Repo
{

    const SCHEMA_CLASS = 'TodoApp\\Model\\ItemSchema';

    const SCHEMA_PROXY_CLASS = 'TodoApp\\Model\\ItemSchemaProxy';

    const COLLECTION_CLASS = 'TodoApp\\Model\\ItemCollection';

    const MODEL_CLASS = 'TodoApp\\Model\\Item';

    const TABLE = 'items';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const PRIMARY_KEY = 'id';

    const TABLE_ALIAS = 'm';

    const FIND_BY_PRIMARY_KEY_SQL = 'SELECT * FROM items WHERE id = ? LIMIT 1';

    const DELETE_BY_PRIMARY_KEY_SQL = 'DELETE FROM items WHERE id = ?';

    const FETCH_CREATED_BY_SQL = 'SELECT * FROM users WHERE id = ? LIMIT 1';

    const FETCH_UPDATED_BY_SQL = 'SELECT * FROM users WHERE id = ? LIMIT 1';

    public static $columnNames = array (
      0 => 'id',
      1 => 'title',
      2 => 'updated_on',
      3 => 'created_on',
      4 => 'updated_by',
      5 => 'created_by',
      6 => 'ordering',
    );

    public static $columnHash = array (
      'id' => 1,
      'title' => 1,
      'updated_on' => 1,
      'created_on' => 1,
      'updated_by' => 1,
      'created_by' => 1,
      'ordering' => 1,
    );

    public static $mixinClasses = array (
      0 => 'CommonBundle\\Model\\Mixin\\OrderingSchema',
      1 => 'CommonBundle\\Model\\Mixin\\MetaSchema',
    );

    protected $table = 'items';

    protected $loadStm;

    protected $fetchCreatedByStm;

    protected $fetchUpdatedByStm;

    public function free()
    {
        $this->loadStm = null;
        $this->deleteStm = null;
    }

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \TodoApp\Model\ItemSchemaProxy;
    }

    public function findByPrimaryKey($pkId)
    {
        if (!$this->loadStm) {
           $this->loadStm = $this->read->prepare(self::FIND_BY_PRIMARY_KEY_SQL);
           $this->loadStm->setFetchMode(PDO::FETCH_CLASS, 'TodoApp\Model\Item', [$this]);
        }
        $this->loadStm->execute([ $pkId ]);
        $obj = $this->loadStm->fetch();
        $this->loadStm->closeCursor();
        return $obj;
    }

    public function collection()
    {
        return new ItemCollection($this);
    }

    protected static function unsetImmutableArgs($args)
    {
        return $args;
    }

    public function deleteByPrimaryKey($pkId)
    {
        if (!$this->deleteStm) {
           $this->deleteStm = $this->write->prepare(self::DELETE_BY_PRIMARY_KEY_SQL);
        }
        return $this->deleteStm->execute([$pkId]);
    }

    public function fetchCreatedByOf(Model $record)
    {
        if (!$this->fetchCreatedByStm) {
            $this->fetchCreatedByStm = $this->read->prepare(self::FETCH_CREATED_BY_SQL);
            $this->fetchCreatedByStm->setFetchMode(PDO::FETCH_CLASS, \UserBundle\Model\User::class, [$this]);
        }
        $this->fetchCreatedByStm->execute([$record->created_by]);
        $obj = $this->fetchCreatedByStm->fetch();
        $this->fetchCreatedByStm->closeCursor();
        return $obj;
    }

    public function fetchUpdatedByOf(Model $record)
    {
        if (!$this->fetchUpdatedByStm) {
            $this->fetchUpdatedByStm = $this->read->prepare(self::FETCH_UPDATED_BY_SQL);
            $this->fetchUpdatedByStm->setFetchMode(PDO::FETCH_CLASS, \UserBundle\Model\User::class, [$this]);
        }
        $this->fetchUpdatedByStm->execute([$record->updated_by]);
        $obj = $this->fetchUpdatedByStm->fetch();
        $this->fetchUpdatedByStm->closeCursor();
        return $obj;
    }
}
