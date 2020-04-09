<?php

/*
    *  Copyright (c) Codiad & Kent Safranski (codiad.com), distributed
    *  as-is and without warranty under the MIT License. See
    *  [root]/license.txt for more. This information must remain intact.
    */

require_once('../../common.php');
require_once('class.active.php');

//////////////////////////////////////////////////////////////////
// Verify Session or Key
//////////////////////////////////////////////////////////////////
checkSession();

$action = Common::data("action");
$user = Common::data("user", "session");

$path = Common::data("path");

if (!$action) {
	Common::sendJSON("E401m");
	die;
}

$Active = new Active();


switch ($action) {
	//////////////////////////////////////////////////////////////////
	// Get user's active files
	//////////////////////////////////////////////////////////////////
	case "list":
		$Active->username = $user;
		$Active->listActive();
		break;

	//////////////////////////////////////////////////////////////////
	// Add active record
	//////////////////////////////////////////////////////////////////
	case "add":
		$Active->username = $user;
		$Active->path = $path;
		$Active->add();
		break;

	//////////////////////////////////////////////////////////////////
	// Rename
	//////////////////////////////////////////////////////////////////
	case "rename":
		$newPath = Common::data("newPath");
		
		$Active->username = $user;
		$Active->path = $path;
		$Active->new_path = $newPath;
		$Active->rename();
		break;

	//////////////////////////////////////////////////////////////////
	// Check if file is active
	//////////////////////////////////////////////////////////////////
	case "check":
		$Active->username = $user;
		$Active->path = $path;
		$Active->check();
		break;

	//////////////////////////////////////////////////////////////////
	// Remove active record
	//////////////////////////////////////////////////////////////////
	case "remove":
		$Active->username = $user;
		$Active->path = $path;
		$Active->remove();
		break;

	//////////////////////////////////////////////////////////////////
	// Remove all active record
	//////////////////////////////////////////////////////////////////
	case "removeall":
		$Active->username = $user;
		$Active->removeAll();
		break;

	//////////////////////////////////////////////////////////////////
	// Mark file as focused
	//////////////////////////////////////////////////////////////////
	case "focused":

		$Active->username = $user;
		$Active->path = $path;
		$Active->markFileAsFocused();
		break;

	default:
		Common::sendJSON("E401i");
		break;

}