<?
{

  $module = new Module;

  /*
   * initialise the module.
   */
  $module->Define("contact",
		  "contact",
		  "This module enables users to build relations between each others.");

  /*
   * import the module-specific objects.
   */
  $module->Import("objects/contact.php",
		  "Contact");
  $module->Import("objects/network.php",
		  "Network");
  $module->Import("events/user.php");

  /*
   * define the dependencies.
   */
  $module->Depend("user");
  $module->Depend("validation");
  $module->Depend("notification");

  /*
   * define views.
   */
  $module->View("contacts", "views/list");
  $module->View("contacts:add", "views/add",
		array("user"));

  /*
   * define actions.
   */
  $module->Action("contacts:new", "actions/new",
		  array("relation", "name"));
  $module->Action("contacts:delete", "actions/delete",
		  array("relation", "acquaintance"));
  $module->Action("contacts:confirm", "actions/confirm",
		  array("code"));

  /*
   * define the events the module is expecting.
   */
  $module->Event("user#new", "ContactEvent_UserNew");

  /*
   * finally, register the module.
   */
  // XXX Core::Register($module);

}
?>
