<?php
/**
 * Plugin name: Easy
 * Plugin URI: http://wordpress.org/extend/plugins/easy/
 * Description: Easy, but complex GUI website builder.
 * Version: 0.9.4.6
 * Author: 2046
 * Author URI: http://2046.cz
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
	register_widget( 'Easy_2046_builder' );
	// localization
	load_plugin_textdomain( 'builder_2046', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'); 
}

// make class instance
//~ $EasyClassClone = new Easy_2046_builder();
// trespass data to the widget class val
Easy_2046_builder::$EasyItems = $EasyItems;
Easy_2046_builder::$EasyQuery = array(
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
 class Easy_2046_builder extends WP_Widget {
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
	function Easy_2046_builder() {
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
		$defaults = Easy_2046_builder::$EasyItems;
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
	
		// for each item value (array) apply the esc function AKA secure the values, and let only wanted.. 
		// 
		// get the referenctial array
		$default_items = Easy_2046_builder::$EasyItems;
		// process  user arrays
		foreach($new_instance as $item => $val){ 
			foreach ($val as $gui => $g) {
				foreach ($g as $k => $v) {
					if( isset($v['gui']) ){
						$i = 0;
						foreach($v['gui'] as $value){
							// here is the value we want to secure
							$to_be_secured = $value['value'];
							// get the wanted escape type for the actual value - defined in the EasyItem
							// and create reference it to the predefined function, like "esc_attr"
							$escape_type_function = $default_items[$k]['gui'][$i]['esc'];
							if(!empty($escape_type_function)){
								// filter out the user value by the desired escape function
								$new_instance[$item][$gui][$k]['gui'][$i]['value'] = $escape_type_function($to_be_secured);
								// mydump($instance[$item][$gui][$k]['gui'][$i]['value']);
							}
							$i++;
						}
					}
				}
			}	
		}
		return $new_instance;
	}
	
	/**
	 * How to display the widget on the front end
	 */
	function widget($args, $instance) {
		
		//~ reset previous post data.. just to be sure 
		//~ somebody could run their own wp_query and do not reset the data ;)
		wp_reset_postdata();
		
		//~  define default query,so we get something at least, a working query
		$default_query = Easy_2046_builder::$EasyQuery;

		//~ check if it makes sense to process anything
		//~ the resistor ids a filter that returns true if all the conditions are meet, flase if not.. if not then skip the next process
		$resistor = $this->f2046_output_resistor($default_query,$instance);
		if ($resistor == true){
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
			// The Query
			$easy_query = new WP_Query( $query_args );
			//~ General restrictions
			//~ b2046_general_visibility
			//~ $permissions = '';
			//~ if(isset($instance['b2046_controls']['b2046_general_visibility']['gui']['0']['value'])){
				//~ $permissions = $instance['b2046_controls']['b2046_general_visibility']['gui']['0']['value'];
			//~ }
			//~ do something with the scafolding
			$b2046_scafold_type = $instance['b2046_scafold_type']['gui']['0']['value'];
			$b2046_scafold_row_class = $instance['b2046_scafold_row_class']['gui']['0']['value'];
			$b2046_scafolding_column_class = $instance['b2046_scafolding_column_class']['gui']['0']['value'];
			$widget_title = $instance["b2046_widget_title"]["gui"]['0']["value"];
			$output = '';
			$class= '';
			
			
			//~ $permissions = EasyControl_b2046_general_visibility($the_query->post->ID, '');
			//~ if(empty($permissions) || $permissions == 'all' || current_user_can( $permissions )){
				
				if($easy_query->have_posts()) :
					// one per row
					if($b2046_scafold_type == 1){
						$class .= $b2046_scafolding_column_class;
					}
					//~ many per row
					if($b2046_scafold_type == 2){
						$output .= '<div class="'.$b2046_scafold_row_class.'">';
						$class = $b2046_scafolding_column_class;
					}
					//~  default widget classes
					elseif($b2046_scafold_type == 0){
						$output .= $args['before_widget'];
					}
					
					$WPpostClass = get_post_class();
					$class = implode(' ',$WPpostClass) .' '. $class;
					//~ widget title
					if(!empty($widget_title)){
						$output .='<h4 class="widget_title">'.$widget_title.'</h4>';
					}
					
					// The Loop
					while ( $easy_query->have_posts() ) : $easy_query->the_post();
						//~ scafold check
						if($b2046_scafold_type == 1){
							$output .= '<div class="'.$b2046_scafold_row_class.'">';
						}
						
						$output .= '<div id="post-'.get_the_ID().'" class="'.$class.'"'; 
						$output .= '>';
						$output .= $this->f2046_front_end_builder($instance, $easy_query);
						$output .= '</div>';
						
						//~ scafold - one per row - row
						if($b2046_scafold_type == 1){
							$output .= '</div>';
						}
					endwhile;
					
					//~ many per row || one per row
					if($b2046_scafold_type == 2){
						$output .= '</div>';
					}
					//~  default widget classes
					elseif($b2046_scafold_type == 0){
						$output .= $args['after_widget'];
					}
				endif;
				//~ view-after
				$output .= $this->f2046_front_end_after_builder($instance, $easy_query);
				// Reset Post Data
				wp_reset_postdata();
			//~ }
			
			//~ serve it out :)
			echo $output;
		}
	}
	//~ END OF WORDPRESS DEFAULT WIDGET GAME
	//~ HERE STARTS THE HELL ;)

	//~ 
	//~ transforms the "instance" data in to the HTML for the front-end
	//~ 	
	//~ for each instance[view get] get the name and vaues
	//~ execute the function with the same name as the view title
	//~ plus add values
	//~ add function result to the output string
	function f2046_front_end_builder($instance, $easy_query){
		$data_to_process = $this->f2046_matcher($instance, 'view');
		$output = '';
		$values = array();
		
		foreach($data_to_process as $key => $val){
			$i = 0;
			
			foreach($val['gui'] as $each){
				$values[] = $each['value'];
			}
			$func = $val['tmp_title'];
			$output .= $func($easy_query, $values);
			unset($values);
			$i++;
		 }
		return	$output;
	}
	
	//~ 
	//~ build the "something" after the loop, "based on the query"
	//~ 
	function f2046_front_end_after_builder($instance, $easy_query){
		$data_to_process = $this->f2046_matcher($instance, 'view_after');
		$output = '';
		$values = array();
		
		foreach($data_to_process as $key => $val){
			$i = 0;
			
			foreach($val['gui'] as $each){
				$values[] = $each['value'];
			}
			$func = $val['tmp_title'];
			$output .= $func($easy_query, $values);
			unset($values);
			$i++;
		 }
		return	$output;
	}
	
	//~ 
	//~ Dynamicaly create function names which fas to be found "somewhere" and precess the data
	//~ 
	function f2046_output_control($default_query, $instance){
		$output = array();
		$data_to_process = Easy_2046_builder::f2046_matcher($instance, 'control');
		$output = $data_to_process;
		$tmp_result = $default_query;
		//~ echo '--------- data<br />----------------<br />';
		$values = array();
		$i = 0;
		foreach($data_to_process as $key => $val){
			//~  
			//~ check if the array value under given key is defined
			//~ in the case of checkboxed values, some might be empty, and then it trigers errors, obviously.
			//~ sort($val['gui']); // seams like that this was bogus.. it actually resorts some thing inproperly.. come controls might be wrong now!
			if(is_array($val['gui']) && count($val['gui']) > 1){
				$values = array();
				foreach($val['gui'] as $key => $v){
					$values[] = $val['gui'][$key]['value'];
				}
			}else{
				if(isset($val['gui'][0]['value'])){
					$values = ($val['gui'][0]['value']);
				}
			}
			//~ create function
			$func = $val['tmp_title'];
			//~ process data by that function --- should be declared outside , like in EasyFunctions.php
			$function_result = $func($tmp_result, $values);
			//~ echo '-----/\----after function EasyControl_'.$val['tmp_title'].' <br />';
			$tmp_result = array_merge($tmp_result, $function_result);
			$i++;
		 }
		$output = $tmp_result;
		return $output;
	}
	
	
	//~ 
	//~ Dynamicaly create function names which fas to be found "somewhere" and precess the data
	//~ derivate of outputs
	//~ but i this case these controls have to run before loop
	function f2046_output_resistor($default_query, $instance){
		$output = true;
		$data_to_process = $this->f2046_matcher($instance, 'resistor');
		//~ echo '--------- data<br />----------------<br />';
		$values = array();
		$i = 0;
		foreach($data_to_process as $key => $val){
			$output = true;
			//~  
			//~ check if the array value under given key is defined
			//~ in the case of checkboxed values, some might be empty, and then it trigers errors, obviously.
			// sort($val['gui']); // seams like that this was bogus.. it actually resorts some thing inproperly.. come controls might be wrong now!
			if(is_array($val['gui']) && count($val['gui']) > 1){
				$values = array();
				foreach($val['gui'] as $key => $v){
					$values[] = $val['gui'][$key]['value'];
				}
			}else{
				if(isset($val['gui'][0]['value'])){
					$values = ($val['gui'][0]['value']);
				}
			}
			//~ create function
			$func = $val['tmp_title'];
			//~ process data by that function --- should be declared outside , like in EasyFunctions.php
			$function_result = $func($default_query, $values);
			//~ if only just once any of the resistor functions triggers false
			//~ stop the process and return "false"
			if($function_result == false){
				return false;
				break;
			}
			$i++;
		 }
		 //~ if all resistors returns "true" meaning the expectations are meet
		 //~ let them pass
		 return true;
	}
	//~ 
	//~ Matcher
	//~ returns updated array made out of the user data merged with the default item array
	//~ 
	function f2046_matcher($instance, $wanted_type){
		$output = array();
		//~ merge given data with the defults
		//~ 
		//~ load the default item structure
		$defaults = Easy_2046_builder::$EasyItems;
		//~ remove possible helper: bricks array
		unset($defaults['b2046_bricks']);
		//~ do it for all bricks
		$i = 0;
		if($wanted_type == 'general'){
			unset($instance['b2046_bricks']);

			foreach($instance as $key => $val) {
				//~ key['type'] has only one value for now.. the resistor, or any
				//~ resistors are processed in f2046_output_resistor function
				
				if($defaults[$key]['block'] == $wanted_type){
					$tmp = $defaults[$key];
					$tmp['gui'][0]['value'] = $val['gui']['value'];
					$tmp['tmp_title'] = $key;
					$output[] =  $tmp;
				}
				
				$i++;
			}
		}
		if($wanted_type == 'view' || $wanted_type == 'view_after' || $wanted_type == 'control' || $wanted_type == 'resistor'){
			
			if($wanted_type == 'view' || $wanted_type == 'view_after'){
				$distinguisher = 'b2046_bricks';
			}
			else{
				$distinguisher = 'b2046_controls';
			}
				
			if(isset($instance[$distinguisher])){
				foreach($instance[$distinguisher] as $key => $val) {
					 //~ do it for all possible settings
					foreach($val as $each){
						if(array_key_exists(key($val), $defaults) && $defaults[key($val)]['block'] == $wanted_type){ 
							//echo '---wanted type';
							$tmp = $defaults[key($val)];
							$tmp['gui'] = $val[key($val)]['gui'];
							$tmp['tmp_title'] = key($val);
							$output[] =  $tmp;
							
						}
					}
					$i++;
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
		// resort the array by position
		// RESORTING WILL BE NEEDE WHEN WE WILL BUILD THE ACTUAL SETUPS !
		
		foreach ($view as $key => $row) {
			if(isset($row['position'])){
				$positions[$key]  = $row['position']; 
			}else{
				$positions[$key]  = $row['item_title']; 
			}
			// of course, replace 0 with whatever is the date field's index
		}
		array_multisort($positions, SORT_ASC, $view);

		//divide source by widget views
		$general_view_items = array();
		$view_view_items = array();
		$control_view_items = array();
	
		
		// define empty output
		$output = '';
		// divide the defaults by the view types
		foreach($view as $key => $val){
			if ($val['block'] == 'general'){
				$global_view_items[$key] = $val;
			}
			if ($val['block'] == 'view' || $val['block'] == 'view_after'){
				$view_view_items[$key] = $val;
			}
			//~ pass controls and resistors to the control slot
			if ($val['block'] == 'control' || $val['block'] == 'resistor'){
				$control_view_items[$key] = $val;
			}
		}
		// output the inputs to the widget
		$output .= '<div class="general_bank"><h3>General</h3><ul>';
		//~ $post_types = get_post_types($args_types,'names'); 
		//~ foreach ($post_types as $post_type ) {
		  //~ echo '<p>'. $post_type. '</p>';
		//~ }	
			//~ $output .= $this->f2046_inputbuilder($global_view_items, $instance, 'default');
			$output .= $this->f2046_widget_brick_collector($global_view_items, $instance, 'general');
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
		<h3 class="control_h3">'.__('Controls (<span class="res">R</span><i>esistors</i>)').'</h3>
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
		</div>
		<div style="float:left;clear:both;width:100%"><a target="_blank" href="http://2046.cz/easy">Documentation</a></div>
		';
		// get the gold
		return $output;
	}
	
	//~ 
	//~ Get the user data, match them against the default values, combine them together
	//~ --> finaly call the input builder to make HTML bricks(inputs)
	//~ 
	function f2046_widget_brick_collector($view, $instance, $what){
		//~ view = default, Instance=  what we get, what - for what logival part(gen., view, contr.)
		//
		// go through the user bricks
		// combine the user javascript made data(bricks) with default objects
		// serve it to the input builder
		//
		$output = array();
		if($what == 'general'){
			//~ $i = 0;
			//~ For each brick (li)
			foreach($view as $key => $val){
				// this value will be pushed as the object positions
				// that matches because the resulted array is naturaly sorted by numbers 0,1,2 etc. 
				 //~ echo '<br />--- key '.$i.'---<br />';
				$tmp_name = $key;

				//~ If the bricks with the unique ID exists in in defaults (just to make sure no "noncomplete" stuff can pass)
				if(array_key_exists($key, $instance)){
					$clone_brick = $val;
					//~ for each gui
					//~ $key is the brick name					
					//~ push values
					
					$clone_brick['gui'][0]['value'] = $instance[$key]['gui'][0]['value'];
					
					//~ write the item name in to the temporary value
					$clone_brick['tmp_name'] = $key;
					//~ write the block position in to the temporary value
					array_push($output,$clone_brick);
				}else{
					$output = $view;
				}
			}
			
			$output = $this->f2046_inputbuilder( $view,$output,'general');
		}
		elseif(($what == 'view_user_data' && isset($instance['b2046_bricks'])) || ($what == 'control_user_data' && isset($instance['b2046_controls']))){
			
			if($what == 'view_user_data'){
				$distinguisher = 'b2046_bricks';
			}else{
				$distinguisher = 'b2046_controls';
			}
			
			//~ For each brick (li)
			foreach($instance[$distinguisher] as $key => $val){
				//echo '-------kiss <br />';
				$tmp_name = key($val);
				// this value will be pushed as the object positions
				// that matches because the resulted array is naturaly sorted by numbers 0,1,2 etc. 
				//~ widget-builder_2046_main_loop-widget[20][b2046_post_title][gui][0][value]
				if(array_key_exists(key($val), $view)){
					//~ for each gui
					$clone_brick = $view[key($val)];
					
					$values =$val[key($val)]['gui'];
					$ii = 0;
					foreach($values as $key => $val){
						$clone_brick['gui'][$key]['value'] = $val['value'];
						$ii++;
					}
					//~ write the item name in to the temporary value
					$clone_brick['tmp_name'] = $tmp_name;
					//~ write the block position in to the temporary value
					array_push($output,$clone_brick);
				}
				//~ $i++;
			}
			
			if($what == 'view_user_data'){
				$output = $this->f2046_inputbuilder( $view,$output,'view_user_data');
			}else{
				$output = $this->f2046_inputbuilder( $view,$output,'control_user_data');
			}
			
		}
		if(!empty($output)){
			return $output;
		}
	}
	
	//~ 
	//~ Create bricks (inputs)
	//~ 
	function f2046_inputbuilder($view, $instance, $type){
		$output = '';
		//~ decide how many time 
		//~  in default the first array level are names
		//~ if($type == 'control_user_data' || $type == 'view_user_data'){
		if($type == 'view_user_data'){
			$bricks = array($instance);
			$j_name = 'b2046_bricks';
		}elseif($type == 'control_user_data'){
			$bricks = array($instance);
			$j_name = 'b2046_controls';
		}elseif($type == 'control_default' || $type == 'view_default'){
			//~ the differenc is that user_view array is has first level as numbers so we can sort it out by numbered possition, 
			//~ and multiple item instances can be used, unlike for generals, or controls
			$bricks = array(0 => $view);
			$j_name = 'b2046_bricks';
		}
		elseif($type == 'general'){
			$bricks = array($instance);
			$j_name = 'b2046_default';
		}
		
		//~ for each brick
		$each_brick_i = 0;
		foreach($bricks as $loop){
			//~ if($type == 'default'){
				//~ }
			$i = 0;
			foreach($loop as $item_name => $item)
			{
				// force the css id to input - which will force the widget name to its widget handle
				$j_title = '';
				if(isset($item['w_title'])){
					$j_title = ' id="in-widget-title"'; 
				}
				//~ set class out of the item name
				$li_class = '';
				//~ if($type == 'control_user_data'){
					//~ $li_class = $item['tmp_name'];
				//~ }else{
					$li_class = $item_name;
				//~ }
				
				//~ check if the input can be repeatable
				//~ that user can repeatedly insert it in the slot
				if(isset($item['repeatable']) && $item['repeatable'] == false){
					$rel_repeatable = ' rel="non-repeatable"';
				}else{
					$rel_repeatable = '';
				}
				
				$output .= '<li class="li_'.$li_class.' ui-draggable" '.$rel_repeatable.'>';
				if(!empty($item['item_title'])){
					if($item['block'] == 'resistor'){
						$output .= '<span class="res">R</span>';	
					}
					$output .='<strong>'.$item['item_title'].'</strong> <b class="rem">x</b><br />';
				}	
				$each_gui_i = 0;
				$gui_value = '';
				foreach($item['gui'] as $gui => $val)
				{
					//
					// default -  read the unique name from the 
					// user = read the name from the temporary place
					//
					
					if($type == 'view_user_data' || $type == 'control_user_data'){
						//~ split the fieldname so we can reconstruct it later on
						$splited = explode('][',$this->get_field_name($item['tmp_name']));
						//~  get the value-s
						$gui_value = $val['value'];//$instance[$i]['gui'][$each_gui_i]['value'];
						if(isset($val['ui_note'])){
							$ui_note = $val['ui_note'];
						}
						$name = $splited[0].']['.$j_name.']['.$each_brick_i.']['.$item["tmp_name"].']';
						//~ get the temporary name
						$div_id = $item['tmp_name'];
					//widget-builder_2046_main_loop-widget[7][b2046_bricks][1][b2046_post_title][gui][value]
					}
					elseif($type == 'control_default' || $type == 'view_default'){
						$name = $this->get_field_name($item_name);
						//~ get the value from the instance (defauts)
						//~ check if the value exists already before we try to assign it
						$gui_value= $val['value'];
						if(isset($val['ui_note'])){
							$ui_note = $val['ui_note'];
						}
						$div_id = $item_name;
					}elseif($type == 'general'){
						$splited = explode('][',$this->get_field_name($item_name));
						$gui_value = $val['value'];
						if(isset($val['ui_note'])){
							$ui_note = $val['ui_note'];
						}
						
						if(isset($item["tmp_name"])){
							$name = $splited[0].']['.$item["tmp_name"].']';
						}else{
							$name = $splited[0].']['.$item_name.']';
						}

						$div_id = $item_name;
					}
					
					
					
					//~ UI BUILDER
					
					//~ 
					//~ simple inputs
					//~ 
					if ($val['ui_type'] == 'input'){
						if(isset($ui_note)){
							$placeholder = 'placeholder="'.$ui_note.'"';
						}else{
							$placeholder = '';
						}
						$output .= '<input '.$j_title.' '.$placeholder.' type="text" name="'. $name .'[gui]['.$each_gui_i.'][value]" value="'. $gui_value .'">';
					}

					// textarea
					elseif ($val['ui_type'] == 'textarea'){
						if(isset($ui_note)){
							$placeholder = 'placeholder="'.$ui_note.'"';
						}else{
							$placeholder = '';
						}
						$output .= '<textarea type="text" '.$placeholder.' name="'. $name .'[gui]['.$each_gui_i.'][value]">'. $gui_value .'</textarea>';
					}
					//~ 
					//~ select box
					//~ 
					elseif ($val['ui_type'] == 'select_box'){
						$output .= '<select name="'. $name .'[gui]['.$each_gui_i.'][value]">';
						if(isset($ui_note)){
							$output .='<option>-- '.$ui_note.' --</option>';
						}
						foreach($val['choices'] as $keyx => $valx){
							if($keyx == $gui_value){
								$selected = ' selected="selected"';
							}else{
								$selected = '';
							}
							$output .= '<option'.$selected.' value="'.$keyx.'">'.$valx.'</option>';
						}
						$output .= '</select>';
					}
					//~ 
					//~ check box //// NOT TESTED ! TODO
					//~ 
					elseif ($val['ui_type'] == 'check_box'){
						//~ $gui_i = 0;
						foreach($val['choices'] as $keys => $vals){
							if($keys == $gui_value){
								$selected = ' checked="checked"';
							}else{
								$selected = '';
							}
							$output .= '<div class="ew2046_check_box"><input name="'. $name .'[gui]['.$each_gui_i.'][value]" type="checkbox"'.$selected.' value="'.$keys.'" />'.$vals.'<br />';
							if(isset($ui_note)){
								$output .= '<em>'.$ui_note.'</em>';
							}
							$output .= '</div>';
						}
					}
					//~ 
					//~ hidden
					//~ 
					elseif ($val['ui_type'] == 'hidden'){
						if(isset($ui_note)){
							$placeholder = $ui_note;
						}else{
							$placeholder = '';
						}
						$output .= '<input '.$j_title.' type="hidden" name="'. $name .'[gui]['.$each_gui_i.'][value]" value="'. $gui_value .'"/>';
						$output .= '<em>'.$placeholder.'</em>';
					}
					//~ 
					//~ radio group
					//~ 
					elseif ($val['ui_type'] == 'radio_group'){
						$output .='<div class="radiogroup">';
						foreach($val['choices'] as $keyx => $valx){ 
							if($keyx == $gui_value ){
								$selected = ' checked="checked"';
							}else{
								$selected = '';
							}
							$output .= '<input'.$selected.' type="radio" name="'. $name .'[gui]['.$each_gui_i.'][value]" value="'.$keyx.'" /><label>'.$valx.'</label><br />';
						}
						if(isset($ui_note)){
							$output .='<em>'.$ui_note.'</em>';
						}
						$output .= '</div>';
					}
					//~ 
					//~ playin text - note
					//~ 
					elseif ($val['ui_type'] == 'plain'){
						if(isset($ui_note)){
							$placeholder = $ui_note;
						}else{
							$placeholder = '';
						}
						// $output .= '<input '.$j_title.' type="hidden" name="'. $name .'[gui]['.$each_gui_i.'][value]" value="'. $gui_value .'"/>';
						$output .= '<em>'.$placeholder.'</em>';
					}

					//~ iterate for each gui
					$each_gui_i++;
				$i++;
				unset($ui_note);
				}
				$output .= '</li>';
			$each_brick_i++;
			}
			
		}

		return $output;
	}
	
	
	//~ id cleaner
	
	function f2046_id_cleaner_to_array($val){
		if(!empty($val)){
			$post_id_clean = ereg_replace(" ", "", $val);
			$post_ids_array = explode(',', $post_id_clean);
			return $post_ids_array;
		}
	}
	function f2046_id_cleaner_to_string($val){
		if(!empty($val)){
			$post_id_string = ereg_replace(" ", "", $val);
			return $post_ids_string;
		}
	}
	//~  helper  for listing all the 
	function f2046_get_post_types(){
		$out = array();
		$post_types = get_post_types($args_types,'names'); 
			foreach ($post_types as $post_type ) {
			  $out[] = $post_type;
		}
		return $out;
	}
	// search child pages through X levels
	function getChildren($id, $depth, $include_exclude){
		$i = 0;
		$pages = $id;
		// create empty tmp array,
		$tmp_pages = array();
		// find children for each given page id
		//  if the new iteration won't bring any new pages stop the while process
		while ($depth != $i){
			$diff = array_diff($pages, $tmp_pages);
			//  if the last iteration did not bring new page ids (child pages)
			//  brake the while cycle.. there is no neeed to provess it further
			if(empty($diff)){
				break;
			// if the last iteration bought some new page ids go further
			}else{
				// put the actual array to tmp
				// if the pages array wont change aftere this foreach the while wont process
				// meaning, there are no new siblings and has no reason to go run this process
				$tmp_pages = $pages;

				foreach ($pages as $p) {
					$defaults = array( 
					    'post_parent' => $p,
					    'post_type'   => 'any', 
					    'numberposts' => -1,
					    'post_status' => 'any'
					);
					$kids = get_pages($defaults);
					if (is_object($kids)){
						foreach($kids as $kid){
							$pages[] = $kid->ID;
						}
					}
					$pages = array_unique($pages);
				}
				$i++;
			}
		}
		// clean the array
		
		// include exclude currnet
		if($include_exclude == 'exclude'){
			$pages = array_diff($pages, $id);
		}
		return $pages;
	}
	// search parent pages through X levels
	function getParents($ids, $depth, $include_exclude){
		$i = 0;
		$pages  = array();
		foreach ($ids as $id) {	
			$ancestors = get_post_ancestors( $id );
			if(!empty($ancestors)){
				$pages = $ancestors;
			}
		}
		$pages = ($depth == 1) ? array($pages[0]) : array_slice($pages, 0, $depth);
		if($include_exclude == 'include'){
			$pages = array_merge($pages, $ids); 
		}
		return $pages;
	}

} // END of Widget class

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//~ some extra functions

// add WP featured image support
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' ); 
}
global $wp_scripts;

add_action('admin_print_styles-widgets.php', 'f2046_Easy_insert_custom_css');
function f2046_Easy_insert_custom_css(){
	wp_register_style('easy_2046', plugins_url( 'css/easy_2046.css' , __FILE__ ),false,0.1,'all');
	wp_enqueue_style( 'easy_2046');
	
	wp_register_script('easy_2046_widget',plugins_url( 'js/2046_easy_widget.js' , __FILE__ ));
	wp_enqueue_script('easy_2046_widget', array('jquery'),null, null, true);
	
}

//  cleaning filter - only numbers
function filter_number($string){
	$output = '';
	$output = preg_replace("/[^0-9]/", "", $string );
	return $output;
}

//  cleaning filter - / numbers, spaces, dashes
function filter_number_space_dash($string){
	$output = '';
	$output = preg_replace("/[^0-9\s,]/", "", $string );
	return $output;
}

//  cleaning filter - // letters
function filter_letter($string){
	$output = '';
	$output = preg_replace("/[^A-Za-z]/", "", $string );
	return $output;
}

//  cleaning filter - // letters, space, dash
function filter_letter_space_dash($string){
	$output = '';
	$output = preg_replace("/[^A-Za-z\s,]/", "", $string );
	return $output;
}

//  cleaning filter - // letters, numbers, dash, underscore, space
function filter_attribute_characters($string){
	$output = '';
	$output = preg_replace("/[^A-Za-z0-9\s-\_]/", "", $string );
	return $output;
}

//  cleaning filter - / alphabet numbers, spaces, dashes, comma
function filter_save_characters($string){
	$output = '';
	$output = preg_replace("/[^A-Za-z0-9\s-\_,]/", "", $string );
	return $output;
}

function mydump($a){
	echo '<pre>';
		var_dump($a);
	echo '</pre>';
};

// 
// WRITE PLUGIN OPTIONS IN TO DB
// 
// get registred image sizes 
// write them in to the DB
// so that WP can use them sooner or later
// --why -- Wordpress has no trace of what image sizes are registered. instead it register them on the way .. which not much handy for us
// we need the values before the WP is on the way, we have to get it from somewhere .. this time from DB
add_action('init', 'easy_widget_DB_options', 99);

function easy_widget_DB_options() {
	// define the table prefix
	$easy_widget_DB_options = 'easy_2046_';
	// get extra image sizes if any
	$e_images = get_intermediate_image_sizes();
	// check the image sizes and make the value
	if(!empty($e_images)){
		foreach ($e_images as $key => $value) {
			$extra_image_sizes[$value] = $value;
		}
	}else{
		$extra_image_sizes = array();
	}
	// get the options from DB
	$easy_options = get_option($easy_widget_DB_options);
	// update only when the it the data are not there already
	if($easy_options['extra_image_sizes'] != $extra_image_sizes){
		// build the data
		$data = array(
			'extra_image_sizes' => $extra_image_sizes
			);
		// update the options
		update_option($easy_widget_DB_options, $data);
	}
}
// create our own get_dynamic_sidebar function, which is not in the WP core
if (!function_exists('get_dynamic_sidebar')) {
	function get_dynamic_sidebar($index) 
	{
		$sidebar_contents = "";
		ob_start();
		dynamic_sidebar($index);
		$sidebar_contents = ob_get_clean();
		return $sidebar_contents;
	}
}
function list_of_image_sizes(){
	$image_size_from_DB_options = get_option('easy_2046_');
	// get the extra image sizes form our options
	$intermediate_image_sizes_raw = get_intermediate_image_sizes();
	foreach ($intermediate_image_sizes_raw as $key => $value) {
			$intermediate_image_sizes[$value] = $value;
		}
	if(isset($image_size_from_DB_options['extra_image_sizes'])){
		$intermediate_image_sizes = $intermediate_image_sizes + $image_size_from_DB_options['extra_image_sizes'];
	} 
	$full_image_width = array('full' => 'full');
	$list_of_image_sizes = array_merge($intermediate_image_sizes,$full_image_width );
	return $list_of_image_sizes;
}