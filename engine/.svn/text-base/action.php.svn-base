<?
{

  class Action
  {
    public static $actions;

    public static function	Register($pattern, $file, $parameters)
    {
      Handler::Register($pattern, $file, $parameters);
    }

    public static function	Trigger($URN)
    {
      $context = new Context;
      $output = null;

      Handler::Trigger($URN, $context, $output);

      if (Configuration::Get("Debug") == true)
	print $output;
    }
  }

}
?>
