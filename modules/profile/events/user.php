<?
{

  function			ProfileEvent_UserNew($user)
  {
    if (is_null($user) == true)
      throw new Fault("A user object should be carried by the event");

    $profile = new Profile;

    $profile->Reserve($user->id, null, null, null, null, null, null, null, null, Access::TypePublic);
    $profile->Store();
  }

}
?>
