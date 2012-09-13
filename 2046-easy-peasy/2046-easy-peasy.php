<?php
/**
 * Plugin name: Easy peasy
 * Plugin URI: http://wordpress.org/extend/plugins/2046s-widget-loops/
 * Description: The GUI website builder.
 * Version: 0.3
 * Author: 2046
 * Author URI: http://2046.cz
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'builder_2046_main_loop_load_widget' );

/**
 * Register our widget.
 * 'builder_2046_main_loop_Widget' is the widget class used below.
 */
function builder_2046_main_loop_load_widget() {
	register_widget( 'builder_2046_main_loop' );
	// localization
	load_plugin_textdomain( 'builder_2046', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'); 
}
require_once( 'includes/items.php' );

// make class instance
$moo = new builder_2046_main_loop();
// trespass data to the widget class val
$moo::$route_in = $view;

//builder_2046_main_loop::route_in('oop');
/**
 * builder_2046_main_loop Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 */
// builder_2046_main_loop::$route_in = 'abc';
 class builder_2046_main_loop extends WP_Widget {
 	// set the routing variable
	public  static $route_in;
	// Setter for class variable
	    function setSomething($s)
	    {
		$this->route_in = $s;
		return true; 
	    }
	/**
	 * Widget setup.
	 */
	function builder_2046_main_loop() {
		/* Widget settings. */
		$widget_ops = array( 
			'classname' => 'builder_2046_main_loop',
			'description' => __('The GUI website builder.','builder_2046') 
		);	

		/* Widget control settings. */
		$control_ops = array( 
			'width' => 620,
			'height' => 350,
			'id_base' => 'builder_2046_main_loop-widget' 
		);
		//global $view;
		//$this->view = $view;
		/* Create the widget. */
		$this->WP_Widget( 'builder_2046_main_loop-widget', __('Builder', 'builder_2046'), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) { 
		
		/* Set up some default widget settings. */
		// initialize data - read the externals to the default widget 
		$defaults = $this::$route_in;
		//$instance = wp_parse_args( $instance, $defaults );
		//extract( $instance, EXTR_SKIP );
		
		echo '<div id="the_widget_id_'.$this->id.'" class="pw_2046_lw">';
			//
			////////// echo the widget HTML //////////////////
			//
			echo $this->f2046_widget_builder($defaults, $instance); ?>
		</div>
		<script>
			jQuery(function($) {
				//$( "#general_bank" ).accordion();
				//$("#general_bank").click(function () {
				//called before .sortable(); 

				// define remove function
				$.fn.removeStep = function() {
					 // `this` is now a reference to the $ Object on which `.removeStep()` was invoked 
					 this.closest('li').remove();
					 $('#view_container').sortable('refresh');
					 // Allow chaining
					 return this;
				} 
				// remove item from sorted list
				$('.rem').live('click', function() {
					$(this).removeStep();
				});
				// make it sortable
				$("#view_container ol").sortable({
				
					stop: function(event, ui) {
						// when are items resorted
						// resorting  all items -> and write their indexes to hidden input fields
						$(this).find('li').each(function(index) {
							//console.log($(this).attr('class') + ' <-parent' + $(this).index() );
							parent = this;
							the_index  = $(this).index();
							var  name = $(this).find('input,select,textarea').attr('name').split('][b2046_bricks][');
							// get the number of chunks
							var temp = name[0] + '][b2046_bricks][' + the_index;
							// strip of the actual position
							var tail = name[1].split('][');
							// get the lenght
							tail_lenght = name[1].split('][').length;
							// combine it all in one
							for(i=1; i<tail_lenght; i++){
							    temp = temp + '][' + tail[i];
							}
							// make it real
							$(this).find('input,select,textarea').attr('name',temp);
						});
					}
				});
				//
				$( ".view_bank li" ).draggable({
					appendTo: "body",
					helper: "clone"
				});
				// append new item in the list - after it's draged in the div
				$( "#view_container ol" ).droppable({
					activeClass: "ui-state-default",
					hoverClass: "ui-state-hover",
					accept: ":not(.ui-sortable-helper)",
					drop: function( event, ui ) {
						// define the actual clone
						var clone = $(ui.draggable).clone();
						// add a class - not necessary
					        //$(clone).attr('class', 'me')
					        // add the clone to the final div
					        $(this).append(clone);
						// remove the dummy object 
						$( this ).find( ".placeholder" ).remove();
						// append the dragable item to the slot
						//$( '<li class="me"></li>' ).html( ui.draggable.html() ).appendTo( this );
						// re-name dropped items
						// change the array so the vzlues are saved in extra array
						// this array is post processed by PHP in the update process
						// and saved to the desired places
						var  name = $(clone).find('input,select,textarea').attr('name').split('][');
						// get the number of chunks
						l = $(clone).find('input,select,textarea').attr('name').split('][').length;
						// inject temporary array so we do not rewrite defaults
						var temp = name[0] + '][b2046_bricks][0',i;
						// combine it all in one
						for(i=1; i<l; i++){
						    temp = temp + '][' + name[i];
						}
						// this touches the oroginal draged element ;/
						// $(ui.draggable).find('input,select,textarea').attr('name',temp);
						// changes the name of all inner inputs :)
						$(clone).find('input,select,textarea').attr('name',temp);
						//console.log(ui.helper.attr('class'));
						//console.log(el);
					
					}
				}).sortable({
					items: "li:not(.placeholder)",
					sort: function() {
						// gets added unintentionally by droppable interacting with sortable
						// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
						$( this ).removeClass( "ui-state-default" );
						
					}
					/*,
					function _onSortableUpdate(e, ui) { 
						console.log('Update'); 
						//_toggleSortableDummies(); 
					} 
					function _onSortableChange(e, ui) { 
						console.log('Change'); 
						//ui.placeholder.width(ui.item.get(0).offsetWidth + 'px').height(ui.helper.height()); 
					} 
					*/
				});
				// style the widget a bit
				$( ".pw_2046_lw").closest(".widget-inside").addClass("style_me");
			});
			</script>
		<?php
	}
	
	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance ) {
	
		//
		// Here wiil be just the data validation
		//
	
		//$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			//$instance['the_post_type'] = strip_tags( $new_instance['the_post_type'] ); 
			// just pass the variable to db without any other rework
			// TODO escape attributes based on inputs
		return $new_instance;
	}
	
	/**
	 * How to display the widget on the front end
	 */
	function widget($args, $instance) {
		extract( $args );
		
		// the viarables

	}
	
	function f2046_widget_builder ($view, $instance){
		// remove the briks for now
		//unset($view['b2046_bricks']);
		//mydump($view);
		// resort the array by position
		// RESORTING WILL BE NEEDE WHEN WE WILL BUILD THE ACTUAL SETUPS !
		foreach ($view as $key => $row) {
			$positions[$key]  = $row['position']; 
			// of course, replace 0 with whatever is the date field's index
		}
		array_multisort($positions, SORT_ASC, $view);

		//divide source by widget views
		$general_view_items = array();
		$view_view_items = array();
		$logic_view_items = array();
	
		
		// define empty output
		$output = '';
		// divide the input area by the view types
		foreach($view as $key => $val){
			if ($val['block'] == 'general'){
				$global_view_items[$key] = $val;
			}
			if ($val['block'] == 'view'){
				$view_view_items[$key] = $val;
			}
			if ($val['block'] == 'control'){
				$control_view_items[$key] = $val;
			}
		}
		// output the inputs to the widget
		$output .= '<div class="general_bank"><h3>General</h3><ul>';
			$output .= $this->f2046_inputbuilder($global_view_items, $instance);
		$output .= '</ul></div>
		<h3>'.__('Views').'</h3>
		<div class="view_holder">
			<div class="view_bank">
				<ul>';
				$output .= $this->f2046_inputbuilder($view_view_items, $instance);
			$output .= '</ul>
			</div>
			<div id="view_container">
				<div class="ui-widget-content">
					<ol>';
						// if there are no user data already put there dummy object
						if(empty($instance['b2046_bricks'])){
							$output .= '<li class="placeholder">Add your view objects here</li>';
						};
						$output .= $this->f2046_widget_user_inputs_builer($view_view_items, $instance);
					$output .= '</ol>
				</div>
			</div>
		</div>
		<h3 class="control_h3">'.__('Controls').'</h3>
		<div class="control_holder">
			<div class="control_bank">
				<ul>';
				//$output .= $this->f2046_inputbuilder($control_view_items, $instance);
			$output .= '</ul>
			</div>';
		$output .= '
			<div id="control_container">
				<div class="ui-widget-content">
					<ol>
						<li class="placeholder">Add your control objects here</li>
					</ol>
				</div>
			</div>
		</div>';
		// get the gold
		return $output;
	}
	
	function f2046_inputbuilder($view, $instance){		
		$output = '';
		foreach($view as $item_name => $item){
		// TODO load the defaults val if there were no user data
		
		// TODO find out how to save the cosen objects to the database !
 		//	
			$i = 0;
			foreach($item['gui'] as $gui){
				
				$name = $this->get_field_name($item_name);
				// force the css id to input - which will force the widget name to its widget handle
				$j_title = '';
				if(isset($item['w_title'])){
					$j_title = ' id="in-widget-title"'; 
				}
				$output .= '<li class="id_'.sanitize_title($item_name).'">';
					$output .='<strong>'.$item['item_title'].'</strong> <b class="rem">x</b><br />';
					// simple inputs
					if ($gui['ui_type'] == 'input'){
						$output .= '<input '.$j_title.' type="text" name="'. $name .'[gui]['.$i.']" value="'. $instance[$item_name]['gui'][$i] .'"/>';
					}

					// textarea
					if ($gui['ui_type'] == 'textarea'){
					
						$output .= '<textarea type="text" name="'. $name .'[gui]['.$i.']">'. $instance[$item_name]['gui'][$i] .'</textarea>';
					}

					// select box
					// TODO let the objects make multi input element
					if ($gui['ui_type'] == 'select_box'){
						$output .= '<select name="'. $name .'[gui]['.$i.']">';
						foreach($gui['choices'] as $key => $val){
							if($key == $instance[$item_name]['gui'][$i]){
								$selected = ' selected="selected"';
							}else{
								$selected = '';
							}
							$output .= '<option'.$selected.' value="'.$key.'">'.$val.'</option>';
						}
						$output .= '</select>';
					}

				if(!empty($item['item_note'])){
					$output .= '<br /><em>'.$item['item_note'].'</em>';
				}
				// input field stores the HTML object position
				$output .= '<input class="ui_position" type="hidden" value="'.$item['position'].'" name="'. $name .'[position]" /></li>'; 
				$i++;
			}
			//$i= 0;
		}
		return $output;
	}
	
	function f2046_widget_user_inputs_builer($view, $instance){
		// go through the user bricks
		foreach($instance['b2046_bricks'] as $brick){
			/*if ($key == 'position'){
				$position = $val;
				
			}*/
			mydump($brick);
			
			$output = '';
			
			foreach($brick as $key => $val){
				$output .= '<li><strong>a</strong> <b class="rem">x</b><br />';
				if(array_key_exists($key, $defaults)){
					$output .= 'ok '.$key.'<br>';
				}else{
					$output .= 'nope '.$key.'<br>';
				}
				$output .= '</li>';
			}
			
		}
		return $output;
	}

} // END of class

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// build image html
function f_2046_build_image($post_, $image_with_link, $image_size) {
	$post_thumbnail_id = get_post_thumbnail_id( $post_->ID );
	$output = '';
	// make the image link to the post/page
	if ($image_with_link == 1){
		$output .= '<a href="'. get_permalink($post_->ID) . '" title="'.get_the_title($post_->ID).'" class="page_link img_link">';
	}
	// make the image link to it's large version
	if ($image_with_link == 2){
		$image_large_src = wp_get_attachment_image_src( $post_thumbnail_id, 'large');
		// set links to large image and image's title
		$output .= '<a href="'. $image_large_src[0] . '" class="image_link img_link">';
	}
		// define thumbnail atributes
		$default_attr = array(
			'title'	=> trim(strip_tags( $post_->post_title )),
		);
		if($image_size == 1){
			$output .= wp_get_attachment_image( $post_thumbnail_id, 'thumbnail'); //get_the_post_thumbnail('thumbnail', $default_attr);
		}
		if($image_size == 2){
			$output .= wp_get_attachment_image( $post_thumbnail_id, 'medium'); //get_the_post_thumbnail('medium', $default_attr);
		}
		elseif($image_size == 3){
			$output .= wp_get_attachment_image( $post_thumbnail_id, 'large'); //get_the_post_thumbnail('large', $default_attr);
		}
	
	if ($image_with_link > 0){
		$output .= '</a>';
	}
	
	return $output;
	
}
// add WP featured image support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' ); 
}
// gallery function_exists
function f_2046_gallery_builder($p_ID, $image_size, $link, $p_id){
	$l_image_attributes = wp_get_attachment_image_src($p_ID , 'large');
	$sizes = array('','thumbnail', 'medium','large');
	foreach($sizes as $key=>$value){
		if($key == $image_size){
			$thmb_size = $value;
		}
	}
	$default_img_attr = array(
		'class'	=> "image $thmb_size lightbox",
	);
	// image without link
	if($link == 0){
		$output = wp_get_attachment_image( $p_ID, $thmb_size, false);
	}
	// image with link to post/page
	elseif($link == 1){
		$img_src = wp_get_attachment_image_src( $p_ID, $thmb_size );
		$post_title = get_the_title($p_id);
		$output = '<a href="'.get_page_link($p_id).'"  title="'.$post_title.'"><img src="'.$img_src[0] .'" alt="'.$post_title.'"/></a>';
	}
	// image with link to large sizes
	else{
		$output = '<a href="'.$l_image_attributes[0].'">'. wp_get_attachment_image( $p_ID, $thmb_size, false).'</a>';
	}
	return $output;
}
global $wp_scripts;

add_action('admin_print_styles-widgets.php', 'f2046_lw_insert_custom_css');
function f2046_lw_insert_custom_css(){
	wp_register_style('style_lw_2046', plugins_url( 'css/style_lw_2046.css' , __FILE__ ),false,0.1,'all');
	wp_enqueue_style( 'style_lw_2046');

}

function mydump($a){
	echo '<pre>';
	var_dump($a);
	echo '</pre>';
};
