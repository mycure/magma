<?
{

  class Keep
  {
    public static function	Module($module)
    {
      if (Check::Module($module) == false)
	throw new Error("This page cannot be accessed");
    }

    public static function	Feature($feature)
    {
      if (Check::Feature($feature) == false)
	throw new Error("This page cannot be accessed");
    }

    public static function	User($id = null)
    {
      if (Check::User($id) == false)
	throw new Error("You need to log on to be able to access this page");
    }

    public static function	Administrator()
    {
      if (Check::Administrator() == false)
	throw new Error("You are not allowed to access this page");
    }
  }

}
?>
