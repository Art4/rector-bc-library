<?php

class SomeClass
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
-----
<?php

class SomeClass
{
    /**
     * @var string
     */
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
