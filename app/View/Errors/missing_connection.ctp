<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>

<?php
/*
if ('admin' == $this->Session->read('Auth.User.role')) {
	echo "
	<h2> $name </h2>
	<p class='error'>
		<strong>". __d('cake', 'Error') ."</strong>
		".printf(
			__d('cake', 'The requested address %s was not found on this server.'),
			"<strong>'{$url}'</strong>"
		)."
	</p>";

	if (Configure::read('debug') > 0 ):
		echo $this->element('exception_stack_trace');
	endif;
}
else
{
*/
	echo "<h2>DB problem</h2>";
//}
?>