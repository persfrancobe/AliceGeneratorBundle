<?php

namespace Trappar\AliceGeneratorBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Trappar\AliceGeneratorBundle\Tests\SymfonyApp\TestBundle\ObjectHandler\CustomHandler;

class FixtureGeneratorTests extends KernelTestCase
{
    public function test()
    {
        static::bootKernel();
        $fg = static::$kernel->getContainer()->get('trappar_alice_generator.fixture_generator');

        $valueVisitor = $this->readAttribute($fg, 'valueVisitor');

        $metadataResolver = $this->readAttribute($valueVisitor, 'metadataResolver');
        $fakerResolvers = $this->readAttribute($metadataResolver, 'fakerResolvers');
        $this->assertCount(5, $fakerResolvers);

        $objectHandlerRegistry = $this->readAttribute($valueVisitor, 'objectHandlerRegistry');
        $handlers = $this->readAttribute($objectHandlerRegistry, 'handlers');
        $this->assertCount(3, $handlers);
        $this->assertInstanceOf(CustomHandler::class, $handlers[0]);
    }
}