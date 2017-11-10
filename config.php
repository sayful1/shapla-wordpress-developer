<?php

$config = array(
	'mail' => array(
		'host'     => 'smtp.mailtrap.io',
		'port'     => 2525,
		'username' => '792cd84e65fa40',
		'password' => '7ff7b702b825a3',
	),
);

return json_decode( json_encode( $config ), false );