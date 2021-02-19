<div class="kntnt-podcast-player">
    <div>
		<?php echo wp_audio_shortcode( [ 'src' => $src, 'preload' => $preload, 'autoplay' => $autoplay, 'loop' => $loop ], $content ); ?>
    </div>
	<?php if ( $badges ): ?>
        <div>
			<?php foreach ( $badges as $badge ): ?><a href="<?php echo $badge['link']; ?>" title="<?php echo $badge['text']; ?>"><img src="<?php echo $badge['src']; ?>" srcset="<?php echo $badge['srcset']; ?>" alt="<?php echo $badge['text']; ?>"></a><?php endforeach; ?>
        </div>
	<?php endif; ?>
</div>
