<?php
/**
 * Widget Tipos de Produtos
 * @package carpigiani-theme
 */
// Creating the widget 
class tipos_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'tipos_widget', 

			// Widget name will appear in UI
			__('Tipos de Produtos', 'tipos_widget_domain'), 

			// Widget description
			array( 'description' => __( 'Os Tipos de Produtos principais do site', 'tipos_widget_domain' ), ) 
			);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
	// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title']; ?>

	<?php 
		$args_tax = array(
		    'orderby'       => 'name', 
		    'order'         => 'ASC',
		    'hide_empty'    => false, 
		    'exclude'       => array(), 
		    'exclude_tree'  => array(), 
		    'include'       => array(),
		    'number'        => 4, 
		    'fields'        => 'all', 
		    'hierarchical'  => true, 
		    'child_of'      => 0, 
		    'get'           => '', 
		    'name__like'    => '',
		    'pad_counts'    => false, 
		); 

		 $terms = get_terms("tipos", $args_tax);
		 if ( !empty( $terms ) && !is_wp_error( $terms ) ){
		     echo "<ul>";
		     foreach ( $terms as $term ) {
                $termlinks = get_term_link ( $term, 'tipos' );
                ?>

					<li class="each-widget-tipo each-widget-<?php echo $term->slug; ?>">
						<a href="<?php echo $termlinks; ?>">
							<?php echo $term->name; ?>
						</a>
					</li>
			
			<?php }
		     echo "</ul>";
		 }

	?>
		
		<?php echo $args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'tipos_widget_domain' );
		}
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Class tipos_widget ends here

// Register and load the widget
function load_tipos_widget() {
	register_widget( 'tipos_widget' );
}

add_action( 'widgets_init', 'load_tipos_widget' );

?>