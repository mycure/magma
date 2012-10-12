<?
{

  /*
   * check the access.
   */
  Keeper::User();

  /*
   * retrieve the user and profile objects.
   */

  $user = unserialize(Cache::Get("user"));

  $profile = new Profile;
  $profile->Lookup($user->id);

  /*
   * check the avatar.
   */

  if ((isset(Environment::$files["avatar"]) == true) && (empty(Environment::$files["avatar"]["name"]) == false))
    {
      // XXX[this constant should be relocated]
      $FILE_SIZE = 20000;

      $types = array("image/gif", "image/jpeg", "image/pjpeg");

      $file = Environment::$files["avatar"];

      if (in_array($file["type"], $types) == false)
	throw new Error("This type '" . $file["type"] . "'of file is not accepted");

      if ($file["size"] > $FILE_SIZE)
	throw new Error("The avatar size should not exceed '" . $FILE_SIZE . "'");

      $profile->avatar = sha1(file_get_contents($file["tmp_name"])) . ".avtr";

      $path = Configuration::Get("DirectoryStore") . "/profile/" . $profile->avatar;

      if (file_exists($path) == false)
	move_uploaded_file($file["tmp_name"], $path);
    }

  /*
   * update the profile.
   */

  $profile->identity = Environment::$inputs["identity"];
  $profile->gender = Atom::Call("gender/encode",
				array("gender" => Environment::$inputs["gender"]));
  $profile->location = Environment::$inputs["location"];
  $profile->dob = Atom::Call("date/encode",
			     array("day" => Environment::$inputs["day"],
				   "month" => Environment::$inputs["month"],
				   "year" => Environment::$inputs["year"]));
  $profile->website = Environment::$inputs["website"];
  $profile->description = Environment::$inputs["description"];
  $profile->signature = Environment::$inputs["signature"];
  $profile->access = Environment::$inputs["access"];

  $profile->Store();

  View::Forward("profile");

}
?>
