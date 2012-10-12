<?
{

  /*
   * check the access.
   */
  if (isset(Environment::$session["user"]) == false)
    throw new Error("You must be logged in to access this page");

  /*
   * retrieve the user object
   */
  $user = Environment::$session["user"];

  /*
   * retrieve the inputs
   */
  $relation = Environment::$inputs["relation"];
  $acquaintance = Environment::$inputs["acquaintance"];

  /*
   * check the inputs
   */

  if ((is_null($relation) == true) || (is_null($acquaintance) == true))
    throw new Fault("A relation and a contact must be provided to this action");

  /*
   * retrieve the contact by name
   */
  if (Contact::Exist($relation, $user->id, $acquaintance) == false)
    throw new Fault("This contact does not exist in this network");

  /*
   * behaving according to the type of network
   */
  switch (Network::$networks[$relation]["mode"])
    {
    case Network::ModePersonal:
      {
	$contact = new Contact;
	$contact->Lookup($relation, $user->id, $acquaintance);
	$contact->Destroy();

	break;
      }
    case Network::ModeHierarchical:
      {
	$contact = new Contact;
	$contact->Lookup($relation, $user->id, $acquaintance);
	$contact->Destroy();

	break;
      }
    }

  /*
   * forward
   */

  Report::Success("The contact has been removed from your '" . $relation . "' network");

  View::Forward("contacts");

}
?>
