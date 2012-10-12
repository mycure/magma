<?
{

  function			ContactEvent_UserNew($user)
  {
    if (is_null($user) == true)
      throw new Fault("A user object should be carried by the event");

    foreach (Network::$networks as $relation => $type)
      {
	$network = new Network;

	$network->Reserve($relation, $user->id, Access::TypePublic);
	$network->Store();
      }
  }

}
?>
