<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */

?>
</div><!-- #content -->
<?php
if (akina_option('general_disqus_plugin_support')) {
    get_template_part('layouts/duoshuo');
} else {
    comments_template('', true);
}
?>
</div><!-- #page Pjax container-->
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
        <div class="footertext">
            <p class="foo-logo" style="background-image: url('<?php bloginfo('template_url');?>/images/f-logo.png');"></p>
            <div id="typing" class="footer-device"><?php echo akina_option('admin_des', ''); ?></div>
        </div>
        <!--显示底部加载所用时间-->
        <?php if (akina_option('load-timeshow') != '0') {?>
            <div class="footer-device" id="TimeShow"></div>
        <?php }?>
        <div>页面生成仅用了<?php timer_stop(1);?>秒</div>
        <div class="footer-device">
        <?php
$statistics_link = akina_option('site_statistics_link') ? '<a href="' . akina_option('site_statistics_link') . '" target="_blank" rel="nofollow">Statistics</a>' : '';
$site_map_link = akina_option('site_map_link') ? '<a href="' . akina_option('site_map_link') . '" target="_blank" rel="nofollow">Sitemap</a>' : '';
printf(esc_html__('%1$s &nbsp; %2$s &nbsp; %3$s &nbsp; %4$s', 'akina'), $site_map_link, '<a href="https://www.liudank.cn/archives/283.html" rel="designer" target="_blank" rel="nofollow">Theme</a>', '<a href="https://wordpress.org/" target="_blank" rel="nofollow">WordPress</a>', $statistics_link);
?>

 <div class="footer-device"><?php echo akina_option('footer_info', ''); ?></div>

    <!--显示网站已运行多长时间-->
<?php if (akina_option('web_runtime') != '0') {
    $web_buildtime = akina_option('web_buildtime');
    ?>
    <div class="footer-device">
        <span id="span_dt_dt"></span>
        <script type="text/javascript">
function show_date_time() {
    window.setTimeout("show_date_time()", 1000);
    BirthDay = new Date("<?php echo $web_buildtime; ?>");//这个日期是可以修改的
    today = new Date();
    timeold = (today.getTime() - BirthDay.getTime());
    sectimeold = timeold / 1000
    secondsold = Math.floor(sectimeold);
    msPerDay = 24 * 60 * 60 * 1000
    e_daysold = timeold / msPerDay
    daysold = Math.floor(e_daysold);
    e_hrsold = (e_daysold - daysold) * 24;
    hrsold = Math.floor(e_hrsold);
    e_minsold = (e_hrsold - hrsold) * 60;
    minsold = Math.floor((e_hrsold - hrsold) * 60);
    seconds = Math.floor((e_minsold - minsold) * 60);
    span_dt_dt.innerHTML = " <?php bloginfo('name');?>已经坚强存活了：" + daysold + "天" + hrsold + "小时" + minsold + "分" + seconds + "秒";
}
            show_date_time();
        </script>
    </div>
<?php }?>
<!-- 备案信息 S-->
<div class="footer-device"><?php echo akina_option('copyrightlink') ? '<a href="https://www.beian.miit.gov.cn" target="_blank" rel="nofollow">' . akina_option('copyrightlink') . '</a>' : ''; ?><?php echo akina_option('beian_link') ? ' | <a href="' . akina_option('beian_link') . '" target="_blank" rel="nofollow"><img src="' . get_template_directory_uri() . '/images/beian.png" style="width:14px;weight:14px;"/>' . akina_option('beian_value') . '</a>' : ''; ?></div>
<!-- 备案信息 E-->
</div>
</footer><!-- #colophon -->
<div class="openNav">
    <div class="iconflat">
        <div class="icon"></div>
    </div>
    <div class="site-branding">
        <?php if (akina_option('akina_logo')) {?>
            <div class="site-title"><a href="<?php bloginfo('url');?>"><img src="<?php echo akina_option('akina_logo'); ?>"></a></div>
        <?php } else {?>
            <h1 class="site-title"><a href="<?php bloginfo('url');?>"><?php bloginfo('name');?></a></h1>
        <?php }?>
    </div>
</div><!-- m-nav-bar -->
</section><!-- #section -->
<!-- m-nav-center -->
<div id="mo-nav">
    <div class="m-avatar">
        <?php $ava = akina_option('focus_logo') ? akina_option('focus_logo') : get_template_directory_uri() . '/images/avatar.jpg';?>
        <img src="<?php echo $ava ?>">
    </div>
    <div class="m-search">
        <form class="m-search-form" method="get" action="<?php echo home_url(); ?>" role="search">
            <input class="m-search-input" type="search" name="s" placeholder="<?php _e('搜索...', 'akina')?>" required>
        </form>
    </div>
    <?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'primary', 'container' => false));?>
</div><!-- m-nav-center end -->
<a href="#" class="cd-top"></a>
<!-- search start -->
<form class="js-search search-form search-form--modal" method="get" action="<?php echo home_url(); ?>" role="search">
    <div class="search-form__inner">
        <div>
            <p class="micro mb-"><?php _e('输入后按回车搜索 ...', 'akina')?></p>
            <i class="iconfont">&#xe65c;</i>
            <input class="text-input" type="search" name="s" placeholder="<?php _e('Search', 'akina')?>" required>
        </div>
    </div>
    <div class="search_close"></div>
</form>
<!-- search end -->

<!-- page loading -->
<div id="loading">
    <div id="loading-center-absolute">
		<span class="heartbeat-loader">Loading&#8230;</span>
		<p>正在玩命加载中...</p>
    </div>
</div>
<?php wp_footer();?>

<?php if (akina_option('focus_canvas_animinte') == 'waveloop') {?>
<!-- 波浪动画 -->
<script type="text/javascript">
    $(function () {
        //底部波浪动画
        function waveloop1() {
            $("#banner_bolang_bg_1").css({"left": "-236px"}).animate({"left": "-1233px"}, 25000, 'linear', waveloop1);
        }

        function waveloop2() {
            $("#banner_bolang_bg_2").css({"left": "0px"}).animate({"left": "-1009px"}, 60000, 'linear', waveloop2);
        }

        //循环播放
        if (screen && screen.width > 480) {
            waveloop1();
            waveloop2();
        }
    });
</script>
<?php }?>

<?php if (akina_option('focus_canvas_animinte') == 'bubble') {?>
<!-- 气泡动画 -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/bubble.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".bubble").show();
    });
</script>
<?php }?>
<?php if (akina_option('canvas_nest') != '0') {?>
<!-- 引入峰窝canvas 如果屏幕大于480的话 -->
<script type="text/javascript">
    if (screen && screen.width > 480) {
        document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/canvas-nest.min.js" type="text/javascript"><\/script>');
    }
</script>
<?php }?>
<?php if (akina_option('canvas_heart') != '0') {?>
<!-- 鼠标❤特效 -->
<script type="text/javascript">
    if (screen && screen.width > 480) {
        document.write('<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/canvas-heart.min.js" type="text/javascript"><\/script>');
    }
</script>
<?php }?>
 <?php if (akina_option('progress_type') == 'readprogress') {?>
		<!--/*阅读进度条js*/-->
    <script type="text/javascript">
        document.onscroll = function () {
            var scrollDistance = getScrollTop();
            var pxx = scrollAct(scrollDistance)
            document.getElementById("readprogress").style.width = pxx;
        }

        function scrollAct(insetOff) {
            var webHeight = document.body.scrollHeight - window.innerHeight;
            var p = (insetOff / webHeight ) * 100;
            return p.toString() + "%";
        }

        function getScrollTop() {
            var scrollPos;
            if (window.pageYOffset) {
                scrollPos = window.pageYOffset;
            }
            else if (document.compatMode && document.compatMode != 'BackCompat') {
                scrollPos = document.documentElement.scrollTop;
            }
            else if (document.body) {
                scrollPos = document.body.scrollTop;
            }
            return scrollPos;
        }
    </script>
	
    <?php }?>
<?php if (akina_option('progress_type') == 'loadprogress') {?>
<!-- nprogress进度条加载 -->
<script type="text/javascript">
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function () {
        NProgress.done();
        $('.fade').removeClass('out');
    }, 1000);
</script>
<?php }?>
<script type="text/javascript">
        var t1 = new Date().getTime();
        if (!!window.ActiveXObject || "ActiveXObject" in window) { //is IE?
            alert('请抛弃万恶的IE系列浏览器吧！');
        };
    </script>
<script type="text/javascript">
		function rbq() {
			var audio = document.createElement('audio');
			var body = document.body;
			audio.autoplay = true;
			body.appendChild(audio);
			audio.addEventListener('ended', function() {
					body.removeChild(audio);  // 播放完毕后从HTML中删除该音频
			}, false);
		};
    </script>
     <!--网站标题自动判断	设置/*-->
     <script type="text/javascript">
        var title = document.title;
        // window 失去焦点
        window.onblur = function () {
            document.title = '<?php echo $onblur_text; ?>';
        };
        // window 获得焦点
        window.onfocus = function () {
            document.title = '<?php echo $onfocus_text; ?>';
            setTimeout("document.title=title", 3000);
        }
    </script>
<?php if (akina_option('music_id') && akina_option('music_res')) {?>
<!-- 播放音乐需要引入 -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/APlayer.min.css">
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/APlayer.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/Meting.min.js"></script>
<meting-js
	mini="true"
	fixed="true"
	server="<?php echo akina_option('music_res'); ?>"
	type="playlist"
	id="<?php echo akina_option('music_id'); ?>">
</meting-js><?php }?>
	</body>
</html>