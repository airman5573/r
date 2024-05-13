<div id="kboard-dalia-before-after-list">
	<ul class="kboard-dalia-before-after-list">
		<?php while($content = $list->hasNext()):?>
			<?php include 'list-board-list.php'?>
		<?php endwhile?>
	</ul>
</div>

<?php
wp_enqueue_script('kboard-dalia-before-after-list', "{$skin_path}/list.js", array(), KBOARD_VERSION, true);
?>