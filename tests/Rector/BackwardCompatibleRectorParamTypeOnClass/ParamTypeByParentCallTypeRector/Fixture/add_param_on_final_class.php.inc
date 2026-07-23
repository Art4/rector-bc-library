<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamTypeOnClass\ParamTypeByParentCallTypeRector\Fixture;

class ParentClass
{
    public function __construct(string $name)
    {
    }
}

final class ChildClass extends ParentClass
{
    public function __construct($name)
    {
        parent::__construct($name);
    }
}
-----
<?php

namespace Art4\RectorBcLibrary\Tests\Rector\BackwardCompatibleRectorParamTypeOnClass\ParamTypeByParentCallTypeRector\Fixture;

class ParentClass
{
    public function __construct(string $name)
    {
    }
}

final class ChildClass extends ParentClass
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }
}