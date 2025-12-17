<?php

final class SomeClass
{
    public function foo()
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
-----
<?php

final class SomeClass
{
    public function foo(): string
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
