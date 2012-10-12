<?
{

  /*
   * check the inputs.
   */

  if (is_null(Environment::$inputs["code"]) == true)
    {
      Report::Failure("A validation code must be provided when accessing this page");
      View::Forward("contacts");
    }

  $code = Environment::$inputs["code"];

  /*
   * retrieve the validation object
   */

  $validation = new Validation;
  $validation->Lookup($code);

  /*
   * extract the contact object and store it.
   */

  $contacts = unserialize($validation->information);

  $relation = $contacts["first"]->relation;
  $first = $contacts["first"];
  $second = $contacts["second"];

  /*
   * load the acquaintance user object.
   */

  try
    {
      $acquaintance = new User;
      $acquaintance->Load($second->user);
    }
  catch (Abortion $e)
    {
      throw new Error("This user does not seem to exist, hence cannot be added to your '" . $relation . "' network");
    }

  /*
   * check the existence of such a contact
   */
  if (Contact::Exist($first->relation, $first->user, $first->contact) == true)
    {
      $validation->Destroy();

      Report::Failure("Sorry but it looks like this contact already exists in your '" . $relation . "' network");
      View::Forward("contacts");
    }

  /*
   * behaving according to the type of network
   */
  switch (Network::$networks[$relation]["mode"])
    {
      case Network::ModeHierarchical:
	{
	  $first->Store();

	  /*
	   * make sure it does not exist already.
	   */
	  if (Contact::Exist($second->relation, $second->user, $second->contact) == false)
	    $second->Store();

	  break;
	}
    }

  /*
   * destroy the validation object
   */

  $validation->Destroy();

  /*
   * notify the user, report and forward
   */

  Report::Success("The user '" . $acquaintance->name . "' has been successfully added to your '" . $relation . "' network");

  View::Forward("contacts");

}
?>
