<?
{

  class Context
  {
    public $scope = array();

    public function		__construct(array $defaults = array())
    {
      foreach ($defaults as $name => $value)
	$this->scope[$name] = $value;
    }

    public function		Get($name, $default = null, $template = null)
    {
      if (self::Exist($name) == false)
	return $default;

      if (is_null($template) == false)
	return Template::Resolve($template,
				 array($name => $this->scope[$name]));
      else
	return $this->scope[$name];
    }

    public function		Set($name, $value)
    {
      $this->scope[$name] = $value;
    }

    public function		Exist($name)
    {
      return array_key_exists($name, $this->scope);
    }

    public function		Dump()
    {
      print "[context]<br />";

      foreach ($this->scope as $key => $value)
	{
	  print "  [slot] " . $key . "<br />";
	  var_dump($value);
	  print "<br />";
	}
    }
  }

}
?>
