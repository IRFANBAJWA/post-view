<?php
function user_record_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . "post_view";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    v_date timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
    postid int(11) NOT NULL,
    view int(2) DEFAULT '0' NOT NULL,
    userip varchar(256) NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
