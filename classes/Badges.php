<?php


namespace Kntnt\Podcast_Player;


trait Badges {

	public static function services( $name = '' ) {
		static $services = [
			'acast' => 'Acast',
			'alexa' => 'Alexa',
			'amazon' => 'Amazon',
			'android' => 'Android',
			'apple' => 'Apple Podcasts',
			'audible' => 'Audible',
			'breaker' => 'Breaker',
			'castro' => 'Castro',
			'cuonda' => 'Cuonda',
			'google' => 'Google Podcasts',
			'ivoox' => 'iVoox',
			'overcast' => 'Overcast',
			'pocketcasts' => 'Pocket Casts',
			'podimo' => 'Podimo',
			'spotify' => 'Spotify',
			'stitcher' => 'Stitcher',
			'telegram' => 'Telegram',
			'tunein' => 'Tunein',
			'feed' => 'RSS-feed',
		];
		return $name ? $services[ $name ] : $services;
	}

	public static function colors( $name = '' ) {
		static $colors = [
			'black' => 'Dark',
			'white' => 'Light',
		];
		return $name ? $colors[ $name ] : $colors;
	}
}