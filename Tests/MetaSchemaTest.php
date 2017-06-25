<?php

namespace CommonBundle\Tests;

use CommonBundle\Model\Mixin\MetaSchema;
use Phifty\Testing\ModelTestCase;
use Maghead\Schema\DeclareSchema;

class ItemSchema extends DeclareSchema
{
    public function schema()
    {
        $this->column('title')->varchar(30);
        $this->mixin(MetaSchema::class);
    }
}

class MetaSchemaTest extends ModelTestCase
{
    public function models() {
        return [new ItemSchema];
    }

    public function test()
    {
        $ret = Item::create([ 'title' => 'works' ]);
        $this->assertResultSuccess($ret);
    }
}



