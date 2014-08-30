<?php
// If uninstall not called from WordPress exit
if( !defined( 'WP_UNINSTALL_PLUGIN' ) )
exit ();
// define the table prefix
$easy_widget_DB_options = 'easy_2046_';
// Delete option from options table
delete_option( $easy_widget_DB_options );
//remove any additional options and custom tables