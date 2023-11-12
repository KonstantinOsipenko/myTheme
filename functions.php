<?php


// Enqueue styles and scripts
function enqueue_theme_styles() {
    wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), filemtime( get_template_directory() . '/style.css' ) );

    // Enqueue your main.css from the "dist" folder
    wp_enqueue_style('main-css', get_template_directory_uri() . '/dist/main.css', array(), '1.0', 'all');

    // Enqueue your main.js from the "dist" folder
    wp_enqueue_script('main-js', get_template_directory_uri() . '/dist/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');

// Register custom navigation menus
function register_custom_menus() {
    register_nav_menus(array(
        'header-menu' => 'Header Menu',
        'footer-menu' => 'Footer Menu'
    ));
}
add_action('init', 'register_custom_menus');

// Add theme support
add_theme_support('post-thumbnails');
add_theme_support('html5', array('search-form'));

// Custom widget areas
function theme_widgets_init() {
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar-1',
        'description' => 'Add widgets here for the sidebar',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'theme_widgets_init');

// Load text domain for translation
load_theme_textdomain('k-dev', get_template_directory() . '/languages');

// Define a custom menu location
function theme_custom_menu_locations($locations) {
    $locations['primary-menu'] = 'Primary Navigation Menu';
    return $locations;
}
add_filter('theme_location_names', 'theme_custom_menu_locations');

// Display the menu in your theme
function display_custom_menu() {
    wp_nav_menu(array(
        'theme_location' => 'primary-menu',
        'menu_id' => 'primary-menu',
        'menu_class' => 'menu-class',
    ));
}


/**
 * Custom styles in TinyMCE
 */
add_filter(
    'mce_buttons_2',
    function ($buttons) {
        array_unshift($buttons, 'styleselect');
        return $buttons;
    }
);

add_filter(
    'tiny_mce_before_init',
    function ($init_array) {
        // Define the style_formats array
        $headings = [
            'title' => __('Headings', 'k-dev'),
            'items' => [
                [
                    'title' => 'Heading 1',
                    'classes' => 'h1',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
                    'wrapper' => false,
                ],
                [
                    'title' => 'Heading 2',
                    'classes' => 'h2',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
                    'wrapper' => false,
                ],
                [
                    'title' => 'Heading 3',
                    'classes' => 'h3',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
                    'wrapper' => false,
                ],
                [
                    'title' => 'Heading 4',
                    'classes' => 'h4',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
                    'wrapper' => false,
                ],
                [
                    'title' => 'Heading 5',
                    'classes' => 'h5',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
                    'wrapper' => false,
                ],
                [
                    'title' => 'Heading 6',
                    'classes' => 'h6',
                    'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
                    'wrapper' => false,
                ],
            ]
        ];

        $text = [
            'title' => __('Text', 'k-dev'),
            'items' => [
                [
                    'title' => 'Small',
                    'inline' => 'small',
                ],
                [
                    'title' => 'Large',
                    'classes' => 'text-large',
                    'inline' => 'span',
                ],
                [
                    'title' => 'Uppercase',
                    'classes' => 'text-uppercase',
                    'selector' => 'p,h1,h2,h3,h4,h5,h6,ul',
                ],
                [
                    'title' => 'Justify',
                    'classes' => 'text-align-justify',
                    'selector' => 'p,h1,h2,h3,h4,h5,h6,ul',
                ],
                [
                    'title' => 'Underlined',
                    'inline' => 'u',
                ],
            ]
        ];

        $lists = [
            'title' => __('Lists', 'k-dev'),
            'items' => [
                [
                    'title' => 'List unstyled',
                    'classes' => 'list-unstyled',
                    'selector' => 'ul',
                ],
                [
                    'title' => 'Two columns',
                    'classes' => 'two-columns',
                    'selector' => 'p,h1,h2,h3,h4,h5,h6,ul',
                ],
                [
                    'title' => 'Three columns',
                    'classes' => 'three-columns',
                    'selector' => 'p,h1,h2,h3,h4,h5,h6,ul',
                ],
            ]
        ];

        $buttons = [
            'title' => __('Buttons', 'k-dev'),
            'items' => [
                [
                    'title' => 'Button',
                    'classes' => 'btn',
                    'selector' => 'a',
                    'wrapper' => false,
                ],
                [
                    'title' => 'Button Secondary',
                    'classes' => 'btn btn-secondary',
                    'selector' => 'a',
                    'wrapper' => false,
                ],
                [
                    'title' => 'Fancybox open',
                    'classes' => 'fancybox',
                    'selector' => 'a',
                    'wrapper' => false,
                ],
            ]
        ];



        $style_formats = [$headings, $text, $lists, $buttons,];

        $init_array['style_formats'] = json_encode($style_formats);

        return $init_array;
    }
);

add_editor_style();

/**
 * Add custom color to TinyMCE editor text color selector
 */
add_filter(
    'tiny_mce_before_init',
    /**
     * @param $init array
     *
     * @return mixed array
     */
    function ($init) {
        $default_colours = [
            'Black' => '000000',
            'Burnt orange' => '993300',
            'Dark olive' => '333300',
            'Dark green' => '003300',
            'Dark azure' => '003366',
            'Navy Blue' => '000080',
            'Indigo' => '333399',
            'Very dark gray' => '333333',
            'Maroon' => '800000',
            'Orange' => 'ff6600',
            'Olive' => '808000',
            'Green' => '008000',
            'Teal' => '008080',
            'Blue' => '0000ff',
            'Grayish blue' => '666699',
            'Gray' => '808080',
            'Red' => 'ff0000',
            'Amber' => 'ff9900',
            'Yellow green' => '99cc00',
            'Sea green' => '339966',
            'Turquoise' => '33cccc',
            'Royal blue' => '3366ff',
            'Purple' => '800080',
            'Medium gray' => '999999',
            'Magenta' => 'ff00ff',
            'Gold' => 'ffcc00',
            'Yellow' => 'ffff00',
            'Lime' => '00ff00',
            'Aqua' => '00ffff',
            'Sky blue' => '00ccff',
            'Brown' => '993366',
            'Silver' => 'c0c0c0',
            'Pink' => 'ff99cc',
            'Peach' => 'ffcc99',
            'Light yellow' => 'ffff99',
            'Pale green' => 'ccffcc',
            'Pale cyan' => 'ccffff',
            'Light sky blue' => '99ccff',
            'Plum' => 'cc99ff',
            'White' => 'ffffff',
        ];

        /**
         * By using the same array keys as the default values you'll override (replace) them
         */
        $custom_colours = [
            'Navy' => '123154',
            'Light Navy' => '173a62',
            'Red' => 'e21c54',
            'Black' => '1d1d1d',
            'Gray' => '737373',
        ];

        $textcolor_map = [];
        foreach (array_merge($default_colours, $custom_colours) as $name => $color) {
            $textcolor_map[] = "\"$color\", \"$name\"";
        }

        if (!empty($textcolor_map)) {
            $init['textcolor_map'] = '[' . implode(', ', $textcolor_map) . ']';
            $init['textcolor_rows'] = 6; // expand colour grid to 6 rows
        }

        return $init;
    }
);

// Disable gutenberg
add_filter('use_block_editor_for_post_type', '__return_false');