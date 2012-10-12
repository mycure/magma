<?
{

  class Atom
  {
    public static function	Call($name, $parameters = array(), $result = "result", $forwarder = null)
    {
      if (strpos($name, "#") == false)
	$path = Configuration::Get("Path") . "/" . Configuration::Get("DirectoryAtoms") . "/" . trim($name) . ".fc";
      else
	{
	  list($module, $name) = split("#", $name);

	  $path = Configuration::Get("Path") . "/" . Configuration::Get("DirectoryModules") . "/" . trim($module) . "/" . Configuration::Get("DirectoryAtoms") . "/" . trim($name) . ".fc";
	}

      $context = new Context($parameters);
      $output = null;

      $value = Code::Call($path, $context, $output);

      if (Configuration::Get("Debug") == true)
	print $output;

      if ((is_null($forwarder) == false) && ($value == false))
	View::Forward($forwarder);

      return $context->Get[$result];
    }
  }

}
?>
