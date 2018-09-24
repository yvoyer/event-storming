<?php declare(strict_types=1);

namespace Star\EventStorming\Domain\Model\Schema;

interface SchemaDumper
{
    /**
     * @param Schema $schema
     *
     * @return string
     */
    public function dump(Schema $schema): string;
}
