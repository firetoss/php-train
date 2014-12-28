<?php 

abstract class DomainObject {
	private $_group;

	public function __construct()
	{
		$this->_group = static::getGroup();
	}

	public static function create()
	{
		return new static();
	}

	public static function getGroup()
	{
		return "default";
	}
}

class User extends DomainObject {

}

class Document extends DomainObject {
	public static function getGroup() {
		return "Document";
	}
}

class SpreadSheet extends Document {
	public static function getGroup() {
		return "SpreadSheet";
	}
}

print_r(User::create());
print_r(SpreadSheet::create());