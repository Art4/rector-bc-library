<?php

class SomeClass
{
    private function isActive()
    {
        return true;
    }
}
-----
<?php

class SomeClass
{
    private function isActive(): bool
    {
        return true;
    }
}
