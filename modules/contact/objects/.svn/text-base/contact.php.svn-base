<?
{

  class Contact
  {
    const Table = "Contacts";

    private $attributes;

    /*
     * check that everything required exists.
     */
    public static function	Install()
    {
      /*
       * install the network concept as well
       */
      Network::Install();

      $schema = Schema::Load(self::Table);

      $handle = Database::Handle();

      if ($handle->Exist(self::Table) == true)
	$handle->Execute("DROP TABLE " . self::Table);

      $handle->Execute($schema);
    }

    public static function	Exist($relation, $user, $contact)
    {
      $handle = Database::Handle();

      $record = $handle->Execute("SELECT * FROM " . self::Table . " WHERE ((relation='$relation') AND (user='$user') AND (contact='$contact'))", Database::ResultSingle);

      return !empty($record);
    }

    public function		Lookup($relation, $user, $contact)
    {
      $handle = Database::Handle();

      $record = $handle->Execute("SELECT * FROM " . self::Table . " WHERE ((relation='$relation') AND (user='$user') AND (contact='$contact'))", Database::ResultSingle);

      if (empty($record) == true)
	throw new Error("Either the '$relation' contact does not exist or you are not allowed to access it");

      $this->attributes = $record;
    }

    /*
     * create a new contact
     */
    public function		Reserve($relation, $user, $contact)
    {
      if (Contact::Exist($relation, $user, $contact) == true)
	throw new Error("Unable to create this '$relation' contact as one seems to already exist");

      $this->attributes["relation"] = $relation;
      $this->attributes["user"] = $user;
      $this->attributes["contact"] = $contact;
    }

    /*
     * store the user object.
     */
    public function		Store()
    {
      if (Contact::Exist($this->attributes["relation"], $this->attributes["user"], $this->attributes["contact"]) == true)
	throw new Fault("The contacts should not be updated but created and removed");

      $handle = Database::Handle();

      $handle->Execute("INSERT INTO " . self::Table . " VALUES('" . implode("', '", $this->attributes) . "')");
    }

    public function		Destroy()
    {
      $handle = Database::Handle();

      $attributes = array();

      foreach ($this->attributes as $name => $value)
	$attributes[] = "$name='$value'";

      $handle->Execute("DELETE FROM " . self::Table . " WHERE ((" . implode(") AND (", $attributes) . "))");
    }

    public function		__get($attribute)
    {
      if (isset($this->attributes[$attribute]) == false)
	throw new Fault("Unable to get attribute '$attribute'");

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

  /* XXX
  class Connections
  {
    public static function	Retrieve($user, $relationship = null)
    {
    }
  }

  class Network
  {
    public static function	Retrieve($user, $depth = Configuration::ConnectionDepth)
    {
      $network = Connections::Retrieve($user, Connection::RelationshipContact);

     
      for ($d = 0, $contacts = $network; $d < $depth ; $d++)
	{
	  foreach ($contacts as $contact)
	    {
	      if ($contact->first == $user)
		$relation = $contact->second;
	      else
		$relation = $contact->first;

	      $people = Connections::Retrieve($relation, Connection::RelationshipContact);

	      $network = array_merge($network, $people);
	    }
	}

      return $network;
    }
  }
  */

}
?>
