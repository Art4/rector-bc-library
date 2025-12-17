<?php

final class SomeClass
{
    public function run()
    {
        $values = [];

        return $values;
    }
}
-----
<?php

final class SomeClass
{
    public function run(): array
    {
        $values = [];

        return $values;
    }
}
