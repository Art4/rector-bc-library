<?php

class SomeClass
{
    final public function isActive()
    {
        return true;
    }
}
-----
<?php

class SomeClass
{
    final public function isActive(): bool
    {
        return true;
    }
}
