<?php

// Instantiate WP menus
require_once('library/menus.php');

// ACF functions
require_once('library/acf.php');

// Theme JS/CSS enqueues
require_once('library/enqueues.php');

// General WP
require_once('library/cleanup.php');

// Custom theme blocks
require_once('library/blocks/init.php');

// WP Default Settings
show_admin_bar(false);
add_theme_support('post-thumbnails');
