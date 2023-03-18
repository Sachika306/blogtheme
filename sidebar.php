<aside class="col-md-4">
    <?php if (get_theme_mod('show_popular_article_control')) : ?>
        <section class="sidebar">
            <div class="topArticles">
                <h3 class="sidebar-title">人気記事ランキング</h3>
                <div class="topArticles-wrap">
                    <?php get_template_part('template-parts/showRanking'); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (get_theme_mod('show_profile_control')) : ?>
        <section class="sidebar" itemscope itemtype="https://schema.org/Person">
            <div class="profile" itemprop="author">
                <h3 class="sidebar-title" itemprop="name"><?php echo get_theme_mod('profile_name_control'); ?></h3>
                <img class="profile-image" src="<?php echo get_theme_mod('profile_image_control'); ?>" alt="プロフィール画像" >
                <div class="profile-text">
                    <p><?php echo get_theme_mod('profile_text_control'); ?></p>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (get_theme_mod('show_tag_cloud_control')) : ?>
        <section class="sidebar">
            <div class="tagCloud" itemprop="keywords">
                <h3 class="sidebar-title"><?php echo get_theme_mod('tag_cloud_title_control'); ?></h3>
                <div class="tag_cloud">
                    <?php echo get_template_part('template-parts/showTagCloud'); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>


</aside>