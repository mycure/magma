<?
{

  $module = new Module;

  /*
   * initialise the module.
   */
  $module->Define("profile",
		  "profile",
		  "This module enables users to build an online profile.");

  /*
   * import the module-specific objects.
   */
  $module->Import("objects/profile.php",
		  "Profile");
  $module->Import("events/user.php");

  /*
   * define the features the module relies on.
   */
  $module->Need("user");

  /*
   * define views.
   */
  //  $module->View("profile/%name%", "views/show");
  $module->View("profile", "views/show");
  $module->View("profile/edit", "views/edit");

  /*
   * define actions.
   */
  $module->Action("profile:modify", "actions/modify",
		  array("identity", "gender", "location", "day", "month",
			"year", "website", "description", "signature", "access"));

  /*
   * define the events the module is expecting.
   */
  $module->Event("user#new", "ProfileEvent_UserNew");

  /*
   * finally, register the module.
   */
  $context->module = $module;

}
?>
