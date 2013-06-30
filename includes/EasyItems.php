<?php 

// item is build out off
// 'id' => (array('actual values'), array('possible values'))

// ------------------------------------------------------------------- // 
//                   declare some variations first
// ------------------------------------------------------------------- // 


// 
// UI choices
// @input
// @check_box
// @select_box - 
// @radio_group -
// @textarea - textarea
// @hidden - hidden value
// @plain - just a raw text , good for notes
// 
// specify the roles
$levels = array( 
	'all' => __('Anyone') ,
	'subscriber' => __('Subcriber'),
	'contributor' => __('Contributor'),
	'author' => __('Author'),
	'editor' => __('Editor'),
	'administrator' => __('Administrator')
	);

// get all public post types
$args_types=array(
	'public'	=> true, // publicaly visible
	//'_builtin' => false, // only not built in
	//'capability_type' => 'post' // and only types of post
); 

// object title choices
$object_title_choices =array(
	'0' => __('no link'),
	'1' => __('Link to "post"'),
	'2' => __('Link to "custom meta"')
);
// Object title extrension choices
$object_title_extension_choices = array(
	'0' => 'raw text',
	'h1' => 'h1',
	'h2' => 'h2',
	'h3' => 'h3',
	'h4' => 'h4',
	'h5' => 'h5',
	'div' => 'div'
);
// Specify scafolding type tpes
$scafolding_types =array(
	'0' => __('Default scaffolding'),
	'1' => __('One per row'),
	'2' => __('Many per row')
	); // default, one per row, many per row
	
$content_choices = array(
	'content'=>'content',
	'excerpt'=>'excerpt',
	'above' => 'above more tag',
	'below' => 'below more tag',
);

//~ 
//~ show categories as
//~
$show_post_categories = array(
	'0' => 'links',
	'1' => 'list'
);

//~ 
//~ get images
//~ 
$list_of_image_sizes = list_of_image_sizes();

$image_links = array(
	'nolink' => 'no link',
	'objectlink' => 'object link',
	'customlink' => 'custom meta value'
);
$image_links = array_merge($image_links, $list_of_image_sizes);

//~ 
//~ Meta show choices
//~ 
$meta_show_choices = array(
	'0' => 'text',
	'1' => 'list',
);
$post_statuses = array(
	'publish' => 'publish', //a published post or page.
	'pending' => 'pending', //post is pending review.
	'draft' => 'draft', //a post in draft status.
	'auto-draft' => 'auto-draft', //- a newly created post, with no content.
	'future' => 'future', //- a post to publish in the future.
	'private' =>'private', //- not visible to users who are not logged in.
	'inherit' => 'inherit', //- a revision. see get_children.
	'trash' => 'trash', //- post is in trashbin (available with Version 2.9).
	'any' => 'any'
);
//~ categoris control
$category_controls = array(
	'cat' => 'cat', //(int) - use category id.
	//~ 'category_name' => 'category_name', //(string) - use category slug (NOT name).
	'category__and' => 'category__and', //(array) - use category id.
	'category__in' => 'category__in', //(array) - use category id.
	'category__not_in' => 'category__not_in', // (array) - use category id.
);
$conditional_tags_array = array(
	array(
		'ui_type' => 'radio_group', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
		'choices' => array(
			'1' => 'show when',
			'0' => 'hide when'
		),	
		'value' => '1',
		'esc' => 'filter_number'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_home' => 'home'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_front_page' => 'front page'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_single' => 'single'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_page' => 'page'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_sticky' => 'sticky'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_category' => 'category'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_tax' => 'taxonomy archive'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_archive' => 'archive'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_search' => 'search result'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_404' => '404 error'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_attachment' => 'attachment page'),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	)
);
//~ sorting choices
$sorting_choices = array(
	'Sort by' => 'Sort by',
	'ID' => 'ID',  
	'title' => 'title', 
	'date' => 'date',
	'modified' => 'modified',
	'rand' => 'rand',
	'comment_count' => 'comment_count',
	'menu_order' => 'menu_order',
	'parent' => 'parent',
	'meta_value' => 'meta_value',
	'meta_value_num' => 'meta_value_num'
);

// ------------------------------------------------------------------- // 
//                         Build the VIEW array
// ------------------------------------------------------------------- // 
$EasyItems = array(
	// category controls
	'b2046_category_controls' => array(
		'block' => 'control',  
		'repeatable' => true,
		'item_title' => __('Category','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Control by','p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => $category_controls,
				'value' => 'cat',
				'esc' => 'filter_save_characters'
			),
			array(
				'ui_note' => __('cat IDs (separate by coma)', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'filter_number_space_dash'
			)
		)
	),
	
	// widget title
	'b2046_title' => array(
		'position' => 15,
		'block' => 'general',  
		'item_title' => __('Widget admin title','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Admin widget title', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'esc_attr'
			)
		),
		'w_title' => '',  // this extra parametr tells the input builder to put in the element additional id
	),
	// scaffolding
	'b2046_scafold_type' => array(
		'position' =>10,
		'block' => 'general',  
		'item_title' => __('Surrounding widget scafold type','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Select type','p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => $scafolding_types,
				'value' => $scafolding_types[0],
				'esc' => 'filter_number'
			)
		)
	),
	'b2046_widget_title' => array(
		'position' => 5,
		'block' => 'general',  
		'item_title' => __('Widget frontend title','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Rendered before the loop', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'esc_attr'
			)
		)
	),
	// scaffolding
	'b2046_scafold_row_class' => array(
		'position' => 25,
		'block' => 'general',  
		'item_title' => __('','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('row class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'filter_attribute_characters'
			)
		)
	),
	// widget note
	'b2046_note' => array(
		'position' => 35,
		'block' => 'general',  
		'item_title' => __('Widget description','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Widget intention. Used for administrative purposes.', 'p_2046s_easy_widget'),
				'ui_type' => 'textarea', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'esc_attr'
			)
		)
	),
	// scaffolding
	'b2046_scafolding_column_class' => array(
		'position' => 30,
		'block' => 'general',  
		'item_title' => __('','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('each (column) class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'filter_attribute_characters'
			)
		)
	),
	// who can see the vidget on the front end
	//~ 
	'b2046_general_visibility' => array( 
		// general
		'block' => 'resistor',  
		'repeatable' => false,
		'item_title' => __('Permissions','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Who will be able to see the widget result.','p_2046s_easy_widget'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea. 6 hidden
				'choices' => $levels,
				'value' => '',
				'esc' => 'filter_attribute_characters'
			)
		),
	),
	'b2046_on_condition' => array( 
		// general
		'block' => 'resistor',  
		'repeatable' => false,
		'item_title' => __('On template types: show / hide','p_2046s_easy_widget'),
		// gui
		'gui' => $conditional_tags_array
	),
	'b2046_on_p_ID' => array( 
		// general
		'block' => 'resistor',  
		'repeatable' => true,
		'item_title' => __('On ID: show / hide','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'radio_group', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => array(
					'1' => 'show when',
					'0' => 'hide when'
				),	
				'value' => '1',
				'esc' => 'filter_number'
			),
			array(
				'ui_note' => __('IDs. Separed by comma','p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'choices' => '',
				'value' => '',
				'esc' => 'filter_number_space_dash'
			)
		)
	),
	// post_types
	'b2046_post_type' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Post type','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => 'post, page, attachment,..',
				'ui_type' => 'input', 
				'esc' => 'filter_save_characters',
				'choices' => '',
				'value' => 'post'
			),
			//~ array(
				//~ 'ui_type' => 'radio_group', 
				//~ 'esc' => 'esc_attr',
				//~ 'choices' => array(
					//~ '1' => 'ON paging',
					//~ '0' => 'OFF paging'
				//~ ),
				//~ 'value' => '1'
			//~ ),
			array(
				'ui_type' => 'radio_group', 
				'esc' => 'filter_number',
				'choices' => array(
					'1' => 'affected by page number',
					'0' => 'not affected'
				),
				'value' => '1'
			)
		)
	),
	// post_types
	'b2046_show_post_by_id' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Show only (by ID)','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('post / page / custom IDs (separate by coma)', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			)
		)
	),
	// post_types
	'b2046_exclude_actual' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Exclude actual post/page','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Exclude currently displayed post/page from this Easy loop', 'p_2046s_easy_widget'),
				'ui_type' => 'hidden', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_taxonomy_parameters' => array(
		'block' => 'control',  
		'repeatable' => true,
		'item_title' => __('Taxonomy','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => 'only one taxonomy (name)',
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => 'terms IDs, separated by comma',
				'ui_type' => 'input', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			),
			//~ operator for each term / //~ 'IN', 'NOT IN', 'AND'
			array(
				'ui_note' => 'terms operator',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND (operator)',
					'IN' => 'IN',
					'NOT IN' => 'NOT IN'
				),
				'value' => 'IN'
			),
			//~ relation between multiple taxonomies
			array(
				'ui_note' => 'Taxonomy relation. If you use multiple taxonomy bricks, the later relation beats previous ones.',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND (relation)',
					'OR' => 'OR'
				),
				'value' => 'OR'
			)
		)
	),'b2046_based_on_actual_taxonomy' => array(
		'block' => 'control',  
		'repeatable' => true,
		'item_title' => __('Taxonomy match','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => 'only one taxonomy (name)',
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => 'terms operator',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND (operator)',
					'IN' => 'IN',
					'NOT IN' => 'NOT IN'
				),
				'value' => 'IN'
			),
			//~ relation between multiple taxonomies
			array(
				'ui_note' => 'Taxonomy relation. If you use multiple taxonomy bricks, the later relation beats previous ones.',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND (relation)',
					'OR' => 'OR'
				),
				'value' => 'OR'
			)
		)
	),
	'b2046_on_taxonomy' => array(
		'block' => 'resistor',  
		'repeatable' => true,
		'item_title' => __('On Taxonomy (Category)','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => 'only one taxonomy (name)',
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => 'terms IDs, separated by comma',
				'ui_type' => 'input', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => '',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'show' => 'show',
					'hide' => 'hide',
				),
				'value' => 'show'
			)
		)
	),
	'b2046_on_hierarchy' => array(
		'block' => 'resistor',  
		'repeatable' => true,
		'item_title' => __('Show/hide based on hierarchy','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => 'show or hide',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'show' => 'show',
					'hide' => 'hide',
				),
				'value' => 'show'
			),
			array(
				'ui_note' => 'Show on',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
						'child' => 'On child pages of defined IDs',
						'parent' => 'On parent page of defined IDs',
					),
				'value' => 'child'
			),
			array(
				'ui_note' => 'Page IDs, separated by comma',
				'ui_type' => 'input', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => 'Depth (default 1 level)',
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => 'including/excluding given IDs',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'exclude' => 'omit',
					'include' => 'include',
				),
				'value' => 'exclude'
			)
		)
	),
	'b2046_meta' => array(
		'block' => 'control',  
		'repeatable' => true,
		'item_title' => __('Meta','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => 'Meta key',
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => 'Meta value',
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => 'Comparison type',
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'NUMERIC' => 'NUMERIC',
					'BINARY' => 'BINARY',
					'CHAR' => 'CHAR',
					'DATE' => 'DATE',
					'DATETIME' => 'DATETIME',
					'DECIMAL' => 'DECIMAL',
					'SIGNED' => 'SIGNED',
					'TIME' => 'TIME',
					'UNSIGNED' => 'UNSIGNED'
				),
				'value' => 'CHAR'
			),
			array(
				'ui_note' => 'Comparison operator',
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
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
				),
				'value' => '0'
			),
			array(
				'ui_note' => 'Relation',
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND',
					'OR' => 'OR'
				),
				'value' => 'OR'
			)
		)
	),
	/*'b2046_based_on_actual_meta' => array(
		'block' => 'control',  
		'repeatable' => true,
		'item_title' => __('Meta match','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => 'Meta key',
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => 'Meta value',
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => 'terms operator',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND (operator)',
					'IN' => 'IN',
					'NOT IN' => 'NOT IN'
				),
				'value' => 'IN'
			),
			//~ relation between multiple taxonomies
			array(
				'ui_note' => 'Taxonomy relation. If you use multiple taxonomy bricks, the later relation beats previous ones.',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND (relation)',
					'OR' => 'OR'
				),
				'value' => 'OR'
			)
		)
	),*/
	'b2046_link_to_archive' => array(
		'block' => 'view',  
		'repeatable' => true,
		'item_title' => __('Link to archive','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'taxonomy' => 'taxonomy',
					'post_type' => 'post_type',
				),
				'value' => 'taxonomy'
			),
			array(
				'ui_note' => 'Taxonomy or Post type name',
				'ui_type' => 'input', 
				'esc' => 'filter_save_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => 'term ID (in case of Taxonomy)',
				'ui_type' => 'input', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => 'Link text',
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => 'Link to archive ..'
			),
			array(
				'ui_note' => __('custom class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_save_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	
	'b2046_post_title' => array(
		'block' => 'view',  
		'item_title' => __('Title','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_save_characters',
				'choices' => $object_title_choices,
				'value' => $object_title_choices[0]
			),
			array(
				'ui_note' => __('Scafolding', 'p_2046s_easy_widget'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_save_characters',
				'choices' => $object_title_extension_choices,
				'value' => $object_title_extension_choices['h1']
			),
			array(
				'ui_note' => __('Link taget','p_2046s_easy_widget'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
						'parent' => 'same window',
						'blank' => 'new window', 
					),
				'value' => ''
			),
			array(
				'ui_note' => __('custom meta value', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('custom class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_content' => array(
		'block' => 'view',  
		'item_title' => __('Content','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => $content_choices,
				'value' => $content_choices['content']
			),
			array(
				'ui_type' => 'input', 
				'ui_note' => __('Read more text', 'p_2046s_easy_widget'),
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_sidebar' => array(
		'block' => 'view',  
		'item_title' => __('Sidebar','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Sidebar ID', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_author' => array(
		'block' => 'view',  
		'item_title' => __('Author','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array( 
					0 => 'plain text',
					1 => 'link to authors posts',
					2 => 'link to authors url',
				),
				'value' => '0'
			),
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array( 
					0 => 'ID',
					1 => 'user_login',
					2 => 'user_nicename',
					3 => 'user_email',
					4 => 'user_url',
					5 => 'display_name'
				),
				'value' => '0'
			),
			array(
				'ui_note' => __('custom class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_number' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Number','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Number of objects.', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_number',
				'choices' => '',
				'value' => '1'
			)
		)
	),
	'b2046_post_offset' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Offset','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Number', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_number',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_status' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Status','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => $post_statuses,
				'value' => 'publish'
			)
		)
	),
	'b2046_by_author' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('By author','p_2046s_easy_widget'),
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				// 'ui_note' => __('Authors ID(s)', 'p_2046s_easy_widget'),
				'esc' => 'filter_number',
				'choices' => array(
					0 => 'by ID(only one)',
					1 => 'author of current post content'),
				'value' => '0'
			),
			array(
				'ui_type' => 'input', 
				// 'ui_note' => __('Authors ID(s)', 'p_2046s_easy_widget'),
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_order' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Order','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'ASC' => 'Ascendingly',
					'DESC' => 'Descendingly'
				),
				'value' => 'DESC'
			),
			array(
				'ui_type' => 'select_box', 
				'esc' => 'esc_attr',
				'choices' => $sorting_choices,
				'value' => 'none'
			)
		)
	),
	'b2046_post_taxonomies' => array(
		'block' => 'view',  
		'item_title' => __('Taxonomies (Categories)','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'esc_attr',
				'choices' => $show_post_categories,
				'value' => '0'
			),
			array(
				'ui_note' => __('taxonomy name', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_type' => 'radio_group', 
				'esc' => 'esc_attr',
				'choices' => array(0 => __('Do not show count'), 1 => __('Show count')),
				'value' => '0'
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_image' => array(
		'block' => 'view',  
		'item_title' => __('Featured image','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Get featured image.','p_2046s_easy_widget'),
				'ui_type' => 'select_box', 
				'esc' => 'esc_attr',
				'choices' => $list_of_image_sizes,
				'value' => ''
			),
			array(
				'ui_note' => __('Link image to','p_2046s_easy_widget'),
				'ui_type' => 'select_box', 
				'esc' => 'esc_attr',
				'choices' => $image_links,
				'value' => ''
			),
			array(
				'ui_note' => __('Link taget','p_2046s_easy_widget'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
						'parent' => 'same window',
						'blank' => 'new window', 
					),
				'value' => ''
			),
			array(
				'ui_note' => __('custom field name','p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => ''
			)
		)
	),
	//~ n Images from the selected posts
	'b2046_post_images' => array(
		'block' => 'view',  
		'item_title' => __('Post gallery','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Image size','p_2046s_easy_widget'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => $list_of_image_sizes,
				'value' => ''
			),
			array(
				'ui_note' => __('Link image to','p_2046s_easy_widget'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => $list_of_image_sizes,
				'value' => ''
			),
			array(
				'ui_type' => 'select_box', 
				'esc' => 'esc_attr',
				'choices' => array(
					'ASC' => 'Ascendingly',
					'DESC' => 'Descendingly'
				),
				'value' => 'DESC'
			),
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => $sorting_choices,
				'value' => 'none'
			),
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'0' => 'empty title attribute',
					'1' => 'image as image title attribute',
					'2' => 'caption as image title attribute',
				),
				'value' => 'none'
			),
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_number',
				'choices' => array(
					'0' => 'include featured image',
					'1' => 'exclude featured image'
				),
				'value' => '0'
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_edit_link' => array(
		'block' => 'view',  
		'item_title' => __('Edit link','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_number',
				'choices' => array(
					'0' => 'Link',
					'1' => 'Link with ID'
				),
				'value' => 0
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_object_meta' => array(
		'block' => 'view',  
		'item_title' => __('Meta','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Show as', 'p_2046s_easy_widget'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => $meta_show_choices,
				'value' => ''
			),
			array(
				'ui_note' => __('meta key', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			//~ array(
				//~ 'ui_note' => __('meta value', 'p_2046s_easy_widget'),
				//~ 'ui_type' => 'input', 
				//~ 'esc' => 'esc_attr',
				//~ 'choices' => '',
				//~ 'value' => ''
			//~ ),
			array(
				'ui_note' => __('separator', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_textfield' => array(
		'block' => 'view',  
		'item_title' => __('Text','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Some text', 'p_2046s_easy_widget'),
				'ui_type' => 'textarea', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'wp_kses_post'
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		),
		
	),
	'b2046_query_debug' => array(
		'block' => 'control',  
		'item_title' => __('Debug controls','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Debug will output the Query made by control bricks ABOVE this debug brick!</br></br>See the out put on frontend.', 'p_2046s_easy_widget'),
				'ui_type' => 'hidden', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => 1,
				'esc' => 'filter_number'
			)
		),
		
	),
	'b2046_for_actual_postid' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('For actual post/page','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('It will "guess" the actual post and show the VIEW content for it', 'p_2046s_easy_widget'),
				'ui_type' => 'hidden', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => 1,
				'esc' => 'filter_number'
			)
		),
		
	),
	//~ hyerarchical control
	'b2046_hierarchy_based' => array(
		'block' => 'control',  
		'item_title' => __('Hierarchy based','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => array(
						'0' => 'Pages from the same level as current page',
						'1' => 'Pages from the same level as given ID',
						'2' => 'Child pages of current page',
						'3' => 'Child pages of given ID'
					),
				'value' => 0,
				'esc' => 'filter_number'
			),
			array(
				'ui_note' => __('given ID, only one', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'filter_number'
			),
			array(
				'ui_note' => __('(in case of: ..from same level)', 'p_2046s_easy_widget'),
				'ui_type' => 'check_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => array( 1 => 'Exclude current'),
				'value' => '',
				'esc' => 'filter_attribute_characters'
			)
		),
		
	),
	'b2046_shortcode' => array(
		'block' => 'view',  
		'item_title' => __('Shortcode','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('[shortcode]', 'p_2046s_easy_widget'),
				'ui_type' => 'textarea', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_comments_number' => array(
		'block' => 'view',  
		'item_title' => __('Comments number','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_number',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_comments_template' => array(
		'block' => 'view',  
		'item_title' => __('Comments','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_date' => array(
		'block' => 'view',  
		'item_title' => __('Date','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_letter',
				'choices' => array(
						'published' => 'published',
						'modifed' => 'modified',
					),
				'value' => 'published'
			),
			//~ array(
				//~ 'ui_type' => 'check_box', 
				//~ 'esc' => 'esc_attr',
				//~ 'choices' => array(
					//~ 1 => 'link to archive'
				//~ ),
				//~ 'value' => '1'
			//~ ),
			array(
				'ui_note' => __('PHP date format', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => 'D. M. Y'
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_WP_pagenavi' => array(
		'block' => 'view_after',  
		'item_title' => __('WP-Pagenavi','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('<a href="http://wordpress.org/extend/plugins/wp-pagenavi/">WP-Pagenavi</a> works when the plugin is installed and active.<br />The navigation will be placed automatically after the View content.', 'p_2046s_easy_widget'),
				'ui_type' => 'hidden', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => 1,
				'esc' => 'filter_number'
			)
		)
	),
	'b2046_previous_posts_link' => array(
		'block' => 'view_after',  
		'item_title' => __('Link to previous post','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Previous text - Post name if empty', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
			
		)
	),
	'b2046_next_posts_link' => array(
		'block' => 'view_after',  
		'item_title' => __('Link to next post','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Next text - Post name if empty', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_posts_nav_link' => array(
		'block' => 'view_after',  
		'item_title' => __('Navigation (Prev/Next links)','p_2046s_easy_widget'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Separator', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('Prev label', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('Next label', 'p_2046s_easy_widget'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('class', 'p_2046s_easy_widget'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	// 
	// Bricks is the storage for elements in charge. Both Views & Controls.
	// The data are stored in:
	// array (
	// 	'object_unique_name' => 'xyz',  // "post_title" or something
	// 	'position' => '0',
	// 	'value' => array() // the array of values as they where sorted in the default input array
	// 	)
	// 
	'b2046_bricks'=> array()
);

