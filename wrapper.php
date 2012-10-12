<?
{

  /*
   * load the engine
   */
  require ("engine/engine.php");

  /*
   * load the engine
   */
  Engine::Load();

  /*
   * connect to the database
   */
  Database::Connect();

  /*
   * initialise the engine
   */
  Engine::Initialise();

  /*
   * pick the modules to load at the engine startup.
   */
  if (Metadata::Ready() == false)
    $modules = Core::$defaults;
  else
    $modules = Metadata::Get("modules");

  /*
   * start the engine
   */
  Engine::Start($modules);

  /*
   * if no URN is given, forward to the log in page, assuming
   * that there is one...
   */
  if (empty($_REQUEST["URN"]) == true)
    {
      if (Check::Feature("user") == false)
	throw new Fault("Unable to display the user login page as the 'user' feature is missing");

      View::Forward("user/login");
    }
  else
    {
      /*
       * trigger the proper view/action
       */
      if (strstr($_REQUEST["URN"], ":") === false)
	View::Trigger($_REQUEST["URN"]);
      else
	Action::Trigger($_REQUEST["URN"]);
    }

}
?>
