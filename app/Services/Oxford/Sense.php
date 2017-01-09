<?php

namespace App\Services\Oxford;

class Sense
{
    /* @var string */
    protected $definition;

    /* @var [] */
    protected $examples;

    public function __construct(string $definition, array $examples)
    {
        $this->definition = $definition;
        $this->examples = $examples;
    }

    public function definition()
    {
        return $this->definition;
    }

    public function examples()
    {
        return $this->examples;
    }

    public function toArray()
    {
        return [
            'definition' => $this->definition(),
            'examples' => $this->examples(),
        ];
    }
}
