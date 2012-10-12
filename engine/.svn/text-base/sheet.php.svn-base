<?
{

  class Sheet
  {
    public static $sheets = array();

    public static function	Register($path)
    {
      if (is_file($path) == false)
	throw new Fault("The given sheet '$path' does not seem to exist");

      self::$sheets[] = $path;
    }

    public static function	Retrieve()
    {
      return self::$sheets;
    }
  }

}
?>
