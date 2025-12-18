<?php

class SomeClass
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
-----
<?php

class SomeClass
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
