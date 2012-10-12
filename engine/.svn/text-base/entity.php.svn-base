<?
{

  /*
   * an entity represents a magma class.
   *
   * the system keeps track of such defined classes so that a method
   * can be called on all such entities.
   *
   * such entities are registered because the system cannot know
   * in advance what classes the modules are going to define.
   */

  class Entity
  {
    public static $classes = array();

    public static function	Register($class)
    {
      self::$classes[] = $class;
    }

    // XXX[change this by __callStatic when PHP 5.3 is ready]
    public static function	Call($name, $arguments = array())
    {
      // XXX[call these methods in parallel in order to speed up the process, especially for the Search class]

      foreach (self::$classes as $class)
	if (method_exists($class, $name) == true)
	  call_user_func_array($class . "::" . $name, $arguments);
    }

    public static function	Dump()
    {
      print "[entities]<br />";

      foreach (self::$classes as $class)
	print "  " . $class . "<br />";
    }
  }

}
?>
