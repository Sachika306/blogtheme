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
        $('#searchbox').focus(); // 検索開いたら自動でinputにフォーカス
        if ($('.search').hasClass('openSearch')) {
            $('body').addClass('active');
        } else {
            $('body').removeClass('active');
        }
    });

    // 検索開いてるとき、ボックス以外の箇所をクリックしたら閉じる
    $('.search').click(function(e) {
        if (!$(e.target).closest('#searchbox').length) {
            $('.search').removeClass('openSearch');　
            $('body').removeClass('active');
          }
    });
});
