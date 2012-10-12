<?
{

  class Tag
  {
    public static $tags = array();

    public static function	Register($tag)
    {
      self::$tags[] = $tag;
    }

    public static function	Retrieve()
    {
      return self::$tags;
    }
  }

}
?>
