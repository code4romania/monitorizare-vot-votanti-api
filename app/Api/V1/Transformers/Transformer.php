<?php

namespace App\Api\V1\Transformers;

use App\Incident;

abstract class Transformer
{

    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform(Incident $item);
}
