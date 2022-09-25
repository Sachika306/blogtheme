<aside class="col-md-4">
    <?php if (get_theme_mod('show_popular_article_control')) : ?>
        <section class="sidebar">
            <div class="topArticles">
                <!-- 人気の記事 -->
                <h3 class="sidebar-title">人気の記事</h3>
                <?php
                $i = 1; // ランキングのカウント開始数値
                $query = new WP_query( array(
                    'posts_per_page' => get_theme_mod('popular_article_control'),
                    'meta_key' => 'post_views_count', // アクセス数ごとに並び替える
                    'orderby'   => 'meta_value_num' // アクセス数ごとに並び替える
                ));
                if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                ?>

                    <article class="topArticles-element" itemscope itemtype ="https://schema.org/BlogPosting">
                        <span class="topArticles-element__num"><?php echo ($i); $i++; ?></span>
                        <h4 class="topArticles-element__title" itemprop="headline"><a href="<?php the_permalink(); ?>" itemprop="mainEntityOfPage"><?php the_title(); ?></a></h4>
                    </article>
                <?php
                endwhile; 
                endif;
                wp_reset_query();
                ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if (get_theme_mod('show_profile_control')) : ?>
        <section class="sidebar" itemscope itemtype="https://schema.org/Person">
            <div class="profile" itemprop="author">
                <h3 class="sidebar-title" itemprop="name"><?php the_author_meta('nickname'); ?></h3>
                <img class="profile-image" src="<?php echo get_theme_mod('profile_image_control'); ?>" alt="プロフィール画像" >
                <div class="profile-text">
                    <p><?php echo get_theme_mod('profile_text_control'); ?></p>
                </div>
            </div>
        </section>
    <?php endif; ?>

</aside>