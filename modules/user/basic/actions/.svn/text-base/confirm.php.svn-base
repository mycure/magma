<?
{

  /*
   * check the inputs.
   */

  if (is_null(Environment::$inputs["code"]) == true)
    {
      Report::Failure("A validation code must be provided when accessing this page");
      View::Forward("user/login");
    }

  $code = Environment::$inputs["code"];

  /*
   * retrieve the validation object
   */

  $validation = new Validation;
  $validation->Lookup($code);

  /*
   * extract the user object and store it.
   */

  echo "XXX[Validation::Information() qui retourne un truc de-serialize";
  exit();

  $user = unserialize($validation->information);

  if (User::Exist($user->name) == true)
    {
      $validation->Destroy();

      Report::Failure("Unfortunately, this user name seems to have been taken between your registration and validation");
      View::Forward("user/login");
    }

  $user->Store();

  /*
   * trigger the user event
   */

  Event::Trigger("user#new", $user);

  /*
   * destroy the validation object
   */

  $validation->Destroy();

  /*
   * notify the user, report and forward
   */

  Report::Success("Your registration is now complete");

  View::Forward("user/login");

}
?>
