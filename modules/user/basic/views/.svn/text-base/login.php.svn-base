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

  $button = "<span class='profile-button'>" .
    Cell::Call("basic/button",
	       array("value" => "Log in")) .
    "</span>";

  $fields = <<<END
$name
<br />
$password
<br />
$button
END;

  $form = Cell::Call("basic/form",
		     array("action" => Configuration::Get("URL") . "/user:login",
			   "method" => "POST",
			   "body" => $fields));

  /*
   * generate the page
   */

  $join = Cell::Call("basic/anchor", array("href" => Configuration::Get("URL") . "/user/join",
					   "text" => "register"));
					   
  $links = <<<END
<span class="alignment-right font-60">[{$join}]</span>
END;

  $page = <<<END
<div id="user">

  <h2>Log in</h2>

  $form
  <br />
  $links
  
  
</div>
END;

  /*
   * display the page
   */
  Page::Display("Log in",
		array("contents" => $page));

}
?>
