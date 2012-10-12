<?
{

  class Module
  {
    public $name;

    public $feature;
    public $description;

    public $imports;
    public $dependencies;
    public $needs;

    public $views;
    public $actions;
    public $events;

    public $scripts;
    public $sheets;
    public $tags;

    public function		Define($feature, $description)
    {
      $this->feature = $feature;
      $this->description = $description;

      $this->imports = array();
      $this->dependencies = array();
      $this->needs = array();

      $this->views = array();
      $this->actions = array();
      $this->events = array();

      $this->scripts = array();
      $this->sheets = array();
      $this->tags = array();
    }

    public function		Import()
    {
      $paths = func_get_args();

      $import = array("file" => func_get_arg(0),
		      "classes" => array());

      for ($i = 1; $i < func_num_args(); $i++)
	$import["classes"][] = func_get_arg($i);

      $this->imports[] = $import;
    }

    public function		Depend()
    {
      $dependencies = func_get_args();

      foreach ($dependencies as $dependency)
	$this->dependencies[] = $dependency;
    }

    public function		Need()
    {
      $needs = func_get_args();

      foreach ($needs as $need)
	$this->needs[] = $need;
    }

    public function		View($pattern, $file)
    {
      $this->views[$pattern] = array("file" => $file);
    }

    public function		Action($pattern, $file, $parameters = array())
    {
      $this->actions[$pattern] = array("file" => $file,
				       "parameters" => $parameters);
    }

    public function		Event($string, $function)
    {
      $this->events[$string] = $function;
    }

    public function		Script($file)
    {
      $this->scripts[] = $file;
    }

    public function		Sheet($file)
    {
      $this->sheets[] = $file;
    }

    public function		Tag($tag)
    {
      $this->tags[] = $tag;
    }

    public static function	Catalogue()
    {
      $modules = array();

      $names = Misc::Search(Configuration::Get("Path") . "/" . Configuration::Get("DirectoryModules"), "^manifest\.fc$", Misc::OptionFile | Misc::OptionWalk);

      foreach ($names as $name)
	{
	  if (is_null($module = self::Load(dirname($name))) == true)
	    continue;

	  $modules[] = $module->name;
	}

      return $modules;
    }

    public static function	Search($feature)
    {
      $modules = array();

      $names = Misc::Search(Configuration::Get("Path") . "/" . Configuration::Get("DirectoryModules"), "^manifest\.fc$", Misc::OptionFile | Misc::OptionWalk);

      foreach ($names as $name)
	{
	  if (is_null($module = self::Load(dirname($name))) == true)
	    continue;

	  if ($module->feature == $feature)
	    $modules[] = $module->name;
	}

      return $modules;
    }

    public static function	Load($name)
    {
      $context = new Context(array("module" => null));
      $output = null;

      Code::Call(Configuration::Get("Path") . "/" . Configuration::Get("DirectoryModules") . "/" . $name . "/manifest.fc", $context, $output);

      if (Configuration::Get("Debug") == true)
	print $output;

      if (is_null($module = $context->Get("module")) == true)
	return null;

      /*
       * set the name
       */
      $module->name = trim($name, "/");

      return $module;
    }

    /*
     * this function returns true if there is a loaded module providing
     * the given feature.
     */
    public static function	Feature($feature)
    {
      foreach (Core::$modules as $module)
	if ($module->feature == $feature)
	  return true;

      return false;
    }

    /*
     * this function checks that the given module is already loaded.
     */
    public static function	Exist($name)
    {
      foreach (Core::$modules as $module)
	if ($module->name == $name)
	  return true;

      return false;
    }

    public static function	Register($name)
    {
      if (Module::Exist($name) == true)
	return;

      if (is_null($module = self::Load($name)) == true)
	throw new Fault("Unable to register the module '$name'");

      Core::Register($module);
    }
  }

}
?>
