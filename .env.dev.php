<?php
$clientId = 'VyqAjCyRKE';
$url = "https://quizlet.com/authorize?client_id={$clientId}&response_type=code&scope=read%20write_set";

return array(
	'dbpass' => 'russ',
	'quizlet_redirect_url' => 'http://localhost/quizlet',
	'quizlet_client_id' => $clientId,
	'quizlet_secret' => '6afyrX6WrEHRVBZvQwEaxA',
	'quizlet_authorize_url' => $url,
	'quizlet_token_url' => 'https://api.quizlet.com/oauth/token',
);