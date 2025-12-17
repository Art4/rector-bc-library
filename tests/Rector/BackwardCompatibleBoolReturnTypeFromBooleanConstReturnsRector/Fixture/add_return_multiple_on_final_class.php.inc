<?php

final class SomeClass
{
    public function checkStatus()
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}
-----
<?php

final class SomeClass
{
    public function checkStatus(): bool
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}
