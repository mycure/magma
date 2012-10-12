<?
{

  /*
   * check the access.
   */
  if (!(isset(Environment::$session["cache"]["user"]) == true))
    throw new Error("You cannot edit your profile as your are not logged in");

  /*
   * retrieve the user and profile objects.
   */

  $user = unserialize(Environment::$session["cache"]["user"]);

  $profile = new Profile;
  $profile->Lookup($user->id);

  /*
   * pre-compute the inputs
   */

  $name = $user->name;

  $icon = Cell::Call("profile#avatar",
		     array("user" => $user->name));

  $avatar = "<div class='attribute'><span class='profile-attribute'>Avatar</span> :</div> <span class='profile-input-avatar'>" .
    Cell::Call("basic/file",
	       array("name" => "avatar"));

  $identity = "<div class='attribute'><span class='profile-attribute'>Identity</span> :</div> <div class='profile-input-identity'>" .
    Cell::Call("basic/text",
	       array("name" => "identity",
		     "value" => $profile->identity)) .
    "</div>";

  $gender = "<div class='attribute'><span class='profile-attribute'>Gender</span> :</div> <span class='profile-input-gender'>" .
    Cell::Call("gender/selector",
	       array("name" => "gender",
		     "gender" => $profile->gender,
		     "class" => "styled")) .
    "</span><hr class='clearfloat' />";

  $location = "<div class='attribute'><span class='profile-attribute'>Location</span> :</div> <span class='profile-input-location'>" .
    Cell::Call("basic/text",
	       array("name" => "location",
		     "value" => $profile->location)) .
    "</span>";

  $dob = "<div class='attribute'><span class='profile-attribute'>Date of Birth</span> :</div> <span class='profile-input-dob'>" .
    Cell::Call("date/selector",
	       array("dob" => $profile->dob)) .
    "</span>";

  $website = "<div class='attribute'><span class='profile-attribute'>Website</span> :</div> <span class='profile-input-website'>" .
    Cell::Call("basic/text",
	       array("name" => "website",
		     "value" => $profile->website)) .
    "</span>";

  $description = "<div class='attribute'><span class='profile-attribute'>Description</span> :</div> <span class='profile-input-description'>" .
    Cell::Call("basic/textarea",
	       array("name" => "description",
		     "text" => $profile->description)) .
    "</span>";

  $signature = "<div class='attribute'><span class='profile-attribute'>Signature</span> :</div> <span class='profile-input-signature'>" .
    Cell::Call("basic/textarea",
	       array("name" => "signature",
		     "text" => $profile->signature)) .
    "</span>";

  $access = "<div class='attribute'><span class='profile-attribute'>Access</span> :</div> <span class='profile-input-access'>" .
    Cell::Call("access/selector",
	       array("name" => "access",
		     "access" => $profile->access)) .
    "</span>";

  $button = "<span class='profile-button'>" .
    Cell::Call("basic/button",
	       array("value" => "Save")) .
    "</span>";

  $fields = <<<END
$avatar
<br />
$identity
<br />
$gender
<br />
$location
<br />
$dob
<br />
$website
<br />
$description
<br />
$signature
<br />
$access
<br />
$button
END;

  $form = Cell::Call("basic/form",
		     array("action" => Configuration::Get("URL") . "/profile:modify",
			   "method" => "POST",
			   "enctype" => "multipart/form-data",
			   "body" => $fields));

  /*
   * generate the page
   */

  $page = <<<END
<div id="profile">
  <div id="profile-avatar">
    $icon
  </div>

  <h2>$name</h2>

  <div class="clear"></div>

  $form
</div>
END;

  Page::Display($name . "'s Profile",
		array("contents" => $page,
		      "sheets" => array(Configuration::Get("URL") . "/modules/profile/sheets/layout.css"),
		      "scripts" => array(Configuration::Get("URL") . "/modules/profile/js/custom-form-elements.js")));

}
?>
