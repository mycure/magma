<?
{

  /*
   * retrieve inputs
   */
  $name = $context->name;
  $password = $context->password;
  $verification = $context->verification;
  $email = $context->email;
  $language = $context->language;

  /*
   * check inputs
   */
  if ((empty($name) == true) || (ereg("^[A-Za-z0-9.-_]{3,32}$", $name) == false))
    {
      Report::Failure("user:report:name");
      Atom::Yield(false);
    }

  if ((empty($password) == true) || (ereg("^.{6,32}$", $password) == false))
    {
      Report::Failure("user:report:password");
      Atom::Yield(false);
    }

  if ($password != $verification)
    {
      Report::Failure("user:report:different");
      Atom::Yield(false);
    }

  if ((empty($email) == true) || (ereg("^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$", $email) == false))
    {
      Report::Failure("user:report:email");
      Atom::Yield(false);
    }

  /*
   * check that this user name does not already exist
   */
  if (User::Exist($name) == true)
    {
      Report::Failure("user:report:exist");
      View::Forward("setup");
    }

  /*
   * create the user object
   */
  $user = new User;
  $user->Reserve($name, $password, $email, $language, User::RoleAdministrator);
  $user->Store();

  /*
   * return the user object
   */
  $context->user = $user;

  Atom::Yield(true);

}
?>
