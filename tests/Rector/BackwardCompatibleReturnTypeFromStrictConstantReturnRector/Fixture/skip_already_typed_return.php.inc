<?php

final class SomeClass
{
    public const MESSAGE = 'hello';

    public function getMessage(): mixed
    {
        return self::MESSAGE;
    }
}
