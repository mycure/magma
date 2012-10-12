<?
{

  class View
  {
    public static function	Register($pattern, $file)
    {
      Handler::Register($pattern, $file);
    }

    public static function	Trigger($URN)
    {
      $context = new Context;
      $output = null;

      Handler::Trigger($URN, $context, $output);

      print $output;
    }

    public static function	Forward($URN = "")
    {
      if (headers_sent() == true)
	return;

      if (empty($URN) == false)
	$location = Configuration::Get("URL") . "/" . $URN;
      else
	$location = Configuration::Get("URL");

      header("Location: " . $location);

      exit();
    }

    public static function	Back()
    {
      // XXX[go to the referer URL]
      // XXX[means we have to store the Referer in the session]
    }
  }

}
?>
