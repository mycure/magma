<?
{

  /*
   * retrieve inputs
   */
  $user = $context->user;

  /*
   * re-check
   */
  if (User::Exist($user->name) == true)
    {
      Report::Failure("Unfortunately, this user name seems to have been taken before the registration process terminated");
      Atom::Yield(false);
    }

  /*
   * store the object
   */
  $user->Store();

  /*
   * trigger the user event
   */
  Event::Trigger("user#new", $user);

  /*
   * return
   */
  Atom::Yield(true);

}
?>
