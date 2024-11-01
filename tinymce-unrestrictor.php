<?php
/*
Plugin Name: TinyMCE Unrestrictor
Plugin URI: http://www.daniel-klose.com
Description: A very simple plugin that focusses on being lightweight (only about 100 lines of code) and enables the missing buttons of the TinyMCE Editor.
Version: 1.0
Author: Daniel Klose
Author Email: info@daniel-klose.com
License:

  Copyright 2011 Daniel Klose (info@daniel-klose.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

class TinyMCEUnrestrictor {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'TinyMCE Unrestrictor';
	const slug = 'tinymce_unrestrictor';

	/**
	 * Constructor
	 */
	function __construct() {
		//Hook up to the init action
		add_action( 'init', array( &$this, 'init_tinymce_unrestrictor' ) );
	}

	/**
	 * Runs when the plugin is initialized
	 */
	function init_tinymce_unrestrictor() {

		if ( is_admin() ) {
			//this will run when in the WordPress admin
			function enable_more_tmcebuttons($tmcebuttons) {

			$tmcebuttons[] = 'fontselect';
			$tmcebuttons[] = 'fontsizeselect';
			$tmcebuttons[] = 'styleselect';
			$tmcebuttons[] = 'backcolor';
			$tmcebuttons[] = 'cut';
			$tmcebuttons[] = 'copy';
			$tmcebuttons[] = 'charmap';
			$tmcebuttons[] = 'hr';

			return $tmcebuttons;
			}
			add_filter('mce_buttons_3', 'enable_more_tmcebuttons');

			//Open the Kitchen Sink by default
			add_filter('tiny_mce_before_init', 'openSinkTinyMCE');
			function openSinkTinyMCE( $in ) {

			$in['wordpress_adv_hidden'] = FALSE;

			return $in;
			}

		} else {
			//this will run when on the frontend
		}

		/*
		 * TODO: Define custom functionality for your plugin here
		 *
		 * For more information:
		 * http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters

		add_action( 'your_action_here', array( &$this, 'action_callback_method_name' ) );
		add_filter( 'your_filter_here', array( &$this, 'filter_callback_method_name' ) );
		*/
	}

} // end class
new TinyMCEUnrestrictor();

?>