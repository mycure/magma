<?
{

  /*
   * inputs:
   *
   *   name
   *   access [optional]
   */

  /*
   * handle options
   */

  if (isset($context->inputs["access"]) == true)
    $access = $context->inputs["access"];
  else
    $access = null;

  /*
   * generate the cell
   */

  $cell = Cell::Call("basic/select",
		     array("name" => $context->inputs["name"],
			   "groups" => true,
			   "items" => Access::Descriptors(),
			   "selected" => $access));

  print $cell;

}
?>
