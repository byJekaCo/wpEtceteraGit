<?php
/*
Plugin Name: Custom plugin
Version: 1.0
Author: byJeka
Author URI: https://www.upwork.com/freelancers/~01862fd8b1f7fc4423
*/


add_action('init', 'register_post_type_properties');
function register_post_type_properties(){
    register_post_type('property', array(
        'labels'             => array(
            'name'               => 'Объекты недвижимости',
            'singular_name'      => 'Объект недвижимости',
            'add_new'            => 'Добавить новый',
            'add_new_item'       => 'Добавить новый объект недвижимости',
            'edit_item'          => 'Редактировать объект недвижимости',
            'new_item'           => 'Новый объект недвижимости',
            'view_item'          => 'Посмотреть объект недвижимости',
            'search_items'       => 'Найти объект недвижимости',
            'not_found'          => 'Объектов недвижимости не найдено',
            'not_found_in_trash' => 'В корзине объектов недвижимости не найдено',
            'parent_item_colon'  => '',
            'menu_name'          => 'Объекты недвижимости'

          ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title','editor','author','thumbnail','excerpt','comments')
    ) );
}



add_action( 'init', 'create_area_custom_taxonomy', 0 );
 
//create a custom taxonomy name it "type" for your posts
function create_area_custom_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Район', 'taxonomy general name' ),
    'singular_name' => _x( 'Район', 'taxonomy singular name' ),
    'search_items' =>  __( 'Искать район' ),
    'all_items' => __( 'Все районы' ),
    'parent_item' => __( 'Parent Type' ),
    'parent_item_colon' => __( 'Parent Type:' ),
    'edit_item' => __( 'Редактировать район' ), 
    'update_item' => __( 'Обновить район' ),
    'add_new_item' => __( 'Добавить новый район' ),
    'new_item_name' => __( 'Название нового района' ),
    'menu_name' => __( 'Районы' ),
  );    
 
  register_taxonomy('types',array('property'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));
}


function get_property_filter($atts) {
  include('property-filter.php');
}
add_shortcode('property_filter', 'get_property_filter');


add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){
    wp_localize_script( 'wp-bootstrap-starter-popper', 'myajax', 
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );  
}

add_action( 'wp_ajax_nopriv_property_filter', 'property_filter' );
add_action( 'wp_ajax_property_filter', 'property_filter' );
function property_filter() {


    
    wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
}







add_action( 'wp_loaded', array ( 'Property_Ajax_Search', 'init' ) );

/**
 * Ajaxify the search form.
 */
class Property_Ajax_Search
{
    protected static $instance = NULL;

    protected $action = 'Property_ajax_search';


    public static function init()
    {
        NULL === self::$instance and self::$instance = new self;
        return self::$instance;
    }


    public function __construct()
    {
        $callback = array ( $this, 'search' );
        add_action( 'wp_ajax_'        . $this->action, $callback );
        add_action( 'wp_ajax_nopriv_' . $this->action, $callback );
    }


    public function search()
    {
        parse_str($_POST['data'], $data);

        $args  = array ( 
            'post_type' => 'property',
            'meta_key' => 'prioperty_eko',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',

        );

        if ($_POST["offset"]) {
            $args['offset'] = $_POST["offset"] > 0 ? $_POST["offset"] : 0;
        }

        $queryArgs = array('relation' => 'AND',);

        if ($data['property_title']){
            array_push($queryArgs, 
                array(
                    'key' => 'property_title',
                    'value'    => $data['property_title'],
                    'compare'   => 'LIKE'
                )
            );    
        }

        if ($data['property_coordinates']){
            array_push($queryArgs, 
                array(
                    'key' => 'property_coordinates',
                    'value'    => $data['property_coordinates'],
                    'compare'   => 'LIKE'
                )
            );    
        }
            
        if ($data['property_floors']){
            array_push($queryArgs, 
                array(
                    'key' => 'property_floors',
                    'value'    => $data['property_floors'],
                    'compare'   => '='
                )
            );    
        }

        if ($data['prioperty_type']){
            array_push($queryArgs, 
                array(
                    'key' => 'prioperty_type',
                    'value'    => $data['prioperty_type'],
                    'compare'   => '='
                )
            );    
        }

        if ($data['prioperty_eko']){
            array_push($queryArgs, 
                array(
                    'key' => 'prioperty_eko',
                    'value'    => $data['prioperty_eko'],
                    'compare'   => '='
                )

            );    
        }

        $args['meta_query'] = $queryArgs;


        $posts = get_posts( $args );
        if ( $posts )
        {
            $this->render_search_results( $posts, $data );
        }
        else
        {
            print '<b>nothing found</b>';
        }
        exit;
    }


    protected function render_search_results( $posts, $data )
    {
        print '<div class="property-ajax-search-results row">';

        foreach ( $posts as $post )
        {
            print '<div class="col-12 property"><div class="row">';
                
                $link = get_permalink( $post->ID );
                $title = get_field('property_title', $post->ID);
                $image = get_field('property_image', $post->ID)['url'];
                $coords = get_field('property_coordinates', $post->ID);
                $floors = get_field('property_floors', $post->ID);
                $type = get_field('prioperty_type', $post->ID);
                $eco = get_field('prioperty_eko', $post->ID);
                
                print('<div class="col-6">');
                    if ($image) print('<img src="'.$image.'" alt="">');
                    print('<br>');
                    if ($title) print('<a href="'.$link.'">'.$title.'</a>');
                print('</div>');
                print('<div class="col-6">');
                    if($coords) print('<p>Координаты: '.$coords.'</p>');
                    if($floors) print('<p>Количество этажей: '.$floors.'</p>');
                    if($type) print('<p>Тип строения: '.$type.'</p>');
                    if($eco) print('<p>Экологичность: '.$eco.'</p>');
                print('</div>');

            print '</div></div>';
            print('<br>');
            print('<div class="col-12"><hr></div>');
            print('<br>');


            if ($data['property_premises_include']) {
                $premises_array = get_field('property_premises', $post->ID);

                foreach ($premises_array as $key => $premises) {
                    if(
                        (!$premises['property_premises_square'] 
                        || (!$data['property_premises_square_max'] || ($premises['property_premises_square'] <= $data['property_premises_square_max']))
                        && (!$data['property_premises_square_min'] || ($premises['property_premises_square'] >= $data['property_premises_square_min'])))

                        && (!$data['property_premises_rooms'] || ($premises['property_premises_rooms'] && $data['property_premises_rooms'] == $premises['property_premises_rooms']))

                        && (!$data['property_premises_balcony'] || $data['property_premises_balcony'] && $premises['property_premises_balcony']) 

                        && (!$data['property_premises_bathroom'] || $data['property_premises_bathroom'] && $premises['property_premises_bathroom']) 
                        
                    ){
                        $link = get_permalink( $post->ID );
                        $title = get_field('property_title', $post->ID);
                        $image = $premises['property_premises_image']['url'];
                        $square = $premises['property_premises_square'];
                        $balcony = $premises['property_premises_balcony'];
                        $balcony_text = $balcony ? "Да" : "Нет";
                        $bathroom = $premises['property_premises_bathroom'];
                        $bathroom_text = $bathroom ? "Да" : "Нет";
                        
                        print('<div class="row">');

                        print('<div class="col-6">');
                            if ($image) print('<img src="'.$image.'" alt="">');
                                else print('<img src="http://wpetcetera/wp-content/uploads/2021/02/npPhoto.png" alt="">');
                            print('<br>');
                            if ($title) print('<a href="'.$link.'">'.$title.' (Помещение)</a>');
                        print('</div>');
                        print('<div class="col-6">');
                            if($square) print('<p>Площадь: '.$square.'</p>');
                            print('<p>Балкон: '.$balcony_text.'</p>');
                            print('<p>Санузел: '.$bathroom_text.'</p>');
                        print('</div>');

                    print '</div>';
                    print('<br>');
                    print('<div class="col-12"><hr></div>');
                    print('<br>');


                    }
                }
            }

        
        }
        print '</div>';
        $shownPosts = $_POST['showed'];

        print '<div class="row"><div class="col-12 property">';
        print('<button class="nav-previous alignleft" onclick="showPosts('.($shownPosts-5).')">Предыдущие записи</button>');
        print('<button class="nav-previous alignright" onclick="showPosts('.($shownPosts+5).')">Следующие записи</button>');
        print '</div></div>';
    }
}