<?php 
//カスタマイザー
function themeslug_sanitize_checkbox($checked) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function sidebar_panel($wp_customize)
{
    // ヘッダー
    // ヘッダーパネル
    $wp_customize->add_panel(
        'header_panel',
        array(
            'title' => 'ヘッダー',
            'priority' => 10,
        )
    );

    // ヘッダーセクション
    $wp_customize->add_section(
        'header_logo', //セクションID
        array(
            'title' => 'ヘッダー左文字列',//セクションタイトル名
            'priority' => 10,//パネル内の表示位置
            'panel' => 'header_panel',//紐付けるパネルID
        )
        );
       
    $wp_customize->add_section(
        'header_mobile_menu', //セクションID
        array(
            'title' => 'ヘッダー右メニュー',//セクションタイトル名
            'priority' => 20,//パネル内の表示位置
            'panel' => 'header_panel',//紐付けるパネルID
        )
        );
    
    // ヘッダーコントロール
    $wp_customize->add_setting('header_logo_control');
    $wp_customize->add_control( 
    'header_logo_control', array(
        'label' => 'ヘッダーロゴ文字列',
        'description' => 'ヘッダー左に表示するロゴを入力してください',
        'settings' => 'header_logo_control',
        'section' => 'header_logo',
    )
    );

    $wp_customize->add_setting('header_mobile_menu_control');
    $wp_customize->add_control( 
    'header_mobile_menu_control', array(
        'label' => 'モバイルヘッダーメニュー表示',
        'description' => 'モバイル利用時に表示される、右上ヘッダーメニューの表示有無',
        'settings' => 'header_mobile_menu_control',
        'section' => 'header_mobile_menu',
        'type' => 'checkbox',
    )
    );

    // サイドバー
    // サイドバーパネル
    $wp_customize->add_panel(
        'sidebar_panel',
        array(
            'title' => 'サイドバー',
            'priority' => 10,
        )
    );

    // サイドバーセクション
    $wp_customize->add_section('sidebar',
        array(
            'title' => '人気記事',
            'priority' => 10,
            'panel' => 'sidebar_panel',
        )
    );

    $wp_customize->add_section('profile',
        array(
            'title' => 'プロフィール',
            'priority' => 20,
            'panel' => 'sidebar_panel',
        )
    );

    // サイドバーコンロール
    $wp_customize->add_setting('show_popular_article_control');
    $wp_customize->add_control('show_popular_article_control', array(
        'settings' => 'show_popular_article_control',
        'label' =>'人気記事の表示',
        'section' => 'sidebar',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('popular_article_control', array('default' => 5));
    $wp_customize->add_control( 'popular_article_control', array(
        'type' => 'range',
        'settings' => 'popular_article_control',
        'label' => '人気記事の表示数',
        'section' => 'sidebar',
        'description' => '1〜10の間で選択してください',
        'input_attrs' => array(
            'min' => 1,
            'max' => 10,
          ),
        )
    );


    // フッター
    // フッターパネル
    $wp_customize->add_panel(
        'footer_panel',
        array(
            'title' => 'フッター',
            'priority' => 10,
        )
    );

    // フッターセクション
    $wp_customize->add_section('footer_left', array(
        'title' => 'フッター左',
        'priority' => 10,
        'panel' => 'footer_panel',
        )
    );

    $wp_customize->add_section('footer_center', array(
        'title' => 'フッター中央',
        'priority' => 10,
        'panel' => 'footer_panel',
        )
    );

    $wp_customize->add_section('footer_right', array(
        'title' => 'フッター右',
        'priority' => 10,
        'panel' => 'footer_panel',
        )
    );

    // フッターコントロール
    $wp_customize->add_setting('show_profile_control',  array(
        'default' => 'child_none',
     ));
     $wp_customize->add_control('show_profile_control', array(
        'settings' => 'show_profile_control',
        'label' =>'プロフィールの表示',
        'section' => 'profile',
        'type' => 'checkbox'
    ));

    $wp_customize->add_setting('profile_name_control');
    $wp_customize->add_control('profile_name_control', array(
            'settings' => 'profile_name_control',
            'label' =>'プロフィール名',
            'panel' => 'sidebar',
            'section' => 'profile',
            'type' => 'text'
        )
    );
     
    $wp_customize->add_setting('profile_image_control');
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize, 'profile_image_control', 
        array(
            'settings' => 'profile_image_control',
            'label' =>'プロフィール画像',
            'panel' => 'sidebar',
            'section' => 'profile',
        )
    ));

    $wp_customize->add_setting('profile_text_control');
    $wp_customize->add_control('profile_text_control',
        array(
            'settings' => 'profile_text_control',
            'label' =>'プロフィール文',
            'section' => 'profile',
            'type' => 'textarea',
            'description' => '改行は自動挿入されません。手動で<br>タグを挿入してください。'
        )
    );

    $wp_customize->add_setting('show_footer_left_control',  array('default' => false));
    $wp_customize->add_control('show_footer_left_control',
        array(
            'settings' => 'show_footer_left_control',
            'label' => 'フッター左の表示',
            'section' => 'footer_left',
            'type' => 'checkbox',
            'description' => 'フッター左にはメニューを設定できます。メニューはカスタマイズ＞メニューから設定してください。'
        )
    );

    $wp_customize->add_setting('show_footer_center_control',  array('default' => false));
    $wp_customize->add_control('show_footer_center_control',
        array(
            'settings' => 'show_footer_center_control',
            'label' => 'フッター中央の表示',
            'section' => 'footer_center',
            'type' => 'checkbox',
            'description' => 'フッター中央にはメニューを設定できます。メニューはカスタマイズ＞メニューから設定してください。'
        )
    );

    $wp_customize->add_setting('show_footer_right_control', array('default' => false));
    $wp_customize->add_control('show_footer_right_control',
        array(
            'settings' => 'show_footer_right_control',
            'label' => 'フッター右の表示',
            'section' => 'footer_right',
            'type' => 'checkbox',
        )
    );

    $wp_customize->add_setting('show_twitter_control');
    $wp_customize->add_control('show_twitter_control',
        array(
            'settings' => 'show_twitter_control',
            'label' => 'Twitterの表示',
            'section' => 'footer_right',
            'type' => 'checkbox',
        )
    );

    $wp_customize->add_setting('twitter_title_control');
    $wp_customize->add_control('twitter_title_control',
        array(
            'settings' => 'twitter_title_control',
            'label' =>'Twitter埋め込み見出し',
            'section' => 'footer_right',
            'type' => 'text',
            'description' => '見出しを入れてください',
        )
    );

    $wp_customize->add_setting('twitter_list_control');
    $wp_customize->add_control('twitter_list_control',
        array(
            'settings' => 'twitter_list_control',
            'label' =>'Twitter埋め込みコード',
            'section' => 'footer_right',
            'type' => 'textarea',
            'description' => 'https://publish.twitter.com/こちらで作ったものを挿入'
        )
    );

    // カラー設定
    // カラー設定パネル
    $wp_customize->add_panel(
        'color_panel',
        array(
            'title' => 'カラー設定',
            'priority' => 10,
        )
    );

    // カラー設定セクション
    $wp_customize->add_section('color_setting', array(
        'title' => 'カラー設定',
        'priority' => 10,
        'panel' => 'color_panel',
        )
    );

    // カラー設定コントロール
    $wp_customize->add_setting('header_color_control',  array(
        'default' => '333333',
     ));
     $wp_customize->add_control(new WP_Customize_Color_Control( 
        $wp_customize, 'header_color_control',
        array(
            'settings' => 'header_color_control',
            'label' =>'ヘッダーの色',
            'section' => 'color_setting',
        )
    ));

    // アクセントカラー（濃）
    $wp_customize->add_setting('accent_color_control',  array(
        'default' => '208997',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control( 
        $wp_customize, 'accent_color_control',
        array(
            'settings' => 'accent_color_control',
            'label' =>'アクセントの色（濃）',
            'section' => 'color_setting',
            'description' => 'サイドバーや、個別記事のh2見出しの下、目次などに利用されます'
        )
    ));

    // アクセントカラー（薄）
    $wp_customize->add_setting('light_accent_color_control',  array(
        'default' => 'F2F7F8',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control( 
        $wp_customize, 'light_accent_color_control',
        array(
            'settings' => 'light_accent_color_control',
            'label' =>'アクセントの色（薄）',
            'section' => 'color_setting',
            'description' => '目次の後ろの背景などに利用されます'
        )
    ));
}
?>