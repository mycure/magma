<?
{

  class Canvas
  {
    public static function	Load()
    {
      $context = new Context;
      $output = null;

      Code::Call(Configuration::Get("DirectoryCanvas") . "/" . Configuration::Get("Canvas") . "/canvas.fc", $context, $output);

      if (Configuration::Get("Debug") == true)
	print $output;
    }

    public static function	Template()
    {
      $path = Configuration::Get("DirectoryCanvas") . "/" . Configuration::Get("Canvas") . "/canvas.tmpl";

      if (is_file($path) == false)
	throw new Fault("The canvas' template file '$path' does not exist");

      $template = Misc::Load($path);

      return $template;
    }
  }

}
?>
