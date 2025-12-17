<?php

final class SomeClass
{
    public function getValues()
    {
        $value = 1000;
        return;
    }
}
-----
<?php

final class SomeClass
{
    public function getValues(): void
    {
        $value = 1000;
        return;
    }
}
