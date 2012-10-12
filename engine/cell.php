<?
{

  class Cell
  {
    public static function	Call($name, $parameters = array())
    {
      if (strpos($name, "#") == false)
	$path = Configuration::Get("Path") . "/" . Configuration::Get("DirectoryCells") . "/" . trim($name) . ".fc";
      else
	{
	  list($module, $name) = split("#", $name);

	  $path = Configuration::Get("Path") . "/" . Configuration::Get("DirectoryModules") . "/" . trim($module) . "/cells/" . trim($name) . ".fc";
	}

      $context = new Context($parameters);
      $output = null;

      Code::Call($path, $context, $output);

      return $output;
    }
  }

}
?>
