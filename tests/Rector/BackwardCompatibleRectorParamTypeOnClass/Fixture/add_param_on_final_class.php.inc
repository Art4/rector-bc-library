<?php

final class SomeClass
{
    public function get($key)
    {
        $data = [
            'name' => 'John',
            'age' => 30,
        ];

        return $data[$key];
    }
}
-----
<?php

final class SomeClass
{
    public function get(string $key)
    {
        $data = [
            'name' => 'John',
            'age' => 30,
        ];

        return $data[$key];
    }
}
