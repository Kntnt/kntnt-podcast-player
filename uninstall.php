<?php

defined( 'WP_UNINSTALL_PLUGIN' ) || die;

global $wpdb;
$wpdb->query( 'DELETE FROM {$wpdb->prefix}options WHERE option_name REGEXP "_?options_kntnt-podcast-shortcuts_.*"' );