<?
{

  function magma_error($code, $message, $file, $line, $context)
  {
    throw new Bug($message, $file, $line);
  }

  function magma_exception($e)
  {
    /*
     * retrieve the pending output
     */
    $output = "";

    while (ob_get_level() != 0)
      {
	$function = Trace::Pop();
	$level = ob_get_level();
	$contents = ob_get_clean();

	$format = <<<END
<h3>$function#$level</h3>

<pre>
$contents
</pre>

END;

	$output = $format . $output;
      }

    /*
     * retrieve the title
     */
    $title = Language::Translate("engine:abortion:abortion");

    /*
     * define the text according to the debug mode
     */
    if (Configuration::Get("Debug") == true)
      $text = <<<END
<h1>%title%</h1>

<h2>%title:message%</h2>

%message%

<br/>

<div align="right">
  <i>
    %file%:%line%
  </i>
</div>

<h2>%title:output%</h2>

%output%

<h2>%title:trace%</h2>

<pre>
%trace%
</pre>

<h2>%title:codes%</h2>

%codes%
END;
    else
      $text = <<<END
<h1>%title%</h1>

%message%

<br/>

<div align="right">
  <i>
    %file%:%line%
  </i>
</div>
END;

    /*
     * compute the codes mappings string
     */
    $codes = "";
    foreach (Code::$codes as $path => $id)
      $codes .= "[$path] $id<br/>";

    /*
     * integrate the variables into the text
     */
    $page = Template::Resolve($text,
			      array("title" => $title,
				    "title:message" => "XXX",
				    "message" => $e->getMessage(),
				    "file" => $e->getFile(),
				    "line" => $e->getLine(),
				    "title:output" => "XXX",
				    "output" => $output,
				    "title:trace" => "XXX",
				    "trace" => $e->getTraceAsString(),
				    "title:codes" => "XXX",
				    "codes" => $codes));

    /*
     * display the page
     */
    // XXX
    //Page::Display($title,
    //	  array("contents" => $page));

    // XXX
    print $page;
  }

  /*
   * set the PHP handlers
   */
  set_error_handler("magma_error");
  set_exception_handler("magma_exception");

}
?>
