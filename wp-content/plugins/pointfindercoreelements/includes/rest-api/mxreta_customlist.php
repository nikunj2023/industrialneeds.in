<?php
 class PointFinder_Custom_Tax_List {

     public function __construct() {
         $this->namespace     = 'pointfindertaxlist/v1';
         $this->resource_name = 'pfgl';
     }

     public function register_routes() {
         register_rest_route( $this->namespace, '/' . $this->resource_name. '', array(
             array(
                 'methods'   => 'GET',
                 'callback'  => array( $this, 'get_items' ),
                 'permission_callback' => array( $this, 'get_items_permissions_check' ),
             ),
             'schema' => array( $this, 'get_item_schema' ),
         ) );

         register_rest_route( $this->namespace, '/' . $this->resource_name. '/(?P<fw>\d+)/(?P<sl>\d+)', array(
             array(
                 'methods'   => 'GET',
                 'callback'  => array( $this, 'get_items' ),
                 'permission_callback' => array( $this, 'get_items_permissions_check' ),
             ),
             'schema' => array( $this, 'get_item_schema' ),
         ) );

     }

     public function get_items_permissions_check( $request ) {
         if ( ! current_user_can( 'read' ) ) {}
         return true;
     }

     public function get_items( $request ) {
       $r_type = (isset($request['_type']))?sanitize_text_field( $request['_type'] ):'';
       $fw = '';
       
       if (isset($request['fw'])) {
         $fw = sanitize_text_field($request['fw']);
       } else {
         if (isset($_GET['fw'])) {
           $fw = sanitize_text_field($_GET['fw']);
         }
       }
      switch ($fw) {
         case 'loc':$taxonomy_name = "pointfinderlocations";break;
         case 'lis':$taxonomy_name = "pointfinderltypes";break;
         case 'it':$taxonomy_name = "pointfinderitypes";break;
         case 'co':$taxonomy_name = "pointfinderconditions";break;
         case 'fe':$taxonomy_name = "pointfinderfeatures";break;
         case 'ta':$taxonomy_name = "post_tag";break;
         default:$taxonomy_name = "pointfinderltypes";break;
       }
       $q = '';
       $ppp = 10;
       if (!empty($r_type)) {
         $q = sanitize_text_field( $request["q"] );
         $ppp = 20;
       }
       $args = array(
          'number' => $ppp,
          'taxonomy' => $taxonomy_name,
          'order' => 'ASC',
          'orderby' => 'name',
          'name__like' => $q,
          'fields' => 'id=>name',
          'hide_empty' => false
       );
       if (isset($request['sl'])) {
         $args['term_taxonomy_id'] = (is_array($request['sl']))?$request['sl']:$this->string2BasicArray($request['sl']);
       }
       $terms = get_terms($args);
       $data = array();

       if ( empty( $terms ) ) {
          return rest_ensure_response( $data );
       }

       foreach ( $terms as $term_key => $term_value ) {
          $response = $this->prepare_item_for_response( $term_key,$term_value, $request );
          $data[] = $this->prepare_response_for_collection( $response );
       }

       // Return all of our comment response data.
       return rest_ensure_response( $data );
     }

     public function prepare_item_for_response( $term_key,$term_value, $request ) {
         $term_data = array();
         $schema = $this->get_item_schema( $request );

         if ( isset( $schema['mxreta']['id'] ) ) {
             $term_data['id'] = (int) $term_key;
         }

				 if ( isset( $schema['mxreta']['text'] ) ) {
             $term_data['text'] = $term_value;
         }

         return rest_ensure_response( $term_data );
     }

     public function prepare_response_for_collection( $response ) {
         if ( ! ( $response instanceof WP_REST_Response ) ) {
             return $response;
         }

         $data = (array) $response->get_data();
         $server = rest_get_server();

         if ( method_exists( $server, 'get_compact_response_links' ) ) {
             $links = call_user_func( array( $server, 'get_compact_response_links' ), $response );
         } else {
             $links = call_user_func( array( $server, 'get_response_links' ), $response );
         }

         if ( ! empty( $links ) ) {
             $data['_links'] = $links;
         }

         return $data;
     }

     public function get_item_schema( $request ) {
         $schema = array(
             '$schema'              => 'http://json-schema.org/draft-07/schema#',
             'title'                => 'post',
             'type'                 => 'object',
             'mxreta'           => array(
                 'id' => array(
                     'description'  => esc_html__( 'Unique identifier for the object.', 'pointfindercoreelements' ),
                     'type'         => 'integer',
                     'context'      => array( 'view', 'edit', 'embed' ),
                     'readonly'     => true,
                 ),
								 'text' => array(
                     'description'  => esc_html__( 'The title for the object.', 'pointfindercoreelements' ),
                     'type'         => 'string',
										 'readonly'     => true,
                 ),
             ),
         );

         return $schema;
     }


     public function authorization_status_code() {

         $status = 401;

         if ( is_user_logged_in() ) {
             $status = 403;
         }

         return $status;
     }

     private function string2BasicArray($string, $kv = ',') {
			$ka = array();
			if($string != ''){
				if(strpos($string, $kv) != false){
					$string_exp = explode($kv,$string);
					foreach($string_exp as $s){
						$ka[]=intval($s);
					}
				}else{
					return array(intval($string));
				}
			}
			return $ka;
		}
 }

  if(!function_exists('pointfinder_custom_taxlist')){
    function pointfinder_custom_taxlist() {
       $controller = new PointFinder_Custom_Tax_List();
       $controller->register_routes();
    }
  }
  add_action( 'rest_api_init', 'pointfinder_custom_taxlist' );
