<aside class="col-md-4">
    <section class="sidebar">
        <div class="topArticles">

            <!-- 人気の記事 -->
            <h3 class="sidebar-title">人気の記事</h3>
            <?php
            $i = 1; // ランキングのカウント開始数値
            $query = new WP_query( array(
                'posts_per_page' => 5,
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

    <section class="sidebar" itemscope itemtype="https://schema.org/Person">
        <div class="profile" itemprop="author">
            <h3 class="sidebar-title" itemprop="name"><?php the_author_meta('nickname'); ?></h3>
            <img class="profile-image" src="<?php echo get_avatar_url(get_the_author_meta(2)); ?>" alt="プロフィール画像" >
            <div class="profile-text">
                <p><?php the_author_meta('description'); ?></p>
            </div>
        </div>
    </section>

    <section class="sidebar">
            <div>
                <h3 class="sidebar-title">独学でエンジニア転職</h3>
                <span>独学でエンジニアに転職するためのロードマップです。</span>
                <div class="loadmap">
                    <div class="loadmap_content">
                        <h4>学習編</h4>
                        <div class="list">
                            <ol>
                                <li>HTML/CSSを勉強する</li>
                                <li>サーバーサイド言語を勉強する</li>
                                <li>aaa</li>
                            </ol>
                        </div>
                    </div>
                    <div class="loadmap_content">
                        <h4 class="">ポートフォリオ制作のコツ</h4>
                        <div class="list">
                            <ol>
                                <li>HTML/CSSを勉強する</li>
                                <li>サーバーサイド言語を勉強する</li>
                                <li>aaa</li>
                            </ol>
                        </div>
                    </div>
                    <div class="loadmap_content">
                        <h4 class="">転職活動編</h4>
                        <div class="list">
                            <ol>
                                <li>HTML/CSSを勉強する</li>
                                <li>サーバーサイド言語を勉強する</li>
                                <li>aaa</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
    </section>

</aside>