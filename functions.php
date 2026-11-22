<?php
/**
 * LASU Alumni Theme v2 functions and definitions
 */

if ( ! function_exists( 'lasu_alumni_setup' ) ) :
	function lasu_alumni_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'responsive-embeds' );

		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'lasu-alumni' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'lasu_alumni_setup' );

function lasu_alumni_scripts() {
	wp_enqueue_style( 'lasu-alumni-style', get_stylesheet_uri(), array(), '2.0.0' );

	wp_add_inline_script( 'jquery', '
		document.addEventListener("DOMContentLoaded", function() {
			const toggle = document.querySelector(".menu-toggle");
			const nav = document.querySelector(".main-nav");
			if (toggle && nav) {
				toggle.addEventListener("click", function() {
					nav.classList.toggle("active");
					const expanded = nav.classList.contains("active");
					toggle.setAttribute("aria-expanded", expanded);
					toggle.textContent = expanded ? "Close" : "Menu";
				});
			}
		});
	' );
}
add_action( 'wp_enqueue_scripts', 'lasu_alumni_scripts' );

function lasu_alumni_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'lasu-alumni' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here.', 'lasu-alumni' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lasu_alumni_widgets_init' );

/**
 * Preload demo content on theme activation.
 */
function lasu_alumni_create_demo_content() {
	// Only run once
	if ( get_option( 'lasu_alumni_demo_imported' ) ) {
		return;
	}

	// Sample pages
	$pages = array(
		'About' => 'The LASU Alumni Association connects graduates of Lagos State University worldwide. Our motto is For Truth and Service.',
		'Membership' => 'Join the LASU Alumni Association to access networking opportunities, exclusive events, career resources, and more. Membership is open to all LASU graduates.',
		'Events' => 'Stay updated on upcoming reunions, networking mixers, career workshops, and chapter meetings. Check back regularly for new events.',
		'Contact' => 'Get in touch with the LASU Alumni Association. Email: alumni@lasu.edu.ng or visit our social channels.',
	);

	foreach ( $pages as $title => $content ) {
		if ( ! get_page_by_title( $title ) ) {
			wp_insert_post( array(
				'post_title'   => $title,
				'post_content' => $content,
				'post_status'  => 'publish',
				'post_type'    => 'page',
			) );
		}
	}

	// Sample posts (news)
	$posts = array(
		'LASU Alumni Honour Outstanding Members' => 'The association recently recognised distinguished alumni for their contributions to society and the university.',
		'Networking Mixer Held in Lagos' => 'Alumni gathered for a successful networking event featuring industry leaders and career discussions.',
		'Call for Mentors: Support Current Students' => 'We are seeking alumni volunteers to mentor LASU students in various fields. Sign up today.',
	);

	foreach ( $posts as $title => $content ) {
		if ( ! get_page_by_title( $title, OBJECT, 'post' ) ) {
			wp_insert_post( array(
				'post_title'   => $title,
				'post_content' => $content,
				'post_status'  => 'publish',
				'post_type'    => 'post',
			) );
		}
	}

	update_option( 'lasu_alumni_demo_imported', true );
}
add_action( 'after_switch_theme', 'lasu_alumni_create_demo_content' );
