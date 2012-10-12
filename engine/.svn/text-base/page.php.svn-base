<?
{

  class Page
  {
    public static function	Display($title, $arguments = array())
    {
      /*
       * load both the canvas and theme
       */
      Canvas::Load();
      Theme::Load();

      /*
       * build the information array
       */
      $information = array("title" => $title,
			   "tags" => Tag::Retrieve(),
			   "sheets" => Sheet::Retrieve(),
			   "scripts" => Script::Retrieve());

      /*
       * retrieve the template file from the canvas directory
       */
      $template = Canvas::Template();

      /*
       * compute the header and footer according to the information
       */
      $header = Cell::Call("page/header", $information);
      $footer = Cell::Call("page/footer");

      $report = Cell::Call("report/report");

      /*
       * resolve the template according to both the arguments and information
       */
      $page = Template::Resolve($template,
				array_merge($arguments, array("header" => $header,
							      "footer" => $footer,
							      "report" => $report)));

      /*
       * finally, display the page
       */
      print $page;
    }
  }

}
?>
