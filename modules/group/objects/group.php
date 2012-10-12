<?
{

/*
 * ---------- information -----------------------------------------------------
 *
 * XXX
 */

  class Group
  {
    const TableDescriptors = "GroupDescriptors";
    const TableMembers = "GroupMembers";

    public static $Type;

    public $attributes;

    public static function	Install()
    {
      /*
       * table for descriptors.
       */

      $schema = Schema::Load(self::TableDescriptors);

      $handle = Database::Handle();

      if ($handle->Exist(self::TableDescriptors) == true)
	$handle->Execute("DROP TABLE " . self::TableDescriptors);

      $handle->Execute($schema);

      /*
       * table for members.
       */
 
      $schema = Schema::Load(self::TableMembers);

      $handle = Database::Handle();

      if ($handle->Exist(self::TableMembers) == true)
	$handle->Execute("DROP TABLE " . self::TableMembers);

      $handle->Execute($schema);
    }

    public static function	Exist($user)
    {
      $handle = Database::Handle();

      $record = $handle->Execute("SELECT * FROM " . self::TableDescriptors . " WHERE (owner='$owner' AND name='$name')", Database::ResultSingle);

      return !empty($record);
    }

    public function		Lookup($owner, $name)
    {
      $handle = Database::Handle();

      $record = $handle->Execute("SELECT * FROM " . self::TableDescriptors . " WHERE (owner='$owner' AND name='$name')", Database::ResultSingle);

      if (empty($record) == true)
	throw new Error("Either the group does not exist or you are not allowed to access it");

      $this->attributes = $record;
    }

    public function		Load($id)
    {
      $handle = Database::Handle();

      $record = $handle->Execute("SELECT * FROM " . self::TableDescriptors . " WHERE id='$id'", Database::ResultSingle);

      if (empty($record) == true)
	throw new Error("Either the group does not exist or you are not allowed to access it");

      $this->attributes = $record;
    }

    public function		Reserve($owner, $name)
    {
      if (Group::Exist($owner, $name) == true)
	throw new Error("Unable to create this group");

      $this->attributes["id"] = Identifier::Reserve();
      $this->attributes["owner"] = $owner;
      $this->attributes["name"] = $name;
    }

    public function		Store()
    {
      $handle = Database::Handle();

      if (User::Exist($this->attributes["owner"], $this->attributes["name"]) == true)
	{
	  $attributes = array();

	  foreach ($this->attributes as $name => $value)
	    $attributes[] = "$name='$value'";

	  $handle->Execute("UPDATE " . self::Table . " SET " . implode(", ", $attributes) . " WHERE id='" . $this->attributes["id"] . "'");
	}
      else
	$handle->Execute("INSERT INTO " . self::TableDescriptors . " VALUES('" . $this->id . "', '" . $this->owner . "', '" . $this->name . "')");
    }

    public function		Destroy()
    {
      $handle = Database::Handle();

      $handle->Execute("DELETE FROM " . self::TableDescriptors . " WHERE id='" . $this->id . "'");
    }

    public function		Belongs($member)
    {
      $handle = Database::Handle();

      $record = $handle->Execute("SELECT * FROM " . self::TableMembers . " WHERE (id='" . $this->id . "' AND member='$member')", Database::ResultSingle);

      if (empty($record) == false)
	return false;

      return true;
    }

    public function		Add($member, $type)
    {
      $handle = Database::Handle();

      $handle->Execute("INSERT INTO " . self::TableMembers . " VALUES('" . $this->attributes["id"] . "', '" . $member . "', '" . $type . "')");
    }

    public function		Remove($member)
    {
      $handle = Database::Handle();

      if ($this->Belongs($member) == true)
	$handle->Execute("DELETE FROM " . self::TableMembers . " WHERE (id='" . $this->attributes["id"] . "' AND member='" . $member . "')");
    }

    public static function	Access($user)
    {
      $accesses = array();

      $handle = Database::Handle();

      $records = $handle->Execute("SELECT id FROM " . self::TableMembers . " WHERE (member='$user')", Database::ResultEvery);

      if (empty($records) == false)
	foreach ($records as $record)
	  {
	    $group = $handle->Execute("SELECT name FROM " . self::TableDescriptors . " WHERE (id='" . $record["id"] . "')", Database::ResultSingle);

	    if (empty($group) == true)
	      throw new Fault("The group '" . $record["id"] . "' should exist as it contains members");

	    $accesses[] = array("id" => $record["id"],
				"name" => $group["name"]);
	  }

      return $accesses;
    }
  }

  Access::Register("Group");

}
?>
