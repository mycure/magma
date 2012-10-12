<?
{

  class Script
  {
    public static $scripts = array();

    public static function	Register($path)
    {
      if (is_file($path) == false)
	throw new Fault("The given script '$path' does not seem to exist");

      self::$scripts[] = $path;
    }

    public static function	Retrieve()
    {
      return self::$scripts;
    }
  }

}
?>
