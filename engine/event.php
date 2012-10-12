<?
{

  class Event
  {
    public static $events = array();

    public static function	Register($string, $function)
    {
      if (is_callable($function) == false)
	throw new Fault("The given function name '$function' does not represent a callable function or method");

      if (array_key_exists($string, self::$events) == false)
	self::$events[$string] = array();

      self::$events[$string][] = $function;
    }

    public static function	Trigger($string, $arguments = null)
    {
      if (array_key_exists($string, self::$events) == false)
	return;

      foreach (self::$events[$string] as $function)
	call_user_func($function, $arguments);
    }
  }

}
?>
