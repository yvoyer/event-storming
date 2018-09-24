<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model\Schema;

use Star\EventStorming\Domain\Model\EventTypeFactory;

interface SchemaLoader
{
    /**
     * @param EventTypeFactory $factory
     * @param string $string
     *
     * @return Schema
     */
    public function load(EventTypeFactory $factory, string $string): Schema;
}
