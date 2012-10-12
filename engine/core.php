<?
{

  class Core
  {
    public static $defaults = array("setup");

    public static $modules = array();

    public static function	Install($modules = null)
    {
      if (is_null($modules) == true)
	{
	  $modules = array();

	  foreach (self::$modules as $module)
	    $modules[] = $module->name;
	}

      Metadata::Create("modules", $modules);
    }

    public static function	Dump()
    {
      print "[modules]<br />";

      foreach (self::$modules as $module)
	print "  " . $module->name . "<br />";
    }

    public static function	Register(Module $module)
    {
      self::$modules[] = $module;

      $directory = Configuration::Get("Path") . "/" . Configuration::Get("DirectoryModules");

      /*
       * dependencies
       */
      foreach ($module->dependencies as $dependency)
	{
	  if (Module::Exist($dependency) == false)
	    Module::Register($dependency);
	}

      /*
       * imports
       */
      foreach ($module->imports as $import)
	{
	  foreach ($import["classes"] as $class)
	    Entity::Register($class);

	  Engine::Import($directory . "/" . $module->name . "/" . $import["file"]);
	}

      /*
       * views
       */
      foreach ($module->views as $pattern => $action)
	View::Register($pattern, $directory . "/" . $module->name . "/" . $action["file"] . ".fc");

      /*
       * actions
       */
      foreach ($module->actions as $pattern => $action)
	Action::Register($pattern, $directory . "/" . $module->name . "/" . $action["file"] . ".fc", $action["parameters"]);

      /*
       * events
       */
      foreach ($module->events as $string => $function)
	Event::Register($string, $function);

      /*
       * scripts
       */
      foreach ($module->scripts as $file)
	Script::Register($directory . "/" . $module->name . "/" . $file);

      /*
       * sheets
       */
      foreach ($module->sheets as $file)
	Sheet::Register($directory . "/" . $module->name . "/" . $file);

      /*
       * tag
       */
      foreach ($module->tags as $tag)
	Tag::Register($tag);

      /*
       * language
       */
      if (is_dir($directory . "/" . $module->name . "/languages") == true)
	Language::Add($module->name);
    }

    public static function	Validate()
    {
      foreach (self::$modules as $module)
	{
	  foreach ($module->needs as $need)
	    {
	      if (Module::Feature($need) == false)
		throw new Fault("The module '" . $module->name . "' requires the '" . $need . "' feature which does not seem to be provided by any module");
	    }
	}
    }
  }

}
?>
