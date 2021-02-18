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

	private $shortcodes;

	public function run() {

		$this->shortcodes = get_field( 'kntnt-podcast-shortcuts', 'option' ) ?: [];
		Plugin::debug( '$shortcodes = %s', $this->shortcodes );

		foreach ( $this->shortcodes as $shortcode ) {
			add_shortcode( $shortcode['tag'], [ $this, 'shortcode' ] );
			Plugin::debug( 'Added shortcode [%s].', $shortcode['tag'] );
		}

	}

	public function shortcode( $variables, $content, $tag ) {

		// Fill in the blanks
		$variables = Plugin::shortcode_atts( self::$defaults, $variables, $tag );

		// Add $content to the variables
		$variables['content'] = $content;

		// Add shortcode settings to the variables.
		$variables += $this->shortcodes[ array_search( $tag, array_column( $this->shortcodes, 'tag' ) ) ];

		// If template is provided and src is empty, use template to create src.
		if ( ! $variables['src'] && $variables['source_template_substitute'] ) {
			$variables['src'] = strtr( $variables['source_template'], [ '{}' => $variables['source_template_substitute'] ] );
		}

		// Grok with the badges.
		$color = $variables['color'];
		foreach ( $variables['badges'] as &$badge ) {
			$name = $badge['name'];
			$badge['text'] = sprintf( 'feed' == $name ? __( 'Subscribe with %s', 'kntnt_podcast_player' ) : __( 'Listen on %s', 'kntnt_podcast_player' ), Plugin::services( $name ) );
			$badge['src'] = Plugin::plugin_url( "badges/{$name}_{$color}_en.png" );
			$badge['srcset'] = Plugin::plugin_url( "badges/{$name}_{$color}_en@2x.png" ) . ' 2x, ' . Plugin::plugin_url( "badges/{$name}_{$color}_en@3x.png" ) . ' 3x';
		}

		Plugin::debug( 'Variables: %s', $variables );

		// Return the player HTML.
		return Plugin::include_template( 'includes/kntnt-podcast-player.php', $variables, true );

	}

}