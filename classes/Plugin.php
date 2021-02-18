<?php


namespace Kntnt\Podcast_Player;


final class Plugin extends Abstract_Plugin {

	use Logger;
	use Shortcodes;
	use Templates;
	use Dependency_Check;
	use Services;

	private static $classes = [
		'any' => [
			'plugins_loaded' => [
				'Load_ACF',
			],
		],
		'public' => [
			'wp' => [
				'Add_Shortcode',
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

	public static function dependencies() {
		return self::$dependencies;
	}

	public function classes_to_load() {
		return self::is_dependencies_satisfied() ? self::$classes : [];
	}

}
