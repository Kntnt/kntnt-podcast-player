<?php


namespace Kntnt\Podcast_Player;


final class Plugin extends Abstract_Plugin {

	use Logger;
	use Shortcodes;
	use Templates;
	use Dependency_Check;

	private static $shortcodes = null;

	public static function dependencies() {
		return self::$dependencies;
	}

	public function classes_to_load() {
		return self::is_dependencies_satisfied() ? self::$classes : [];
	}

	public static function &get_shortcodes() {
		if ( null === self::$shortcodes ) {
			self::$shortcodes = get_field( 'kntnt-podcast-player-shortcodes', 'option' ) ?: [];
			Plugin::debug( 'Loaded podcast shortcodes: %s', self::$shortcodes );
		}
		return self::$shortcodes;
	}

	public static function all_shortcodes( $key = null ) {
		$shortcodes = &self::get_shortcodes();
		return array_column( $shortcodes, $key );
	}

	public static function shortcode_settings( $tag ) {
		$shortcodes = &self::get_shortcodes();
		return $shortcodes[ array_search( $tag, array_column( $shortcodes, 'tag' ) ) ];
	}

	private static $classes = [
		'any' => [
			'plugins_loaded' => [
				'Load_ACF',
			],
		],
		'public' => [
			'wp' => [
				'Add_Shortcode',
				'Load_CSS', // Must come after Add_Shortcode
			],
		],
	];

	private static $dependencies = [
		'plugins' => [
			[
				'advanced-custom-fields-pro/acf.php' => 'Advanced Custom Fields Pro',
			],
		],
	];

}
