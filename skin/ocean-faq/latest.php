<ul id="kboard-ocean-faq-latest">
	<?php while($content = $list->hasNext()):?>
		<li class="kboard-ocean-faq-latest-item cut_strings">
			<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>"><?php echo $content->title?></a>
		</li>
	<?php endwhile?>
</ul>