<?php


namespace Kntnt\Podcast_Player;


use EnableMediaReplace\Build\PackageLoader;

class Load_ACF {

	use Badges;

	public function run() {
		add_action( 'acf/init', [ $this, 'add_options_sub_page' ] );
		add_action( 'acf/init', [ $this, 'add_fields' ] );
	}

	public function add_options_sub_page() {
		Plugin::debug();
		acf_add_options_sub_page( [
			'parent_slug' => 'options-general.php',
			'menu_slug' => 'kntnt-podcast-player',
			'menu_title' => __( 'Kntnt Podcast Player', 'kntnt-podcast-player' ),
			'page_title' => __( 'Kntnt Podcast Player', 'kntnt-podcast-player' ),
		] );
	}

	public function add_fields() {
		Plugin::debug();
		acf_add_local_field_group( [
			'key' => 'group_602c0668e836a',
			'title' => __( 'Kntnt Podcast Player', 'kntnt-podcast-player' ),
			'fields' => [
				[
					'key' => 'field_602c067f2b233',
					'label' => __( 'Shortcodes', 'kntnt-podcast-player' ),
					'name' => 'kntnt-podcast-player-shortcodes',
					'type' => 'repeater',
					'instructions' => __( 'Each shortcode must have a unique <strong>tag</strong> that you specify. It can only contain the characters A–Z, a–z, 0–9, - and _. If you enter <em>my_podcast</em> as tag, then you can use <code>[my_podcast]</code> to insert WordPress built-in audio player followed by badges that link to your show on various platforms.<br>
<br>
The shortcodes accept optional attributes that are identical to those of WordPress\' build-in shortcode <a href="https://wordpress.org/support/article/audio-shortcode/"><code>[audio]</code></a>. For instance, <code>[my_podcast src="https://www.my-podcast.com/my-podcast-001.mp3"]</code> will play the audio file that can be downloaded at <em>https://www.my-podcast.com/my-podcast-001.mp3</em>.<br>
<br>
As an alternative to provide the <code>src</code> attribute, you can add a string of A–Z, a–z, 0–9, - and _ in the shortcode, which will replace <code>{}</code> in the <strong>source template</strong> you provide. If you, for an example, enter <code>https://www.my-podcast.com/my-podcast-{}.mp3</code> in the source template field, then <code>[my_podcast 001]</code> will give the same result as <code>[my_podcast src="https://www.my-podcast.com/my-podcast-001.mp3"]</code>.<br>
<br>', 'kntnt-podcast-player' ),
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => [
						'width' => '',
						'class' => '',
						'id' => '',
					],
					'collapsed' => 'field_602c06bc2b234',
					'min' => 0,
					'max' => 0,
					'layout' => 'block',
					'button_label' => __( 'Add shortcode', 'kntnt-podcast-player' ),
					'sub_fields' => [
						[
							'key' => 'field_602c06bc2b234',
							'label' => __( 'Shortcode tag', 'kntnt-podcast-player' ),
							'name' => 'tag',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => [
								'width' => '20',
								'class' => '',
								'id' => '',
							],
							'default_value' => '',
							'placeholder' => _x( 'my_podcast', 'placeholder', 'kntnt-podcast-player' ),
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						],
						[
							'key' => 'field_602ec48024726',
							'label' => __( 'Color scheme', 'kntnt-podcast-player' ),
							'name' => 'color',
							'type' => 'select',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => [
								[
									[
										'field' => 'field_602c06bc2b234',
										'operator' => '!=empty',
									],
								],
							],
							'wrapper' => [
								'width' => '20',
								'class' => '',
								'id' => '',
							],
							'choices' => self::colors(),
							'default_value' => false,
							'allow_null' => 0,
							'multiple' => 0,
							'ui' => 0,
							'return_format' => 'value',
							'ajax' => 0,
							'placeholder' => '',
						],
						[
							'key' => 'field_602fb3dc3e0b3',
							'label' => __( 'Preload default', 'kntnt-podcast-player' ),
							'name' => 'preload',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => [
								[
									[
										'field' => 'field_602c06bc2b234',
										'operator' => '!=empty',
									],
									[
										'field' => 'field_602ec48024726',
										'operator' => '!=empty',
									],
								],
							],
							'wrapper' => [
								'width' => '20',
								'class' => '',
								'id' => '',
							],
							'message' => '',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => __( 'On', 'kntnt-podcast-player' ),
							'ui_off_text' => __( 'Off', 'kntnt-podcast-player' ),
						],
						[
							'key' => 'field_602fb43f3e0b4',
							'label' => __( 'Autoplay default', 'kntnt-podcast-player' ),
							'name' => 'autoplay',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => [
								[
									[
										'field' => 'field_602c06bc2b234',
										'operator' => '!=empty',
									],
									[
										'field' => 'field_602ec48024726',
										'operator' => '!=empty',
									],
								],
							],
							'wrapper' => [
								'width' => '20',
								'class' => '',
								'id' => '',
							],
							'message' => '',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => __( 'On', 'kntnt-podcast-player' ),
							'ui_off_text' => __( 'Off', 'kntnt-podcast-player' ),
						],
						[
							'key' => 'field_602fb4553e0b5',
							'label' => __( 'Loop default', 'kntnt-podcast-player' ),
							'name' => 'loop',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => [
								[
									[
										'field' => 'field_602c06bc2b234',
										'operator' => '!=empty',
									],
									[
										'field' => 'field_602ec48024726',
										'operator' => '!=empty',
									],
								],
							],
							'wrapper' => [
								'width' => '20',
								'class' => '',
								'id' => '',
							],
							'message' => '',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => __( 'On', 'kntnt-podcast-player' ),
							'ui_off_text' => __( 'Off', 'kntnt-podcast-player' ),
						],
						[
							'key' => 'field_602c2a13f6d7c',
							'label' => __( 'Source template', 'kntnt-podcast-player' ),
							'name' => 'source_template',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => [
								[
									[
										'field' => 'field_602c06bc2b234',
										'operator' => '!=empty',
									],
									[
										'field' => 'field_602ec48024726',
										'operator' => '!=empty',
									],
								],
							],
							'wrapper' => [
								'width' => '',
								'class' => '',
								'id' => '',
							],
							'default_value' => '',
							'placeholder' => '{}',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						],
						[
							'key' => 'field_602c09a02b237',
							'label' => __( 'Badges', 'kntnt-podcast-player' ),
							'name' => 'badges',
							'type' => 'repeater',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => [
								[
									[
										'field' => 'field_602c06bc2b234',
										'operator' => '!=empty',
									],
									[
										'field' => 'field_602c2a13f6d7c',
										'operator' => '!=empty',
									],
									[
										'field' => 'field_602ec48024726',
										'operator' => '!=empty',
									],
								],
							],
							'wrapper' => [
								'width' => '',
								'class' => '',
								'id' => '',
							],
							'collapsed' => 'field_602c072f2b236',
							'min' => 0,
							'max' => 0,
							'layout' => 'block',
							'button_label' => __( 'Add badge', 'kntnt-podcast-player' ),
							'sub_fields' => [
								[
									'key' => 'field_602c072f2b236',
									'label' => __( 'Badge', 'kntnt-podcast-player' ),
									'name' => 'name',
									'type' => 'select',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => 0,
									'wrapper' => [
										'width' => '25',
										'class' => '',
										'id' => '',
									],
									'choices' => self::services(),
									'default_value' => false,
									'allow_null' => 1,
									'multiple' => 0,
									'ui' => 0,
									'return_format' => 'value',
									'ajax' => 0,
									'placeholder' => '',
								],
								[
									'key' => 'field_602c0a092b238',
									'label' => __( 'Link', 'kntnt-podcast-player' ),
									'name' => 'link',
									'type' => 'url',
									'instructions' => '',
									'required' => 1,
									'conditional_logic' => [
										[
											[
												'field' => 'field_602c072f2b236',
												'operator' => '!=empty',
											],
										],
									],
									'wrapper' => [
										'width' => '75',
										'class' => '',
										'id' => '',
									],
									'default_value' => '',
									'placeholder' => '',
								],
							],
						],
					],
				],
			],
			'location' => [
				[
					[
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'kntnt-podcast-player',
					],
				],
			],
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'seamless',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		] );
	}

}