<?php

final class SomeClass
{
    private string $name;

    public function setName($name)
    {
        $this->name = $name;
    }
}
-----
<?php

final class SomeClass
{
    private string $name;

    public function setName(string $name)
    {
        $this->name = $name;
    }
}
