<?php

final class SomeClass
{
    public $prop1;
    protected $prop2;
    private $prop3;

    public function __construct(string $prop1, int $prop2, array $prop3)
    {
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
        $this->prop3 = $prop3;
    }
}
-----
<?php

final class SomeClass
{
    /**
     * @var string
     */
    public $prop1;
    protected int $prop2;
    private array $prop3;

    public function __construct(string $prop1, int $prop2, array $prop3)
    {
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
        $this->prop3 = $prop3;
    }
}
