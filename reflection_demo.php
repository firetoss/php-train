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
    public $a = '1';
    
    function __construct()
    {
        // code...
    }

    function &referenceTest()
    {
        $this->a = 2;
        return $this;
    }
}

function classData(ReflectionClass $class)
{
    $detail = '';
    $name   = $class->getName();

    if ($class->isUserDefined()) {
        $detail .= "$name is user defined\n";
    }

    if ($class->isInternal()) {
        $detail .= "$name is built-in\n";
    }

    if ($class->isInterface()) {
        $detail .= "$name is interface\n";
    }

    if ($class->isAbstract()) {
        $detail .= "$name is abstract class\n";
    }

    if ($class->isFinal()) {
        $detail .= "$name is a final class\n";
    }

    if ($class->isInstantiable()) {
        $detail .= "$name can be instantiabled\n";
    }
    else {
        $detail .= "$name can not be instantiabled\n";
    }

    return $detail;
}

$prod_class = new ReflectionClass('CdProduct');
print classData($prod_class);

$class = new CdProduct();
print_r($class->referenceTest());
