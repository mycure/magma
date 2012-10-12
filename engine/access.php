<?
{

  class Access
  {
    const TypePublic = 0;

    private static $entities = array();

    /*
     * this method returns the list of access entities
     * the current user belongs to.
     */
    public static function	Identifiers()
    {
      $accesses = array(self::TypePublic);

      if (Cache::Exist("user") == false)
	return $accesses;

      $user = Cache::Get("user");

      $accesses[] = $user->id;

      foreach (self::$entities as $entity)
	{
	  // XXX[we could perform theses operations in parallel to speed up the process]
	  $access = call_user_func($entity . "::Access", $user->id);

	  if (empty($access) == true)
	    continue;

	  foreach ($access as $object)
	    $accesses[] = $object["id"];
	}

      return $accesses;
    }

    /*
     * this method returns a list of descriptors i.e
     * human-readable stuff.
     */
    public static function	Descriptors()
    {
      $accesses = array("Default" => array("Public" => self::TypePublic));

      if (Cache::Exist("user") == false)
	return $accesses;

      $user = Cache::Get("user");

      $accesses["Default"]["Private"] = $user->id;

      foreach (self::$entities as $entity)
	{
	  // XXX[we could perform theses operations in parallel to speed up the process]
	  $access = call_user_func($entity . "::Access", $user->id);

	  if (empty($access) == true)
	    continue;

	  $accesses[$entity] = array();

	  foreach ($access as $object)
	    $accesses[$entity][$object["name"]] = $object["id"];
	}

      return $accesses;
    }

    public static function	Register($entity)
    {
      self::$entities[] = $entity;
    }
  }

}
?>
