<?php

//~ returns two scafolding classes
function b2046_scafolding($value, $custom_class){ // custom_class will come with when will work the multi input
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
//~ *
//~

 //~ change number of posts to be seen 
function b2046_post_number($tmp_query, $values){
	$output = array();
	//~ mydump($values);
	$args = array(
		'posts_per_page' => (int)$values
		);
		//~ rewrite the default data with our own
	$output = $args;
	return $output;
}

//~ offset posts
function b2046_post_offset($tmp_query, $values){
	$output = array();
	$args = array(
		'offset' => $values
		);
		//~ rewrite the default data with our own
	$output = $args;
	return $output;
}

function b2046_taxonomy_parameters($tmp_query, $values){
	$output = array();
	//~ mydump($values);
	//~ 0 - taxonomy
	//~ 1 - terms
	//~ 2 - term operator
	//~ 3 - taxonomy relation
	if(!empty($values[0]) && !empty($values[1])){
		$taxonomy = Easy_2046_builder::f2046_id_cleaner_to_array($values[0]);
		$the_only_taxonomy = $taxonomy[0];
		$terms = Easy_2046_builder::f2046_id_cleaner_to_array($values[1]);
		$args =  array(
			'tax_query' => array(
				'relation' => $values[3], 
				array(
					'taxonomy' => $the_only_taxonomy,
					'field' => 'id',
					'terms' => $terms,
					'operator' => $values[2]
					)
				)
			);
		$output = array_merge( $output, $args);
	}
	return $output;
}
function b2046_based_on_actual_taxonomy($tmp_query, $values){
	$output = array();
	$taxonomy = !empty($values[0]) ? $values[0] : 'category';
	$operator = $values[1];
	$relation = $values[2];
	global $post;
	
	$term_list = wp_get_post_terms($post->ID, $taxonomy, array("fields" => "ids"));
	$args =  array(
		'tax_query' => array(
			'relation' => $relation, 
			array(
				'taxonomy' => $taxonomy,
				'field' => 'id',
				'terms' => $term_list,
				'operator' => $operator
				)
			)
		);

	$output = array_merge( $output, $args);
	return $output;
}

function b2046_meta($tmp_query, $values){
	$output = array();
	$args = array();
	$key = $values[0];
	$vals = $values[1];
	$type = $values[2];
	$compare = $values[3];
	$compare_choices = array(
		'0' => '=',
		'1' => '!=',
		'2' => '>',
		'3' =>  '>=',
		'4' =>  '<',
		'5' =>  '<=',
		'6' =>  'LIKE',
		'7' =>  'NOT LIKE',
		'8' =>  'IN',
		'9' =>  'NOT IN',
		'10' =>  'BETWEEN',
		'11' =>  'NOT BETWEEN',
		'12' =>  'EXISTS',
		'13' =>  'NOT EXISTS'
	);
	$relation = $values[4];
	// if the query has the meta call already, join the actual one to the existing one
	if (isset($tmp_query['meta_query'])){
		// revrite the realition to the actual one
		$tmp_query['meta_query']['relation'] = $relation;
		// define next meta query
		$args_tmp = array(
			'key' => $key,
          	'value' => $vals, //array(3, 4),
          	'type' => $type,
          	'compare' => $compare_choices[$compare]
		);
		// add thew new meta query to the existing
		array_push($tmp_query['meta_query'], $args_tmp);
		// create the args
		$args = array("meta_query" => $tmp_query['meta_query']);
	}else{
		$args = array(
	   // 'meta_key' => 'age',
		'meta_query' => array(
			'relation' => $relation,
			array(
				'key' => $key,
	          	'value' => $vals, //array(3, 4),
	          	'type' => $type,
	          	'compare' => $compare_choices[$compare],
	           )
			)
		);
	}
	// $output = $output + $args;
	$output = array_merge($output, $args);
	return $output;
}

function b2046_based_on_actual_meta($tmp_query, $values){
	$output = array();
	return $output;
}

//~ Change post type
function b2046_post_type($tmp_query, $values){
	$output = array();
	global $post;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	//~ post type

	$args = array(
		'post_type' => $values[0]
		);
	$output = array_merge( $output, $args);

	if($values[1] == 1){
		$paged = array(
			'paged' => $paged
			);
		$output = array_merge( $args , $paged);
	}
	
	return $output;
}
//~  post status
function b2046_post_status($tmp_query, $values){
	$output = array();
	$args = array(
		'post_status' => $values
		);
		//~ rewrite the default data with our own
	$output =  $args;
	return $output;
}
//~ category control
function b2046_category_controls($tmp_query, $values){
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
function b2046_order($tmp_query, $values){
	$order = $values[0];
	$order_by = $values[1];

	$args = array(
		'order' => $order,
		'orderby' => $order_by
		);
	return $args;
}


//~ 
//~ 
//~ VIEW FUNCTIONS - creates front end content
//~ *
//~ 

//~ This extension si to build the title of the desired object
function b2046_post_title($easy_query, $values){
	$link = $values[0];
	$scafold = $values[1];
	$class = $values[2]; 
	$out = '';

	if($scafold != '0'){
		$out .= '<'.$scafold.' class="'.$class.'">';
	}
	
	if($link == 0){
		$out .= get_the_title($easy_query->post->ID);
	}else{
		$out .= '<a href="'.get_permalink($easy_query->post->ID).'">'.get_the_title($easy_query->post->ID).'</a>';
	}
	
	if($scafold !='0'){
		$out .= '</'.$scafold.'>';
	}

	return $out;
}
function b2046_sidebar($easy_query, $values){
	$out = '';

	if(!empty($values[0])){
		$out = get_dynamic_sidebar($values[0]);
	}
	return $out;
}
function b2046_post_author($easy_query, $values){
	$linkType = $values[0];
	$linkVar = $values[1]; 
	$class = $values[2]; 
	$link_choices = array( 
		0 => 'ID',
		1 => 'user_login',
		2 => 'user_nicename',
		3 => 'user_email',
		4 => 'user_url',
		5 => 'display_name'
		);
	$out = '';
	$user = get_userdata($easy_query->post->post_author);

	$out .= '<div class="'.$class.' '.$easy_query->post->display_name.'">';

	// plain text
	if($linkType == 0){
		$out .= $user->$link_choices[$linkVar];
	}
	// link to authors post archive
	elseif($linkType == 1){
		$out .= '<a href="'.get_author_posts_url( $easy_query->post->post_author).'">'.$user->$link_choices[$linkVar].'</a>';
	}
	// link to authors url
	else{
		$out .= '<a href="'.$user->user_url.'">'.$user->$link_choices[$linkVar].'</a>';
	}
	
	$out .= '</div>';

	return $out;
}

//~ This extension si to build contet or excerpt,...
function b2046_post_content($easy_query, $values){
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
//~ VIEW - List post categories
function b2046_post_taxonomies($easy_query, $values){
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
		$terms = wp_get_post_terms( $easy_query->post->ID, $taxonomy, array("fields" => "all") );
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
function b2046_edit_link($easy_query, $values){
	$value = $values[0];
	$class = $values[1];
	$out = '';
	$link =  get_edit_post_link($easy_query->post->ID);
	if($value == 0){
		$out = '<a class="edit_link '.$class.'" href="'.$link.'">'.__('Edit').'</a>';
	}else{
		$out = '<span class="edit_link '.$class.'"><a href="'.$link.'">'.__('Edit').'</a> '.$easy_query->post->ID.'</span>';
	}
	return $out;
}

//~ get images
//~ 
function b2046_post_image($easy_query, $values){
	$image = $values[0];
	$link = $values[1];
	$class = $values[2];
	$out = '';

	$att_id =get_post_thumbnail_id($easy_query->post->ID);
	
	if($link == 'objectlink'){
		$url = get_permalink($easy_query->post->ID);
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
		
		$out .= '<img src="'.$image_url[0].'" alt="'.get_the_title($easy_query->post->ID).'" />';
		
		if($link != 'nolink'){
			$out .= '</a>';
		}
		if(!empty($class)){
			$out .= '</div>';
		}
	}
	return $out;
}

//~ gel n images form the post
function b2046_post_images($easy_query, $values){
	$image = $values[0];
	$link = $values[1];
	$order = $values[2];
	$orderby = $values[3];
	$title_value = $values[4];
	$featured_image_showhide = $values[5];
	$class = $values[6];
	$out = '';
	//~ get all posts based on the user query
	//~ get all its IDs and make arrayy late used as parent pages
	$the_query = new WP_Query($easy_query->query);

	$g_args =array(
		'post_parent' => $the_query->post->ID,
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => $order,
		'orderby' => $orderby
		);
	// if the do NOT want to include featured image in the gallery
	if($featured_image_showhide == 1){
		$g_args['post__not_in'] = array(get_post_thumbnail_id( $easy_query->post->ID ));
	}
	if($the_query->have_posts()){
		while ( $the_query->have_posts() ) : $the_query->the_post();
		$attachments = get_children($g_args);

			//~ process all found
		foreach($attachments as $key => $val) {
			if(!empty($val->ID)){
				$image_url = wp_get_attachment_image_src( $val->ID, $image);
				$img_obj = wp_get_attachment_image_src( $val->ID, $link);
				$url = $img_obj[0];

				if(!empty($class)){
					$out .= '<div class="'.$class.'">';
				}
				if($link != 'nolink'){
					$out .= '<a href="'.$url.'">';
				}
				$the_title = '';
				if ($title_value == 1){
					$the_title = $val->post_title;
				}elseif($title_value == 2){
					$the_title = $val->post_excerpt;
				}
				$out .= '<img src="'.$image_url[0].'" title="'.$the_title.'" alt="'.$val->post_title.'" />';
				if($link != 'nolink'){
					$out .= '</a>';
				}
				if(!empty($class)){
					$out .= '</div>';
				}
			}
		}
		endwhile;
	}
	// Reset Post Data
	wp_reset_postdata();
	
	return $out;
}
//~ 
//~ CONTROL - finds the actual post id and ad it to the query
//~ 
function b2046_for_actual_postid($tmp_query, $values){
	global $post;
	
	$args = array(
		'post__in' => array($post->ID),
		'post_type' => $post->post_type
		);
	return $args;
}

//~ 
//~ VIEW - custom meta data
//~ 
function b2046_object_meta($easy_query, $values){
	$out = '';
	$show_as = $values[0];
	$meta_key = $values[1];
	$separator = $values[2];
	$class = $values[3];
	$post_meta_values = get_post_custom_values($meta_key, $easy_query->post->ID);

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
function b2046_textfield($easy_query, $values){
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
function b2046_query_debug($tmp_query, $values){
	echo '<pre><b>DEBUG:</b><br />';
	var_dump( $tmp_query);
	echo '</pre>';
	$out = array();
	return $out;
}

//~ 
//~ link to archive
//~ 
function b2046_link_to_archive($tmp_query, $values){
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

function b2046_shortcode($easy_query, $values){
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

function b2046_comments_number($easy_query, $values){
	$class = $values[0];
	$out = '';
	if(!empty($value) && !empty($class)){
		$out .= '<div class="'.$class.'">'.get_comments_number($easy_query->post->ID).'</div>';
	}elseif(!empty($value)){
		$out .= get_comments_number($easy_query->post->ID);
	}
	return $out;
}

//~ 
//~ Comments number
//~ 

function b2046_comments_template($easy_query, $values){
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

function b2046_show_post_by_id($easy_query, $values){
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
function b2046_date($easy_query, $values){
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
function b2046_general_visibility($tmp_query, $values){
	global $current_user;
	if (isset($current_user->roles[0])){
		$user_level =  $current_user->roles[0];
	}else{
		$user_level = '';
	}
	
	if($values == 'all' || empty($values) ){
		return true;
		
	}elseif(!empty($user_level) && $user_level >= $values ){
		return true;
	}else{
		return false;
	}
}

//~ 
//~ Hide on view type
//~ 
function b2046_on_condition($tmp_query, $values){
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
function b2046_on_p_ID($tmp_query, $values){
	if($values[0] == 1){
		$a = true; 
		$b = false;
	}else{
		$a = false; 
		$b = true;
	}
	// if the post id is defined
	if(!empty($values[1])){
		global $post;
		$output = true;
		$pids = Easy_2046_builder::f2046_id_cleaner_to_array($values[1]);
		$object_id = $post->ID;
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

//~ 
//~ restrict based on hierarchy
//~ 

function b2046_hierarchy_based($tmp_query, $values){
	//~ '0' => 'Pages from the same level as current page',
	//~ '1' => 'Pages from the same level as given ID',
	//~ '2' => 'Child pages of current page',
	//~ '3' => 'Child pages of given ID'
	$output = array();
	$args = array();
	$choice = $values[0];
	$page_ids = Easy_2046_builder::f2046_id_cleaner_to_array($values[1]);
	if(!empty($values[2])){
		$xclude = $values[2];
	}else{
		$xclude = '';
	}
	$args_parent = array();
	global $post;
	
	
	//~ '0' => 'Pages from the same level as current page',
	if($choice == 0){
		if (!empty($post->post_parent)){
			$output['post_parent'] = $post->post_parent;
			if($xclude == '1'){
				$output['post__not_in'] = array($post->ID); 
			}
		}else{
			//~  if there are no parent, we are in the top level and so will return only top level pages with zero parent
			$output['post_parent'] = '0';
			if($xclude == '1'){
				$output['post__not_in'] = array($post->ID);
			}
		}
		//~ force the post type to be the same as the current page, or the given page ID
		$output['post_type'] = $post->post_type;
	//~ '2' => 'Child pages of current page',
	}elseif($choice == 2){
		$output['post_parent'] = $post->ID;
		$output['post_type'] = $post->post_type;
	}
	//~ '1' => 'Pages from the same level as given ID',
	elseif($choice == 1){
		if (!empty(get_post($page_ids[0])->post_parent)){
			$output['post_parent'] = get_post($page_ids[0])->post_parent;
		}else{
			$output['post_parent'] = '0';
		}
		$output['post_type'] = get_post_type($page_ids[0]);
		if($xclude == 1){
			$output['post__not_in'] = array($page_ids[0]); 
		}
	}
	//~ '3' => 'Child pages of given ID'
	elseif($choice == 3){
		$output['post_parent'] = $page_ids[0];
		$output['post_type'] = get_post_type($page_ids[0]);
	}

	return $output;
}

//~ 
//~ navigation - View
//~ 
function b2046_WP_pagenavi($easy_query, $values){
	ob_start();
	wp_pagenavi( array( 'query' => $easy_query ) );
	$output = ob_get_clean();
	wp_reset_postdata();	// avoid errors further down the page
	return $output;
}

// Previous post on current Easy loop
function b2046_previous_posts_link($easy_query, $values){
	
	$output = '';
	$previous_post_obj = get_previous_post();

	// if previous post exists
	if(isset($previous_post_obj->ID)){
		$text = $values[0];
		$class = $values[1];
		if(!empty($class)){
			$output .= '<div class="'.$class.'">';
		}
			//  check if they do not want to use their own string
		if(!empty($text)){$text_string = $text;}else{$text_string = $previous_post_obj->post_title;}
		$output .= '<a href="'.get_permalink( $previous_post_obj->ID ).'">'.$text_string.'</a>';
		
		if(!empty($class)){
			$output .= '</div>';
		}
	}
	return $output;
}
// Next post on current Easy loop
function b2046_next_posts_link($easy_query, $values){
	$output = '';
	$next_post_obj = get_next_post();
	// if the next page exist
	if(isset($next_post_obj->ID)){
		$text = $values[0];
		$class = $values[1];
		if(!empty($class)){
			$output .= '<div class="'.$class.'">';
		}
			//  check if they do not want to use their own string
		if(!empty($text)){$text_string = $text;}else{$text_string = $next_post_obj->post_title;}
		$output .= '<a href="'.get_permalink( $next_post_obj->ID ).'">'.$text_string.'</a>';
		if(!empty($class)){
			$output .= '</div>';
		}
	}
	return $output;
}

// Next post on current Easy loop
function b2046_posts_nav_link($easy_query, $values){
	$output = '';
	$separator = (empty($values[0])) ? '&#8212;' : $values[0];
	$prevlabel = (empty($values[1])) ? __('&laquo; Previous Page') : $values[1];
	$nextlabel = (empty($values[2])) ? __('Next Page &raquo;') : $values[2];
	$class =     (empty($values[3])) ? 'post_nav_link'          : $values[3];
	
	$output = '<div class="'.$class.'">'.get_previous_posts_link($prevlabel) . $separator . get_next_posts_link($nextlabel).'</div>';

	return $output;
}

//~ 
//~ CONTROL - finds the actual post id and ad it to the query
//~ 
function b2046_exclude_actual($tmp_query, $values){	
	// get the global post object
	global $post;
	// check if the post__not_in is not emapty, if not then combine what we got already with the actual post
	if(!empty($tmp_query['post__not_in'])){
		$id_array = array_push($tmp_query['post__not_in'], $post->ID);
	}
	// 
	else{
		$id_array = array($post->ID);
	}

	$args = array(
		'post__not_in' => $id_array
		);
	return $args;
}



