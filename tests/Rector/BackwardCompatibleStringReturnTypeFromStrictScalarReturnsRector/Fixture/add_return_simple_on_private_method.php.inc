<?php

class SomeClass
{
    private function foo()
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
    private function foo(): string
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
