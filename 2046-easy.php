<?php
/**
 * Plugin name: Easy
 * Plugin URI: http://wordpress.org/extend/plugins/2046s-widget-loops/
 * Description: Easy, but complex GUI website builder.
 * Version: 0.3
 * Author: 2046
 * Author URI: http://2046.cz
 *
 */
 
 /*
  * Btw I gratly appreciate the Geany editor - chek it out http://www.geany.org/
  * 
  * /
/*
//~ The function structure:
* 
* 
read externals:
 - items (array, each subaray represents the widget UI it's position, the name of the function(the logic))
 - functions (functions which will be used by each item, as it's stated above)
	 
register widget

	Widget:
	- widget reads the externally defined items 
	- widget inicialize itself
	- function "form"
	->uses function "f2046_widget_builder" (creates the Admin widget UI)
	-->uses function "f2046_inputbuilder" (makes the input, select, and other html based on the external definitions, for all it's 3 parts)
	-->uses function "f2046_widget_brick_collector" (goes through the user bricks combine the user data(bricks) with default objects serve it to the input builder)
	--->uses function "f2046_inputbuilder" {this will create the drag&droped inputs back to the slot after the witget is saved and loaded again}
	- function "update" (updates the gathered data to the database, and santized... not yet!)
	-function "widget"
	-->uses function "f2046_front_end_builder" (buildz the front end HTML)
	---> uses function"f2046_matcher" (matcher collects the user values from widget with the default structure, and completes the array of each needed item )
	---> ! - it creates a new function with unique name taken form the item name (this functin have to be stated in externals.. and has to able manipulate properly with the given data. The it returns each HTML back)
*
*/

//~ read default items & functions
require_once( 'includes/EasyItems.php' );
require_once( 'includes/EasyFunctions.php' );

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


// make class instance
$moo = new builder_2046_main_loop();
// trespass data to the widget class val
$moo::$EasyItems = $EasyItems;
$moo::$EasyQuery = array(
	'post_type' => 'post',
	'posts_per_page' => 1,
	'post_status' => 'publish'
);

//builder_2046_main_loop::EasyItems('oop');
/**
 * builder_2046_main_loop Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 */
// builder_2046_main_loop::$EasyItems = 'abc';
 class builder_2046_main_loop extends WP_Widget {
 	// set the routing variable
	public static $EasyItems;
	public static $EasyQuery;
	
	// Setter for usr data
	function ExtensionSetterItems($input){
		$this->EasyItems = $input;
		return true; 
	}
	// Setter for usr data
	function ExtensionSetterQuery($input){
		$this->EasyQuery = $input;
		return true; 
	}
	/**
	 * Widget setup.
	 */
	function builder_2046_main_loop() {
		/* Widget settings. */
		$widget_ops = array( 
			'classname' => 'builder_2046_main_loop',
			'description' => __('Easy content builder.','builder_2046') 
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
		$this->WP_Widget( 'builder_2046_main_loop-widget', __('Easy', 'builder_2046'), $widget_ops, $control_ops );
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) { 
		
		/* Set up some default widget settings. */
		// initialize data - read the externals to the default widget 
		$defaults = $this::$EasyItems;
		//$instance = wp_parse_args( $instance, $defaults );
		//extract( $instance, EXTR_SKIP );
		
		echo '<div id="the_widget_id_'.$this->id.'" class="easy_2046_lw">';
			//
			////////// build the widget HTML //////////////////
			//
			echo $this->f2046_widget_builder($defaults, $instance);
		echo '</div>';
	}
	
	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance ) {
	
		//
		// Here wiil be just the data validation
		//
		//~ each value will be validated by the logic stated in the item array
		
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
		//~  define default query,so we get something at least, a working query
		$default_query = $this::$EasyQuery;
		//~ if the user used some query controls
		$user_query = $this->f2046_output_control($default_query,$instance);
		//~ if the user query is empty, use d default instead
		if(empty($user_query)){
			$query_args = $default_query;
		}
		//~ merge the default query by the user query, (If the input arrays have the same string keys, then the later value for that key will overwrite the previous one.)
		else{
			$query_args = array_merge($default_query, $user_query);
		}
		//~ Get the query args 
		

		// The Query
		$the_query = new WP_Query( $query_args );
		//~ General restrictions
		//~ b2046_general_visibility
		//~ $permissions = $instance['b2046_general_visibility']['gui']['value'];
		//~ do something about the scafolding
		$scafold = EasyView_b2046_scafolding($instance['b2046_scafolding']['gui']['value'], '');

		if(empty($permissions) || $permissions == 'all' || current_user_can( $permissions )){
			if($the_query->have_posts()) :
				echo '<div id="post-'.get_the_ID().'" '; post_class($scafold[0]); echo '>';
				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post();
					echo '<div class="'. $scafold[1] .'">';
						echo $this->f2046_front_end_builder($instance, $the_query->post->ID);
					echo '</div>';
				endwhile;
				echo '</div>';
			endif;
			// Reset Post Data
			wp_reset_postdata();
		}
	}


	//~ 
	//~ transforms the "instance" data in to the HTML for the front-end
	//~ 	
	//~ for each instance[view get] get the name and vaues
	//~ execute the function with the same name as the view title
	//~ plus add values
	//~ add function result to the output string
	function f2046_front_end_builder($instance, $post_ID){
		$data_to_process = $this->f2046_matcher($instance, 'view');
		//~ mydump($data_to_process);
		$output = '';
		$i = 0;
		foreach($data_to_process as $key => $val){
			$values = ($val['gui'][0]['value']);
			$func = 'EasyView_'.$val['tmp_title'];
			$output .= $func($post_ID, $values);
			$i++;
		 }
		return	$output;
	}
	
	//~ 
	//~ 
	//~ 
	function f2046_output_control($default_query, $instance){
		$output = array();
		$data_to_process = $this->f2046_matcher($instance, 'control');
		$output = $data_to_process;
		$i = 0;
		foreach($data_to_process as $key => $val){
			$values = ($val['gui'][0]['value']);
			$func = 'EasyControl_'.$val['tmp_title'];
			$output = $func($default_query, $values);
			$i++;
		 }
		return $output;
	}

	//~ 
	//~ Matcher
	//~ returns updated array made of the user data merged with the default item array
	//~ 
	
	function f2046_matcher($instance, $wanted_type){
		$output = array();
		//~ merge given data with the defults
		//~ 
		//~ load the default item structure
		$defaults = $this::$EasyItems;
		//mydump($defaults);
		//~ remove possible helper: bricks array
		unset($defaults['b2046_bricks']);
		//~ mydump($instance['b2046_bricks']);
		//~ do it for all bricks
		$i = 0;
		
		if($wanted_type == 'view'){
			//~ echo '---instance: '. $wanted_type;
			//~ mydump($instance);
			if(isset($instance['b2046_bricks'])){
				foreach($instance['b2046_bricks'] as $key => $val) {
					//~ mydump(key($val));
					 //~ do it for all possible settings
					foreach($val as $each){
						if(array_key_exists(key($val), $defaults) && $defaults[key($val)]['block'] == $wanted_type){ 
							//echo '---wanted type';
							//mydump($wanted_type);
							//~ mydump($val[key($val)]['gui']['value']);
							$tmp = $defaults[key($val)];
							//~ mydump(key($val));
							$tmp['gui'][$i]['value'] = $val[key($val)]['gui']['value'];
							$tmp['tmp_title'] = key($val);
							$output[] =  $tmp;
						}
					}
					$i++;
				}
			}
		}elseif($wanted_type == 'general'){
			unset($instance['b2046_bricks']);
			//~ mydump('general');
			//mydump($instance);
			foreach($instance as $key => $val) {
				//~ mydump($defaults[$key]['block']);
				if($defaults[$key]['block'] == $wanted_type){
					//~ mydump($defaults[$key]['gui'][0]['value']);
					//~ mydump($val['gui']['value']);
					$tmp = $defaults[$key];
					$tmp['gui'][0]['value'] = $val['gui']['value'];
					//~ mydump($tmp);
					$tmp['tmp_title'] = $key;
					$output[] =  $tmp;
				}
				$i++;
			}
		}
		//~ control
		else{
			if(isset($instance['b2046_controls'])){
				foreach($instance['b2046_controls'] as $key => $val) {
					//~ mydump(key($val));
					 //~ do it for all possible settings
					foreach($val as $each){
						if($defaults[$key]['block'] == $wanted_type){
							//~ mydump($defaults[$key]['gui'][0]['value']);
							//~ mydump($val['gui']['value']);
							$tmp = $defaults[$key];
							$tmp['gui'][0]['value'] = $val['gui']['value'];
							//~ mydump($tmp);
							$tmp['tmp_title'] = $key;
							$output[] =  $tmp;
						}
					$i++;
					}
				}
			}
		}
		return $output;
	}
	
	
	//~ 
	//~ builds the admin widget
	//~ 
	function f2046_widget_builder ($view, $instance){
		// remove the briks for now
		unset($view['b2046_bricks']);
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
		$control_view_items = array();
	
		
		// define empty output
		$output = '';
		// divide the input area by the view types
		foreach($view as $key => $val){
			if ($val['block'] == 'general'){
				$global_view_items[$key] = $val;
			}
			if ($val['block'] == 'view'){
				$view_view_items[$key] = $val;
				//~ mydump($val);
			}
			if ($val['block'] == 'control'){
				$control_view_items[$key] = $val;
			}
		}
		// output the inputs to the widget
		$output .= '<div class="general_bank"><h3>General</h3><ul>';
			$output .= $this->f2046_inputbuilder($global_view_items, $instance, 'default');
		$output .= '</ul></div>
		<h3>'.__('Views').'</h3>
		<div class="view_holder">
			<div class="view_bank">
				<ul>';
				//~ build the dummy items, that can be drag&dropped to the slot bellow for the actual use
				$output .= $this->f2046_inputbuilder($view_view_items, $instance, 'view_default');
			$output .= '</ul>
			</div>
			<div id="view_container">
				<div class="ui-widget-content">
					<ol>';
						//~ process the "view" data and serve them back in form of complete "li" with inputs and such
						$output .= $this->f2046_widget_brick_collector($view_view_items, $instance, 'view_user_data');
					$output .= '</ol>
				</div>
			</div>
		</div>
		<h3 class="control_h3">'.__('Controls').'</h3>
		<div class="control_holder">
			<div class="control_bank">
				<ul>';
				//~ build the dummy items, that can be drag&dropped to the slot bellow for the actual use
				$output .= $this->f2046_inputbuilder($control_view_items, $instance, 'control_default');
			$output .= '</ul>
			</div>';
		$output .= '
			<div id="control_container">
				<div class="ui-widget-content">
					<ol>';
						//~ process the "control" data and serve them back in form of complete "li" with inputs and such
						$output .= $this->f2046_widget_brick_collector($control_view_items, $instance, 'control_user_data');
					$output .= '</ol>
				</div>
			</div>
		</div>';
		// get the gold
		return $output;
	}
	
	function f2046_inputbuilder($view, $instance, $type){
		$output = '';
		//~ decide how many time 
		//~  in default t efirst array level are names
		if($type == 'control_user_data' || $type == 'view_user_data'){
			$loops = array($instance);
			
			if($type == 'control_user_data'){
				$j_name = 'b2046_controls';
			}else{
				$j_name = 'b2046_bricks';
			}
		//~ the differenc is that user array is has first level as numbers so we can sort it out, 
		//~ and multiple item instances can be used, unlike for generals, or controls
		}else{
			$loops = array(0 => $view);
			$j_name = 'b2046_bricks';
		}
		
		foreach($loops as $loop){
			$i = 0;
			//~ echo '------- '.$type.' <br>';
			//~ mydump($loop);
			foreach($loop as $item_name => $item)
			{
				foreach($item['gui'] as $gui)
				{
					//
					// default -  read the unique name from the 
					// user = read the neme from the temporary place
					//
					if($type == 'view_user_data'){
						$splited = explode('][',$this->get_field_name($item['tmp_name']));
						$gui['value'] = $instance[$i]['gui'][0]['value'];
						$name = $splited[0].']['.$j_name.']['.$i.']['.$item["tmp_name"].']';
						// change the value
						//echo '>>>>>>>>>>>>>><br>';
						//var_dump( );
						$div_id = $item['tmp_name'];
						//widget-builder_2046_main_loop-widget[7][b2046_bricks][1][b2046_post_title][gui][value]
					}elseif($type == 'control_user_data'){
						$splited = explode('][',$this->get_field_name($item['tmp_name']));
						$gui['value'] = $instance[$i]['gui'][0]['value'];
						$name = $splited[0].']['.$j_name.']['.$item["tmp_name"].']';
						// change the value
						//echo '>>>>>>>>>>>>>><br>';
						//var_dump( );
						$div_id = $item['tmp_name'];
						
					}
					else{
						$name = $this->get_field_name($item_name);
						//~ get the value from the instance (defauts)
						//~ check if the value exists already before we try to assign it
						if(isset($instance[$item_name]['gui']['value'])){
							$gui['value'] = $instance[$item_name]['gui']['value'];
						}
						$div_id = $item_name;
					}
					
					// force the css id to input - which will force the widget name to its widget handle
					$j_title = '';
					if(isset($item['w_title'])){
						$j_title = ' id="in-widget-title"'; 
					}
					//~ set class out of the item name
					$li_class = '';
					if($type == 'control_user_data'){
						$li_class = $item['tmp_name'];
					}else{
						$li_class = $item_name;
					}
					
					$output .= '<li class="'.$li_class.' ui-draggable">';
						$output .='<strong>'.$item['item_title'].'</strong> <b class="rem">x</b><br />';
						//~ 
						//~ simple inputs
						//~ 
						//~ TODO let the objects make multi input element
						if ($gui['ui_type'] == 'input'){
							$output .= '<input '.$j_title.' type="text" name="'. $name .'[gui][value]" value="'. $gui['value'] .'"/>';
						}

						// textarea
						if ($gui['ui_type'] == 'textarea'){
						
							$output .= '<textarea type="text" name="'. $name .'[gui][value]">'. $gui['value'] .'</textarea>';
						}
						//~ 
						//~ select box
						//~ 
						// TODO let the objects make multi input element
						if ($gui['ui_type'] == 'select_box'){
								$output .= '<select name="'. $name .'[gui][value]">';
							foreach($gui['choices'] as $key => $val){
								if($key == $gui['value']){
									$selected = ' selected="selected"';
								}else{
									$selected = '';
								}
								$output .= '<option'.$selected.' value="'.$key.'">'.$val.'</option>';
							}
							$output .= '</select>';
						}

					if(!empty($item['item_note'])){
						$output .= '<em>'.$item['item_note'].'</em>';
					}
				$i++;
				}
				
			}
			
		}
		return $output;
	}
	
	function f2046_widget_brick_collector($view, $instance,$what){
		//
		// go through the user bricks
		// combine the user javascript made data(bricks) with default objects
		// serve it to the input builder
		//
		
		$i = 0;
		$output = array();
		//~ render control data
		if ($what == 'control_user_data'){
			if(isset($instance['b2046_controls'])){
				foreach($instance['b2046_controls'] as $key => $val){
					// this value will be pushed as the object positions
					// that matches because the resulted array is naturaly sorted by numbers 0,1,2 etc. 
					//~ echo '<br />--- key '.$i.'---<br />';
					//~ mydump($key);
					if(array_key_exists($key, $view)){
						$clone_brick = $view[$key];
						//echo '<br />--- clone ---<br />';
						//mydump($clone_brick);
						//mydump($clone_brick['gui'][0]['value']); //view[$key]
						//~ echo '<br />--- '.$key.' ---<br />';

						if(isset($instance['b2046_controls'][$key]['gui']['value'])){
							$clone_brick['gui'][0]['value'] = $instance['b2046_controls'][$key]['gui']['value'];
							 echo 'exists';
						}else{
							$clone_brick['gui'][0]['value'] = '';
							 echo 'nope';
						}
						//echo '<br />--- val ---<br />';
						//~ mydump($clone_brick); //view[$key]
						//~ write the item name in to the temporary value
						$clone_brick['tmp_name'] = $key;

						//~ write the block position in to the temporary value
						//~ $clone_brick['tmp_block'] = $instance['b2046_bricks'][$i][key($val)]['block'];
						//mydump($clone_brick['gui'][0]['value']);
						array_push($output,$clone_brick);
						//widget-builder_2046_main_loop-widget[7][b2046_bricks][0][-----][gui][value]
					}
					$i++;
				}
			}
			$output = $this->f2046_inputbuilder( $view,$output,'control_user_data');
			
			//~ VIEWS 
		}else{
		//~ combiine data for views (multiple)	
			if(isset($instance['b2046_bricks'])){
				foreach($instance['b2046_bricks'] as $key => $val){
					// this value will be pushed as the object positions
					// that matches because the resulted array is naturaly sorted by numbers 0,1,2 etc. 
					//echo '<br />--- key '.$i.'---<br />';
					//mydump($val);
					if(array_key_exists(key($val), $view)){
						//echo '-------kiss <br />';
						//mydump(key($val));
						$clone_brick = $view[key($val)];
						//echo '<br />--- clone ---<br />';
						//mydump($clone_brick);
						//mydump($clone_brick['gui'][0]['value']); //view[$key]
						//~ echo '<br />--- '.$key.' ---<br />';
						//~ mydump($key);
						//~ mydump($val);

						if(isset($instance['b2046_bricks'][$i][key($val)]['gui']['value'])){
							$clone_brick['gui'][0]['value'] = $instance['b2046_bricks'][$i][key($val)]['gui']['value'];
							//~ echo 'exists';
						}else{
							$clone_brick['gui'][0]['value'] = '';
							//~ echo 'nope';
						}
						//echo '<br />--- val ---<br />';
						//~ mydump($clone_brick); //view[$key]
						//~ write the item name in to the temporary value
						$clone_brick['tmp_name'] = key($val);
						//~ write the block position in to the temporary value
						//~ $clone_brick['tmp_block'] = $instance['b2046_bricks'][$i][key($val)]['block'];

						array_push($output,$clone_brick);
						//widget-builder_2046_main_loop-widget[7][b2046_bricks][0][-----][gui][value]
					}
					$i++;
				}
			}
			$output = $this->f2046_inputbuilder( $view,$output,'view_user_data');
		}
		//mydump($output);
		
		return $output;
	}

} // END of Widget class

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// build image html
function f_2046_Easy_build_image($post_, $image_with_link, $image_size) {
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
function f_2046_Easy_gallery_builder($p_ID, $image_size, $link, $p_id){
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

add_action('admin_print_styles-widgets.php', 'f2046_Easy_insert_custom_css');
function f2046_Easy_insert_custom_css(){
	wp_register_style('easy_2046', plugins_url( 'css/easy_2046.css' , __FILE__ ),false,0.1,'all');
	wp_enqueue_style( 'easy_2046');
	
	wp_register_script('easy_2046_widget',plugins_url( 'js/2046_easy_widget.js' , __FILE__ ));
	wp_enqueue_script('easy_2046_widget');
	
}

function mydump($a){
	echo '<pre>';
	var_dump($a);
	echo '</pre>';
};
