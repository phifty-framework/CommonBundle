<?php

namespace TodoApp\Model;

use CommonBundle\Model\Mixin\MetaSchema;
use CommonBundle\Model\Mixin\OrderingSchema;

use Phifty\Testing\ModelTestCase;
use Maghead\Schema\DeclareSchema;
use UserBundle\Model\UserSchema;

class MetaSchemaTest extends ModelTestCase
{
    public function models() {
        return [new UserSchema, new ItemSchema];
    }

    public function testCreateWithDefaultDateTime()
    {
        $ret = Item::create([ 'title' => 'works' ]);
        $this->assertResultSuccess($ret);
    }
}



