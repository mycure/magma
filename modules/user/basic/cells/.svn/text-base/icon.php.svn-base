<?
{

  /*
   * inputs:
   *
   *   id
   */

  /*
   * retrieve the profile from a given user id.
   */

  $user = new User;
  $user->Load($inputs["id"]);

  /*
   * if the profile module is loaded, also display the avatar.
   */

  if (Module::Exist("profile") == true)
    {
      $avatar = Atom::Call("profile!avatar",
			   array("user" => $user->id));
    }

  print $user->name;

}
?>
