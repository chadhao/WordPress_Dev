<?php

function theme_enqueue_styles()
{
    wp_enqueue_style('avada-parent-stylesheet', get_template_directory_uri().'/style.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function avada_lang_setup()
{
    $lang = get_stylesheet_directory().'/languages';
    load_child_theme_textdomain('Avada', $lang);
}
add_action('after_setup_theme', 'avada_lang_setup');

function ac_list_info($atts)
{
    $list_items = explode('|', $atts['list']);
    $content = '<div class="fusion-clearfix" style="margin-bottom: 20px;">';
    $content .= '<div style="width: 20%; margin: 0; margin-top: 10px; float: left;"><p style="width: 100%; font-size: 42px; text-align: center; margin: 0; color: #000000; line-height: 42px; weight: bold;">'.$atts['days'].'</p><p style="width: 100%; margin: 0; font-size: 11px; text-align: center; color: #000000;">DAYS</span></div>';
    $content .= '<ul style="width: 80%; margin: 0; float: right; border-left: 1px solid #ccc; color: #000; list-style-type: none; padding-left: 20px;">';
    foreach ($list_items as $item) {
        $content .= '<li>'.$item.'</li>';
    }
    $content .= '</ul>';
    $content .= '</div>';

    return $content;
}
add_shortcode('ac_list_info', 'ac_list_info');

function ac_homepage_time()
{
    $content = '<div class="clear-fix" style="width: 100%; height: 232px; overflow: hidden;">';
    $content .= '<h2 style="margin-top: 20px; margin-bottom: 0; color: #ffffff;">北京时间</h3>';
    $content .= '<p id="ac_homepage_time_bj" style="margin-bottom: 10px; font-size: 18px; line-height: 26px;">0000-00-00<br>00:00:00</p>';
    $content .= '<h2 style="margin-top: 20px; margin-bottom: 0; color: #ffffff;">奥克兰时间</h3>';
    $content .= '<p id="ac_homepage_time_akl" style="margin-bottom: 10px; font-size: 18px; line-height: 26px;">0000-00-00<br>00:00:00</p>';
    $content .= '</div>';

    return $content;
}
add_shortcode('ac_homepage_time', 'ac_homepage_time');

function ac_homepage_exchange_fetch()
{
    $apiurl = 'http://api.fixer.io/latest';
    $base = 'NZD';
    $symbol = 'CNY';
    $fullurl = $apiurl.'?base='.$base.'&symbols='.$symbol;
    $exchange_raw = file_get_contents($fullurl);
    $exchange_decode = json_decode($exchange_raw);

    return $exchange_decode->rates->CNY;
}

function ac_homepage_exchange()
{
    $last_update = get_option('ac_exchange_rate_update');
    if ($last_update !== false) {
        $dt_now = (new DateTime())->getTimestamp();
        $dt_last_update = (new DateTime($last_update))->getTimestamp();
        if ($dt_now - $dt_last_update > 86400000) {
            update_option('ac_exchange_rate_update', date('Y-m-d H:i:s'));
            update_option('ac_exchange_rate', ac_homepage_exchange_fetch());
        }
    } else {
        update_option('ac_exchange_rate_update', date('Y-m-d H:i:s'));
        update_option('ac_exchange_rate', ac_homepage_exchange_fetch());
    }
    $rate_now = get_option('ac_exchange_rate');

    $content = '<div class="clear-fix" style="width: 100%; height: 232px; overflow: hidden;">';
    $content .= '<h2 style="margin-top: 25px; margin-bottom: 0; color: #ffffff;">￥'.(100 * $rate_now).'人民币</h3>';
    $content .= '<h2 style="margin-top: 25px; margin-bottom: 0; color: #ffffff;">兑换</h3>';
    $content .= '<h2 style="margin-top: 25px; margin-bottom: 0; color: #ffffff;">$100新西兰元</h3>';
    $content .= '</div>';

    return $content;
}
add_shortcode('ac_homepage_exchange', 'ac_homepage_exchange');
