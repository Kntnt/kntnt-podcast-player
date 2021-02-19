<?php


namespace Kntnt\Podcast_Player;


class Load_CSS {

	public function run() {
		global $post;
		if ( isset( $post->post_content ) && is_singular( get_post_types( [ 'public' => true ] ) ) ) {
			foreach ( Plugin::all_shortcodes( 'tag' ) as $tag ) {
				if ( has_shortcode( $post->post_content, $tag ) ) {
					add_action( 'wp_enqueue_scripts', [ $this, 'load_css' ] );
				}
			}
		}
	}

	public function load_css() {
		wp_enqueue_style( 'kntnt-podcast-player.css', Plugin::plugin_url( 'css/kntnt-podcast-player.css' ), [], Plugin::version() );
		Plugin::debug( 'Enqueued kntnt-podcast-player.css' );
	}

}
