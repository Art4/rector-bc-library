<?php

class SomeClass
{
    final public function checkStatus()
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}
-----
<?php

class SomeClass
{
    final public function checkStatus(): bool
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}
