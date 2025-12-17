<?php

class SomeClass
{
    final public function run()
    {
        $values = [];

        return $values;
    }
}
-----
<?php

class SomeClass
{
    final public function run(): array
    {
        $values = [];

        return $values;
    }
}
