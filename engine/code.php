<?
{

  class Code
  {
    public static $codes = array();

    public static function	Create($path)
    {
      if (is_file($path) == false)
	throw new Fault("Unable to locate the '$path' code file");

      self::$codes[$path] = create_function('&$context', Misc::Load($path));
    }

    public static function	Call($path, &$context = null, &$output = null)
    {
      /*
       * create the function if necessary
       */
      if (array_key_exists($path, self::$codes) == false)
	self::Create($path);

      /*
       * allocate an empty context if no context is required
       */
      if (is_null($context) == true)
	$context = new Context;

      /*
       * insert the code path in the context
       */
      $context->Set(".path", dirname($path));

      /*
       * push the path into the trace
       */
      Trace::Push($path);

      /*
       * launch the function
       */
      ob_start();
      $value = call_user_func(self::$codes[$path], $context);
      $output = ob_get_clean();

      /*
       * remove the path from the trace context
       */
      Trace::Pop();

      /*
       * return the code-returned value
       */
      return $value;
    }

    public static function	Dump()
    {
      print "[codes]<br/>";

      foreach (self::$codes as $path => $id)
	print "  [$path] $id<br/>";
    }
  }

}
?>
