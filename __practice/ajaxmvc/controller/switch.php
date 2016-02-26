<?php
// is this a request?
if (empty($_GET['request'])) {
	die();
}
// get the business logic
include_once '../model/business.php';

// figure out the request
// and call the business logic object
switch ($_GET['request']) 
{
	case 'loadSomething':
		echo loadSomething();
		break;
	case 'loadSomeMore': // not used, example
		echo loadSomeMore();
		break;
}
?>
