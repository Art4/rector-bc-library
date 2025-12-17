<?php

class SomeClass
{
    private function checkStatus()
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
    private function checkStatus(): bool
    {
        if ($this->enabled) {
            return true;
        }
        return false;
    }
}
