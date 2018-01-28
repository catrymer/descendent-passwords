<?php
/*
Plugin Name:  Descendent Passwords
Description:  This plugin automatically adds passwords to all children, grandchildren, etc pages if an ancestor page is password protected.
Version:      1.0
Author:       Cat Scheer
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

/**
 *  Add a password to the $post_object if it has an ancestor with a password
 *
 * @param obj $post_object
 * @return obj
 */
function add_descendent_passwords( &$post_object ) {
	// check if the $post_object has a password set already. If it does then just return it.
	if( !empty( $post_object->post_password) ) {
		return $post_object;
	}

	// check if the $post_object has ancestors, if not then return the $post_object as is 
	$_post_ancestors = get_post_ancestors( $post_object );
	if( empty( $_post_ancestors ) ) {
		return $post_object;
	}

	// get the passwords for all posts in the ancestor array 
	$_imploded_ancestors = implode( ", ", array_map( "absint", $_post_ancestors ) );
	global $wpdb;
	$_ancestor_passwords = $wpdb->get_results( "SELECT post_password FROM wp_posts WHERE ID IN ($_imploded_ancestors) AND post_password <> ''" );

	
	// if any of the ancestor posts had passwords, assign the first password that was found as the password for the current $post_object
	if( !empty( $_ancestor_passwords ) ) {
		$post_object->post_password = $_ancestor_passwords[0]->post_password;
	}
	
	return $post_object;

}
add_action( 'the_post', 'add_descendent_passwords' );
