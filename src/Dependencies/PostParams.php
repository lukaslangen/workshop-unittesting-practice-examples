<?php

declare(strict_types=1);

namespace LukasLangen\Workshop\UnitTesting\Dependencies;

class PostParams
{
    public function getParam(string $name)
    {
        return $_POST[$name];
    }
}
