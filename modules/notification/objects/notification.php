<?
{

  class Notification
  {
    public static function	Emit($user, $subject, $message)
    {
      $from = "noreply@" . Configuration::Get("SiteDomain");

      $headers =
	"From: " . Configuration::Get("SiteName") . " <" . "noreply@" . Configuration::Get("SiteDomain") . ">\r\n";

      mail($user->email, $subject, $message, $headers);
    }
  }

}
?>
