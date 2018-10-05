<?php
require_once "abstractmodel.php";

class Employee extends AbstructModel
{
	public $title;
	public $content;
	public $type;

	protected static $tableName    = 'books';
	protected static $primarykey   = 'id';

	protected static $tableSchema  = array(
		'title'   => self::DATA_TYPE_STR,
		'content' => self::DATA_TYPE_INT,
		'type'    => self::DATA_TYPE_DECIMAL,
	);

	function __construct($title,$content,$type)
	{
		global $connection;

		$this->title   = $title;
		$this->content = $content;
		$this->type    = $type;
		
	}
}




?>