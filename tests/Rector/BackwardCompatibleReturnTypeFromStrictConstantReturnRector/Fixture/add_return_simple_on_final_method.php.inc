<?php

class SomeClass
{
    public const NAME = 'name';

    final public function getName()
    {
        return self::NAME;
    }
}
-----
<?php

class SomeClass
{
    public const NAME = 'name';

    final public function getName(): string
    {
        return self::NAME;
    }
}
