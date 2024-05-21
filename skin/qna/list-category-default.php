
<div class="kboard-category">
    <?php if ($board->initCategory1()): ?>
        <ul class="kboard-category-list">
            <li<?php if (!kboard_category1()): ?> class="kboard-category-selected"<?php endif; ?>>
                <a href="<?php echo $url->set('category1', '')
                                        ->set('pageid', '1')
                                        ->set('target', '')
                                        ->set('keyword', '')
                                        ->set('mod', 'list')
                                        ->tostring(); ?>">
                    <?php echo __('All', 'kboard'); ?>
                    <span class="post-amount">(<?php echo dalia_get_count_of_all_article_with_search($board); ?>)</span>
                </a>
            </li>
            <?php while ($board->hasNextCategory()): ?>
                <li<?php if (kboard_category1() == $board->currentCategory()): ?> class="kboard-category-selected"<?php endif; ?>>
                    <a href="<?php echo $url->set('category1', $board->currentCategory())
                                            ->set('pageid', '1')
                                            ->set('target', '')
                                            ->set('keyword', '')
                                            ->set('mod', 'list')
                                            ->toString(); ?>">
                        <?php echo $board->currentCategory(); ?>
                        <?php 
							$category_count = $board->getCategoryCount(array('category1' => $board->currentCategory()));
							if ($category_count) { ?>
								<span class="post-amount">(<?php echo $category_count; ?>)</span> <?php
							}
						?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
    
    <?php if ($board->initCategory2()): ?>
        <ul class="kboard-category-list">
            <li<?php if (!kboard_category2()): ?> class="kboard-category-selected"<?php endif; ?>>
                <a href="<?php echo $url->set('category2', '')
                                        ->set('pageid', '1')
                                        ->set('target', '')
                                        ->set('keyword', '')
                                        ->set('mod', 'list')
                                        ->tostring(); ?>">
                    <?php echo __('All', 'kboard'); ?>
                </a>
            </li>
            <?php while ($board->hasNextCategory()): ?>
                <li<?php if (kboard_category2() == $board->currentCategory()): ?> class="kboard-category-selected"<?php endif; ?>>
                    <a href="<?php echo $url->set('category2', $board->currentCategory())
                                            ->set('pageid', '1')
                                            ->set('target', '')
                                            ->set('keyword', '')
                                            ->set('mod', 'list')
                                            ->toString(); ?>">
                        <?php echo $board->currentCategory(); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
</div>