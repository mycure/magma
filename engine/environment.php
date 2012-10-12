<?
{

  class Environment
  {
    public static $session;
    public static $keys;
    public static $inputs;
    public static $files;

    public static function	Initialise()
    {
      session_name("magma");
      session_start();

      self::$session = &$_SESSION;
      self::$keys = array();
      self::$inputs = array();
      self::$files = &$_FILES;
    }

    public static function	Dump()
    {
      print "[environment]<br />";

      print "  [session]<br />";
      var_dump(self::$session);
      print "<br />";

      print "  [keys]<br />";
      var_dump(self::$keys);
      print "<br />";

      print "  [inputs]<br />";
      var_dump(self::$inputs);
      print "<br />";

      print "  [files]<br />";
      var_dump(self::$files);
      print "<br />";
    }
  }

}
?>
