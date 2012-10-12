<?
{

  class Cache
  {
    public static function	Initialise()
    {
      if (array_key_exists("cache", Environment::$session) == false)
	Environment::$session["cache"] = array();
    }

    public static function	Set($key, $value)
    {
      Environment::$session["cache"][$key] = serialize($value);
    }

    public static function	Get($key)
    {
      if (self::Exist($key) == false)
	return null;

      return unserialize(Environment::$session["cache"][$key]);
    }

    public static function	Exist($key)
    {
      return array_key_exists($key, Environment::$session["cache"]);
    }

    public static function	Invalidate($key)
    {
      unset(Environment::$session["cache"][$key]);
    }

    public static function	Flush()
    {
      unset(Environment::$session["cache"]);

      self::Initialise();
    }
  }

}
?>
