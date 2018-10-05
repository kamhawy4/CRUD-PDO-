<?php

class AbstructModel {	

      const DATA_TYPE_BOOL    = PDO::PARAM_BOOL;
      const DATA_TYPE_STR     = PDO::PARAM_STR;
      const DATA_TYPE_INT     = PDO::PARAM_INT;
      const DATA_TYPE_DECIMAL = 4;


	  //  handel data   by bindValue 
	  private function prepareValue(PDOStatement $stmt)
	  {
	  	foreach(static::$tableSchema as $columnName => $type) {
	  	  if($type == 4)
	  	  {
	  	   $sanitizevalue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
	  	    $stmt->bindValue(":{$columnName}",$sanitizevalue);
	  	    }else{
	  	    $stmt->bindValue(":{$columnName}",$this->$columnName,$type);
	  	  }
	  	}
	  }

	  // data 
	  private static function BuildNameParametrSql()
	  {
	    $nameparams = "";
	    foreach(static::$tableSchema as $columnName => $type) {
	    	$nameparams .= $columnName .'=:'. $columnName.',';
	    }
	    return trim($nameparams, ',');
	  }

	  // Create Data  
	  private  function create()
	  {
	  	global $connection;
	  	$sql  =  'INSERT INTO '.static::$tableName.' SET '.self::BuildNameParametrSql();
	  	$stmt =  $connection->prepare($sql);
	  	$this->prepareValue($stmt);
	  	return $stmt->execute();
	  }


	  // Update Data  
	  private  function update()
	  {
	  	global $connection;
	  	$sql  =  'UPDATE '.static::$tableName.' SET '.self::BuildNameParametrSql().' WHERE '. static::$primarykey.'='.$this->{static::$primarykey};
	  	$stmt =  $connection->prepare($sql);
	  	$this->prepareValue($stmt);
	  	return $stmt->execute();
	  }


	  // update and  create [ if primarykey = null use create else use update ] 
	  public function Save()
	  {
	  	return  $this->{static::$primarykey} === null ? $this->create() : $this->update(); 
	  }


	  public function GetAll()
	  {
	    global $connection;
		$sql  = 'SELECT * FROM '.static::$tableName;
		    $stmt =  $connection->prepare($sql);
		return $stmt->execute() === true ? $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,get_called_class(),array_keys(static::$tableSchema)) : false ;
	  }

	  // Delete Data
	  public  function delete()
	  {
	  	global $connection;
	  	$sql  =  'DELETE FROM '.static::$tableName.' WHERE '. static::$primarykey.'='.$this->{static::$primarykey};
	  	$stmt =  $connection->prepare($sql);
	  	return $stmt->execute();
	  }


	  // Select by id table
	  public static function getByPk($pk)
	  {
	  	global $connection;
	  	$sql  =  ' SELECT * FROM '.static::$tableName .' WHERE ' . static::$primarykey . '="' . $pk. '"';
	  	$stmt =  $connection->prepare($sql);
	  	if($stmt->execute() === true){
	  	$obj = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,get_called_class(),array_keys(static::$tableSchema));
	  	return array_shift($obj); 
	  	}
	  	return false;
	  }

}


?>