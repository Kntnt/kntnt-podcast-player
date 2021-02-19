<?php


namespace Kntnt\Podcast_Player;


class Add_Shortcode {

	use Badges;

	public function run() {

		foreach ( Plugin::all_shortcodes( 'tag' ) as $tag ) {
			add_shortcode( $tag, [ $this, 'shortcode' ] );
			Plugin::debug( 'Added shortcode [%s].', $tag );
		}

	}

	public function shortcode( $variables, $content, $tag ) {

		// Get settings for the shortcode.
		$shortcode_settings = Plugin::shortcode_settings( $tag );

		// Add extra badge information to the variables.
		foreach ( $shortcode_settings['badges'] as &$badge ) {
			$badge['text'] = sprintf( 'feed' == $badge['name'] ? __( 'Subscribe with %s', 'kntnt_podcast_player' ) : __( 'Listen on %s', 'kntnt_podcast_player' ), self::services( $badge['name'] ) );
			$badge['src'] = Plugin::plugin_url( "badges/{$badge['name']}_{$shortcode_settings['color']}_en.png" );
			$badge['srcset'] = Plugin::plugin_url( "badges/{$badge['name']}_{$shortcode_settings['color']}_en@2x.png" ) . ' 2x, ' . Plugin::plugin_url( "badges/{$badge['name']}_{$shortcode_settings['color']}_en@3x.png" ) . ' 3x';
		}

		// Fill in missing shortcode attributes.
		$variables = Plugin::shortcode_atts( [
			'source_template_substitute' => null,
			'src' => '',
			'preload' => $shortcode_settings['preload'],
			'autoplay' => $shortcode_settings['autoplay'],
			'loop' => $shortcode_settings['loop'],
		], $variables, $tag );

		// If template is provided and src is empty, use template to create src.
		if ( ! $variables['src'] && $variables['source_template_substitute'] ) {
			$variables['src'] = strtr( $shortcode_settings['source_template'], [ '{}' => $variables['source_template_substitute'] ] );
		}

		// Add $content to the variables.
		$variables['content'] = $content;

		// Add shortcode settings to the variables.
		$variables += $shortcode_settings;

		Plugin::debug( 'Variables: %s', $variables );

		// Get HTML for the player.
		$html = Plugin::include_template( 'includes/kntnt-podcast-player.php', $variables, true );
		Plugin::debug( "HTML added to page:\n%s", $html );

		return $html;

	}

}