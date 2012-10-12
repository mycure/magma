<?
{

  class Database
  {
    const TypeMySQL = 1;
    const TypeSQLite = 2;

    const ResultSingle = 1;
    const ResultEvery = 2;

    /*
     * attributes
     */
    private static $implementation;

    public static function	Connect()
    {
      switch (Configuration::Get("DatabaseType"))
	{
	case self::TypeMySQL:
	  {
	    self::$implementation = new DatabaseMySQL(Configuration::Get("DatabaseHost"),
						      Configuration::Get("DatabaseUser"),
						      Configuration::Get("DatabasePassword"),
						      Configuration::Get("DatabaseName"));
	    break;
	  }
	}
    }

    public static function	Exist($table)
    {
      $result = self::Execute("SHOW TABLES LIKE '" . $table . "'");

      if (empty($result) == true)
	return false;

      return true;
    }

    public static function	Lock($name)
    {
      self::Execute("SELECT GET_LOCK('$name', 30)");
    }

    public static function	Unlock($name)
    {
      self::Execute("SELECT RELEASE_LOCK('$name')");
    }

    public static function	Flush()
    {
      $result = self::Execute("SHOW TABLES");

      foreach ($result as $element)
	{
	  $array = array_values($element);

	  $table = $array[0];

	  self::Execute("DROP TABLE " . $table);
	}
    }

    /*
     * interface
     */

    public static function	Execute($query, $result = Database::ResultEvery)
    {
      return self::$implementation->Execute($query, $result);
    }
  }

  class DatabaseMySQL
  {
    private $handle;

    public function		__construct($host, $user, $password, $name)
    {
      if (($this->handle = mysql_pconnect($host, $user, $password, true)) == false)
	throw new Fault("Unable to connect to the '$host' database on behalf of user '$user'");

      if (mysql_select_db($name, $this->handle) == false)
	throw new Fault("Unable to select the '$name' database");
    }

    public function		Execute($query, $result = Database::ResultEvery)
    {
      $records = array();

      if (($data = mysql_query($query, $this->handle)) === false)
	throw new Fault("Unable to execute the query '$query' because: '" . mysql_error() . "'");
      else if ($data === true)
	return null;

      switch ($result)
	{
	case Database::ResultSingle:
	  {
	    $record = mysql_fetch_assoc($data);

	    mysql_free_result($data);

	    return $record;
	  }
	case Database::ResultEvery:
	  {
	    while ($row = mysql_fetch_assoc($data))
	      $records[] = $row;

	    mysql_free_result($data);

	    return $records;
	  }
	}

      return null;
    }
  }

}
?>
