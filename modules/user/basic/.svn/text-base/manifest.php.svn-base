<?
{

  $module = new Module;

  /*
   * initialise the module.
   */
  $module->Define("user",
		  "This module provides a user entity.");

  /*
   * import the module-specific objects.
   */
  $module->Import("objects/user.php",
		  "User");

  /*
   * define the dependencies.
   */
  $module->Depend("notification");
  $module->Depend("validation");

  /*
   * define the views.
   */
  $module->View("user", "views/home");
  $module->View("user/join", "views/join");
  $module->View("user/leave", "views/leave");
  $module->View("user/login", "views/login");

  /*
   * define the actions.
   */
  $module->Action("user:new", "actions/new",
		  array("name", "password", "email", "language", "captcha"));
  $module->Action("user:delete", "actions/delete");
  $module->Action("user:confirm", "actions/confirm",
		  array("code"));
  $module->Action("user:login", "actions/login",
		  array("name", "password"));

  /*
   * register an additional sheet
   */
  $module->Sheet("sheets/layout.css");

  /*
   * return the module through the context
   */

  $context->module = $module;

}
?>
