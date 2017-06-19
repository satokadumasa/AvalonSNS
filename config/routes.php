<?php
$route = new Route($CONV_STRING_LIST);
$route->setRoute(DOCUMENT_ROOT.'login', 'UserController', 'login');
$route->setRoute(DOCUMENT_ROOT.'auth', 'UserController', 'auth');
$route->setRoute(DOCUMENT_ROOT.'logout', 'UserController', 'logout');
$route->setRoute(DOCUMENT_ROOT.'confirm/CONFIRM_STRING', 'UserController', 'confirm');
$route->setRoute(DOCUMENT_ROOT.'regist_subscriptionid/SUBSCRIPTION_STRING', 'SubscriptionController', 'regist');
$route->setRoute(DOCUMENT_ROOT.'Shouts/getShoutsWithJson/CREATED_AT', 'ShoutController', 'getShoutsWithJson');
$route->setRoute(DOCUMENT_ROOT.'Shouts/getShoutsWithJson', 'ShoutController', 'getShoutsWithJson');
# ホームページに関する記述は一番最後に 
$route->setRoute(DOCUMENT_ROOT, 'DefaultController', 'index');
