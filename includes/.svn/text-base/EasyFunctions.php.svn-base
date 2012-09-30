<?php

//~ returns two scafolding classes
function EasyView_b2046_scafolding($value, $custom_class){ // custom_class will come with when will work the multi input
	$out = array('','');
	if(isset($value)){
		 if ($value == '1'){
			 //~ Hard definied just for now
			 $out[0] = 'row';
			 $out[1] = 'span12';
		}elseif($value == '2'){
			$out[0] = '';
			$out[1] = 'row';
		}
	}else{
			$out[0] = '';
			$out[1] = '';
	}
	return $out;
}


//~ 
//~ 
//~ ONTROL FUNCTIONS - creates front end content
//~ EasyControl_*
//~

 //~ change number of posts to be seen 
function EasyControl_b2046_post_number($tmp_query, $values){
	$output = array();
	//~ mydump($values);
		$args = array(
			'posts_per_page' => $values
		);
		//~ rewrite the default data with our own
		$output = $args;
	return $output;
}

//~ offset posts
function EasyControl_b2046_post_offset($tmp_query, $values){
	$output = array();
		$args = array(
			'offset' => $values
		);
		//~ rewrite the default data with our own
		$output = $args;
	return $output;
}

function EasyControl_b2046_taxonomy_parameters($tmp_query, $values){
	$output = array();
	//~ mydump($values);

	if(isset($values[3]) && isset($values[2])){
		$taxonomy = Easy_2046_builder::f2046_id_cleaner_to_array($values[3]);
		$the_only_taxonomy = $taxonomy[0];
		$terms = Easy_2046_builder::f2046_id_cleaner_to_array($values[0]);
		$args =  array(
			'tax_query' => array(
				'relation' => $values[1], 
				 array(
					'taxonomy' => $the_only_taxonomy,
					'field' => 'id',
					'terms' => $terms,
					'operator' => $values[2]
				)
			)
		);
		$output = array_merge( $output, $args);
		return $output;
	}
}

//~ Change post type
function EasyControl_b2046_post_type($tmp_query, $values){
	$output = array();
	global $post;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	//~ post type

	$args = array(
		'post_type' => $values[1]
	);
	$output = array_merge( $output, $args);

	if($values[0] == 1){
		$paged = array(
			'paged' => $paged
		);
		$output = array_merge( $args , $paged);
	}
	
	return $output;
}
//~  post status
function EasyControl_b2046_post_status($tmp_query, $values){
	$output = array();
		$args = array(
			'post_status' => $values
		);
		//~ rewrite the default data with our own
		$output =  $args;
	return $output;
}
//~ category control
function EasyControl_b2046_category_controls($tmp_query, $values){
	$output = array();
	$control = $values[0];
	$cats = $values[1];
	if($control == 'cat'){
		$putre_cat_ids = Easy_2046_builder::f2046_id_cleaner_to_string($cats);
	}else{
		$putre_cat_ids = Easy_2046_builder::f2046_id_cleaner_to_array($cats);
	}
	$args = array(
		$control => $putre_cat_ids
	);
	//~ rewrite the default data with our own
	$output =  $args;
	return $output;
}

//~ 
//~ Control order
//~ 
function EasyControl_b2046_order($tmp_query, $values){
	$order = $values[0];
	$order_by = $values[1];
	$args = array(
		'order' => $order,
		'order_by' => $order_by
	);
	return $args;
}


//~ 
//~ 
//~ VIEW FUNCTIONS - creates front end content
//~ EasyView_*
//~ 

//~ This extension si to build the title of the desired object
function EasyView_b2046_post_title($post_id, $values){
	$link = $values[0];
	$scafold = $values[1];
	$class = $values[2]; 
	$out = '';

	if($scafold != '0'){
		$out .= '<'.$scafold.' class="'.$class.'">';
	}
	
	if($link == 0){
		$out .= get_the_title($post_id);
	}else{
		$out .= '<a href="'.get_permalink($post_id).'">'.get_the_title($post_id).'</a>';
	}
	
	if($scafold !='0'){
		$out .= '</'.$scafold.'>';
	}
			
	return $out;
}

//~ This extension si to build contet or excerpt,...
function EasyView_b2046_post_content($post_id, $values){
	$content_type = $values[0];
	$class = $values[1];
	$morestring = '<!--more-->';
	
	$out = '<div class="entry-content '.$class.'">';
	if($content_type == 'content'){
			$out .= apply_filters('the_content',get_the_content());
	}
	elseif($content_type == 'excerpt'){
			$out .= get_the_excerpt();
	}
	elseif($content_type == 'above'){
		global $post;
		$explodemore = explode($morestring, $post->post_content);
		$out .= $explodemore[0];
	}
	elseif($content_type == 'below'){
		global $post;
		$explodemore = explode($morestring, $post->post_content);
		$out .= $explodemore[1];
	}
	$out .= '</div>';
	return $out;
}
//~ List post categories
function EasyView_b2046_post_taxonomies($post_id, $values){
	$out = '';
	if(!empty($values[1])){
		$user_given_taxonomy = Easy_2046_builder::f2046_id_cleaner_to_array($values[1]);
		$taxonomy = $user_given_taxonomy[0];
		$cat_count = $values[2];
		if(!empty($values[3])){
			$class = $values[3];
		}else{
			$class = '';
		}
		//~ Easy_2046_builder::f2046_id_cleaner_to_array($values[1]);
		//~ $post_categories = wp_get_post_categories( $post_id );
		$terms = wp_get_post_terms( $post_id, $taxonomy, array("fields" => "all") );
		//~  if the user want to see the result as links
		if($values[0] == 0){
			if(!empty($class)){
				$out .='<div class="'.$class.'">';
			}
			foreach($terms as $c){
				$tax = get_term( $c, $taxonomy );//get_category( $c );
				if($cat_count == 1){
					$count = ' ('.$tax->count.')';
				}else{
					$count= '';
				}
				$tax_link = get_term_link( $c, $taxonomy );//get_category_link($c);
				$out .= '<a href="'.$tax_link.'">'.$tax->name.'</a>'.$count;
				if (end($terms) != $c){
					$out .= ', ';
					}
			}
			if(!empty($class)){
				$out .='</div>';
			}
		}
		//~  if the user want to see the result as list
		else{
			$out .= '<ul class="'.$class.'">';
			foreach($terms as $c){
				$tax = get_term( $c, $taxonomy );
				if($cat_count == 1){
					$count = ' ('.$tax->count.')';
				}else{
					$count= '';
				}
				
				$tax_link = get_term_link( $c, $taxonomy );
				$out .= '<li class="'.$tax->slug.'"><a href="'.$tax_link.'">'.$tax->name.'</a>'.$count.'</li>';
			}
			$out .='</ul>';
		}
	}
	return $out;
}

//~ edit link
function EasyView_b2046_edit_link($post_id, $values){
	$value = $values[0];
	$class = $values[1];
	$out = '';
		$link =  get_edit_post_link($post_id);
		if($value == 0){
			$out = '<a class="edit_link '.$class.'" href="'.$link.'">'.__('Edit').'</a>';
		}else{
			$out = '<span class="edit_link '.$class.'"><a href="'.$link.'">'.__('Edit').'</a> '.$post_id.'</span>';
		}
	return $out;
}

//~ get images
//~ 
function EasyView_b2046_post_image($post_id, $values){
	$image = $values[0];
	$link = $values[1];
	$class = $values[2];
	$out = '';
	$att_id =get_post_thumbnail_id($post_id);
	
	if($link == 'objectlink'){
		$url = get_permalink($post_id);
	}elseif($link != 'objectlink' || $link != 'nolink'){
		$img_obj = wp_get_attachment_image_src( $att_id, $link);
		$url = $img_obj[0];
	}
	
	if(!empty($att_id)){
		$image_url = wp_get_attachment_image_src( $att_id, $image);
		if(!empty($class)){
			$out .= '<div class="'.$class.'">';
		}
		if($link != 'nolink'){
			$out .= '<a href="'.$url.'">';
		}
		
		$out .= '<img src="'.$image_url[0].'" alt="'.get_the_title($post_id).'" />';
		
		if($link != 'nolink'){
			$out .= '</a>';
		}
		if(!empty($class)){
			$out .= '</div>';
		}
	}
	return $out;
}

//~ 
//~ custom meta data
//~ 
function EasyView_b2046_object_meta($post_id, $values){
	$out = '';
	$show_as = $values[0];
	$meta_key = $values[1];
	//~ $meta_val = $values[2];
	$separator = $values[2];
	$class = $values[3];
	//~ $post_meta_keys = get_post_custom_keys($post_id);
	$post_meta_values = get_post_custom_values($meta_key, $post_id);

	if(!empty($post_meta_values)){
		//~ show as raw text
		if($show_as == 0){
			$out .= '<div class="'.$class.'">';
			foreach ( $post_meta_values as $key) {
				$out .= $key; 
				$out .= $separator;
			}
			$out .= '</div>';
		}
		//~ show as link to archives
		else{
			$out .='<ul class="'.$class.'">';
			foreach ($post_meta_values as $key) {
				$out .= '<li class="'.$meta_key.'">'.$key.'</li>'; 
				$out .= $separator;
			}
			$out .= '</ul>';
		}
		
	}
	
	return $out;
}

//~ 
//~ Simple text
//~ 
function EasyView_b2046_textfield($post_id, $values){
	$value = $values[0];
	$class = $values[1];
	$out = '';
		if(!empty($value) && !empty($class)){
			$out .= '<div class="'.$class.'">'.$value.'</div>';
		}elseif(!empty($value)){
			$out .= $value;
		}
	return $out;
}

//~ 
//~ Debug
//~ 
function EasyControl_b2046_query_debug($tmp_query, $values){
	echo '<pre><b>DEBUG:</b><br />';
	var_dump( $tmp_query);
	echo '</pre>';
	$out = array();
	return $out;
}

//~ 
//~ link to archive
//~ 
function EasyView_b2046_link_to_archive($tmp_query, $values){
	$out = '';
	$type = $values[0];
	$base_name = $values[1];
	$sec_name = $values[2];
	$text = $values[3];
	$class = $values[4];
	if($type == 'taxonomy' && !empty($base_name) && !empty($sec_name)){
		$out .= '<div class="'.$class.'"><a href="'.get_term_link( $base_name, $sec_name ).'">'.$text.'</a></div>';
	}elseif($type =='post_type'){
		$out .= '<div class="'.$class.'"><a href="'.get_post_type_archive_link($base_name).'">'.$text.'</a></div>';
	}
	
	return $out;
}

//~ 
//~ Shortcode 
//~ 

function EasyView_b2046_shortcode($post_id, $values){
	$value = $values[0];
	$class = $values[1];
	$out = '';
		if(!empty($value) && !empty($class)){
			$out .= '<div class="'.$class.'">'.do_shortcode($value).'</div>';
		}elseif(!empty($value)){
			$out .= do_shortcode($value);
		}
	return $out;
}

//~ 
//~ Comments number
//~ 

function EasyView_b2046_comments_number($post_id, $values){
	$class = $values[0];
	$out = '';
		if(!empty($value) && !empty($class)){
			$out .= '<div class="'.$class.'">'.get_comments_number($post_id).'</div>';
		}elseif(!empty($value)){
			$out .= get_comments_number($post_id);
		}
	return $out;
}

//~ 
//~ Comments number
//~ 

function EasyView_b2046_comments_template($post_id, $values){
	$class = $values[0];
	$out = '';
		if(!empty($class)){
			$out .= '<div class="'.$class.'">'.comments_template().'</div>';
		}else{
			$out .= comments_template();
			
		}
	return $out;
}
//~ 
//~ Permissions
//~ 

function EasyControl_b2046_show_post_by_id($post_id, $values){
	$out = array();
	if(!empty($values)){
		$out = array(
			'post__in' => Easy_2046_builder::f2046_id_cleaner_to_array($values)
		);
	}
	
	return $out;
}

//~ 
//~ Get date of the "post"
//~ 
function EasyView_b2046_date($post_id, $values){
	$out = '';
	$type = $values[0];
	//~ $link = $values[0];
	$date_format = $values[1];
	$class = $values[2];
	
	//~ show the published date
	if($type == 'published'){
		if(!empty($date_format)){
			$the_date = get_the_date($date_format);
		}else{
			$the_date = get_the_date('d. M. Y.');
		}
	}
	//~ show modified date
	else{
		if(!empty($date_format)){
			$the_date = get_the_modified_date($date_format);
		}else{
			$the_date = get_the_modified_date('d. M. Y.');
		}
	}
	$out .= '<div class="'.$class.'">';
		$out .= $the_date;
	$out .= '</div>';
	return $out;
	
}

//~ 
//~ Global permission resistor 
//~ 
function EasyResistor_b2046_general_visibility($tmp_query, $values){
	global $current_user;
	if (isset($current_user->roles[0])){
		$user_level =  $current_user->roles[0];
	}else{
		$user_level = '';
	}
	
	if($values == 'all' || empty($values) ){
		echo('true');
		return true;
		
	}elseif(!empty($user_level) && $user_level >= $values ){
		echo('true');
		return true;
	}else{
		echo('false');
		return false;
	}
}

//~ 
//~ Hide on view type
//~ 
function EasyResistor_b2046_on_condition($tmp_query, $values){
	global $wp_query;
	$output = true;
	//~  do not show on conditions
	if($values[0] == 0 && isset($values[1])){
		//~ $i = 1;
		//~ check if the values against the global query
		unset($values[0]);
		foreach($values as $val){
			if($wp_query->$val == 1){
				$output = false;
				//~ echo $output.' (' .$i.')<br>';
				break;
				
			}else{
				$output = true;
				//~ echo $output .' (' .$i.')<br>';
			}
			//~ $i++;
		}
	}
	//~ show on conditions
	elseif($values[0] == 1 && isset($values[1])){
		unset($values[0]);
		foreach($values as $val){
			if($wp_query->$val == 1){
				$output = true;
				//~ echo $output.' (' .$i.')<br>';
				
			}else{
				$output = false;
				//~ echo $output .' (' .$i.')<br>';
				break;
			}
			//~ $i++;
		}
	}
	return $output;
}

//~ 
//~ Show on post, page, what ever id
//~ 
function EasyResistor_b2046_on_p_ID($tmp_query, $values){
	if($values[0] == 1){
		$a = true; 
		$b = false;
	}else{
		$a = false; 
		$b = true;
	}

	if(!empty($values[1])){
		global $wp_query;
		$output = true;
		$pids = Easy_2046_builder::f2046_id_cleaner_to_array($values[1]);
		$object_id = '';
		if(isset($wp_query->query_vars['p'])){
			$object_id = $wp_query->query_vars['p'];
		}
		elseif(isset($wp_query->query_vars['page_id'])){
			$object_id = $wp_query->query_vars['page_id'];
		}
		
		foreach($pids as $pid){
			if($object_id == $pid || $object_id == $pid ){
				$output = $a;
			}else{
				$output = $b;
			}
		}
		
	}else{
		$output = true;
	}
	
	return $output;
}

