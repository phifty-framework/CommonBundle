<?php

namespace TodoApp\Model;


use Maghead\Runtime\Model;
use Maghead\Schema\SchemaLoader;
use Maghead\Runtime\Result;
use Maghead\Runtime\Inflator;
use Magsql\Bind;
use Magsql\ArgumentArray;
use DateTime;
use WebAction\Maghead\Traits\ActionCreatorTrait;

class ItemBase
    extends Model
{

    use ActionCreatorTrait;

    const SCHEMA_PROXY_CLASS = 'TodoApp\\Model\\ItemSchemaProxy';

    const READ_SOURCE_ID = 'master';

    const WRITE_SOURCE_ID = 'master';

    const TABLE_ALIAS = 'm';

    const SCHEMA_CLASS = 'TodoApp\\Model\\ItemSchema';

    const LABEL = 'Item';

    const MODEL_NAME = 'Item';

    const MODEL_NAMESPACE = 'TodoApp\\Model';

    const MODEL_CLASS = 'TodoApp\\Model\\Item';

    const REPO_CLASS = 'TodoApp\\Model\\ItemRepoBase';

    const COLLECTION_CLASS = 'TodoApp\\Model\\ItemCollection';

    const TABLE = 'items';

    const PRIMARY_KEY = 'id';

    const GLOBAL_PRIMARY_KEY = NULL;

    const LOCAL_PRIMARY_KEY = 'id';

    public static $column_names = array (
      0 => 'id',
      1 => 'title',
      2 => 'updated_on',
      3 => 'created_on',
      4 => 'updated_by',
      5 => 'created_by',
      6 => 'ordering',
    );

    public static $mixin_classes = array (
      0 => 'CommonBundle\\Model\\Mixin\\OrderingSchema',
      1 => 'CommonBundle\\Model\\Mixin\\MetaSchema',
    );

    protected $table = 'items';

    public $id;

    public $title;

    public $updated_on;

    public $created_on;

    public $updated_by;

    public $created_by;

    public $ordering;

    public static function getSchema()
    {
        static $schema;
        if ($schema) {
           return $schema;
        }
        return $schema = new \TodoApp\Model\ItemSchemaProxy;
    }

    public static function createRepo($write, $read)
    {
        return new \TodoApp\Model\ItemRepoBase($write, $read);
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getKey()
    {
        return $this->id;
    }

    public function hasKey()
    {
        return isset($this->id);
    }

    public function setKey($key)
    {
        return $this->id = $key;
    }

    public function removeLocalPrimaryKey()
    {
        $this->id = null;
    }

    public function getId()
    {
        return intval($this->id);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUpdatedOn()
    {
        return Inflator::inflate($this->updated_on, 'DateTime');
    }

    public function getCreatedOn()
    {
        return Inflator::inflate($this->created_on, 'DateTime');
    }

    public function getUpdatedBy()
    {
        return intval($this->updated_by);
    }

    public function getCreatedBy()
    {
        return intval($this->created_by);
    }

    public function getOrdering()
    {
        return intval($this->ordering);
    }

    public function getAlterableData()
    {
        return ["id" => $this->id, "title" => $this->title, "updated_on" => $this->updated_on, "created_on" => $this->created_on, "updated_by" => $this->updated_by, "created_by" => $this->created_by, "ordering" => $this->ordering];
    }

    public function getData()
    {
        return ["id" => $this->id, "title" => $this->title, "updated_on" => $this->updated_on, "created_on" => $this->created_on, "updated_by" => $this->updated_by, "created_by" => $this->created_by, "ordering" => $this->ordering];
    }

    public function setData(array $data)
    {
        if (array_key_exists("id", $data)) { $this->id = $data["id"]; }
        if (array_key_exists("title", $data)) { $this->title = $data["title"]; }
        if (array_key_exists("updated_on", $data)) { $this->updated_on = $data["updated_on"]; }
        if (array_key_exists("created_on", $data)) { $this->created_on = $data["created_on"]; }
        if (array_key_exists("updated_by", $data)) { $this->updated_by = $data["updated_by"]; }
        if (array_key_exists("created_by", $data)) { $this->created_by = $data["created_by"]; }
        if (array_key_exists("ordering", $data)) { $this->ordering = $data["ordering"]; }
    }

    public function clear()
    {
        $this->id = NULL;
        $this->title = NULL;
        $this->updated_on = NULL;
        $this->created_on = NULL;
        $this->updated_by = NULL;
        $this->created_by = NULL;
        $this->ordering = NULL;
    }

    public function fetchCreatedBy()
    {
        return static::masterRepo()->fetchCreatedByOf($this);
    }

    public function fetchUpdatedBy()
    {
        return static::masterRepo()->fetchUpdatedByOf($this);
    }
}
