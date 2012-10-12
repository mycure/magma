<?
{

  /*
   * retrieve the keys and inputs
   */
  // XXX is_null
  if (isset(Environment::$inputs["name"]) == false)
    throw new Error("A user name is to be provided");

  $name = Environment::$inputs["name"];

  /*
   * check that the user is connected.
   */
  if (isset(Environment::$session["user"]) == false)
    throw new Error("You must be logged in to access this page");

  /*
   * retrieve the user object.
   */

  $user = Environment::$session["user"];

  print "XXX";

}
?>
