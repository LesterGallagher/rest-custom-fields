<?php
/**
 * 
*/


class Rest_Custom_Fields_Core {

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct( $plugin_name, $plugin_version ) {
		$this->plugin_name    = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->api_version    = 1;
		$this->namespace      = $plugin_name . '/v' . $this->api_version;

		$this->init();

    }
    
    /**
	 * Initialize this class with hooks.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'rest_api_init', array( $this, 'add_api_routes' ) );
		// add_filter( 'rest_api_init', array( $this, 'add_cors_support' ) );
		// add_filter( 'rest_pre_dispatch', array( $this, 'rest_pre_dispatch' ), 10, 2 );
    }
    
    public function add_api_routes() {
        register_rest_field(
            'page',
            'meta',
            array('get_callback' => 'show_fields')
        );
    }
}

function show_fields($object, $field_name, $request) {
    $meta = get_post_meta($object['id']);
    $filtered = array();

    foreach ($meta as $key => $value) {
        if (strpos($key, '_') !== 0) {
            $filtered[$key] = $value;
        }
    }
    
    return $filtered;
}

new Rest_Custom_Fields_Core( $plugin_name, $plugin_version );
