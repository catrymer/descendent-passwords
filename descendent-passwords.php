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
	// first check if the $post_object has ancestors with get_post_ancestors(), if that returns an empty array then return the $post_object as is 
	// iterate over the ancestor array and look for the presence of a password protected page, if none then return the $post_object as is
	// if a password protected page is found then add that same password to the $post_object, once this occurs it's fine to break out of the iteration??
}
add_action( 'the_post', 'add_descendent_passwords' );
