<?php declare(strict_types=1);

namespace Star\Schema;

interface SchemaDumper
{
    /**
     * @param Schema $schema
     *
     * @return string
     */
    public function dump(Schema $schema): string;
}
