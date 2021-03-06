<?php
/**
 * Dallas Lite Option Registration.
 *
 * @package Dallas Lite
 */

/**
 * Dallas Lite Option Registration.
 */
class dallaslite_Theme_Function {
	/**
	 * Add call back functions.
	 *
	 * @param object $callback callback sanitize function.
	 */
	function sanitize_call_back( $callback ) {
	}
}
/**
 * Add style CSS.
 */
function dallaslite_admin_style() {
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/assets/css/admin-style.css' );
}
add_action( 'admin_enqueue_scripts', 'dallaslite_admin_style' );
add_action( 'customize_register', 'dallaslite_option' );
/**
 * Add customize options.
 *
 * @param object $wp_customize wp_customize to print for resource hints.
 */
function dallaslite_option( $wp_customize ) {
	$callback = new Theme_Register_Function;
	$wp_customize->add_setting( 'separatorline', array(
		'default' => '',
		'sanitize_callback' => $callback->sanitize_call_back( 'call_back_separatorline' ),
	) );
	$wp_customize->add_panel( 'blog_layout', array(
		'priority' => 20,
		'blog_layout' => '',
		'title' => esc_html__( 'WP Dallas Lite Options', 'dallas-lite' ),
		'description' => esc_html__( 'Set editable text for certain content.', 'dallas-lite' ),
	) );
	$wp_customize->add_section( 'Blog_layout_option', array(
		'title' => esc_html__( 'Site Layout', 'dallas-lite' ),
		'panel' => 'blog_layout',
		'priority' => 10,
	) );
	$wp_customize->add_setting( 'body_layout', array(
		'default' => 'fullwidth_body_layout',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'fullwidth_layout', array(
		'label' => esc_html__( 'Body Layout', 'dallas-lite' ),
		'section' => 'Blog_layout_option',
		'settings' => 'body_layout',
		'type' => 'select',
		'choices' => array(
			'box_layout' => esc_html__( 'Box Layout', 'dallas-lite' ),
			'fullwidth_body_layout' => esc_html__( 'Fullwidth Layout', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'blog_layout_selection', array(
		'default' => 'blogright',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	// Add control.
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'select_blog_layout', array(
		'label' => esc_html__( 'Select Blog Layout', 'dallas-lite' ),
		'section' => 'Blog_layout_option',
		'settings' => 'blog_layout_selection',
		'type' => 'select',
		'choices' => array(
			'blogleft' => esc_html__( 'Left Sidebar', 'dallas-lite' ),
			'blogright' => esc_html__( 'Right Sidebar', 'dallas-lite' ),
			'blogfullwidth' => esc_html__( 'Full Width', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'select_blog_single_page_layout', array(
		'default' => 'rightside',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	// Add control.
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'select_blog_single_page_layout', array(
		'label' => esc_html__( 'Select Single Post Layout', 'dallas-lite' ),
		'section' => 'Blog_layout_option',
		'settings' => 'select_blog_single_page_layout',
		'type' => 'select',
		'choices' => array(
			'leftside' => esc_html__( 'Left Sidebar', 'dallas-lite' ),
			'rightside' => esc_html__( 'Right Sidebar', 'dallas-lite' ),
			'fullwidth' => esc_html__( 'Full Width', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'select_pagination_layout', array(
		'default' => 'paginumber',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	// Add control.
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'select_pagination_layout', array(
		'label' => esc_html__( 'Select Pagination Layout', 'dallas-lite' ),
		'section' => 'Blog_layout_option',
		'settings' => 'select_pagination_layout',
		'type' => 'select',
		'choices' => array(
			'pagiloadmore' => esc_html__( 'Load More', 'dallas-lite' ),
			'paginumber' => esc_html__( 'Number', 'dallas-lite' ),
		),
	) ) );
	/*---------Blog Settings---------------------  */
	$wp_customize->add_section( 'blog_setting', array(
		'title' => esc_html__( 'Blog Settings', 'dallas-lite' ),
		'panel' => 'blog_layout',
		'priority' => 10,
	) );
	$wp_customize->add_setting( 'enableExcerpt', array(
		'default' => '1',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_blog_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'enable_Excerpt', array(
		'label' => esc_html__( 'Enable Excerpt', 'dallas-lite' ),
		'section' => 'blog_setting',
		'settings' => 'enableExcerpt',
		'type' => 'radio',
		'choices' => array(
			'1' => esc_html__( 'Yes', 'dallas-lite' ),
			'0' => esc_html__( 'No', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'excerptwordLimit', array(
		'default' => '330',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_blog_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'excerpt_word_limit', array(
		'label' => esc_html__( 'Excerpt Word Limit', 'dallas-lite' ),
		'section' => 'blog_setting',
		'settings' => 'excerptwordLimit',
		'type' => 'text',
		'choices' => array(
			'logo_text' => esc_html__( 'Use your Custom logo text', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'enableBlogReadmore', array(
		'default' => '1',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_blog_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'enable_blog_readmore', array(
		'label' => esc_html__( 'Enable Blog Readmore', 'dallas-lite' ),
		'section' => 'blog_setting',
		'settings' => 'enableBlogReadmore',
		'type' => 'radio',
		'choices' => array(
			'1' => esc_html__( 'Yes', 'dallas-lite' ),
			'0' => esc_html__( 'No', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'continueReading', array(
		'default' => 'Read more',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_blog_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'continue_reading', array(
		'label' => esc_html__( 'Continue Reading', 'dallas-lite' ),
		'section' => 'blog_setting',
		'settings' => 'continueReading',
		'type' => 'text',
		'choices' => array(
			'continue_reading' => esc_html__( 'Read more', 'dallas-lite' ),
		),
	) ) );
	/*---------Blog Settings---------------------  */
	$wp_customize->add_section( 'blog_setting', array(
		'title' => esc_html__( 'Blog Settings', 'dallas-lite' ),
		'panel' => 'blog_layout',
		'priority' => 10,
	) );
	$wp_customize->add_setting( 'enableExcerpt', array(
		'default' => '1',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'enable_Excerpt', array(
		'label' => esc_html__( 'Enable Excerpt', 'dallas-lite' ),
		'section' => 'blog_setting',
		'settings' => 'enableExcerpt',
		'type' => 'radio',
		'choices' => array(
			'1' => esc_html__( 'Yes', 'dallas-lite' ),
			'0' => esc_html__( 'No', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'excerptwordLimit', array(
		'default' => '330',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'excerpt_word_limit', array(
		'label' => esc_html__( 'Excerpt Word Limit', 'dallas-lite' ),
		'section' => 'blog_setting',
		'settings' => 'excerptwordLimit',
		'type' => 'text',
		'choices' => array(
			'logo_text' => esc_html__( 'Use your Custom logo text', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'enableBlogReadmore', array(
		'default' => '1',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'enable_blog_readmore', array(
		'label' => esc_html__( 'Enable Blog Readmore', 'dallas-lite' ),
		'section' => 'blog_setting',
		'settings' => 'enableBlogReadmore',
		'type' => 'radio',
		'choices' => array(
			'1' => esc_html__( 'Yes', 'dallas-lite' ),
			'0' => esc_html__( 'No', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'continueReading', array(
		'default' => 'Read more',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'continue_reading', array(
		'label' => esc_html__( 'Continue Reading', 'dallas-lite' ),
		'section' => 'blog_setting',
		'settings' => 'continueReading',
		'type' => 'text',
		'choices' => array(
			'continue_reading' => esc_html__( 'Read more', 'dallas-lite' ),
		),
	) ) );
	/*---------Layout & Styling---------------------  */
	$wp_customize->add_section( 'layout_styling', array(
		'title' => esc_html__( 'Layout & Styling', 'dallas-lite' ),
		'panel' => 'blog_layout',
		'priority' => 10,
	) );
	$wp_customize->add_setting( 'right-to-left', array(
		'default' => false,
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'style_rtl', array(
		'label' => esc_html__( 'RTL on template', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'right-to-left',
		'type' => 'checkbox',
	) ) );
	/*  Layout Separator code  */
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'body-separatorline', array(
		'section' => 'layout_styling',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Body Color Settings', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'body_separator',
	) ) );
	/*  Layout Separator code  */
	$wp_customize->add_setting( 'body_bg_color', array(
		'default' => '#fff',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_body_background_color', array(
		'label' => esc_html__( 'Body Background Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'body_bg_color',
	) ) );
	$wp_customize->add_setting( 'major_color', array(
		'default' => '#ffc414',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_major_color', array(
		'label' => esc_html__( 'Major Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'major_color',
	) ) );
	$wp_customize->add_setting( 'hover_color', array(
		'default' => '#e6ac00',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
		'label' => esc_html__( 'Hover Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'hover_color',
	) ) );
	$wp_customize->add_setting( 'top_header_color', array(
		'default' => '#1a1c28',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_top_header_color', array(
		'label' => esc_html__( 'Top Header Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'top_header_color',
	) ) );
	$wp_customize->add_setting( 'header_color', array(
		'default' => '#222534',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_header_color', array(
		'label' => esc_html__( 'Header Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'header_color',
	) ) );
	/*  Layout Separator code  */
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'footer_separatorline', array(
		'section' => 'layout_styling',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Footer Background Settings', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/*  Layout Separator code  */
	$wp_customize->add_setting( 'footer_color', array(
		'default' => '#1A1C28',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
		'label' => esc_html__( 'Footer Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'footer_color',
	) ) );
	$wp_customize->add_setting( 'copyright_color', array(
		'default' => '#000000',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'copyright_bg_color', array(
		'label' => esc_html__( 'Copyright Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'copyright_color',
	) ) );
	/*  Layout Separator code  */
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'separatorline', array(
		'section' => 'layout_styling',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Button Color Settings', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/*  Layout Separator code  */
	$wp_customize->add_setting( 'buttonColorSettings ', array(
		'default' => esc_html__( 'Button Color Settings', 'dallas-lite' ),
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'font_size', array(
		'section' => 'layout_styling',
		'settings' => 'buttonColorSettings',
		'label' => esc_html__( 'Body Font Size', 'dallas-lite' ),
		'type' => 'title',
		'default' => esc_html__( 'Button Color Settings', 'dallas-lite' ),
	) ) );
	$wp_customize->add_setting( 'button_bg_color', array(
		'default' => '#222533',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_background_color', array(
		'label' => esc_html__( 'Background Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'button_bg_color',
	) ) );
	$wp_customize->add_setting( 'button_hover_bg_color', array(
		'default' => '#363b52',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_background_color', array(
		'label' => esc_html__( 'Hover Background Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'button_hover_bg_color',
	) ) );
	$wp_customize->add_setting( 'button_text_color', array(
		'default' => '#fff',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_text_color', array(
		'label' => esc_html__( 'Text Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'button_text_color',
	) ) );
	$wp_customize->add_setting( 'button_hover_text_color', array(
		'default' => '#fff',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_text_color', array(
		'label' => esc_html__( 'Hover Text Color', 'dallas-lite' ),
		'section' => 'layout_styling',
		'settings' => 'button_hover_text_color',
	) ) );
	/*---------Typography Setting---------------------  */
	$wp_customize->add_section( 'typographySetting', array(
		'title' => esc_html__( 'Typography Settings', 'dallas-lite' ),
		'panel' => 'blog_layout',
		'priority' => 10,
	) );
	/*  Layout Separator code  */
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'body-font', array(
		'section' => 'typographySetting',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Body Font', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/*  Layout Separator code  */
	$wp_customize->add_setting( 'body_google_font', array(
		'default' => 'Lato',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'google_font', array(
		'section' => 'typographySetting',
		'settings' => 'body_google_font',
		'label' => esc_html__( 'Body Google Font', 'dallas-lite' ),
		'type' => 'select',
		'default' => 'Lato',
		'choices' => dallaslite_google_fonts(),
		'google_font' => true,
		'google_font_weight' => 'body_font_weight',
		'google_font_weight_default' => '400',
	) ) );
	$wp_customize->add_setting( 'body_font_size', array(
		'default' => '16',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'font_size', array(
		'section' => 'typographySetting',
		'settings' => 'body_font_size',
		'label' => esc_html__( 'Body Font Size', 'dallas-lite' ),
		'type' => 'number',
		'default' => '16',
	) ) );
	/*  Layout Separator code  */
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'menu-font', array(
		'section' => 'typographySetting',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Menu Font', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/*  Layout Separator code  */
	$wp_customize->add_setting( 'menu_google_font', array(
		'default' => 'Lato',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'select_google_font', array(
		'section' => 'typographySetting',
		'settings' => 'menu_google_font',
		'label' => esc_html__( 'Menu Google Font', 'dallas-lite' ),
		'type' => 'select',
		'default' => 'Lato',
		'choices' => dallaslite_google_fonts(),
		'google_font' => true,
		'google_font_weight' => 'menu_font_weight',
		'google_font_weight_default' => '400',
	) ) );
	$wp_customize->add_setting( 'menu_font_size', array(
		'default' => '15',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'menu_font_size', array(
		'section' => 'typographySetting',
		'settings' => 'menu_font_size',
		'label' => esc_html__( 'Menu Font Size', 'dallas-lite' ),
		'type' => 'number',
		'default' => '15',
	) ) );
	// H1.
	/*  Layout Separator code  */
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h1-separatorline', array(
		'section' => 'typographySetting',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Heading1 Font', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/**
	 * Layout Separator code.
	 */
	// H1 Font.
	$wp_customize->add_setting( 'h1_google_font', array(
		'default' => 'Lato',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h1_google_font',
		array(
			'section' => 'typographySetting',
			'settings' => 'h1_google_font',
			'label' => esc_html__( 'H1 Google Font', 'dallas-lite' ),
			'type' => 'select',
			'default' => 'Lato',
			'choices' => dallaslite_google_fonts(),
			'google_font' => true,
			'google_font_weight' => 'menu_font_weight',
			'google_font_weight_default' => '700',
	) ) );
	// h1 Font weight.
	$wp_customize->add_setting( 'h1_font_weight', array(
		'default' => '500',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h1_font_weight',
		array(
			'section' => 'typographySetting',
			'settings' => 'h1_font_weight',
			'label' => esc_html__( 'H1 Font weight', 'dallas-lite' ),
			'type' => 'select',
			'choices' => array(
				'normal' => 'Normal',
				'100' => '100',
				'300' => '300',
				'500' => '500',
				'700' => '700',
				'900' => '900',
		),
	) ) );
		// H1 Font Size.
	$wp_customize->add_setting( 'h1_font_size', array(
		'default' => '36',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h1_font_size',
		array(
			'section' => 'typographySetting',
			'settings' => 'h1_font_size',
			'label' => esc_html__( 'H1 Font Size', 'dallas-lite' ),
			'type' => 'number',
			'default' => '36',
	) ) );
	// h1 line height.
	$wp_customize->add_setting( 'h1_line_height', array(
		'default' => '50',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h1_line_height',
		array(
			'section' => 'typographySetting',
			'settings' => 'h1_line_height',
			'label' => esc_html__( 'H1 Line Height (in px)', 'dallas-lite' ),
			'type' => 'number',
			'default' => '50',
	) ) );
	// H2.
	/*  Layout Separator code  */
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h2-separator', array(
		'section' => 'typographySetting',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Heading2 Font', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/**
	 * Layout Separator code.
	 */
	// h2 Font.
	$wp_customize->add_setting( 'h2_google_font', array(
		'default' => 'Lato',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h2_google_font',
		array(
			'section' => 'typographySetting',
			'settings' => 'h2_google_font',
			'label' => esc_html__( 'H2 Google Font', 'dallas-lite' ),
			'type' => 'select',
			'default' => 'Lato',
			'choices' => dallaslite_google_fonts(),
			'google_font' => true,
			'google_font_weight' => 'menu_font_weight',
			'google_font_weight_default' => '700',
	) ) );
	// h2 Font weight.
	$wp_customize->add_setting( 'h2_font_weight', array(
		'default' => '500',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h2_font_weight',
		array(
			'section' => 'typographySetting',
			'settings' => 'h2_font_weight',
			'label' => esc_html__( 'H2 Font weight', 'dallas-lite' ),
			'type' => 'select',
			'choices' => array(
				'normal' => 'Normal',
				'100' => '100',
				'300' => '300',
				'500' => '500',
				'700' => '700',
				'900' => '900',
		),
	) ) );
	// h2 Font Size.
	$wp_customize->add_setting( 'h2_font_size', array(
		'default' => '30',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h2_font_size',
		array(
			'section' => 'typographySetting',
			'settings' => 'h2_font_size',
			'label' => esc_html__( 'H2 Font Size', 'dallas-lite' ),
			'type' => 'number',
			'default' => '30',
	) ) );
	// H2 line height.
	$wp_customize->add_setting( 'h2_line_height', array(
		'default' => '45',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h2_line_height',
		array(
			'section' => 'typographySetting',
			'settings' => 'h2_line_height',
			'label' => esc_html__( 'H2 Line Height (in px)', 'dallas-lite' ),
			'type' => 'number',
			'default' => '45',
	) ) );
	// H3.
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h3-separatorline', array(
		'section' => 'typographySetting',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Heading3 Font', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/**
	 * Layout Separator code
	 */
	// h3 Font.
	$wp_customize->add_setting( 'h3_google_font', array(
		'default' => 'Lato',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h3_google_font',
		array(
			'section' => 'typographySetting',
			'settings' => 'h3_google_font',
			'label' => esc_html__( 'H3 Google Font', 'dallas-lite' ),
			'type' => 'select',
			'default' => 'Lato',
			'choices' => dallaslite_google_fonts(),
			'google_font' => true,
			'google_font_weight' => 'menu_font_weight',
			'google_font_weight_default' => '700',
	) ) );
	// h3 Font weight.
	$wp_customize->add_setting( 'h3_font_weight', array(
		'default' => '500',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h3_font_weight',
		array(
			'section' => 'typographySetting',
			'settings' => 'h3_font_weight',
			'label' => esc_html__( 'H3 Font weight', 'dallas-lite' ),
			'type' => 'select',
			'choices' => array(
				'normal' => 'Normal',
				'100' => '100',
				'300' => '300',
				'500' => '500',
				'700' => '700',
				'900' => '900',
		),
	) ) );
	// h3 Font Size.
	$wp_customize->add_setting( 'h3_font_size', array(
		'default' => '26',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h3_font_size',
		array(
			'section' => 'typographySetting',
			'settings' => 'h3_font_size',
			'label' => esc_html__( 'H3 Font Size', 'dallas-lite' ),
			'type' => 'number',
			'default' => '26',
	) ) );
	// H3 line height.
	$wp_customize->add_setting( 'h3_line_height', array(
		'default' => '40',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h3_line_height',
		array(
			'section' => 'typographySetting',
			'settings' => 'h3_line_height',
			'label' => esc_html__( 'H3 Line Height (in px)', 'dallas-lite' ),
			'type' => 'number',
			'default' => '40',
	) ) );
	// H4.
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h4-separatorline', array(
		'section' => 'typographySetting',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Heading4 Font', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/**
	 * Layout Separator code.
	 */
	// h4 Font.
	$wp_customize->add_setting( 'h4_google_font', array(
		'default' => 'Lato',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h4_google_font',
		array(
			'section' => 'typographySetting',
			'settings' => 'h4_google_font',
			'label' => esc_html__( 'H4 Google Font', 'dallas-lite' ),
			'type' => 'select',
			'default' => 'Lato',
			'choices' => dallaslite_google_fonts(),
			'google_font' => true,
			'google_font_weight' => 'menu_font_weight',
			'google_font_weight_default' => '700',
	) ) );
	// h4 Font weight.
	$wp_customize->add_setting( 'h4_font_weight', array(
		'default' => '500',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h4_font_weight',
		array(
			'section' => 'typographySetting',
			'settings' => 'h4_font_weight',
			'label' => esc_html__( 'H4 Font weight', 'dallas-lite' ),
			'type' => 'select',
			'choices' => array(
				'normal' => 'Normal',
				'100' => '100',
				'300' => '300',
				'500' => '500',
				'700' => '700',
				'900' => '900',
		),
	) ) );
	// h4 Font Size.
	$wp_customize->add_setting( 'h4_font_size', array(
		'default' => '24',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h4_font_size',
		array(
			'section' => 'typographySetting',
			'settings' => 'h4_font_size',
			'label' => esc_html__( 'H4 Font Size', 'dallas-lite' ),
			'type' => 'number',
			'default' => '24',
	) ) );
	// H4 line height.
	$wp_customize->add_setting( 'h4_line_height', array(
		'default' => '35',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h4_line_height',
		array(
			'section' => 'typographySetting',
			'settings' => 'h4_line_height',
			'label' => esc_html__( 'H4 Line Height (in px)', 'dallas-lite' ),
			'type' => 'number',
			'default' => '35',
	) ) );
	// H5.
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h5-separatorline', array(
		'section' => 'typographySetting',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Heading5 Font', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/**
	 * Layout Separator code.
	 */
	// h5 Font.
	$wp_customize->add_setting( 'h5_google_font', array(
		'default' => 'Lato',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h5_google_font',
		array(
			'section' => 'typographySetting',
			'settings' => 'h5_google_font',
			'label' => esc_html__( 'H5 Google Font', 'dallas-lite' ),
			'type' => 'select',
			'default' => 'Lato',
			'choices' => dallaslite_google_fonts(),
			'google_font' => true,
			'google_font_weight' => 'menu_font_weight',
			'google_font_weight_default' => '700',
	) ) );
	// h5 Font weight.
	$wp_customize->add_setting( 'h5_font_weight', array(
		'default' => '500',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h5_font_weight',
		array(
			'section' => 'typographySetting',
			'settings' => 'h5_font_weight',
			'label' => esc_html__( 'H5 Font weight', 'dallas-lite' ),
			'type' => 'select',
			'choices' => array(
				'normal' => 'Normal',
				'100' => '100',
				'300' => '300',
				'500' => '500',
				'700' => '700',
				'900' => '900',
		),
	) ) );
	// h5 Font SIze.
	$wp_customize->add_setting( 'h5_font_size', array(
		'default' => '22',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h5_font_size',
		array(
			'section' => 'typographySetting',
			'settings' => 'h5_font_size',
			'label' => esc_html__( 'H5 Font Size', 'dallas-lite' ),
			'type' => 'number',
			'default' => '22',
	) ) );
	// H5 line height.
	$wp_customize->add_setting( 'h5_line_height', array(
		'default' => '30',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h5_line_height',
		array(
			'section' => 'typographySetting',
			'settings' => 'h5_line_height',
			'label' => esc_html__( 'H5 Line Height (in px)', 'dallas-lite' ),
			'type' => 'number',
			'default' => '30',
	) ) );
	// H6.
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h2-separatorline', array(
		'section' => 'typographySetting',
		'settings' => 'separatorline',
		'label' => esc_html__( 'Heading6 Font', 'dallas-lite' ),
		'type' => 'hidden',
		'class' => 'layout_separator',
	) ) );
	/**
	 * Layout Separator code.
	 */
	// h6 Font.
	$wp_customize->add_setting( 'h6_google_font', array(
		'default' => 'Lato',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h6_google_font',
		array(
			'section' => 'typographySetting',
			'settings' => 'h6_google_font',
			'label' => esc_html__( 'H6 Google Font', 'dallas-lite' ),
			'type' => 'select',
			'default' => 'Lato',
			'choices' => dallaslite_google_fonts(),
			'google_font' => true,
			'google_font_weight' => 'menu_font_weight',
			'google_font_weight_default' => '700',
	) ) );
	// h6 Font weight.
	$wp_customize->add_setting( 'h6_font_weight', array(
		'default' => '500',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h6_font_weight',
		array(
			'section' => 'typographySetting',
			'settings' => 'h6_font_weight',
			'label' => esc_html__( 'H6 Font weight', 'dallas-lite' ),
			'type' => 'select',
			'choices' => array(
				'normal' => 'Normal',
				'100' => '100',
				'300' => '300',
				'500' => '500',
				'700' => '700',
				'900' => '900',
		),
	) ) );
	// h6 Font Size.
	$wp_customize->add_setting( 'h6_font_size', array(
		'default' => '20',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'h6_font_size',
		array(
			'section' => 'typographySetting',
			'settings' => 'h6_font_size',
			'label' => esc_html__( 'H6 Font Size', 'dallas-lite' ),
			'type' => 'number',
			'default' => '20',
	) ) );
	// H6 line height.
	$wp_customize->add_setting( 'h6_line_height', array(
		'default' => '25',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'h6_line_height',
		array(
			'section' => 'typographySetting',
			'settings' => 'h6_line_height',
			'label' => esc_html__( 'H6 Line Height (in px)', 'dallas-lite' ),
			'type' => 'number',
			'default' => '25',
	) ) );
	/**
	 * 404 Error.
	 */
	$wp_customize->add_section( 'error', array(
		'title' => esc_html__( '404 Error', 'dallas-lite' ),
		'panel' => 'blog_layout',
		'priority' => 10,
	) );
	$wp_customize->add_setting( '404pageTitle', array(
		'default' => 'Page Not Found - Lost Maybe?.',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'page_title', array(
		'label' => esc_html__( '404 Page Title', 'dallas-lite' ),
		'section' => 'error',
		'settings' => '404pageTitle',
		'type' => 'text',
		'choices' => array(
			'error_page_title' => esc_html__( '404 Page Title', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( '404pageDescription', array(
		'default' => 'The page you are looking for was moved, removed, renamed or might never existed..',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'page_description', array(
		'label' => esc_html__( '404 Page Description', 'dallas-lite' ),
		'section' => 'error',
		'settings' => '404pageDescription',
		'type' => 'textarea',
		'choices' => array(
			'textarea_rows' => 5,
		),
	) ) );
	$wp_customize->add_setting( '404buttonText', array(
		'default' => 'Go Back Home',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_dallas_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'button_text', array(
		'label' => esc_html__( '404 Button Text', 'dallas-lite' ),
		'section' => 'error',
		'settings' => '404buttonText',
		'type' => 'text',
		)
	) );
	/**
	 * Footer Option.
	 */
	$wp_customize->add_section( 'footer_section', array(
		'title' => esc_html__( 'Footer Settings', 'dallas-lite' ),
		'panel' => 'blog_layout',
		'priority' => 10,
	) );
	$wp_customize->add_setting( 'enable_copyright_text', array(
		'default' => '1',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_footer_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'enable_copyright_text', array(
		'label' => esc_html__( 'Enable Copyright Text', 'dallas-lite' ),
		'section' => 'footer_section',
		'settings' => 'enable_copyright_text',
		'type' => 'radio',
		'choices' => array(
			'1' => esc_html__( 'Yes', 'dallas-lite' ),
			'0' => esc_html__( 'No', 'dallas-lite' ),
		),
	) ) );
	$wp_customize->add_setting( 'copyright_text', array(
		'default' => 'Copyright 2018 dallas-lite. All Right Reserved. Created by JoomDev',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_copyright_text_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'copyright_text', array(
		'label' => esc_html__( 'Copyright Text', 'dallas-lite' ),
		'section' => 'footer_section',
		'settings' => 'copyright_text',
		'type' => 'textarea',
		array(
			'textarea_rows' => 5,
		),
	) ) );
	$wp_customize->add_setting( 'backToTop', array(
		'default' => '1',
		'sanitize_callback' => $callback->sanitize_call_back( 'enable_backtotop_call' ),
	) );
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'back_to_top', array(
		'label' => esc_html__( 'Back To Top', 'dallas-lite' ),
		'section' => 'footer_section',
		'settings' => 'backToTop',
		'type' => 'radio',
		'choices' => array(
			'1' => esc_html__( 'Yes', 'dallas-lite' ),
			'0' => esc_html__( 'No', 'dallas-lite' ),
		),
	) ) );
}
