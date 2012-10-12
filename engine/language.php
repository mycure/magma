<?
{

  class Language
  {
    public static $directories = array();

    public static $languages = array();

    public static function	Initialise()
    {
      self::$directories[] = Configuration::Get("Path") . "/" . Configuration::Get("DirectoryLanguages");
    }

    public static function	Add($module)
    {
      self::$directories[] = Configuration::Get("Path") . "/" . Configuration::Get("DirectoryModules") . "/" . trim($module) . "/" . Configuration::Get("DirectoryLanguages");
    }

    public static function	Register($name)
    {
      self::$languages[$name] = array();
    }

    public static function	Load($name)
    {
      if (array_key_exists($name, self::$languages) == false)
	self::Register($name);

      foreach (self::$directories as $directory)
	{
	  $files = Misc::Search($directory, "^.*$", Misc::OptionFile | Misc::OptionWalk);

	  foreach ($files as $file)
	    {
	      $context = new Context(array("language" => self::$languages[$name]));
	      $output = null;

	      Code::Call($directory . "/" . $file, $context, $output);

	      if (Configuration::Get("Debug") == true)
		print $output;

	      /*
	       * update the languages database
	       */
	      self::$languages[$name] = $context->Get("language");
	    }
	}
    }

    public static function	Translate($id, $substitutions = array())
    {
      $name = Configuration::Get("Language");

      if (array_key_exists($name, self::$languages) == false)
	self::Load($name);

      /*
       * if, even after loading the whole language package, the translation does
       * not exist, the id is returned instead of the translated text.
       */
      if (array_key_exists($id, self::$languages[$name]) == false)
	return $id;

      return Template::Resolve(self::$languages[$name][$id], $substitutions);
    }

    public static function	Catalogue()
    {
      $languages = Misc::Search(Configuration::Get("Path") . "/" . Configuration::Get("DirectoryLanguages"), "^.*$", Misc::OptionDirectory);

      return $languages;
    }
  }

}
?>
