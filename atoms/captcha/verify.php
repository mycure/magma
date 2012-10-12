<?
{

  /*
   * inputs;
   *
   *   name
   */

  Core::Load(Configuration::Get("DirectoryUtils") . "/secureimage/secureimage.php");

  $securimage = new Securimage();

  if ($securimage->check(Environment::$inputs[$context->inputs["name"]]) == true)
    $context->output = true;
  else
    $context->output = false;

}
?>
