<?
{

  class Abortion extends Exception
  {
    public function		__construct($message)
    {
      parent::__construct($message);
    }
  }

  /*
   * a fault represents an internal fatal error.
   *
   * the message should be kept to the administrator.
   */
  class Fault extends Abortion
  {
    public function		__construct($message)
    {
      parent::__construct($message);
    }
  }

  /*
   * an error occurs when something is wrong according to the
   * given information, inputs, parameters etc.
   *
   * such error messages can be displayed to the end-user.
   */
  class Error extends Abortion
  {
    public function		__construct($message)
    {
      parent::__construct($message);
    }
  }

  /*
   * a bug is an internal error.
   */
  class Bug extends Abortion
  {
    public function		__construct($message, $file, $line)
    {
      parent::__construct($message);

      $this->file = $file;
      $this->line = $line;
    }
  }

  /*
   * a fraud represents an unauthorised access.
   */
  class Fraud extends Abortion
  {
    public function		__construct($message)
    {
      $this->message = $message;
    }
  }

}
?>
