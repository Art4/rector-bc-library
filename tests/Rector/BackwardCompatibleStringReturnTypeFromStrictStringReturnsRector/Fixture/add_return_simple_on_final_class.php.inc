<?php

final class SomeClass
{
    public function foo($value)
    {
        if ($value) {
            return 'yes';
        }

        return strtoupper($value);
    }
}
-----
<?php

final class SomeClass
{
    public function foo($value): string
    {
        if ($value) {
            return 'yes';
        }

        return strtoupper($value);
    }
}
