<?
{

  /*
   * inputs:
   *
   *   raw
   */

  /*
   * includes
   */

  Core::Load(Configuration::Get("DirectoryCells") . "/gender/constants.php");

  /*
   * transform
   */

  switch ($context->inputs["raw"])
    {
    case $GenderMale:
      {
	$cell = "Male";
	break;
      }
    case $GenderFemale:
      {
	$cell = "Female";
	break;
      }
    default:
      {
	$cell = "";
	break;
      }
    }

  print $cell;

}
?>
