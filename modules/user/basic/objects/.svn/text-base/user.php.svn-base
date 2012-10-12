<?
{

/*
 * ---------- information -----------------------------------------------------
 *
 * XXX
 */

  class User
  {
    /*
     * constants
     */
    const Table = "Users";

    const RoleAdministrator = 0;
    const RoleUser = 1;

    public static $Type;

    /*
     * attributes
     */
    public $attributes;

    public static function	Ready()
    {
      return Database::Exist(self::Table);
    }

    public static function	Install()
    {
      $schema = Schema::Load(self::Table);

      if (self::Ready() == false)
	Database::Execute($schema);
    }

    public static function	Uninstall()
    {
      if (self::Ready() == true)
	Database::Execute("DROP TABLE " . self::Table);
    }

    public static function	Flush()
    {
      if (self::Ready() == true)
	Database::Execute("DELETE FROM " . self::Table);
    }

    public static function	Exist($name)
    {
      $record = Database::Execute("SELECT * FROM " . self::Table . " WHERE name='$name'", Database::ResultSingle);

      return !empty($record);
    }

    public function		Lookup($name)
    {
      $record = Database::Execute("SELECT * FROM " . self::Table . " WHERE name='$name'", Database::ResultSingle);

      if (empty($record) == true)
	throw new Error("Either the user does not exist or you are not allowed to access it");

      $this->attributes = $record;
    }

    /*
     * load a stored user.
     */
    public function		Load($id)
    {
      $record = Database::Execute("SELECT * FROM " . self::Table . " WHERE id='$id'", Database::ResultSingle);

      if (empty($record) == true)
	throw new Fault("Unable to load the user '$id' from the database");

      $this->attributes = $record;
    }

    /*
     * create a new user.
     */
    public function		Reserve($name, $password, $email, $language, $role)
    {
      if (User::Exist($name) == true)
	throw new Error("Unable to create this user as a user with the same name already exists");

      $this->attributes["id"] = Identifier::Reserve();
      $this->attributes["name"] = $name;
      $this->attributes["password"] = $password;
      $this->attributes["email"] = $email;
      $this->attributes["language"] = $language;
      $this->attributes["role"] = $role;
    }

    /*
     * store the user object.
     */
    public function		Store()
    {
      // XXX[here we should flush the user object which is in cache]

      if (User::Exist($this->attributes["name"]) == true)
	{
	  $attributes = array();

	  foreach ($this->attributes as $name => $value)
	    $attributes[] = "$name='$value'";

	  Database::Execute("UPDATE " . self::Table . " SET " . implode(", ", $attributes) . " WHERE id='" . $this->attributes["id"] . "'");
	}
      else
	Database::Execute("INSERT INTO " . self::Table . " VALUES('" . implode("', '", $this->attributes) . "')");
    }

    public function		Destroy()
    {
      Database::Execute("DELETE FROM " . self::Table . " WHERE id='" . $this->attributes["id"] . "'");
    }

    public function		__get($attribute)
    {
      if (empty($this->attributes[$attribute]) == true)
	return null;

      return $this->attributes[$attribute];
    }

    public function		__set($attribute, $value)
    {
      if (isset($this->attributes[$attribute]) == false)
	throw new Fault("Unable to set attribute '$attribute'");

      $this->attributes[$attribute] = $value;
    }
  }

}
?>
