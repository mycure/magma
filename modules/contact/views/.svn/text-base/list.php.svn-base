<?
{

  /*
   * check the access.
   */
  if (isset(Environment::$session["user"]) == false)
    throw new Error("You must be logged in to access this page");

  /*
   * retrieve the user object.
   */

  $user = Environment::$session["user"];

  /*
   * generate the networks for each type of acquaintance
   */

  $page = <<<END
<h2>Contacts</h2>
END;

  foreach (Network::$networks as $relation => $type)
    {
      $network = new Network;
      $network->Lookup($relation, $user->id);

      $contacts = $network->Retrieve();

      $page .= <<<END
<h3>{$relation}</h3>

<ul>
END;

      foreach ($contacts as $contact)
	{
	  $acquaintance = new User;
	  $acquaintance->Load($contact);

	  $link = "[" . Atom::Call("basic/anchor",
				   array("href" => Configuration::URL . "/contacts:delete?relation=" . $relation . "&acquaintance=" . $acquaintance->id,
					 "text" => "delete")) . "]";

	  $page .= <<<END
<li>
  {$acquaintance->name} {$link}
</li>
END;
	}

      $page .= <<<END
</ul>
<br />
END;

      /*
       * access control form
       */
      $fields = Atom::Call("access/selector", array("name" => "access", "access" => $network->access)) .
	Atom::Call("basic/button", array("value" => "Modify access permissions));

      $form = Atom::Call("basic/form",
			 array("action" => Configuration::URL . "/contacts:access",
			       "method" => "POST",
			       "body" => $fields));

      $page .= <<<END
{$form}
END;

      /*
       * add form
       */
      $fields = Atom::Call("basic/text", array("name" => "name)) .
	Atom::Call("basic/hidden", array("name" => "relation,
					       "value" => $relation)) .
	Atom::Call("basic/button", array("value" => "Add this user));

      $form = Atom::Call("basic/form",
			 array("action" => Configuration::URL . "/contacts:new",
			       "method" => "POST",
			       "body" => $fields));

      $page .= <<<END
{$form}
END;
    }

  /*
   * display the page.
   */

  Layout::Display(Configuration::Layout,
		  $user->name . "'s Contacts",
		  array("contents" => $page));

}
?>
