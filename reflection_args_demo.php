<?php
/**
 * 
 **/
class Product
{
    function __construct()
    {
        // code...
    }
}

/**
 * 
 **/
class CdProduct extends Product
{
    function __construct($arg1, $arg2, Product $arg3)
    {
        // code...
    }
}

$prod_class = new ReflectionClass('CdProduct');
$method     = $prod_class->getMethod('__construct');
$params     = $method->getParameters();

foreach ($params as $param) {
    print argData($param);
}

function argData(ReflectionParameter $arg)
{
    $declaringclass = $arg->getDeclaringClass();

    $detail   = "";
    $name     = $arg->getName();
    $class    = $arg->getClass();
    $position = $arg->getPosition();

    $detail .= "\$$name has position $position\n";

    if (!empty($class)) {
        $classname = $class->getName();
        $detail .= "\$$name must be a $classname object\n";
    }

    if ($arg->isPassedByReference()) {
        $detail .= "\$$name is passed by reference";
    }

    if ($arg->isDefaultValueAvailable()) {
        $def = $arg->getDefaultValue();
        $detail .= "\$$name has default: $def\n";
    }

    return $detail;
}
