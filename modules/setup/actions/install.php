<?
{

  /*
   * retrieve inputs
   */

  $modules = Environment::$inputs["modules"];

  $name = Environment::$inputs["admin-name"];
  $password = Environment::$inputs["admin-password"];
  $verification = Environment::$inputs["admin-verification"];
  $email = Environment::$inputs["admin-email"];
  $language = Environment::$inputs["admin-language"];

  /*
   * load the modules.
   */

  foreach ($modules as $module)
    Module::Register($module);

  /*
   * destroy the previous tables.
   */
  Database::Flush();

  /*
   * install the engine-specific tables
   */
  Engine::Install();

  /*
   * install the modules-specific tables.
   */
  Entity::Call("Install");

  /*
   * flush the cache
   */
  Cache::Flush();

  /*
   * call the user creation atom
   */
  if ($atom->Call("user#new",
		  array("name" => $name,
			"password" => $password,
			"verification" => $verification,
			"email" => $email,
			"language" => $language),
		  $user) == false)
    View::Forward("setup");

  /*
   * report the success
   */

  Report::Success("setup:report:success");

  View::Forward();

}
?>
