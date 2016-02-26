<?php
function loadSomething() {
	$extensions = get_loaded_extensions();
	return '["'. implode('","', $extensions) . '"]'; 
}
?>
