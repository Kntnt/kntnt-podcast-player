<?php


namespace Kntnt\Podcast_Player;


class Add_Shortcode {

	private static $defaults = [
		'source_template_substitute' => null,
		'src' => '',
		'preload' => 'auto',
		'autoplay' => 'off',
		'loop' => 'off',
	];

	private $shortcodes = [];

	public function run() {

		$this->fetch_shortcodes();

		foreach ( array_keys( $this->shortcodes ) as $shortcut ) {
			add_shortcode( $shortcut, [ $this, 'shortcode' ] );
			Plugin::debug( 'Added shortcode [%s].', $shortcut );
		}

	}

	public function shortcode( $atts, $content, $tag ) {

		$atts = Plugin::shortcode_atts( self::$defaults, $atts, $tag );

		if ( $atts['source_template_substitute'] ) {
			if ( ! $atts['src'] ) {
				$atts['src'] = strtr( $this->shortcodes[ $tag ]['source_template'], [ '{}' => $atts['source_template_substitute'] ] );
			}
			unset( $atts['source_template_substitute'] );
		}

		Plugin::debug( '[audio src="%s" preload="%s", autoplay="%s", loop="%s"]', $tag, $atts['src'], $atts['preload'], $atts['autoplay'], $atts['loop'] );

		$content = wp_audio_shortcode( $atts, $content );

		// TODO: ADD BADGES

		return $content;

	}

	private function fetch_shortcodes() {
		if ( $sc = get_field( 'kntnt-podcast-shortcuts', 'option' ) ) {
			foreach ( $sc as $shortcode ) {
				$this->shortcodes[ $shortcode['tag'] ] = [
					'source_template' => $shortcode['source_template'],
					'badges' => $shortcode['badges'],
				];
			}
		}
	}

}