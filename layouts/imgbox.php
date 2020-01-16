<?php
$image_file = get_random_bg_url() ? 'background-image: url(' . get_random_bg_url() . ');' : '';
$bg_style = akina_option('focus_height') ? 'background-position: center center;background-attachment: inherit;' : '';
?>
<figure id="centerbg" class="centerbg" style="<?php echo $image_file . $bg_style ?>">
<?php if (akina_option('focus_canvas_animinte') == 'waveloop') {?>
     <div id="banner_bolang_bg_1"></div>
     <div id="banner_bolang_bg_2"></div>
<?php }?>
	<?php if (!akina_option('focus_infos')) {?>
	<div class="focusinfo">
   		<?php if (akina_option('focus_logo')): ?>
	     <div class="header-tou"><a href="<?php bloginfo('url');?>" ><img alt='logo' src="<?php echo akina_option('focus_logo', ''); ?>"></a></div>
	  	<?php else: ?>
         <div class="header-tou" ><a href="<?php bloginfo('url');?>"><img alt='avatar' src="<?php bloginfo('template_url');?>/images/avatar.jpg"></a></div>
		  <?php endif;if (akina_option('scilper_jinrishici')): ?>
		  <script src="<?php echo get_template_directory_uri() ?>/js/jinrishici.js" charset="utf-8"></script> <?php endif;?>
		<div id="hitokoto" class="header-info animated"><p id="hitokoto_text" class="jinrishici-sentence"><?php echo akina_option('admin_des', 'Carpe Diem and Do what I like'); ?></p></div>
		<div class="top-social">
		<?php if (akina_option('wechat')) {?>
		<li class="wechat"><a href="#"><img src="<?php bloginfo('template_url');?>/images/sns/wechat.png"/></a>
			<div class="wechatInner">
				<img src="<?php echo akina_option('wechat', ''); ?>" alt="微信公众号">
			</div>
		</li>
		<?php }?>
		<?php if (akina_option('sina')) {?>
		<li><a href="<?php echo akina_option('sina', ''); ?>" target="_blank" class="social-sina" title="sina"><img  alt='新浪微博'  src="<?php bloginfo('template_url');?>/images/sns/sina.png"/></a></li>
		<?php }?>
		<?php if (akina_option('qq')) {?>
		<li class="qq"><a href="//wpa.qq.com/msgrd?v=3&uin=<?php echo akina_option('qq', ''); ?>&site=qq&menu=yes" target="_blank" title="Initiate chat ?"><img  alt='QQ' src="<?php bloginfo('template_url');?>/images/sns/qq.png"/></a></li>
		<?php }?>
		<?php if (akina_option('zhihu')) {?>
		<li><a href="<?php echo akina_option('zhihu', ''); ?>" target="_blank" class="social-zhihu" title="zhihu"><img alt='知乎'  src="<?php bloginfo('template_url');?>/images/sns/zhihu.png"/></a></li>
		<?php }?>
		<?php if (akina_option('github')) {?>
		<li><a href="<?php echo akina_option('github', ''); ?>" target="_blank" class="social-github" title="github"><img alt='github'  src="<?php bloginfo('template_url');?>/images/sns/github.png"/></a></li>
		<?php }?>
		<?php if (akina_option('lofter')) {?>
		<li><a href="<?php echo akina_option('lofter', ''); ?>" target="_blank" class="social-lofter" title="lofter"><img  alt='LOFTER' src="<?php bloginfo('template_url');?>/images/sns/lofter.png"/></a></li>
		<?php }?>
		<?php if (akina_option('bili')) {?>
		<li><a href="<?php echo akina_option('bili', ''); ?>" target="_blank" class="social-bili" title="bilibili"><img alt='小破站'  src="<?php bloginfo('template_url');?>/images/sns/bilibili.png"/></a></li>
		<?php }?>
		<?php if (akina_option('youku')) {?>
		<li><a href="<?php echo akina_option('youku', ''); ?>" target="_blank" class="social-youku" title="youku"><img alt='优酷'  src="<?php bloginfo('template_url');?>/images/sns/youku.png"/></a></li>
		<?php }?>
		<?php if (akina_option('wangyiyun')) {?>
		<li><a href="<?php echo akina_option('wangyiyun', ''); ?>" target="_blank" class="social-wangyiyun" title="CloudMusic"><img alt='网易云'  src="<?php bloginfo('template_url');?>/images/sns/wangyiyun.png"/></a></li>
		<?php }?>
		<?php if (akina_option('twitter')) {?>
		<li><a href="<?php echo akina_option('twitter', ''); ?>" target="_blank" class="social-wangyiyun" title="Twitter"><img alt='推特'  src="<?php bloginfo('template_url');?>/images/sns/twitter.png"/></a></li>
		<?php }?>
		<?php if (akina_option('facebook')) {?>
		<li><a href="<?php echo akina_option('facebook', ''); ?>" target="_blank" class="social-wangyiyun" title="Facebook"><img alt='脸书'  src="<?php bloginfo('template_url');?>/images/sns/facebook.png"/></a></li>
		<?php }?>
		<?php if (akina_option('googleplus')) {?>
		<li><a href="<?php echo akina_option('googleplus', ''); ?>" target="_blank" class="social-wangyiyun" title="Google+"><img  alt='谷歌' src="<?php bloginfo('template_url');?>/images/sns/googleplus.png"/></a></li>
		<?php }?>
	  	</div>
	</div>
	<?php }?>
</figure>
<?php
echo bgvideo(); //BGVideo