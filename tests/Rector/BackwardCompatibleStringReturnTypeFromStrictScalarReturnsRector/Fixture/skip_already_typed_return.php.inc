<?php

final class SomeClass
{
    public function foo(): mixed
    {
        if (true) {
            return 'yes';
        }

        return 'no';
    }
}
