<?
{

  /*
   * retrieve the keys and inputs
   *
   * the first part handles the '/profile' view, with no key. in such
   * a case, the system uses the logged-in user name.
   */
  if (isset(Environment::$keys["name"]) == false)
    {
      if (isset(Environment::$session["cache"]["user"]) == false)
	throw new Error("You must be logged in to be able to access your profile");

      $name = unserialize(Environment::$session["cache"]["user"])->name;
    }
  else
    $name = Environment::$keys["name"];

  /*
   * retrieve the user and profile
   */
  $user = new User;
  $user->Lookup($name);

  $profile = new Profile;
  $profile->Lookup($user->id);

  /*
   * pre-compute the values
   */
  $name = $user->name;

  $avatar = Cell::Call("profile#avatar",
		       array("profile" => $profile));

  if (is_null($profile->identity) == false)
    $identity = <<<END
<div class="attribute"><span class="profile-attribute">Identity</span> :</div> <div class="value"><span class="profile-value">{$profile->identity}</span></div><br />
END;
  else
    $identity = "";


  if (is_null($profile->gender) == false)
    {
      $string = Cell::Call("gender/decode",
			   array("raw" => $profile->gender));

      $gender = <<<END
<div class="attribute"><span class="profile-attribute">Gender</span> :</div> <div class="value"><span class="profile-value">{$string}</span></div><br />
END;
    }
  else
    $gender = "";

  if (is_null($profile->dob) == false)
    {
      $string = Cell::Call("date/decode",
			   array("raw" => $profile->dob));

      $dob = <<<END
<div class="attribute"><span class="profile-attribute">Date of Birth</span> :</div> <div class="value"><span class="profile-value">{$string}</span></div><br />
END;
    }
  else
    $dob = "";

  if (is_null($profile->location) == false)
    $location = <<<END
<div class="attribute"><span class="profile-attribute">Location</span> :</div> <div class="value"><span class="profile-value">{$profile->location}</span></div><br />
END;
  else
    $location = "";

  if (is_null($profile->website) == false)
    {
      $anchor = Cell::Call("basic/anchor", array("href" => $profile->website,
						 "text" => $profile->website));

      $website = <<<END
<div class="attribute"><span class="profile-attribute">Website</span> :</div> <div class="value"><span class="profile-value">$anchor</span></div><br />
END;
    }
  else
    $website = "";

  if (is_null($profile->description) == false)
    $description = <<<END
<div class="attribute"><span class="profile-attribute">Description</span> :</div> <div class="value"><span class="profile-value">{$profile->description}</span></div><br />
END;
  else
    $description = "";

  if (is_null($profile->signature) == false)
    $signature = <<<END
<div class="attribute"><span class="profile-attribute">Signature</span> :</div> <div class="value"><span class="profile-value">{$profile->signature}</span></div><br />
END;
  else
    $signature = "";

  $operations = Cell::Call("profile#operations",
			   array("user" => $user,
				 "profile" => $profile));

  /*
   * generate the page
   */
  $page = <<<END
<div id="profile">
  <div id="profile-avatar">
    $avatar
  </div>

  <h2>$name</h2>

  $identity
  $gender
  $location
  $dob
  $website
  $description
  $signature
  <br />
  $operations

</div>
END;

  Page::Display($user->name . "'s Profile",
		array("contents" => $page));

}
?>
