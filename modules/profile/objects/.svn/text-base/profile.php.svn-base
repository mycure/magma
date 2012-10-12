<?
{

/*
 * ---------- information -----------------------------------------------------
 *
 * XXX
 */

  class Profile
  {
    const Table = "Profiles";

    public static $Type;

    public $attributes;

    public static function	Install()
    {
      $schema = Schema::Load(self::Table);

      if (Database::Exist(self::Table) == true)
	Database::Execute("DROP TABLE " . self::Table);

      Database::Execute($schema);
    }

    public static function	Exist($user)
    {
      $record = Database::Execute("SELECT * FROM " . self::Table . " WHERE user='$user'", Database::ResultSingle);

      return !empty($record);
    }

    public function		Lookup($user)
    {
      $record = Database::Execute("SELECT * FROM " . self::Table . " WHERE ((user='$user') AND (access IN ('" . implode("', '", Access::Identifiers()) . "')))", Database::ResultSingle);

      if (empty($record) == true)
	throw new Error("Either the profile does not exist or you are not allowed to access it");

      $this->attributes = $record;
    }

    public function		Load($id)
    {
      $record = Database::Execute("SELECT * FROM " . self::Table . " WHERE ((id='$id') AND (access IN ('" . implode("', '", Access::Identifiers()) . "')))", Database::ResultSingle);

      if (empty($record) == true)
	throw new Error("Either the profile does not exist or you are not allowed to access it");

      $this->attributes = $record;
    }

    public function		Reserve($user, $avatar, $identity, $gender, $location, $website, $signature, $description, $dob, $access)
    {
      if (Profile::Exist($user) == true)
	throw new Error("Unable to create this profile as a profile for this user already exists");

      $this->attributes["id"] = Identifier::Reserve();
      $this->attributes["user"] = $user;
      $this->attributes["identity"] = $identity;
      $this->attributes["avatar"] = $avatar;
      $this->attributes["gender"] = $gender;
      $this->attributes["location"] = $location;
      $this->attributes["website"] = $website;
      $this->attributes["signature"] = $signature;
      $this->attributes["description"] = $description;
      $this->attributes["dob"] = $dob;
      $this->attributes["access"] = $access;
    }

    public function		Store()
    {
      if (Profile::Exist($this->attributes["user"]) == true)
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
      // XXX
      //if (isset($this->attributes[$attribute]) == false)
      //throw new Fault("Unable to get attribute '$attribute'");

      if (empty($this->attributes[$attribute]) == true)
	return null;

      return $this->attributes[$attribute];
    }

    public function		__set($attribute, $value)
    {
      // XXX
      //if (isset($this->attributes[$attribute]) == false)
      //throw new Fault("Unable to set attribute '$attribute'");

      $this->attributes[$attribute] = $value;
    }
  }

}
?>
