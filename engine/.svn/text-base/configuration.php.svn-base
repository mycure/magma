<?
{

  class Configuration
  {
    public static $variables = array("DirectorySchemas" => "schemas",
				     "DirectoryModules" => "modules",
				     "DirectoryAtoms" => "atoms",
				     "DirectoryCells" => "cells",
				     "DirectoryLayouts" => "layouts",
				     "DirectoryCanvas" => "canvas",
				     "DirectoryThemes" => "themes",
				     "DirectoryLanguages" => "languages",
				     "DirectoryUtils" => "utils");

    public static function	Set($key, $value)
    {
      self::$variables[$key] = $value;
    }

    public static function	Get($key)
    {
      if (self::Exist($key) == false)
	throw new Fault("The configuration does not contain a '$key' variable.");

      return self::$variables[$key];
    }

    public static function	Exist($key)
    {
      return array_key_exists($key, self::$variables);
    }
  }

}
?>
