<?php
namespace WorkflowTheme;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use \CPT;
/**
 * Autorun class for your actions and filters.
 */
class Autorun {
    /**
     * Prefix your functions with 'init', add your subject (camelCase) and call them from this constructor.
     */
    public function __construct() {
      $this->initAssets();
      $this->initCustomPostTypes();
      $this->initThemeOptions();
      $this->initFields();
      $this->initCarbonTimber();
      $this->initMenus();
      $this->initSvgSupport();
      $this->initImageSizes();
      $this->initTitleSupport();
      $this->initEditorStyles();
    }
    public function initImageSizes() {
      add_action( 'after_setup_theme', function () {
        add_image_size( 'homepage-header', 300 ); // 300 pixels wide (and unlimited height)
        add_image_size( 'page-header', false, 1920, false ); // (cropped)
      } );

    }
    /**
     * Put your assets in here
     */
    public function initAssets(){
      add_action( 'wp_enqueue_scripts', function() {
        wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation.min.css',false,'1','all');
        wp_enqueue_style( 'fa-brands', get_template_directory_uri() . '/css/brands.css',false,'1','all');
        wp_enqueue_style( 'fa-solid', get_template_directory_uri() . '/css/solid.css',false,'1','all');
        wp_enqueue_style( 'fa-regular', get_template_directory_uri() . '/css/regular.css',false,'1','all');
        wp_enqueue_style( 'fa-shims', get_template_directory_uri() . '/css/v4-shims.css',false,'1','all');
        wp_enqueue_style( 'fa-base', get_template_directory_uri() . '/css/fontawesome.css',false,'1','all');
        wp_enqueue_style( 'workflow-css', get_template_directory_uri() . '/css/app.css',false,'1','all');
        wp_enqueue_script( 'workflow-js', get_template_directory_uri(). '/dist/index-debug.js', ['jquery'], 0.5, false );
      } );

    }
    /**
     * Enables the proper title tag.
     */
    public function initTitleSupport(){
      // add_theme_support( 'title-tag' );
      //
      // add_action( 'wp_head', function () {
      //   echo "<title>". wp_title( '|', true, 'right' ) ."</title>";
      // } );
    }
    /**
     * Initialize your post types here
     * @link https://github.com/jjgrainger/wp-custom-post-type-class
     */
    public function initCustomPostTypes() {
      // $project = new \CPT('project');
        // $news = new \CPT(array(
        // 	'post_type_name' => 'news',
        // 	'singular' => 'Nieuws',
        // 	'plural' => 'Nieuws',
        // 	'slug' => 'nieuws'
        // ));
        // $award = new \CPT('award');
        // $employee = new \CPT(array(
        // 	'post_type_name' => 'employee',
        // 	'singular' => 'Werknemer',
        // 	'plural' => 'Werknemers',
        // 	'slug' => 'werknemer',
        //   'public' => false
        // ));
        $page = new \CPT('page', array(
        	'supports' => array('title')
        ));
    }
    /**
     * Customize the theme options here
     * @link https://carbonfields.net
     */
    public function initThemeOptions() {
      add_action('carbon_fields_register_fields', function (){
        Container::make( 'theme_options', __( 'Thema instellingen', 'jouw' ) )
        // ->add_tab( __('Algemeen'), array(
        //     // Field::make( 'text', 'copyright_text', 'Tekst in copyright gebied' ),
        //     // Field::make( 'text', 'company_address', 'Adres' ),
        //     // Field::make( 'text', 'company_phone', 'Telefoonnummer' ),
        //     // Field::make( 'map', 'company_map', 'Kaart locatie')
        // ) )
        ->add_tab( __('Algemeen'), array(
            Field::make( 'rich_text', 'footer_text', 'Tekst in copyright gebied' ),
            Field::make( 'rich_text', 'footer_address', 'Adres' ),
            Field::make( 'text', 'footer_phone_1', 'Telefoonnummer 1' ),
            Field::make( 'text', 'footer_phone_2', 'Telefoonnummer 2' ),
            Field::make( 'text', 'footer_email', 'E-mail adres' ),
        ) )
        ->add_tab( __('Pagina koppelingen'), array(
          Field::make('text', 'page_contact', 'Contact'),
          Field::make('text', 'page_awards', 'Awards'),
          Field::make('text', 'page_projects', 'Projecten')
        ) )
        ->add_tab( __('Awards'), array(
            Field::make('text', 'awards_title', 'Sectie titel'),
            Field::make('rich_text', 'awards_text', 'Sectie titel'),
            Field::make( 'complex', 'awards', 'Awards (max 4)' )
              ->set_layout( 'tabbed-horizontal' )
              ->add_fields( array(
                  Field::make( 'text', 'title', 'Titel' ),
                  Field::make( 'text', 'year', 'Jaartal' ),
                  Field::make( 'image', 'image', 'Afbeelding' ),
              ) )
          ) )
        ->add_tab( __('Bedrijven'), array(
            Field::make('text', 'brand_title', 'Sectie titel'),
            Field::make('text', 'brand_buttton_title', 'Button titel'),
            Field::make( 'complex', 'brands', 'Brands (max 8)' )
              ->set_layout( 'tabbed-horizontal' )
              ->add_fields( array(
                  Field::make( 'text', 'name', 'Naam' ),
                  Field::make( 'text', 'link', 'Link (incl http(s)://)' ),
                  Field::make( 'rich_text', 'text', 'Tekst' ),
                  Field::make( 'image', 'image', 'Afbeelding' ),
              ) )
          ) )
          ->add_tab( __('Kom jij ons team versterken?'), array(
              Field::make('text', 'team_title', 'Titel'),
              Field::make('rich_text', 'team_text', 'Tekst'),
              Field::make('image', 'team_image', 'Afbeelding'),
              Field::make('text', 'team_link_title', 'Knop titel'),
              Field::make('association', 'team_link', 'Knop link')->set_types( array(
                  array(
                      'type' => 'post',
                      'post_type' => 'page',
                  ),
              ) ),
            ) )
        ->add_tab( __('Project?'), array(
            Field::make('text', 'project_title', 'Titel'),
            Field::make('rich_text', 'project_text', 'Tekst'),
            Field::make('image', 'project_image', 'Afbeelding'),
            Field::make('text', 'project_link_title', 'Knop titel'),
            Field::make('association', 'project_link', 'Knop link')->set_types( array(
                array(
                    'type' => 'post',
                    'post_type' => 'page',
                ),
            ) ),
          ) )
        ->add_tab( __('Sociale media'), array(
            Field::make( 'text', 'social_twitter', 'Twitter' ),
            Field::make( 'text', 'social_facebook', 'Facebook' ),
            Field::make( 'text', 'social_linkedin', 'LinkedIn' ),
            Field::make( 'text', 'social_youtube', 'YouTube' ),
            Field::make( 'text', 'social_googleplus', 'GooglePlus' ),
        ) );

      } );
    }
    /**
     * Adds the carbon_get_post_meta function to Twig so we can access Carbon post meta in our templates
     */
    public function initCarbonTimber(){
      add_filter('timber/twig', function($twig) {
          /* this is where you can add your own functions to twig */
          $twig->addExtension(new \Twig_Extension_StringLoader());

          $twig->addFunction(new \Twig_SimpleFunction('carbon_meta', function( $meta_val, $post_id){
              $post_id = !$post_id ? get_the_id() : $post_id;
              return carbon_get_post_meta($post_id, $meta_val);
          }));
          return $twig;
      });
      add_filter('timber/twig', function($twig) {
        $twig->addExtension(new \Twig_Extension_StringLoader());

          $twig->addFunction(new \Twig_SimpleFunction('youtube', function( $url){
            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
            return $my_array_of_vars['v'];
          }));
          return $twig;

       });
      add_filter('timber/twig', function($twig) {
            /* this is where you can add your own functions to twig */
            $twig->addExtension(new \Twig_Extension_StringLoader());

            $twig->addFunction(new \Twig_SimpleFunction('carbon_option', function( $meta_val){
                return carbon_get_theme_option($meta_val);
            }));
            return $twig;
        });

    }
    public function initMenus() {
      add_action('init', function() {
        register_nav_menu('main-menu',__( 'Hoofdmenu' ));
        register_nav_menu('footer-left',__( 'Footer links' ));
        register_nav_menu('footer-right',__( 'Footer rechts' ));
      });
      add_filter( 'timber/context', function ( $context ) {
          // Now, in similar fashion, you add a Timber Menu and send it along to the context.
          $context['menu'] = new \Timber\Menu( 'main-menu' );
          $context['footer_left'] = new \Timber\Menu( 'footer-left' );
          $context['footer_right'] = new \Timber\Menu( 'footer-right' );
          $context['brands'] = \Timber::get_posts(array('post_type' => 'brand', 'posts_per_page' => 8));
          $context['awards'] = \Timber::get_posts(array('post_type' => 'awards', 'posts_per_page' => 4));
          $context['all_brands'] = \Timber::get_posts(array('post_type' => 'brand', 'posts_per_page' => -1));

          return $context;
      } );
    }
    public function initSvgSupport(){
      add_filter('upload_mimes',   function($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
      });

    }
    /**
     * Set up custom fields here
     * @link https://carbonfields.net
     */
    public function initFields() {
        add_action( 'carbon_fields_register_fields', function () {
          Container::make( 'post_meta', __( 'Pagina info', 'jouw' ) )
          ->where( 'post_template', '=', 'template-home.php' )
          ->add_fields( array(
            Field::make('separator', 'sep1', 'Header'),
            Field::make('text', 'header_title', 'Title'),
            Field::make('image', 'header_image', 'Image'),
            Field::make('separator', 'sep2', 'Content'),
            Field::make('text', 'subtitle', 'Subtitle')
            )
          );

      } );

      add_action( 'after_setup_theme', function () {
          \Carbon_Fields\Carbon_Fields::boot();
      } );
    }
    public function initEditorStyles() {


      // Register our callback to the appropriate filter
      add_filter( 'mce_buttons_2', function ( $buttons ) {
                array_unshift( $buttons, 'styleselect' );
                return $buttons;
            } );

      // Attach callback to 'tiny_mce_before_init'
      add_filter( 'tiny_mce_before_init', function ( $init_array ) {

        $style_formats = array(
            // These are the custom styles
            array(
                'title' => 'Blauwe knop',
                'selector' => 'a',
                'classes' => 'button',
                'wrapper' => true,
            ),
            array(
                'title' => 'Content Block',
                'block' => 'span',
                'classes' => 'content-block',
                'wrapper' => true,
            ),
            array(
                'title' => 'Highlighter',
                'block' => 'span',
                'classes' => 'highlighter',
                'wrapper' => true,
            ),
        );
        // Insert the array, JSON ENCODED, into 'style_formats'
        $init_array['style_formats'] = json_encode( $style_formats );

        return $init_array;

      }  );

    }

  }
?>
