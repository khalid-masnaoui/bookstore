<?php
require_once "core/ini.php";

//we can as well check if yhe user was sign in before (but doesnt matter cuz all we doing is deleting the session);!!
$user = new user();
$user->logOut();
session::flash("messages",array("loggedout"=>"you have been successfully logged out, don't forget to visit us again !"));

redirect::to("index.php");

?>