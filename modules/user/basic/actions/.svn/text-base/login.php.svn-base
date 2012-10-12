<?
{

  /*
   * check the inputs.
   */

  if ((isset(Environment::$inputs["name"]) == false) || (empty(Environment::$inputs["name"]) == true))
    {
      Report::Failure("Please specify your name");
      View::Forward("user/login");
    }

  if ((isset(Environment::$inputs["password"]) == false) || (empty(Environment::$inputs["password"]) == true))
    {
      Report::Failure("Please specify your password");
      View::Forward("user/login");
    }

  /*
   * retrieve the keys and inputs
   */

  $name = Environment::$inputs["name"];
  $password = Environment::$inputs["password"];

  /*
   * try to retrieve the user.
   */

  try
    {
      $user = new User;
      $user->Lookup($name);

      if ($user->password !== $password)
	throw new Exception();
    }
  catch (Abortion $e)
    {
      Report::Failure("Please specify a valid name and password");

      View::Forward("user/login");
    }

  /*
   * cache the user object
   */
  Cache::Set("user", $user);

  /*
   * the user successfully logged in
   */
  Report::Success("You are now logged in as '" . $user->name . "'");

  if (Module::Exist("profile") == true)
    View::Forward("profile");
  else
    View::Forward("system");
  // XXX[add modules such as dashboard etc.]

}
?>
