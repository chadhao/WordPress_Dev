<?php

class Activity
{
    public static function activity_init()
    {
        add_action('admin_post_activity_signup', array('Activity_Signup', 'activity_signup_frontend_add'));
        add_action('admin_post_nopriv_activity_signup', array('Activity_Signup', 'activity_signup_frontend_add'));
    }

    public static function activity_activation()
    {
        $activity_init_terms = get_terms('category', 'orderby=id&hide_empty=0');
        $activity_init_current_option = get_option('activity_category', 'false');
        $activity_option_matches_term = false;

        if (!empty($activity_init_terms) && !is_wp_error($activity_init_terms)) {
            if ($activity_init_current_option != 'false') {
                foreach ($activity_init_terms as $activity_init_term) {
                    if ($activity_init_current_option == $activity_init_term->term_id) {
                        $activity_option_matches_term = true;
                        break;
                    }
                }
                if (!$activity_option_matches_term) {
                    update_option('activity_category', $activity_init_terms[0]->term_id);
                }
            } else {
                update_option('activity_category', $activity_init_terms[0]->term_id);
            }
            update_option('activity_signup_method', '');
        } else {
            update_option('activity_category', 0);
            update_option('activity_signup_method', '');
        }

        self::activity_init_database();
    }

    public static function activity_deactivation()
    {
    }

    public static function activity_uninstall()
    {
        global $wpdb;
        $tablename_signup = $wpdb->prefix.'activity_signup';
        $tablename_meta = $wpdb->prefix.'activity_meta';
        $current_cat = get_option('activity_category');
        $args = array('category' => $current_cat);
        $posts_array = get_posts($args);
        foreach ($posts_array as $post) {
            $wpdb->delete($tablename_signup, array('activity_id' => $post->ID));
            $wpdb->delete($tablename_meta, array('post_id' => $post->ID));
            wp_delete_post($post->id, true);
        }
    }

    /**
     * Initialize plugin database.
     */
    private static function activity_init_database()
    {
        global $wpdb;
        $activity_table_name_meta = $wpdb->prefix.'activity_meta';
        $activity_table_name_signup = $wpdb->prefix.'activity_signup';
        $activity_table_name_posts = $wpdb->prefix.'posts';
        $activity_charset_collate = $wpdb->get_charset_collate();

        $activity_signup_sql = "CREATE TABLE $activity_table_name_signup (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			activity_id bigint(20) unsigned NOT NULL,
			name varchar(255) NOT NULL,
			email varchar(255) NOT NULL,
			phone varchar(15) NOT NULL,
			fee_paid boolean DEFAULT false NOT NULL,
			is_aut_student boolean DEFAULT false NOT NULL,
			is_autcsa_member boolean DEFAULT false NOT NULL,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			CONSTRAINT pk_activity_signup_id PRIMARY KEY (id),
			CONSTRAINT fk_activity_signup_activity_id FOREIGN KEY (activity_id) REFERENCES ".$activity_table_name_meta."(post_id)
		) $activity_charset_collate;";

        $activity_meta_sql = "CREATE TABLE $activity_table_name_meta (
			post_id bigint(20) unsigned NOT NULL,
			location varchar(1024) NOT NULL,
			member_fee varchar(10),
			nonmember_fee varchar(10),
			signup_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			signup_method varchar(2048) NOT NULL,
            max_capacity int unsigned,
			activity_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			poster varchar(255),
			CONSTRAINT pk_activity_meta_post_id PRIMARY KEY (post_id)
		) $activity_charset_collate;";

        require_once ABSPATH.'wp-admin/includes/upgrade.php';

        dbDelta($activity_meta_sql);
        dbDelta($activity_signup_sql);
    }

    public static function activity_view($file_name)
    {
        include ACTIVITY__PLUGIN_DIR.'views/'.$file_name.'.php';
    }
}
