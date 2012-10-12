<?
{

  class Identifier
  {
    public static $defaults = 9;

    public static function	Install()
    {
      Metadata::Create("identifier", self::$defaults);
    }

    public static function	Reserve()
    {
      Database::Lock("identifier");
      {
	$id = Metadata::Get("identifier") + 1;

	Metadata::Set("identifier", $id);
      }
      Database::Unlock("identifier");

      return $id;
    }
  }

}
?>
