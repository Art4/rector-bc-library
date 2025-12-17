<?php

class SomeClass
{
    final public function getValues()
    {
        $value = 1000;
        return;
    }
}
-----
<?php

class SomeClass
{
    final public function getValues(): void
    {
        $value = 1000;
        return;
    }
}
