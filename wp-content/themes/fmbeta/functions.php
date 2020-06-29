<?php

//--------------- * 随机文章小工具
class WP_Widget_myRandom_Posts extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_my_random_posts', 'description' => __( '水景一页定制的随机文章微件。The cnzhx customized random posts widget.' ) );
        parent::__construct('random-posts', __('随机文章'), $widget_ops);
        $this->alt_option_name = 'widget_my_random_posts';
    }

    function widget( $args, $instance ) {
        global $randomposts, $post;

        extract($args, EXTR_SKIP);
        $output = '';
        // 设置 widget 标题
        $title = apply_filters('widget_title', empty($instance['title']) ? __('随机文章') : $instance['title']);

        // 设置要获取的文章数目
        if ( ! $number = absint( $instance['number'] ) )
            $number = 5;

        // WP 数据库查询，使用 rand 参数来获取随机的排序，并取用前面的 $number 个文章
        $randomposts = get_posts( array( 'number' => $number, 'orderby' => 'rand', 'post_status' => 'publish' ) );

        // 下面开始准备输出数据
        // 先输出一般的 widget 前缀
        $output .= $before_widget;
        // 输出标题
        if ( $title )
        $output .= $before_title . $title . $after_title;

        // random posts 列表开始
        $output .= '<ul id="randomposts">';
        if ( $randomposts ) {
            foreach ( (array) $randomposts as $post) {
                $output .= '<li><a href="' . get_permalink() . '">' . $post->post_title . '</a></li>';
            }
        }
        $output .= '</ul>';
        // 输出一般的 widget 后缀
        $output .= $after_widget;

        // 输出到页面
        echo $output;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = absint( $new_instance['number'] );

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_my_random_posts']) )
            delete_option('widget_my_random_posts');

        return $instance;
    }

    //
    // 在 WP 后台的 widget 内部显示两个参数, 1. 标题；2. 显示文章数目
    //
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="cnzhx" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        <?php
    }
}

// register WP_Widget_myRandom_Posts widget
add_action( 'widgets_init', create_function( '', 'return register_widget("WP_Widget_myRandom_Posts");' ) );

//判断文章图片个数
 function junzibuqi_post_images_number(){
    global $post;
    $content = $post->post_content;  
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
    return count($strResult[1]);  }

//MultiPostThumbnails多个特色图片
if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => '第二个特色图片',
            'id' => 'secondary-image',
            'post_type' => 'post'
        )
    );
	new MultiPostThumbnails(
        array(
            'label' => '第三个特色图片',
            'id' => 'third-image',
            'post_type' => 'post'
        )
    );
}


//网站标题
function yzipi_title(){ 
		if ( is_home()  || is_page()) {   
        bloginfo('name'); echo " _ "; bloginfo('description');   
    } elseif ( is_category() ) {   
        single_cat_title(); echo " | "; bloginfo('name');   
    } elseif (is_single() || is_page() ) {   
        single_post_title(); 
    } elseif (is_search() ) {   
       echo" 搜索结果 ";
    } elseif (is_404() ) {   
        echo '页面未找到!';   
    } else {   
        wp_title('',true);   
    }
	wp_reset_query(); 
	}
//网站引入css.js
function yzipi_sc() {  

    if ( is_home()&& !is_page()) {
		wp_register_style( 'light', get_template_directory_uri() . '/css/light.css' );   
        wp_enqueue_style( 'light' );
		/*首页幻灯片*/
		wp_register_script( 'swiper.min', get_template_directory_uri() . '/js/swiper.min.js' );        
        wp_enqueue_script( 'swiper.min' );  
        	};
					
	  wp_register_style( 'sytle', get_template_directory_uri() . '/style.css' );  
        wp_enqueue_style( 'sytle' );  
		
		wp_register_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );        
        wp_enqueue_script( 'html5shiv' );  
		/*使一些浏览器支持HTML5*/
		wp_register_script( 'selectivizr-min', get_template_directory_uri() . '/js/selectivizr-min.js' );        
        wp_enqueue_script( 'selectivizr-min' );  
		/*支持 css3 的 media query*/
		wp_register_script( 'jquery.min', get_template_directory_uri() . '/js/jquery.min.js' );        
        wp_enqueue_script( 'jquery.min' );  
		/*下拉加载和菜单伸缩*/
		wp_register_script( 'jiazai', get_template_directory_uri() . '/js/jiazai.js' );        
        wp_enqueue_script( 'jiazai' );  
		
}  
add_action('wp-head', 'yzipi_sc');

//定义后台菜单
function yzipi_menu(){      
    add_menu_page( '柚子皮', '柚子皮', 'edit_themes', 'yzipi_m','display_function','',6);      
}     
 
//首页关键词和描述设置     
function display_function(){      
     ?>

 <h2>主题更新提示</h2>	
	<p>主题会随时更新，请同学多留意柚子皮动态，获取最新版本.</p>
	<a href="http://www.yzipi.com" target="_blank" class="yzipi_admin_a_submit" >点击查看</a>
	
	<a href="tencent://message/?uin=1875522872&Site=柚子皮&Menu=yes" target="_blank" class="yzipi_admin_a_submit" >QQ咨询</a>
	    
<?php }     
     
add_action('admin_menu', 'yzipi_menu');   
 

//SEO优化
add_action('admin_menu', 'seo_submenu_page');

function seo_submenu_page() {     
    add_submenu_page( 'yzipi_m', 'Seo优化', 'Seo优化', 'edit_themes', 'yzipi_seo', 'seo_page_display' );    
}  
function seo_page_display(){ ?>
<form method="post" name="yzipi_keyword" id="yzipi_keyword" action="options.php">
  <h2 class="yzipi_admin_h2">网站首页关键词设置，请用“，”隔开</h2>
  <p>
    <label>
      <input name="yzipi_keywords" size="40" class="yzipi_admin_input"  value="<?php echo get_option('yzipi_keywords'); ?>"/>
    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="yzipi_keywords" />
  <input type="submit" class="yzipi_admin_submit" name="option_save" value="<?php _e('保存设置'); ?>" />
</form>
<form method="post" name="yzipi_description" id="yzipi_description" action="options.php">
  <h2 class="yzipi_admin_h2">网站首页描述设置</h2>
  <p>
    <label>
      <input name="yzipi_descriptions" size="40" class="yzipi_admin_input" value="<?php echo get_option('yzipi_descriptions'); ?>"/>
    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="yzipi_descriptions" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>
<?php }   

 
//添加新浪微博子菜单  
add_action('admin_menu', 'weibo_submenu_page');

function weibo_submenu_page() {     
    add_submenu_page( 'yzipi_m', '新浪微博号', '新浪微博号', 'edit_themes', 'yzipi_weibo', 'weibo_page_display' );    
}  
function weibo_page_display(){ ?>
<form method="post" name="gardenl_weibo" id="yzipi_weibo" action="options.php">
  <h2 class="yzipi_admin_h2">请填写微博号或微博ID</h2>
  <p>
    <label>
      <input name="yzipi_weibos" size="40" class="yzipi_admin_input" value="<?php echo get_option('yzipi_weibos'); ?>"/>

    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="yzipi_weibos" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>
<?php }   

 //幻灯片
add_action('admin_menu', 'huan1_submenu_page');

function huan1_submenu_page() {     
    add_submenu_page( 'yzipi_m', '幻灯片', '幻灯片', 'edit_themes', 'gardenl_huan1', 'huan1_page_display' );    
}  
function huan1_page_display(){ ?>
<form method="post" name="gardenl_huan1" id="gardenl_huan1" action="options.php">
  <h2 class="yzipi_admin_h2">第一张幻灯片图片地址 ( <a href="media-new.php" target="_blank">点击上传图片</a> )</h2>
  <p>
    <label>
      <input name="gardenl_huan1s" size="40" class="yzipi_admin_input" value="<?php echo get_option('gardenl_huan1s'); ?>"/>

    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="gardenl_huan1s" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>

<form method="post" name="gardenl_huan2" id="gardenl_huan2" action="options.php">
  <h2 class="yzipi_admin_h2">第一张幻灯片连接地址</h2>
  <p>
    <label>
      <input name="gardenl_huan2s" size="40" class="yzipi_admin_input" value="<?php echo get_option('gardenl_huan2s'); ?>"/>

    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="gardenl_huan2s" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>


<form method="post" name="gardenl_huan3" id="gardenl_huan3" action="options.php">
  <h2 class="yzipi_admin_h2">第二张幻灯片图片地址址 ( <a href="media-new.php" target="_blank">点击上传图片</a> )</h2>
  <p>
    <label>
      <input name="gardenl_huan3s" size="40" class="yzipi_admin_input" value="<?php echo get_option('gardenl_huan3s'); ?>"/>
    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="gardenl_huan3s" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>

<form method="post" name="gardenl_huan4" id="gardenl_huan4" action="options.php">
  <h2 class="yzipi_admin_h2">第二张幻灯片连接地址</h2>
  <p>
    <label>
      <input name="gardenl_huan4s" size="40" class="yzipi_admin_input" value="<?php echo get_option('gardenl_huan4s'); ?>"/>

    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="gardenl_huan4s" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>

<form method="post" name="gardenl_huan5" id="gardenl_huan5" action="options.php">
  <h2 class="yzipi_admin_h2">第三张幻灯片图片地址 ( <a href="media-new.php" target="_blank">点击上传图片</a> )</h2>
  <p>
    <label>
      <input name="gardenl_huan5s" size="40" class="yzipi_admin_input" value="<?php echo get_option('gardenl_huan5s'); ?>"/>
    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="gardenl_huan5s" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>

<form method="post" name="gardenl_huan6" id="gardenl_huan6" action="options.php">
  <h2 class="yzipi_admin_h2">第三张幻灯片连接地址</h2>
  <p>
    <label>
      <input name="gardenl_huan6s" size="40" class="yzipi_admin_input" value="<?php echo get_option('gardenl_huan6s'); ?>"/>
    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="gardenl_huan6s" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>


<?php }   

//小工具侧边图片浮动
add_action('admin_menu', 'adx_submenu_page');
function adx_submenu_page() {     
    add_submenu_page( 'yzipi_m', '侧栏图片', '侧栏图片', 'edit_themes', 'yzipi_adx', 'adx_page_display' );    
}  
function adx_page_display(){ ?>
<form method="post" name="yzipi_adx" id="yzipi_adx" action="options.php">
  <h2 class="yzipi_admin_h2">小工具侧边浮动图片设置，请填写图片地址 ( <a href="media-new.php" target="_blank">点击上传图片</a> )</h2>
  <p>
    <label>
      <input name="yzipi_adxs" size="40" class="yzipi_admin_input" value="<?php echo get_option('yzipi_adxs'); ?>"/>
    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="yzipi_adxs" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>

<form method="post" name="yzipi_adx_link" id="yzipi_adx_link" action="options.php">
  <h2 class="yzipi_admin_h2">小工具侧边浮动图片设置，请填写连接地址</h2>
  <p>
    <label>
      <input name="yzipi_adx_links" size="40" class="yzipi_admin_input" value="<?php echo get_option('yzipi_adx_links'); ?>"/>
    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="yzipi_adx_links" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>
<?php }



//微信公众号
add_action('admin_menu', 'weixin_submenu_page');

function weixin_submenu_page() {     
    add_submenu_page( 'yzipi_m', '微信公众号', '微信公众号', 'edit_themes', 'yzipi_weixin', 'weixin_page_display' );    
}  
function weixin_page_display(){ ?>
<form method="post" name="yzipi_weixin" id="yzipi_weixin" action="options.php">
  <h2 class="yzipi_admin_h2">微信公众号</h2>
  <p>
    <label>
      <input name="yzipi_weixins" size="40" class="yzipi_admin_input" value="<?php echo get_option('yzipi_weixins'); ?>"/>

    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="yzipi_weixins" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>

<form method="post" name="yzipi_weixin2" id="yzipi_weixin2" action="options.php">
  <h2 class="yzipi_admin_h2">微信公众号图片</h2>
  <p>
    <label>
      <input name="yzipi_weixin2" size="40" class="yzipi_admin_input" value="<?php echo get_option('yzipi_weixin2'); ?>"/>

    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="yzipi_weixin2" />
  <input type="submit" class="yzipi_admin_submit" name="option_save"  value="<?php _e('保存设置'); ?>" />
</form>

<?php }   

//统计代码
add_action('admin_menu', 'tongji_submenu_page');

function tongji_submenu_page() {     
    add_submenu_page( 'yzipi_m', '统计代码', '统计代码', 'edit_themes', 'yzipi_tongji', 'tongji_page_display' );    
}  
function tongji_page_display(){ ?>
<form method="post" name="yzipi_tongji" id="yzipi_tongji" action="options.php">
  <h2 class="yzipi_admin_h2">请填写统计代码</h2>
  <p>
    <label>
      <input name="yzipi_tongjis" size="40" class="yzipi_admin_input"  value="<?php echo get_option('yzipi_tongjis'); ?>"/>
    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="yzipi_tongjis" />
  <input type="submit" class="yzipi_admin_submit" name="option_save" value="<?php _e('保存设置'); ?>" />
</form>

<?php }  

//备案号
add_action('admin_menu', 'beian_submenu_page');

function beian_submenu_page() {     
    add_submenu_page( 'yzipi_m', '备案号', '备案号', 'edit_themes', 'yzipi_beian', 'beian_page_display' );    
}  
function beian_page_display(){ ?>
<form method="post" name="yzipi_beian" id="yzipi_beian" action="options.php">
  <h2 class="yzipi_admin_h2">请填写备案号</h2>
  <p>
    <label>
      <input name="yzipi_beians" size="40" class="yzipi_admin_input"  value="<?php echo get_option('yzipi_beians'); ?>"/>
    </label>
  </p>
  <?php wp_nonce_field('update-options'); ?>
  <input type="hidden" name="action" value="update" />
  <input type="hidden" name="page_options" value="yzipi_beians" />
  <input type="submit" class="yzipi_admin_submit" name="option_save" value="<?php _e('保存设置'); ?>" />
</form>

<?php }  

 
//后台加载css
function myAdminScripts() {   
    wp_register_style( 'yzipi-admin',  get_template_directory_uri() . '/css/yzipi-admin.css'  );  
    wp_enqueue_style( 'yzipi-admin' );  
}  
add_action( 'admin_enqueue_scripts', 'myAdminScripts' );


//激活头像函数缓存
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');

add_filter( 'avatar_defaults', 'newgravatar' );  
 
 //删除CSS, JS版本号
 function sb_remove_script_version( $src ){
    $parts = explode( '?', $src );
    return $parts[0];
}
add_filter( 'script_loader_src', 'sb_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'sb_remove_script_version', 15, 1 );

//添加侧边栏工具条

if ( function_exists('register_sidebar') ) {

register_sidebar(array(
        'name'          => '首页',
        'id'            => 'widget_homesidebar',
        'before_widget' => ' <div class="sitebar_list">
      ',
'after_widget' => '</div>',
'before_title' => ' <h4 class="sitebar_title">',
'after_title' => '</h4>',
    ));

register_sidebar(array(
        'name'          => '栏目页',
        'id'            => 'widget_categorysidebar',
        'before_widget' => ' <div class="sitebar_list">
      ',
'after_widget' => '</div>',
'before_title' => ' <h4 class="sitebar_title">',
'after_title' => '</h4>',
    )); 
	 

register_sidebar(array(
        'name'          => '标签页',
        'id'            => 'widget_tagsidebar',
        'before_widget' => ' <div class="sitebar_list">
      ',
'after_widget' => '</div>',
'before_title' => ' <h4 class="sitebar_title">',
'after_title' => '</h4>',
    ));
			
register_sidebar(array(
        'name'          => '文章页',
        'id'            => 'widget_singlesidebar',
        'before_widget' => ' <div class="sitebar_list">
      ',
'after_widget' => '</div>',
'before_title' => ' <h4 class="sitebar_title">',
'after_title' => '</h4>',
    ));
				
register_sidebar(array(
        'name'          => '搜索页',
        'id'            => 'widget_searchsidebar',
        'before_widget' => ' <div class="sitebar_list">
      ',
'after_widget' => '</div>',
'before_title' => ' <h4 class="sitebar_title">',
'after_title' => '</h4>',
    ));
}

//删除没用的小工具
function unregister_rss_widget(){ 
unregister_widget('WP_Widget_RSS'); 
} 
add_action('widgets_init','unregister_rss_widget'); 

function unregister_Search_widget(){ 
unregister_widget('WP_Widget_Search'); 
} 
add_action('widgets_init','unregister_Search_widget'); 

function unregister_Recent_Comments(){ 
unregister_widget('WP_Widget_Recent_Comments'); 
} 
add_action('widgets_init','unregister_Recent_Comments'); 

function unregister_Widget_Calendar(){ 
unregister_widget('WP_Widget_Calendar'); 
} 
add_action('widgets_init','unregister_Widget_Calendar');

//小工具标签控制
function my_tag_cloud_filter($args = array()) {
$args['smallest'] = 15; //最小字号
$args['largest'] = 15; //最大字号
$args['unit'] ='px'; //字体单位 px，pt，em
$args['number'] =10;//调用数量
$args['orderby']='count';//按何值排序
$args['order']='RAND';//排序方式
return $args;}
add_filter('widget_tag_cloud_args', 'my_tag_cloud_filter', 10);

//移除wp_head多余函数
remove_action('wp_head','wp_generator' );
remove_action('wp_head','rsd_link' );
remove_action( 'wp_head','wlwmanifest_link');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
//移除wp_head-wp-json
add_filter('rest_enabled', '_return_false');
add_filter('rest_jsonp_enabled', '_return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

//关闭文章相册样式
add_filter( 'use_default_gallery_style', '__return_false' );

//激活友情连接
add_filter('pre_option_link_manager_enabled','__return_true'); 

//缩略图
add_theme_support( 'post-thumbnails' ); //激活文章和页面的缩略图功

//点赞
add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
    $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
    $expire = time() + 99999999;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
    setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);
    if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
        update_post_meta($id, 'bigfa_ding', 1);
    } 
    else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }
   
    echo get_post_meta($id,'bigfa_ding',true);
    
    } 
    
    die;
}
//浏览统计
function record_visitors()
{
	if (is_singular())
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID)
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1)))
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');
 
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
}


//自定义导航
register_nav_menus(array(
'top-menu' => __( '顶部菜单' ),
'bottom-menu' => __( '底部菜单' ),
)
);

//搜索次加亮
function search_word_replace($buffer){
    if(is_search()){
        $arr = explode(" ", get_search_query());
        $arr = array_unique($arr);
        foreach($arr as $v)
            if($v)
                $buffer = preg_replace("/(".$v.")/i", "<cite>$1</cite>", $buffer);
    }
    return $buffer;
}
add_filter("the_title", "search_word_replace", 200);
add_filter("the_excerpt", "search_word_replace", 200);
add_filter("the_content", "search_word_replace", 200);


//修改后台登录logo和连接
function custom_loginlogo() {
echo '<style type="text/css">
h1 a {background-image: url('.get_bloginfo('template_directory').'/images/w-logo-blue.png) !important; }
</style>';
}
add_action('login_head', 'custom_loginlogo');
function custom_loginlogo_url($url) {
    return 'www.yzipi.com';
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );


//激活嵌套评论
function enable_threaded_comments(){
if (!is_admin()) {
if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
wp_enqueue_script('comment-reply');
}
}
add_action('get_header', 'enable_threaded_comments');

// 垃圾评论拦截
class anti_spam {
	function anti_spam() {
		if ( !current_user_can('level_0') ) {
			add_action('template_redirect', array($this, 'w_tb'), 1);
			add_action('init', array($this, 'gate'), 1);
			add_action('preprocess_comment', array($this, 'sink'), 1);
		}
	}
	function w_tb() {
		if ( is_singular() ) {
			ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
				"textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
		}
	}
	function gate() {
		if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
			$_POST['comment'] = $_POST['w'];
		} else {
			$request = $_SERVER['REQUEST_URI'];
			$referer = isset($_SERVER['HTTP_REFERER'])         ? $_SERVER['HTTP_REFERER']         : '隐瞒';
			$IP      = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] . ' (透过代理)' : $_SERVER["REMOTE_ADDR"];
			$way     = isset($_POST['w'])                      ? '手动操作'                       : '未经评论表格';
			$spamcom = isset($_POST['comment'])                ? $_POST['comment']                : null;
			$_POST['spam_confirmed'] = "请求: ". $request. "\n来路: ". $referer. "\nIP: ". $IP. "\n方式: ". $way. "\n內容: ". $spamcom. "\n -- 记录成功 --";
		}
	}
	function sink( $comment ) {
		if ( !empty($_POST['spam_confirmed']) ) {
			if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
			//方法一: 直接挡掉, 將 die(); 前面两斜线刪除即可.
			die();
			//方法二: 标记为 spam, 留在资料库检查是否误判.
			//add_filter('pre_comment_approved', create_function('', 'return "spam";'));
			//$comment['comment_content'] = "[ 小墙判断这是 Spam! ]\n". $_POST['spam_confirmed'];
		}
		return $comment;
	}
}
$anti_spam = new anti_spam();
//评论
function cleanr_theme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID() ?>"> <span> <?php echo get_avatar($comment,$size='60' ); ?> </span>
  <div class="mhcc">
    <address>
  <?php echo get_comment_date('Y.m.d');?> - <?php printf(__('%s'), get_comment_author_link()) ?> 
    </address>
    <?php if ($comment->comment_approved == '0') : ?>
    <p>
      <?php _e('回贴等待审核中！') ?>
    </p>
    <?php endif; ?>
    <?php comment_text() ?>
  </div>
  <?php } ?>