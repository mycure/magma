<?
{

  class Misc
  {
    const OptionFile = 1;
    const OptionDirectory = 2;
    const OptionWalk = 4;

    public static function	Search($path, $pattern, $options)
    {
      $results = array();

      if (($handle = opendir($path)) === false)
	throw new Fault("Unable to search for files '$pattern' in '$path'");

      while (($entry = readdir($handle)) !== false)
	{
	  if ($entry[0] == ".")
	    continue;

	  if (($options & self::OptionWalk) && (is_dir($path . "/" . $entry) == true))
	    {
	      foreach (self::Search($path . "/" . $entry, $pattern, $options) as $element)
		$results[] = $entry . "/" . $element;
	    }

	  if ($options & self::OptionFile)
	    {
	      if (is_file($path . "/" . $entry) == false)
		continue;
	    }

	  if ($options & self::OptionDirectory)
	    {
	      if (is_dir($path . "/" . $entry) == false)
		continue;
	    }

	  if (ereg($pattern, $entry) !== false)
	    $results[] = $entry;
	}

      closedir($handle);

      return $results;
    }

    public static function	Load($path)
    {
      return implode("\n", file($path));
    }
  }

}
?>
