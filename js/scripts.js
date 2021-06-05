$(document).ready(function(){
    $('.header-nav__sp').click(function() {
        $('.spnavMenu').toggleClass('openNav');
        if ($('.spnavMenu').hasClass('openNav')) {
			$('body').addClass('active');
        } else {
            $('body').removeClass('active');
        }
    });

    $('.header-nav__md').click(function() {
        $('.search').toggleClass('openSearch');
        $('.search > form > input').focus(); // 検索開いたら自動でinputにフォーカス
        if ($('.search').hasClass('openSearch')) {
            $('body').addClass('active');
        } else {
            $('body').removeClass('active');
        }
    });

    // 検索開いてるとき、ボックス以外の箇所をクリックしたら閉じる
    $('.search').click(function(e) {
        if (!$(e.target).closest('.form-control').length) {
            $('.search').removeClass('openSearch');　
            $('body').removeClass('active');
          }
    });

    $('.parentMenu').find(".menu-item" ).mouseover(function() {  // mouse enter
        $( this ).find( " > .childMenu" ).toggleClass('menu-itemActive');
    });

    $( ".menu-item" ).mouseout(function() {  // mouse enter
        $( this ).find( " > .childMenu" ).toggleClass('menu-itemActive');
    });


    //　目次の自動作成
    var idcount = 1;
    var toc = '<ol>';
    var level = 0;
    $("article h2,article h3", this).each(function () {
        this.id = "toc-id" + idcount;
        idcount++;
        if (this.nodeName.toLowerCase() == "h2") {
        if (level > 0) {
            toc += '</ol></li>';
            level = 0;
        }
        } else if (this.nodeName.toLowerCase() == "h3") {
        if (level == 0) {
            toc += '<li><ol>';
            level = 1;
        }
        }
        toc += '<li><a href="#' + this.id + '">' + $(this).html() + "</a></li>\n";
    });
    toc += '</ol>';

    // h2の前に目次を挿入
    if ($("article h2")[0]) {
        $("#toc").html('<div class="toc-title">Contents</div>' + toc);
    }

    //　目次をクリックしたときに移動
    $('a[href^="#"]').click(function(){
        var	speed = 400,
            href= $(this).attr("href"),
            target = $(href == "#" || href == "" ? 'html' : href),
            position = target.offset().top;
        $('body,html').animate({scrollTop:position}, speed, 'swing');
        return false;
    });
});
