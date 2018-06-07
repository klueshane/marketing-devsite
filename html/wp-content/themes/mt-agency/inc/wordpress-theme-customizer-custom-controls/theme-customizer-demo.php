<?php
new theme_customizer();

class theme_customizer
{
    public function __construct()
    {
        add_action ('admin_menu', array(&$this, 'customizer_admin'));
        add_action( 'customize_register', array(&$this, 'customize_manager_demo' ));
    }

    /**
     * Add the Customize link to the admin menu
     * @return void
     */
    public function customizer_admin() {
        add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
    }

    /**
     * Customizer manager demo
     * @param  WP_Customizer_Manager $wp_manager
     * @return void
     */
    public function customize_manager_demo( $wp_manager )
    {
        $this->demo_section( $wp_manager );
        $this->custom_sections( $wp_manager );
    }

    /**
     * A section to show how you use the default customizer controls in WordPress
     *
     * @param  Obj $wp_manager - WP Manager
     *
     * @return Void
     */
    private function demo_section( $wp_manager )
    {
        $wp_manager->add_section( 'featured_content_section', array(
            'title'          => 'Featured Content Section',
            'priority'       => 35,
        ) );

        // Dropdown pages control
        $wp_manager->add_setting( 'featured_content', array(
            'default'        => '1',
        ) );

        $wp_manager->add_control( 'featured_content', array(
            'label'   => 'Featured Content',
            'section' => 'featured_content_section',
            'type'    => 'dropdown-pages',
            'priority' => 5
        ) );
        
        $wp_manager->add_section( 'homepage_section', array(
            'title'          => 'Home Page Content Section',
            'priority'       => 35,
        ) );

        // Dropdown pages control
        $wp_manager->add_setting( 'work_page_dropdown', array(
            'default'        => '1',
        ) );

        $wp_manager->add_control( 'work_page_dropdown', array(
            'label'   => 'Work Section Page',
            'section' => 'homepage_section',
            'type'    => 'dropdown-pages',
            'priority' => 5
        ) );

        // Dropdown pages control
        $wp_manager->add_setting( 'about_page_dropdown', array(
            'default'        => '1',
        ) );

        $wp_manager->add_control( 'about_page_dropdown', array(
            'label'   => 'About Section Page',
            'section' => 'homepage_section',
            'type'    => 'dropdown-pages',
            'priority' => 5
        ) );

    }

    /**
     * Adds a new section to use custom controls in the WordPress customiser
     *
     * @param  Obj $wp_manager - WP Manager
     *
     * @return Void
     */
    private function custom_sections( $wp_manager )
    {
     
    }

}

?>