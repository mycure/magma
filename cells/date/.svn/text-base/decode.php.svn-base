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

  Core::Load(Configuration::Get("DirectoryCells") . "/date/constants.php");

  /*
   * cut the raw forming an array
   */

  $dob = explode(":", $context->inputs["raw"]);

  $day = $dob[0];
  $month = $dob[1];
  $year = $dob[2];

  if (empty($day) == false)
    print $Days[$day];

  print " ";

  if (empty($month) == false)
    print $Months[$month];

  print " ";

  if (empty($year) == false)
    print " " . $Years[$year];

}
?>
