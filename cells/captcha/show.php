<?
{

  $cell = Cell::Call("basic/img",
		     array("src" => Configuration::Get("URL") . "/" . Configuration::Get("DirectoryUtils") . "/secureimage/secureimage_show.php"));

  print $cell;

}
?>
