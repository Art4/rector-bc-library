<?php

final class SomeClass
{
    public function foo($value): mixed
    {
        if ($value) {
            return 'yes';
        }

        return strtoupper($value);
    }
}
