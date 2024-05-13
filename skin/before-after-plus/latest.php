<div id="kboard-before-after-plus-list">
	<ul class="kboard-before-after-plus-list">
		<?php while($content = $list->hasNext()):?>
			<?php include 'list-board-list.php'?>
		<?php endwhile?>
	</ul>
</div>

<?php
wp_enqueue_script('kboard-before-after-plus-list', "{$skin_path}/list.js", array(), KBOARD_VERSION, true);
?>