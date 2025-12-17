<?php

class SomeClass
{
    private function run()
    {
        $values = [];

        return $values;
    }
}
-----
<?php

class SomeClass
{
    private function run(): array
    {
        $values = [];

        return $values;
    }
}
