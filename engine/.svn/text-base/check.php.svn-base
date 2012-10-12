<?
{

  class Check
  {
    public static function	Module($module)
    {
      if (Module::Exist($module) == false)
	return false;

      return true;
    }

    public static function	Feature($feature)
    {
      if (Module::Feature($feature) == false)
	return false;

      return true;
    }

    public static function	User($id = null)
    {
      if (Cache::Exist("user") == false)
	return false;

      if ($id !== null)
	{
	  $user = Cache::Get("user");

	  if ($user->id != $id)
	    return false;
	}

      return true;
    }

    public static function	Administrator()
    {
      if (self::User() != true)
	return false;

      $user = Cache::Get("user");

      var_dump(Environment::$session);

      var_dump($user);

      var_dump($user->role);
      var_dump(User::RoleAdministrator);

      if ($user->role != User::RoleAdministrator)
	return false;

      return true;
    }
  }

}
?>
