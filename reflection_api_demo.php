<?php
class Person {
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }
}

interface Module {
    function execute();
}

/**
 * 
 **/
class FtpModule implements Module
{
    function setHost($host)
    {
        print "FtpModule::setHost(): $host\n";
    }

    function setUser($user)
    {
        print "FtpModule::setUser(): $user\n";
    }

    function execute()
    {
        // code...
    }
}

/**
 * 
 **/
class PersonModule implements Module
{
    function setPerson(Person $person)
    {
        print "PersonModule::setPerson(): ($person->name)\n";
    }

    function execute()
    {
        // code...
    }
}

/**
 * 
 **/
class ModuleRunner
{
    private $configData = array(
        'PersonModule' => array('person' => 'bob'),
        'FtpModule'    => array('host' => 'example.com',
                                'user' => 'anon'),
    );

    private $modules = array();

    public function init()
    {
        $interface = new ReflectionClass('Module');

        foreach ($this->configData as $modulename => $params) {
            $module_class = new ReflectionClass($modulename);
            if (!$module_class->isSubclassof($interface)) {
                throw new Exception('unknown module type: $modulename');
            }

            $module  = $module_class->newInstance();
            $methods = $module_class->getMethods();

            foreach ($methods as $method) {
                $this->handleMethod($module, $method, $params);
            }
            array_push($this->modules, $module);
        }
    }

    public function handleMethod(Module $module, ReflectionMethod $method, $params)
    {
        $name = $method->getName();
        $args = $method->getParameters();

        if (count($args) != 1 || substr($name, 0, 3) != 'set') {
            return false;
        }

        $property = strtolower(substr($name, 3));

        if (!isset($params[$property])) {
            return false;
        }

        $arg_class = $args[0]->getClass();
        if (empty($arg_class)) {
            if (!method_exists($module, $name)) {
                echo "$name is not existed\n";
            }
            $method->invoke($module, $params[$property]);
        }
        else {
            if (!class_exists($property)) {
                echo "$property is not existed\n";
            }
            $method->invoke($module, $arg_class->newInstance($params[$property]));
        }
    }
}

$test = new ModuleRunner();
$test->init();
