<?php

/**
 * Plugin main file.
 *
 * @wordpress-plugin
 * Plugin Name:       Kntnt Podcast Player
 * Plugin URI:        https://github.com/Kntnt/kntnt-podcast-player
 * GitHub Plugin URI: https://github.com/Kntnt/kntnt-podcast-player
 * Description:       Allows creation of customizable podcast players.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Requires PHP:      7.1
 */


namespace Kntnt\Podcast_Player;

// Uncomment following line to debug this plugin.
// define( 'KNTNT_PODCAST_PLAYER_DEBUG', true );

require 'autoload.php';

defined( 'WPINC' ) && new Plugin;
