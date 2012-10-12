<?
{

  class Network
  {
    const Table = "Networks";

    const ModePersonal = 1;
    const ModeHierarchical = 2;

    public static $networks = array();

    private $attributes;

    public static function	Install()
    {
      $schema = Schema::Load(self::Table);

      $handle = Database::Handle();

      if ($handle->Exist(self::Table) == true)
	$handle->Execute("DROP TABLE " . self::Table);

      $handle->Execute($schema);
    }

    public static function	Register($relation, $mode)
    {
      self::$networks[$relation] = array("mode" => $mode);
    }

    public static function	Exist($relation, $user)
    {
      $handle = Database::Handle();

      $record = $handle->Execute("SELECT * FROM " . self::Table . " WHERE ((relation='$relation') AND (user='$user'))", Database::ResultSingle);

      return !empty($record);
    }

    public function		Lookup($relation, $user)
    {
      $handle = Database::Handle();

      $record = $handle->Execute("SELECT * FROM " . self::Table . " WHERE ((relation='$relation') AND (user='$user'))", Database::ResultSingle);

      if (empty($record) == true)
	throw new Error("Either the network does not exist or you are not allowed to access it");

      $this->attributes = $record;
    }

    /*
     * create a new contact
     */
    public function		Reserve($relation, $user, $access)
    {
      $this->attributes["relation"] = $relation;
      $this->attributes["user"] = $user;
      $this->attributes["access"] = $access;
    }

    /*
     * store the user object.
     */
    public function		Store()
    {
      $handle = Database::Handle();

      if (Network::Exist($this->attributes["relation"], $this->attributes["user"]) == true)
	{
	  $handle->Execute("UPDATE " . self::Table . " SET access='" . $this->attributes["access"] . "' WHERE ((relation='" . $this->attributes["relation"] . "') AND (user='" . $this->attributes["user"] . "'))");
	}
      else
	$handle->Execute("INSERT INTO " . self::Table . " VALUES('" . implode("', '", $this->attributes) . "')");
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

    public function		Retrieve()
    {
      $contacts = array();

      if (in_array($this->attributes["access"], Access::Tuple()) == false)
	return $contacts;

      $handle = Database::Handle();

      $records = $handle->Execute("SELECT contact FROM " . Contact::Table . " WHERE ((relation='" . $this->attributes["relation"] . "') AND (user='" . $this->attributes["user"] . "'))");

      foreach ($records as $record)
	$contacts[] = $record["contact"];

      return $contacts;
    }
  }

  // XXX[should be put in the site module]
  // XXX[Friends -> friends for the language translation]
  Network::Register("Associates", Network::ModeHierarchical);
  Network::Register("Supporters", Network::ModePersonal);

}
?>
