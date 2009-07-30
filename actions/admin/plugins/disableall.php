<?php
	/**
	 * Disable plugin action.
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2009
	 * @link http://elgg.org/
	 */

	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
	
	// block non-admin users
	admin_gatekeeper();
	
	// Validate the action
	action_gatekeeper();
	
	$plugins = get_installed_plugins();
		
	foreach ($plugins as $p => $data)
	{
		// Disable
		if (disable_plugin($p))
			system_message(sprintf(elgg_echo('admin:plugins:disable:yes'), $p));
		else
			register_error(sprintf(elgg_echo('admin:plugins:disable:no'), $p));
	}		
	
	elgg_view_regenerate_simplecache();
	elgg_filepath_cache_reset();
		
	forward($_SERVER['HTTP_REFERER']);
	exit;
?>