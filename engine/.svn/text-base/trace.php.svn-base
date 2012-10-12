<?
{

  class Trace
  {
    public static $stack = array();

    public static function	Push($function)
    {
      array_push(self::$stack, $function);
    }

    public static function	Pop()
    {
      return array_pop(self::$stack);
    }

    public static function	Dump()
    {
      print "[trace]<br/>";

      foreach (array_reverse(self::$stack) as $function)
	print "  $function<br/>";
    }
  }

}
?>
