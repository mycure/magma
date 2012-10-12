<?
{

  $module = new Module;

  /*
   * initialise the module.
   */
  $module->Define("system",
		  "system",
		  "This module enables the administrators the possibility to manage the system.");

  /*
   * define the views.
   */
  $module->View("system", "views/manage");

  /*
   * define the actions.
   */
  $module->Action("system:update", "actions/update");

  /*
   * finally, register the module.
   */
  $context->module = $module;

}
?>
