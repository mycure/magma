<?
{

  class Validation
  {
    const Table = "Validations";

    public $attributes;

    public static function	Ready()
    {
      return Database::Exist(self::Table);
    }

    public static function	Install()
    {
      $schema = Schema::Load(self::Table);

      if (self::Ready() == false)
	Database::Execute($schema);
    }

    public static function	Uninstall()
    {
      if (self::Ready() == true)
	Database::Execute("DROP TABLE " . self::Table);
    }

    public static function	Flush()
    {
      if (self::Ready() == true)
	Database::Execute("DELETE FROM " . self::Table);
    }

    public static function	Generate()
    {
      return md5(uniqid(rand(), true));
    }

    public static function	Exist($code)
    {
      $record = Database::Execute("SELECT * FROM " . self::Table . " WHERE code='$code'", Database::ResultSingle);

      return !empty($record);
    }

    public function		Lookup($code)
    {
      $record = Database::Execute("SELECT * FROM " . self::Table . " WHERE code='$code'", Database::ResultSingle);

      if (empty($record) == true)
	throw new Error("The validation code '$code' does not seem to exist");

      $this->attributes = $record;
    }

    public function		Reserve($information)
    {
      while (true)
	{
	  $this->attributes["code"] = Validation::Generate();

	  if (Validation::Exist($this->attributes["code"]) == false)
	    break;
	}

      $this->attributes["information"] = $information;
    }

    public function		Store()
    {
      if (Validation::Exist($this->attributes["code"]) == true)
	{
	  $attributes = array();

	  foreach ($this->attributes as $name => $value)
	    $attributes[] = "$name='$value'";

	  Database::Execute("UPDATE " . self::Table . " SET " . implode(", ", $attributes) . " WHERE code='" . $this->attributes["code"] . "'");
	}
      else
	Database::Execute("INSERT INTO " . self::Table . " VALUES('" . implode("', '", $this->attributes) . "')");
    }

    public function		Destroy()
    {
      Database::Execute("DELETE FROM " . self::Table . " WHERE code='" . $this->attributes["code"] . "'");
    }

    public function		__get($attribute)
    {
      if (isset($this->attributes[$attribute]) == false)
	throw new Fault("Unable to get attribute '$attribute'");

      if (empty($this->attributes[$attribute]) == true)
	return null;

      return $this->attributes[$attribute];
    }

    public function		__set($attribute, $value)
    {
      if (isset($this->attributes[$attribute]) == false)
	throw new Fault("Unable to set attribute '$attribute'");

      $this->attributes[$attribute] = $value;
    }
  }

}
?>
