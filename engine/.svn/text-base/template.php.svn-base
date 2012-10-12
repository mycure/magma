<?
{

  class Template
  {
    public static function	Resolve($text = "", $substitutions = array())
    {
      foreach ($substitutions as $key => $value)
	$text = str_replace("%" . $key . "%", $value, $text);

      return $text;
    }
  }

}
?>
