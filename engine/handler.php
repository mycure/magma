<?
{

  class Handler
  {
    public static $handlers = array();

    public static function	Register($pattern, $file, $parameters = array())
    {
      if (is_file($file) == false)
	throw new Fault("The given file '$file' does not seem to exist");

      $pattern = trim($pattern, "/:");

      if ((strpos($pattern, "/") !== false) && (($position = strpos($pattern, ":")) !== false))
	{
	  $first = trim(substr($pattern, 0, $position), "/:");
	  $second = trim(substr($pattern, $position + 1), "/:");

	  $structure = split("/", $first . "/" . $second);
	}
      else
	$structure = split("/", trim($pattern, "/:"));

      $count = count($structure);

      if (array_key_exists($count, self::$handlers) == false)
	self::$handlers[$count] = array();

      self::$handlers[$count][] = array("pattern" => $structure,
					"file" => $file,
					"parameters" => $parameters);
    }

    public static function	Trigger($URN, &$context, &$output)
    {
      $pattern = trim($URN, "/:");

      if ((strpos($pattern, "/") !== false) && (($position = strpos($pattern, ":")) !== false))
	{
	  $first = trim(substr($pattern, 0, $position), "/:");
	  $second = trim(substr($pattern, $position + 1), "/:");

	  $structure = split("/", $first . "/" . $second);
	}
      else
	$structure = split("/", trim($pattern, "/:"));

      $count = count($structure);

      if (array_key_exists($count, self::$handlers) == true)
	foreach (self::$handlers[$count] as $handler)
	  {
	    $store = array();

	    for ($i = 0; $i < $count; $i++)
	      {
		if (($handler["pattern"][$i][0] == '%') && ($handler["pattern"][$i][strlen($handler["pattern"][$i]) - 1] == '%'))
		  {
		    $store[trim($handler["pattern"][$i], "%")] = $structure[$i];

		    continue;
		  }

		if ($handler["pattern"][$i] != $structure[$i])
		  break;
	      }

	    if ($i != $count)
	      continue;

	    foreach ($store as $variable => $value)
	      Environment::$keys[$variable] = $value;

	    foreach ($handler["parameters"] as $variable)
	      {
		if (array_key_exists($variable, $_REQUEST) == true)
		  {
		    if (is_array($_REQUEST[$variable]) == true)
		      $value = $_REQUEST[$variable];
		    else
		      $value = trim($_REQUEST[$variable]);
		  }
		else
		  $value = null;

		Environment::$inputs[$variable] = $value;
	      }

	    $value = Code::Call($handler["file"], $context, $output);

	    return $value;
	  }

      throw new Error("Unable to access the page '$URN'");
    }
  }

}
?>
