<?php

final class SomeClass
{
    public function isActive()
    {
        return true;
    }
}
-----
<?php

final class SomeClass
{
    public function isActive(): bool
    {
        return true;
    }
}
