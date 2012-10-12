<?
{

  /*
   * pre-compute the values
   */

  $name = "<span class='user-attribute'>Name</span>: <div class='user-input-name'>" .
    Cell::Call("basic/text",
	       array("name" => "name")) .
    "</div>";

  $password = "<span class='user-attribute'>Password</span>: <div class='user-input-password'>" .
    Cell::Call("basic/password",
	       array("name" => "password")) .
    "</div>";

  $email = "<span class='user-attribute'>Email Address</span>: <div class='user-input-email'>" .
    Cell::Call("basic/text",
	       array("name" => "email")) .
    "</div>";

  $language = "<span class='user-attribute'>Language</span>: <div class='user-input-email'>" .
    " XXX " .
    "</div>";

  $captcha = "<span class='user-attribute'>Verification</span>: <div class='user-input-verification alignment-right'>" .
    Cell::Call("captcha/show") .
    "</div>" .
    "<div class='user-input-captcha'>" .
    Cell::Call("basic/text",
	       array("name" => "captcha")) .
    "</div>";

  $button = "<span class='profile-button'>" .
    Cell::Call("basic/button",
	       array("value" => "Register")) .
    "</span>";

  $fields = <<<END
$name
<br />
$password
<br />
$email
<br />
$language
<br />
$captcha
<br />
$button
END;

  $form = Cell::Call("basic/form",
		     array("action" => Configuration::Get("URL") . "/user:new",
			   "method" => "POST",
			   "body" => $fields));

  /*
   * generate the page
   */

  $page = <<<END
<div id="user">
  <h2>Register</h2>

  $form
</div>
END;

  Page::Display("Log in",
		array("contents" => $page));

}
?>
