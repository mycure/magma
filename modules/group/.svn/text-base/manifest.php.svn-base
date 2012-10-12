<?
{

  $module = new Module;

  /*
   * initialise the module.
   */
  $module->Define("group",
		  "group",
		  "This module provides users the possibility to group friends, groups, communities etc. into groups and so forth.");

  /*
   * specify the requirements.
   */
  $module->Depend("user");

  /*
   * import the module-specific objects.
   */
  $module->Import("objects/group.php",
		  "Group");

  /*
   * define the views.
   */
  $module->View("group", "views/list");

  $module->View("group/new", "views/new");
  $module->View("group/delete", "views/delete");
  $module->View("group/edit", "views/edit");

  /*
   * define the performing actions.
   */
  $module->Action("group/new/%group%", "actions/new",
		  array("members"));
  $module->Action("group/delete/%group%", "actions/delete");
  $module->Action("group/edit/%group%", "actions/edit",
		  array("members"));

  /*
   * finally, register the module.
   */
  // XXX Core::Register($module);

}
?>
