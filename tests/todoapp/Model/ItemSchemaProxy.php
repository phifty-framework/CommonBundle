<?php

namespace TodoApp\Model;


use Maghead\Schema\RuntimeSchema;
use Maghead\Schema\RuntimeColumn;
use Maghead\Schema\Relationship\Relationship;
use Maghead\Schema\Relationship\HasOne;
use Maghead\Schema\Relationship\HasMany;
use Maghead\Schema\Relationship\BelongsTo;
use Maghead\Schema\Relationship\ManyToMany;

class ItemSchemaProxy
    extends RuntimeSchema
{

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

    public static $column_hash = array (
      'id' => 1,
      'title' => 1,
      'updated_on' => 1,
      'created_on' => 1,
      'updated_by' => 1,
      'created_by' => 1,
      'ordering' => 1,
    );

    public static $mixin_classes = array (
      0 => 'CommonBundle\\Model\\Mixin\\OrderingSchema',
      1 => 'CommonBundle\\Model\\Mixin\\MetaSchema',
    );

    public $columnNames = array (
      0 => 'id',
      1 => 'title',
      2 => 'updated_on',
      3 => 'created_on',
      4 => 'updated_by',
      5 => 'created_by',
      6 => 'ordering',
    );

    public $primaryKey = 'id';

    public $columnNamesIncludeVirtual = array (
      0 => 'id',
      1 => 'title',
      2 => 'updated_on',
      3 => 'created_on',
      4 => 'updated_by',
      5 => 'created_by',
      6 => 'ordering',
    );

    public $label = 'Item';

    public $readSourceId = 'master';

    public $writeSourceId = 'master';

    public $relations;

    public function __construct()
    {
        $this->relations = array( 
      'created_by' => \Maghead\Schema\Relationship\BelongsTo::__set_state(array( 
      'data' => array( 
          'foreign_schema' => 'UserBundle\\Model\\UserSchema',
          'foreign_column' => 'id',
          'self_schema' => 'TodoApp\\Model\\ItemSchema',
          'self_column' => 'created_by',
        ),
      'accessor' => 'created_by',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => NULL,
      'onDelete' => NULL,
      'usingIndex' => false,
    )),
      'updated_by' => \Maghead\Schema\Relationship\BelongsTo::__set_state(array( 
      'data' => array( 
          'foreign_schema' => 'UserBundle\\Model\\UserSchema',
          'foreign_column' => 'id',
          'self_schema' => 'TodoApp\\Model\\ItemSchema',
          'self_column' => 'updated_by',
        ),
      'accessor' => 'updated_by',
      'where' => NULL,
      'orderBy' => array( 
        ),
      'onUpdate' => NULL,
      'onDelete' => NULL,
      'usingIndex' => false,
    )),
    );
        $this->columns[ 'id' ] = new RuntimeColumn('id',array( 
      'locales' => NULL,
      'attributes' => array( 
          'autoIncrement' => true,
          'renderAs' => 'HiddenInput',
          'widgetAttributes' => array( 
            ),
        ),
      'name' => 'id',
      'primary' => true,
      'unsigned' => true,
      'type' => 'int',
      'isa' => 'int',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'autoIncrement' => true,
      'renderAs' => 'HiddenInput',
      'widgetAttributes' => array( 
        ),
    ));
        $this->columns[ 'title' ] = new RuntimeColumn('title',array( 
      'locales' => NULL,
      'attributes' => array( 
          'length' => 30,
        ),
      'name' => 'title',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'varchar',
      'isa' => 'str',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'length' => 30,
    ));
        $this->columns[ 'updated_on' ] = new RuntimeColumn('updated_on',array( 
      'locales' => NULL,
      'attributes' => array( 
          'timezone' => true,
          'default' => \Magsql\Raw::__set_state(array( 
      'value' => 'CURRENT_TIMESTAMP',
    )),
          'label' => '更新時間',
          'renderAs' => 'DateTimeInput',
          'widgetAttributes' => array( 
            ),
        ),
      'name' => 'updated_on',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'timestamp',
      'isa' => 'DateTime',
      'notNull' => false,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => \Magsql\Raw::__set_state(array( 
      'value' => 'CURRENT_TIMESTAMP',
    )),
      'timezone' => true,
      'default' => \Magsql\Raw::__set_state(array( 
      'value' => 'CURRENT_TIMESTAMP',
    )),
      'label' => '更新時間',
      'renderAs' => 'DateTimeInput',
      'widgetAttributes' => array( 
        ),
    ));
        $this->columns[ 'created_on' ] = new RuntimeColumn('created_on',array( 
      'locales' => NULL,
      'attributes' => array( 
          'timezone' => true,
          'default' => function() { return new \DateTime; },
          'label' => '建立時間',
          'renderAs' => 'DateTimeInput',
          'widgetAttributes' => array( 
            ),
        ),
      'name' => 'created_on',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'timestamp',
      'isa' => 'DateTime',
      'notNull' => true,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'timezone' => true,
      'default' => function() { return new \DateTime; },
      'label' => '建立時間',
      'renderAs' => 'DateTimeInput',
      'widgetAttributes' => array( 
        ),
    ));
        $this->columns[ 'updated_by' ] = new RuntimeColumn('updated_by',array( 
      'locales' => NULL,
      'attributes' => array( 
          'refer' => 'UserBundle\\Model\\UserSchema',
          'length' => NULL,
          'default' => function() {
                    if ( isset($_SESSION) ) {
                        return kernel()->currentUser->id;
                    }
                },
          'renderAs' => 'SelectInput',
          'widgetAttributes' => array( 
            ),
          'label' => '更新者',
        ),
      'name' => 'updated_by',
      'primary' => NULL,
      'unsigned' => true,
      'type' => 'int',
      'isa' => 'int',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'refer' => 'UserBundle\\Model\\UserSchema',
      'length' => NULL,
      'default' => function() {
                    if ( isset($_SESSION) ) {
                        return kernel()->currentUser->id;
                    }
                },
      'renderAs' => 'SelectInput',
      'widgetAttributes' => array( 
        ),
      'label' => '更新者',
    ));
        $this->columns[ 'created_by' ] = new RuntimeColumn('created_by',array( 
      'locales' => NULL,
      'attributes' => array( 
          'refer' => 'UserBundle\\Model\\UserSchema',
          'length' => NULL,
          'default' => function() {
                    if (isset($_SESSION)) {
                        return kernel()->currentUser->id;
                    }
                },
          'renderAs' => 'SelectInput',
          'widgetAttributes' => array( 
            ),
          'label' => '建立者',
        ),
      'name' => 'created_by',
      'primary' => NULL,
      'unsigned' => true,
      'type' => 'int',
      'isa' => 'int',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'refer' => 'UserBundle\\Model\\UserSchema',
      'length' => NULL,
      'default' => function() {
                    if (isset($_SESSION)) {
                        return kernel()->currentUser->id;
                    }
                },
      'renderAs' => 'SelectInput',
      'widgetAttributes' => array( 
        ),
      'label' => '建立者',
    ));
        $this->columns[ 'ordering' ] = new RuntimeColumn('ordering',array( 
      'locales' => NULL,
      'attributes' => array( 
          'default' => 0,
          'renderAs' => 'HiddenInput',
          'widgetAttributes' => array( 
            ),
          'label' => '排序編號',
        ),
      'name' => 'ordering',
      'primary' => NULL,
      'unsigned' => NULL,
      'type' => 'int',
      'isa' => 'int',
      'notNull' => NULL,
      'enum' => NULL,
      'set' => NULL,
      'onUpdate' => NULL,
      'default' => 0,
      'renderAs' => 'HiddenInput',
      'widgetAttributes' => array( 
        ),
      'label' => '排序編號',
    ));
    }
}
