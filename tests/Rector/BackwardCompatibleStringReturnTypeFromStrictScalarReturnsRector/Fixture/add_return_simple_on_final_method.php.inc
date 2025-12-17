<?php

class SomeClass
{
    final public function foo()
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
-----
<?php

class SomeClass
{
    final public function foo(): string
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
