<?
{

  class Report
  {
    const TypeFailure = 1;
    const TypeWarning = 2;
    const TypeSuccess = 3;

    public static function	Initialise()
    {
      if (array_key_exists("report", Environment::$session) == false)
	Environment::$session["report"] = array();
    }

    public static function	Failure($message)
    {
      Environment::$session["report"][] = array("type" => self::TypeFailure,
						"message" => $message);
    }

    public static function	Warning($message)
    {
      Environment::$session["report"][] = array("type" => self::TypeWarning,
						"message" => $message);
    }

    public static function	Success($message)
    {
      Environment::$session["report"][] = array("type" => self::TypeSuccess,
						"message" => $message);
    }

    public static function	Retrieve()
    {
      $reports = Environment::$session["report"];

      unset(Environment::$session["report"]);

      self::Initialise();

      return $reports;
    }
  }

}
?>
