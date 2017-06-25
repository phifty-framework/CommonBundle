<?php

namespace CommonBundle\Tests;

use CommonBundle\Model\Mixin\MetaSchema;
use Phifty\Testing\ModelTestCase;
use Maghead\Schema\DeclareSchema;

class ItemSchema extends DeclareSchema
{
    public function schema()
    {
        $this->mixin(MetaSchema::class);
    }
}

class MetaSchemaTest extends TestCase
{
    public function models() {
        return [new ItemSchema];
    }

    public function test()
    {

    }
}



