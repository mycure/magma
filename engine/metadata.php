<?
{

  class Metadata
  {
    const Table = "Metadata";

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

    public static function	Create($name, $value = "")
    {
      Database::Execute("INSERT INTO " . self::Table . " VALUES('$name', '" . serialize($value) . "')");
    }

    public static function	Get($name)
    {
      $value = Database::Execute("SELECT value FROM " . self::Table . " WHERE name='$name'", Database::ResultSingle);

      return unserialize($value["value"]);
    }

    public static function	Set($name, $value)
    {
      Database::Execute("UPDATE " . self::Table . " SET value='" . serialize($value) . "' WHERE name='$name'");
    }
  }

}
?>
