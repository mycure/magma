<?
{

  /*
   * this class provides the system with a way to look for words in the
   * whole system.
   */
  class Search
  {
    public static function	Launch($string)
    {
      Entity::Call("Search", $string);
    }
  }

}
?>
