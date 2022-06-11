<?php

function fancy_lab_import_files() {
    return array(
        array(
            'import_file_name'             => 'Fancy Lab',
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-data/demo-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-data/widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-data/customizer.dat',
            'import_notice'                => __( 'This theme works best with WooCommerce installed.', 'fancy-lab' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'fancy_lab_import_files' );

function fancy_lab_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Fancy Lab Main Menu', 'nav_menu' );
    $footer_menu = get_term_by( 'name', 'Fancy Lab Footer Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'fancy_lab_main_menu' => $main_menu->term_id,
            'fancy_lab_footer_menu' => $footer_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'fancy_lab_after_import_setup' );