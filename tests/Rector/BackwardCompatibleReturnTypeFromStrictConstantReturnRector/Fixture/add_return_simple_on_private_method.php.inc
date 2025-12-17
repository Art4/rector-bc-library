<?php

class SomeClass
{
    public const NAME = 'name';

    private function getName()
    {
        return self::NAME;
    }
}
-----
<?php

class SomeClass
{
    public const NAME = 'name';

    private function getName(): string
    {
        return self::NAME;
    }
}
