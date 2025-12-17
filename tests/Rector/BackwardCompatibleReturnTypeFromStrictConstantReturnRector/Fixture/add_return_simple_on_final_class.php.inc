<?php

final class SomeClass
{
    public const NAME = 'name';

    public function getName(): string
    {
        return self::NAME;
    }
}
-----
<?php

final class SomeClass
{
    public const NAME = 'name';

    public function getName(): string
    {
        return self::NAME;
    }
}
