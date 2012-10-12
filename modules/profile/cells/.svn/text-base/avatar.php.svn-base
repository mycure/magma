<?
{

  /*
   * inputs:
   *
   *   user | profile | id
   */

  /*
   * retrieve the profile from a given user name.
   */

  if (isset($context->inputs["profile"]) == true)
    $profile = $context->inputs["profile"];
  else
    $profile = new Profile;

  if (isset($context->inputs["id"]) == true)
    $profile->Load($context->inputs["id"]);

  if (isset($context->inputs["user"]) == true)
    {
      $user = new User;
      $user->Lookup($context->inputs["user"]);

      $profile->Lookup($user->id);
    }

  /*
   * generate the cell
   */

  if (is_null($profile->avatar) == false)
    $avatar = Cell::Call("basic/img", array("src" => Configuration::Get("URL") . "/" . Configuration::Get("DirectoryStore") . "/profile/" . $profile->avatar,
					    "alt" => "[avatar]"));
  else
    $avatar = Cell::Call("basic/img", array("src" => Configuration::Get("URL") . "/" . Configuration::Get("DirectoryStore") . "/profile/default.avtr",
					    "alt" => "[avatar]"));

  print $avatar;

}
?>
