<?
{

  class Engine
  {
    public static function	Install()
    {
      Metadata::Install();

      Identifier::Install();
      Core::Install();
    }

    public static function	Import($file)
    {
      require ($file);
    }

    public static function	Load()
    {
      $imports = array("engine/abortion.php",
		       "engine/access.php",
		       "engine/action.php",
		       "engine/atom.php",
		       "engine/cache.php",
		       "engine/canvas.php",
		       "engine/cell.php",
		       "engine/check.php",
		       "engine/code.php",
		       "engine/configuration.php",
		       "engine/context.php",
		       "engine/core.php",
		       "engine/database.php",
		       "engine/entity.php",
		       "engine/event.php",
		       "engine/environment.php",
		       "engine/exception.php",
		       "engine/handler.php",
		       "engine/identifier.php",
		       "engine/keep.php",
		       "engine/language.php",
		       "engine/metadata.php",
		       "engine/misc.php",
		       "engine/module.php",
		       "engine/page.php",
		       "engine/report.php",
		       "engine/schema.php",
		       "engine/script.php",
		       "engine/search.php",
		       "engine/sheet.php",
		       "engine/tag.php",
		       "engine/template.php",
		       "engine/theme.php",
		       "engine/trace.php",
		       "engine/view.php",

		       "configuration/site.php");

      foreach ($imports as $import)
	self::Import($import);
    }

    public static function	Initialise()
    {
      Environment::Initialise();
      Cache::Initialise();
      Report::Initialise();
      Language::Initialise();
    }

    public static function	Start($modules)
    {
      foreach ($modules as $module)
	Module::Register($module);

      Core::Validate();
    }
  }

}
?>
