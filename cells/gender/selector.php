<?
{

  /*
   * inputs:
   *
   *   name
   *   gender [optional]
   */

  /*
   * includes
   */

  Core::Load(Configuration::Get("DirectoryCells") . "/gender/constants.php");

  /*
   * handle options
   */

  if (isset($context->inputs["gender"]) == true)
    $gender = $context->inputs["gender"];
  else
    $gender = $GenderUnknown;

  /*
   * generate the cell.
   */

  $cell = Cell::Call("basic/radio",
		     array("name" => "gender",
			   "items" => array($GenderUnknown => "Unknown",
					    $GenderMale => "Male",
					    $GenderFemale => "Female"),
			   "checked" => $gender,
			   "class" => "date-selector"));

  print $cell;

}
?>
