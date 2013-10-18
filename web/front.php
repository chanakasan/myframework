<?php
// framework/front.php
 
require_once __DIR__.'/../src/autoload.php';
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
 
$request = Request::createFromGlobals();
$response = new Response();
 
$map = array(
    '/hello' => 'hello',
    '/bye'   => 'bye',
);
 
$path = $request->getPathInfo();
if (isset($map[$path])) {
	ob_start();
    require sprintf(__DIR__.'/../src/pages/%s.php', $map[$path]);
    $response->setContent(ob_get_clean());
} else {
    $response = new Response('Not Found', 404);
}
 
$response->send();