<?php
function yoga_theme_setup() {
  add_theme_support('title-tag');
  add_theme_support('custom-logo', array(
    'height'      => 120,
    'width'       => 320,
    'flex-height' => true,
    'flex-width'  => true,
  ));
  add_theme_support('post-thumbnails');
  register_nav_menus(array(
    'main' => 'Menu Principal',
  ));
}
add_action('after_setup_theme', 'yoga_theme_setup');

function yoga_enqueue_assets() {
  wp_enqueue_style('astra-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('yoga-style', get_stylesheet_uri(), array('astra-style'));
}
add_action('wp_enqueue_scripts', 'yoga_enqueue_assets');

function yoga_widgets_init() {
  for ($i = 1; $i <= 3; $i++) {
    register_sidebar(array(
      'name'          => 'Footer Column ' . $i,
      'id'            => 'footer-' . $i,
      'description'   => 'Colonne ' . $i . ' du pied de page',
      'before_widget' => '<div class="footer-widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>',
    ));
  }
}
add_action('widgets_init', 'yoga_widgets_init');

add_action('init', function() {
  remove_action('astra_footer', 'astra_footer_markup');
});

add_shortcode('email', 'get_email_shortcode');

function get_email_shortcode($atts) {
  $atts = shortcode_atts(array(
    'id' => get_current_user_id()
  ), $atts, 'email');

  $user_info = get_userdata($atts['id']);
 // var_dump($user_info); // Debugging line to check user data 
  if ($user_info && !empty($user_info->user_email)) {
    return '<a href="mailto:' . esc_html($user_info->user_email) . '">' . esc_html($user_info->user_email) . '</a>';
}
}

/*
* On utilise une fonction pour créer notre custom post type ''
*/

function JM_custom_post_type() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => 'Services',
		// Le nom au singulier
		'singular_name'       => 'Service',
		// Le libellé affiché dans le menu
		'menu_name'           => 'Service',
		// Les différents libellés de l'administration
		'all_items'           => __( 'Toutes les Services'),
		'view_item'           => __( 'Voir les Services professionnelles'),
		'add_new_item'        => __( 'Ajouter une nouvelle Service'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer une Service'),
		'update_item'         => __( 'Modifier une Service'),
		'search_items'        => __( 'Rechercher une Service'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		'label'               => __( 'Service' ),
		'description'         => __( 'Tous les expériences professionnelles' ),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'custom-fields' ),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => false,
		'hierarchical'        => true, // Permet de créer des hiérarchies (comme les pages)
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'service-pro' ),

	);
	
	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type( 'service', $args );

}

add_action( 'init', 'JM_custom_post_type', 0 );
