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
  $name = Environment::$inputs["name"];

  /*
   * check the inputs
   */
  if ((is_null($relation) == true) || (is_null($name) == true))
    throw new Fault("A relation and a contact must be provided to this action");

  /*
   * retrieve the contact by name
   */
  try
    {
      $acquaintance = new User;
      $acquaintance->Lookup($name);
    }
  catch (Abortion $e)
    {
      throw new Error("This user does not seem to exist");
    }

  /*
   * check that the acquaintance is not yourself
   */
  if ($user->id == $acquaintance->id)
    throw new Error("You cannot add yourself to your '" . $relation . "' network");

  /*
   * check the existence of such a contact
   */
  if (Contact::Exist($relation, $user->id, $acquaintance->id) == true)
    throw new Error("This contact already exists");

  /*
   * behaving according to the type of network
   */
  switch (Network::$networks[$relation]["mode"])
    {
    case Network::ModePersonal:
      {
	$contact = new Contact;
	$contact->Reserve($relation, $user->id, $acquaintance->id);
	$contact->Store();

	Report::Success("The user '" . $acquaintance->name . "' has been added to your '" . $relation . "' network");

	break;
      }
    case Network::ModeHierarchical:
      {
	/*
	 * if this relation has existed before, just add it
	 */

	if (Contact::Exist($relation, $acquaintance->id, $user->id) == true)
	  {
	    $contact = new Contact;
	    $contact->Reserve($relation, $user->id, $acquaintance->id);
	    $contact->Store();

	    Report::Success("The user '" . $acquaintance->name . "' has been added to your '" . $relation . "' network");
	  }
	else
	  {
	    $contacts = array("first" => new Contact,
			      "second" => new Contact);
	    $contacts["first"]->Reserve($relation, $user->id, $acquaintance->id);
	    $contacts["second"]->Reserve($relation, $acquaintance->id, $user->id);

	    $validation = new Validation;

	    $validation->Reserve(serialize($contacts));
	    $validation->Store();

	    $link = Configuration::URL . "/contacts:confirm?code=" . $validation->code;

	    $message = <<<END
Hi {$acquaintance->name},

{$user->name} wants you to become member of her '{$relation}' network.

Please follow the link below to confirm:

  {$link}
END;

            Notification::Emit($acquaintance,
			       $user->name . " wants you to become part of her network",
			       $message);

	    Report::Success($user->name . " has been notified of your request");
	  }

	break;
      }
    }

  /*
   * forward
   */
  View::Forward("contacts");

}
?>
