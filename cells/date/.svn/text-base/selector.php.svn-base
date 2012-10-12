<?
{

  /*
   * inputs:
   *
   *   dob [optional]
   *   day [optional]
   *   month [optional]
   *   year [optional]
   *   prefix [optional]
   */

  /*
   * includes
   */

  Core::Load(Configuration::Get("DirectoryCells") . "/date/constants.php");

  /*
   * handle options
   */

  if (is_null($context->inputs["dob"]) == true)
    {
      if (isset($context->inputs["day"]) == true)
	$day = $context->inputs["day"];
      else
	$day = "";

      if (isset($context->inputs["month"]) == true)
	$month = $context->inputs["month"];
      else
	$month = "";

      if (isset($context->inputs["year"]) == true)
	$year = $context->inputs["year"];
      else
	$year = "";
    }
  else
    {
      $dob = explode(":", $context->inputs["dob"]);

      $day = $dob[0];
      $month = $dob[1];
      $year = $dob[2];
    }

  if (isset($context->inputs["prefix"]) == true)
    $prefix = $context->inputs["prefix"];
  else
    $prefix = "";

  /*
   * generate the cell.
   */

  $cell = Cell::Call("basic/select",
		     array("name" => "{$prefix}day",
			   "items" => array_combine(array_values($Days), array_keys($Days)),
			   "selected" => $day)) .
          Cell::Call("basic/select",
		     array("name" => "{$prefix}month",
			   "items" => array_combine(array_values($Months), array_keys($Months)),
			   "selected" => $month)) .
          Cell::Call("basic/select",
		     array("name" => "{$prefix}year",
			   "items" => array_combine(array_values($Years), array_keys($Years)),
			   "selected" => $year));

  print $cell;

}
?>
