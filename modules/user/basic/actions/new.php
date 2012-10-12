<?
{

  /*
   * retrieve inputs
   */

  $name = Environment::$inputs["name"];
  $password = Environment::$inputs["password"];
  $email = Environment::$inputs["email"];
  $language = Environment::$inputs["language"];

  /*
   * check inputs
   */

  if ((empty($name) == true) || (ereg("^[A-Za-z0-9.-_]{3,32}$", $name) == false))
    {
      Report::Failure("The name must be, at least, three characters long and must be composed of letters, numbers, dots, dashes and underscores only");
      View::Forward("user/join");
    }

  if ((empty($password) == true) || (ereg("^.{6,32}$", $password) == false))
    {
      Report::Failure("The password must be, at least, six characters long");
      View::Forward("user/join");
    }

  if ((empty($email) == true) || (ereg("^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$", $email) == false))
    {
      Report::Failure("The email address does not seem valid");
      View::Forward("user/join");
    }

  $captcha = Atom::Call("captcha/verify",
			array("name" => "captcha"));

  if (empty($captcha) == true)
    {
      Report::Failure("Please enter a correct verification code");
      View::Forward("user/join");
    }

  /*
   * check that this user name does not already exist
   */

  if (User::Exist($name) == true)
    {
      Report::Failure("This user name is not available");
      View::Forward("user/join");
    }

  /*
   * create the user object
   */

  $user = new User;
  $user->Reserve($name, $password, $email, $language, User::RoleUser);

  /*
   * create a validation object
   */

  $validation = new Validation;
  $validation->Reserve(serialize($user));
  $validation->Store();

  /*
   * generate the email
   */

  $link = Configuration::Get("URL") . "/user:confirm?code=" . $validation->code;
  $site = Configuration::Get("SiteName");

  $message = <<<END
Hello {$user->name},

Your registration on {$site} has been recorded.

It is now required that you confirm your registration by visiting the
following link:

  {$link}
END;

  Notification::Emit($user,
		     "Registration on " . Configuration::Get("SiteName"),
		     $message);

  /*
   * report the success
   */

  Report::Success("An email has been sent to you containing information for completing your registration");

  View::Forward("user/login");

}
?>
