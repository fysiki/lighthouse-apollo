<?php

namespace BrightAlley\LighthouseApollo\Graph;

use Illuminate\Contracts\Support\Arrayable;

trait ArrayableTrait
{
    /**
     * Convert a field to something for an array.
     *
     * @param mixed $field
     * @return mixed
     */
    private function mapField($field)
    {
        if ($field instanceof Arrayable) {
            return $field;
        }

        if (is_iterable($field)) {
            $result = [];
            foreach ($field as $key => $value) {
                $result[$key] = $this->mapField($value);
            }

            return $result;
        }

        return $field;
    }

    /**
     * Get the instance as an array.
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return array_map([$this, 'mapField'], get_object_vars($this));
    }
}
