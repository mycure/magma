<?
{

  /*
   * inputs:
   *
   *   user
   *   profile
   */

  /*
   * retrieve the inputs
   */

  $user = $context->inputs["user"];
  $profile = $context->inputs["profile"];

  /*
   * generate the cell
   */

  $manager = "";
  $people = "";

  if ((isset(Environment::$session["user"]) == true) && (Environment::$session["user"]->id == $user->id))
    {
      $manager = "[" . Cell::Call("basic/anchor", array("href" => Configuration::URL . "/profile:edit",
							"text" => "Edit my profile")) . "]";
    }
  else if (isset(Environment::$session["user"]) == true)
    {
      if (Module::Exist("contact") == true)
	$people = "[" . Cell::Call("basic/anchor", array("href" => Configuration::URL . "/contact/" . $user->name . ":add",
							 "text" => "Add to my contacts")) . "]";
    }

  $cell = <<<END
{$manager}
{$people}
END;

  print $cell;

}
?>
