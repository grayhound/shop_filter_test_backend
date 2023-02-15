<?php

namespace App\Collections;

use Illuminate\Contracts\Support\Arrayable;

trait SearchableArrayCollectionTrait
{
    /**
     * Return searchable array
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return $this->map(fn ($value) => $value instanceof Arrayable ? $value->toSearchableArray() : $value)->all();
    }
}