<?php

class SomeClass
{
    private function getValues()
    {
        $value = 1000;
        return;
    }
}
-----
<?php

class SomeClass
{
    private function getValues(): void
    {
        $value = 1000;
        return;
    }
}
