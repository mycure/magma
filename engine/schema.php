<?
{

  class Schema
  {
    public static function	Load($name)
    {
      $path = Configuration::Get("Path") . "/" . Configuration::Get("DirectorySchemas") . "/" . $name . ".sql";

      if (file_exists($path) == false)
	throw new Fault("Unable to read the SQL schema '$name'");

      $contents = Misc::Load($path);

      return $contents;
    }
  }

}
?>
