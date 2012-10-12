<?
{

  class Theme
  {
    public static function	Load()
    {
      $context = new Context;
      $output = null;

      Code::Call(Configuration::Get("DirectoryThemes") . "/" . Configuration::Get("Theme") . "/theme.fc", $context, $output);

      if (Configuration::Get("Debug") == true)
	print $output;
    }
  }

}
?>
