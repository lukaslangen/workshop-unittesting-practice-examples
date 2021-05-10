<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Test\Shared;

use Psr\Container\ContainerInterface;
use function array_key_exists;

final class ContainerDoubleFactory
{

    /**
     * @param array<string, callable> $mapping
     */
    public static function createFake(array $mapping)
    {
        return new class($mapping) implements ContainerInterface {
            /** @var array */
            private $mapping;

            public function __construct(array $mapping)
            {
                $this->mapping = $mapping;
            }

            public function get(string $id)
            {
                if (!$this->has($id)) {
                    throw new \InvalidArgumentException("$id is not registered in container");
                }

                return $this->mapping[$id]();
            }

            public function has(string $id): bool
            {
                return array_key_exists($id, $this->mapping);
            }
        };
    }
}
