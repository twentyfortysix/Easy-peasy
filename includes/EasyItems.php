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
	'0' => __('no link', 'builder_2046'),
	'1' => __('Link to "post"', 'builder_2046'),
	'2' => __('Link to "custom meta"', 'builder_2046')
);
// Object title extrension choices
$object_title_extension_choices = array(
	'0' => __('raw text', 'builder_2046'),
	'h1' => 'h1',
	'h2' => 'h2',
	'h3' => 'h3',
	'h4' => 'h4',
	'h5' => 'h5',
	'div' => 'div'
);
// Specify scafolding type tpes
$scafolding_types =array(
	'0' => __('Default scaffolding', 'builder_2046'),
	'1' => __('One per row', 'builder_2046'),
	'2' => __('Many per row', 'builder_2046')
	); // default, one per row, many per row
	
$content_choices = array(
	'content'=>__('content', 'builder_2046'),
	'excerpt'=>__('excerpt', 'builder_2046'),
	'above' => __('above more tag', 'builder_2046'),
	'below' => __('below more tag', 'builder_2046'),
);

//~ 
//~ show categories as
//~
$show_post_categories = array(
	'0' => __('links', 'builder_2046'),
	'1' => __('list', 'builder_2046')
);

//~ 
//~ get images
//~ 
$list_of_image_sizes = list_of_image_sizes();

$image_links = array(
	'nolink' => __('no link', 'builder_2046'),
	'objectlink' => __('object link', 'builder_2046'),
	'customlink' => __('custom meta value', 'builder_2046'),
	'url' => 'url'
);
$image_links = array_merge($image_links, $list_of_image_sizes);

//~ 
//~ Meta show choices
//~ 
$meta_show_choices = array(
	'0' => __('text', 'builder_2046'),
	'1' => __('list', 'builder_2046'),
);
$post_statuses = array(
	'publish' => __('publish'), //a published post or page.
	'pending' => __('pending'), //post is pending review.
	'draft' => __('draft'), //a post in draft status.
	'auto-draft' => __('auto-draft'), //- a newly created post), with no content.
	'future' => __('future'), //- a post to publish in the future.
	'private' =>__('private'), //- not visible to users who are not logged in.
	'inherit' => __('inherit'), //- a revision. see get_children.
	'trash' => __('trash'), //- post is in trashbin (available with Version 2.9).
	'any' => __('any')
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
			'1' => __('show when', 'builder_2046'),
			'0' => __('hide when', 'builder_2046')
		),	
		'value' => '1',
		'esc' => 'filter_number'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_home' => __('home', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_front_page' => __('front page', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_single' => __('single', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_page' => __('page','builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_sticky' => __('sticky', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_category' => __('category', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_tax' => __('taxonomy archive', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_archive' => __('archive', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_search' => __('search result', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_404' => __('404 error', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	),
	array('ui_type' => 'check_box',
		'choices' => array('is_attachment' => __('attachment page', 'builder_2046')),
		'value' => '',
		'esc' => 'filter_attribute_characters'
	)
);
//~ sorting choices
$sorting_choices = array(
	'Sort by' => __('Sort by', 'builder_2046'),
	'ID' => __('ID', 'builder_2046'),  
	'title' => __('title', 'builder_2046'), 
	'date' => __('date', 'builder_2046'),
	'modified' => __('modified', 'builder_2046'),
	'rand' => __('rand', 'builder_2046'),
	'comment_count' => __('comment_count', 'builder_2046'),
	'menu_order' => __('menu_order', 'builder_2046'),
	'parent' => __('parent', 'builder_2046'),
	'meta_value' => __('meta_value', 'builder_2046'),
	'meta_value_num' => __('meta_value_num', 'builder_2046')
);

// ------------------------------------------------------------------- // 
//                         Build the VIEW array
// ------------------------------------------------------------------- // 
$EasyItems = array(
	// category controls
	'b2046_category_controls' => array(
		'block' => 'control',  
		'repeatable' => true,
		'item_title' => __('Category', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Control by', 'builder_2046'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => $category_controls,
				'value' => 'cat',
				'esc' => 'filter_save_characters'
			),
			array(
				'ui_note' => __('cat IDs (separate by coma)', 'builder_2046'),
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
		'item_title' => __('Widget admin title', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Admin widget title', 'builder_2046'),
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
		'item_title' => __('Surrounding widget scafold type', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Select type', 'builder_2046'),
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
		'item_title' => __('Widget frontend title', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Rendered before the loop', 'builder_2046'),
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
		'item_title' => __('', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('row class', 'builder_2046'),
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
		'item_title' => __('Widget description', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Widget intention. Used for administrative purposes.', 'builder_2046'),
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
		'item_title' => __('', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('each (column) class', 'builder_2046'),
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
		'item_title' => __('Permissions', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Who will be able to see the widget result.', 'builder_2046'),
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
		'item_title' => __('On template types: show / hide', 'builder_2046'),
		// gui
		'gui' => $conditional_tags_array
	),
	'b2046_on_post_type' => array( 
		// general
		'block' => 'resistor',  
		'repeatable' => true,
		'item_title' => __('On Post types: show/hide', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('post, page, etc.', 'builder_2046'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea. 6 hidden
				'choices' => '',
				'value' => '',
				'esc' => 'filter_attribute_characters'
			),
			array(
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea. 6 hidden
				'choices' => array(
					'true' => __('show', 'builder_2046'),
					'false' => __('hide', 'builder_2046')
					),
				'value' => '',
				'esc' => 'filter_attribute_characters'
			)
		),
	),
	'b2046_on_p_ID' => array( 
		// general
		'block' => 'resistor',  
		'repeatable' => true,
		'item_title' => __('On ID: show / hide', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'radio_group', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => array(
					'1' => __('show when', 'builder_2046'),
					'0' => __('hide when', 'builder_2046')
				),	
				'value' => '1',
				'esc' => 'filter_number'
			),
			array(
				'ui_note' => __('IDs. Separed by comma', 'builder_2046'),
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
		'item_title' => __('Post type', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('post, page, attachment,..', 'builder_2046'),
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
					'1' => __('affected by page number', 'builder_2046'),
					'0' => __('not affected', 'builder_2046')
				),
				'value' => '1'
			)
		)
	),
	// post_types
	'b2046_show_post_by_id' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Show only (by ID)', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('post / page / custom IDs (separate by coma)', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			)
		)
	),
	// post_types
	'b2046_show_by_date' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('By date', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('4 digit year', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_number',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('Month number (from 1 to 12)' , 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_number',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('Week of the year (from 0 to 53)', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_number',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('Day of the month (from 1 to 31)', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_number',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('before (2 month ago)', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('after (1 month ago)', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
		)
	),
	// post_types
	'b2046_exclude_actual' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Exclude actual post/page', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Exclude currently displayed post/page from this Easy loop', 'builder_2046'),
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
		'item_title' => __('Taxonomy', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('only one taxonomy (name)', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => __('terms IDs, separated by comma', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			),
			//~ operator for each term / //~ 'IN', 'NOT IN', 'AND'
			array(
				'ui_note' => __('terms operator', 'builder_2046'),
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND '.__('(operator)'),
					'IN' => 'IN',
					'NOT IN' => 'NOT IN'
				),
				'value' => 'IN'
			),
			//~ relation between multiple taxonomies
			array(
				'ui_note' => __('Taxonomy relation. If you use multiple taxonomy bricks, the later relation beats previous ones.', 'builder_2046'),
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND '.__('(relation)'),
					'OR' => 'OR'
				),
				'value' => 'OR'
			)
		)
	),'b2046_based_on_actual_taxonomy' => array(
		'block' => 'control',  
		'repeatable' => true,
		'item_title' => __('Taxonomy match', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('only one taxonomy (name)', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => __('terms operator', 'builder_2046'),
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND '.__('(operator)'),
					'IN' => 'IN',
					'NOT IN' => 'NOT IN'
				),
				'value' => 'IN'
			),
			//~ relation between multiple taxonomies
			array(
				'ui_note' => __('Taxonomy relation. If you use multiple taxonomy bricks, the later relation beats previous ones.', 'builder_2046'),
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'AND' => 'AND '.__('(relation)'),
					'OR' => 'OR'
				),
				'value' => 'OR'
			)
		)
	),
	'b2046_on_taxonomy' => array(
		'block' => 'resistor',  
		'repeatable' => true,
		'item_title' => __('On Taxonomy (Category)', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('only one taxonomy (name)', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => __('terms IDs, separated by comma', 'builder_2046'),
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
					'show' => __('show', 'builder_2046'),
					'hide' => __('hide', 'builder_2046'),
				),
				'value' => 'show'
			)
		)
	),
	'b2046_on_hierarchy' => array(
		'block' => 'resistor',  
		'repeatable' => true,
		'item_title' => __('Show/hide based on hierarchy', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => 'show or hide',
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
					'show' => __('show', 'builder_2046'),
					'hide' => __('hide', 'builder_2046'),
				),
				'value' => 'show'
			),
			array(
				'ui_note' => __('Show on', 'builder_2046'),
				'ui_type' => 'radio_group', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
						'child' => __('On child pages of defined IDs', 'builder_2046'),
						'parent' => __('On parent page of defined IDs', 'builder_2046'),
					),
				'value' => 'child'
			),
			array(
				'ui_note' => __('Page IDs, separated by comma', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('Depth (default 1 level)', 'builder_2046'),
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
					'exclude' => __('omit', 'builder_2046'),
					'include' => __('include', 'builder_2046'),
				),
				'value' => 'exclude'
			)
		)
	),
	'b2046_meta' => array(
		'block' => 'control',  
		'repeatable' => true,
		'item_title' => __('Meta', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Meta key', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('Meta value', 'builder_2046'),
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
		'item_title' => __('Meta match', 'builder_2046'),
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
		'item_title' => __('Link to archive', 'builder_2046'),
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
				'ui_note' => __('Taxonomy or Post type name', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_save_characters',
				'choices' => '',
				'value' => 'category'
			),
			array(
				'ui_note' => __('term ID (in case of Taxonomy)', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_number_space_dash',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('Link text', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => 'Link to archive ..'
			),
			array(
				'ui_note' => __('custom class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_save_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	
	'b2046_post_title' => array(
		'block' => 'view',  
		'item_title' => __('Title', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_save_characters',
				'choices' => $object_title_choices,
				'value' => $object_title_choices[0]
			),
			array(
				'ui_note' => __('Scafolding', 'builder_2046'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_save_characters',
				'choices' => $object_title_extension_choices,
				'value' => $object_title_extension_choices['h1']
			),
			array(
				'ui_note' => __('Link taget', 'builder_2046'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
						'parent' => __('same window', 'builder_2046'),
						'blank' => __('new window', 'builder_2046'), 
					),
				'value' => ''
			),
			array(
				'ui_note' => __('custom meta value', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('custom class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_content' => array(
		'block' => 'view',  
		'item_title' => __('Content', 'builder_2046'),
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
				'ui_note' => __('Read more text', 'builder_2046'),
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_bootstrap_menu' => array(
		'block' => 'view',  
		'item_title' => __('Bootstrap3 menu', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'input', 
				'ui_note' => __('Menu location', 'builder_2046'),
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_type' => 'input', 
				'ui_note' => __('Menu name, ID', 'builder_2046'),
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_sidebar' => array(
		'block' => 'view',  
		'item_title' => __('Sidebar', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Sidebar ID', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_author' => array(
		'block' => 'view',  
		'item_title' => __('Author', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array( 
					0 => __('plain text', 'builder_2046'),
					1 => __('link to authors posts', 'builder_2046'),
					2 => __('link to authors url', 'builder_2046'),
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
				'ui_note' => __('custom class', 'builder_2046'),
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
		'item_title' => __('Number', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Number of objects.', 'builder_2046'),
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
		'item_title' => __('Offset', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Number', 'builder_2046'),
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
		'item_title' => __('Status', 'builder_2046'),
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
		'item_title' => __('By author', 'builder_2046'),
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				// 'ui_note' => __('Authors ID(s)', 'builder_2046'),
				'esc' => 'filter_number',
				'choices' => array(
					0 => __('by ID(only one)', 'builder_2046'),
					1 => __('author of current post content', 'builder_2046')
				),
				'value' => '0'
			),
			array(
				'ui_type' => 'input', 
				// 'ui_note' => __('Authors ID(s)', 'builder_2046'),
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_order' => array(
		'block' => 'control',  
		'repeatable' => false,
		'item_title' => __('Order', 'builder_2046'),
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
			),array(
				'ui_note' => __('meta key', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_taxonomies' => array(
		'block' => 'view',  
		'item_title' => __('Taxonomies (Categories)', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'esc_attr',
				'choices' => $show_post_categories,
				'value' => '0'
			),
			array(
				'ui_note' => __('taxonomy name', 'builder_2046'),
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
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_post_image' => array(
		'block' => 'view',  
		'item_title' => __('Featured image', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Get featured image.', 'builder_2046'),
				'ui_type' => 'select_box', 
				'esc' => 'esc_attr',
				'choices' => $list_of_image_sizes,
				'value' => ''
			),
			array(
				'ui_note' => __('Link image to', 'builder_2046'),
				'ui_type' => 'select_box', 
				'esc' => 'esc_attr',
				'choices' => $image_links,
				'value' => ''
			),
			array(
				'ui_note' => __('Link taget', 'builder_2046'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => array(
						'parent' => 'same window',
						'blank' => 'new window', 
					),
				'value' => ''
			),
			array(
				'ui_note' => __('custom field name OR url', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
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
		'item_title' => __('Post gallery', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Image size', 'builder_2046'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => $list_of_image_sizes,
				'value' => ''
			),
			array(
				'ui_note' => __('Link image to', 'builder_2046'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => $list_of_image_sizes,
				'value' => ''
			),
			array(
				'ui_type' => 'select_box', 
				'esc' => 'esc_attr',
				'choices' => array(
					'ASC' => __('Ascendingly', 'builder_2046'),
					'DESC' => __('Descendingly', 'builder_2046')
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
					'0' => __('empty title attribute', 'builder_2046'),
					'1' => __('image as image title attribute', 'builder_2046'),
					'2' => __('caption as image title attribute', 'builder_2046'),
				),
				'value' => 'none'
			),
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_number',
				'choices' => array(
					'0' => __('include featured image', 'builder_2046'),
					'1' => __('exclude featured image', 'builder_2046')
				),
				'value' => '0'
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_edit_link' => array(
		'block' => 'view',  
		'item_title' => __('Edit link', 'builder_2046'),
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
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_object_meta' => array(
		'block' => 'view',  
		'item_title' => __('Meta', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Show as', 'builder_2046'),
				'ui_type' => 'select_box', 
				'esc' => 'filter_attribute_characters',
				'choices' => $meta_show_choices,
				'value' => ''
			),
			array(
				'ui_note' => __('meta key', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			),
			//~ array(
				//~ 'ui_note' => __('meta value', 'builder_2046'),
				//~ 'ui_type' => 'input', 
				//~ 'esc' => 'esc_attr',
				//~ 'choices' => '',
				//~ 'value' => ''
			//~ ),
			array(
				'ui_note' => __('separator', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => ''
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_textfield' => array(
		'block' => 'view',  
		'item_title' => __('Text', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Some text', 'builder_2046'),
				'ui_type' => 'textarea', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'wp_kses_post'
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		),
		
	),
	'b2046_query_debug' => array(
		'block' => 'control',  
		'item_title' => __('Debug controls', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Debug will output the Query made by control bricks ABOVE this debug brick!</br></br>See the out put on frontend.', 'builder_2046'),
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
		'item_title' => __('For actual post/page', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('It will "guess" the actual post and show the VIEW content for it', 'builder_2046'),
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
		'item_title' => __('Hierarchy based', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => array(
						'0' => __('Pages from the same level as current page', 'builder_2046'),
						'1' => __('Pages from the same level as given ID', 'builder_2046'),
						'2' => __('Child pages of current page', 'builder_2046'),
						'3' => __('Child pages of given ID', 'builder_2046')
					),
				'value' => 0,
				'esc' => 'filter_number'
			),
			array(
				'ui_note' => __('given ID, only one', 'builder_2046'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'filter_number'
			),
			array(
				'ui_note' => __('(in case of: ..from same level)', 'builder_2046'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => array( 
					0 => __('Include current', 'builder_2046'),
					1 => __('Exclude current', 'builder_2046')
					),
				'value' => '',
				'esc' => 'filter_attribute_characters'
			),
			array(
				// 'ui_note' => __('(Sometimes in general use listing of top level pages is not desired.)', 'builder_2046'),
				'ui_type' => 'select_box', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => array( 
					0 => __('List top level pages', 'builder_2046'),
					1 => __('Do not list top level pages', 'builder_2046')
					),
				'value' => '',
				'esc' => 'filter_attribute_characters'
			)
		),
		
	),
	'b2046_shortcode' => array(
		'block' => 'view',  
		'item_title' => __('Shortcode', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('[shortcode]', 'builder_2046'),
				'ui_type' => 'textarea', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => '',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_comments_number' => array(
		'block' => 'view',  
		'item_title' => __('Comments number', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_number',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_comments_template' => array(
		'block' => 'view',  
		'item_title' => __('Comments', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_date' => array(
		'block' => 'view',  
		'item_title' => __('Date', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_type' => 'select_box', 
				'esc' => 'filter_letter',
				'choices' => array(
						'published' => __('published', 'builder_2046'),
						'modifed' => __('modified', 'builder_2046'),
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
				'ui_note' => __('PHP date format', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'esc_attr',
				'choices' => '',
				'value' => 'D. M. Y'
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_WP_pagenavi' => array(
		'block' => 'view_after',  
		'item_title' => __('WP-Pagenavi', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('<a href="http://wordpress.org/extend/plugins/wp-pagenavi/">WP-Pagenavi</a> works when the plugin is installed and active.<br />The navigation will be placed automatically after the View content.', 'builder_2046'),
				'ui_type' => 'hidden', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' => 1,
				'esc' => 'filter_number'
			)
		)
	),
	'b2046_previous_posts_link' => array(
		'block' => 'view_after',  
		'item_title' => __('Link to previous post', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Previous text - Post name if empty', 'builder_2046'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
			
		)
	),
	'b2046_next_posts_link' => array(
		'block' => 'view_after',  
		'item_title' => __('Link to next post', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Next text - Post name if empty', 'builder_2046'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
				'ui_type' => 'input', 
				'esc' => 'filter_attribute_characters',
				'choices' => '',
				'value' => ''
			)
		)
	),
	'b2046_posts_nav_link' => array(
		'block' => 'view_after',  
		'item_title' => __('Navigation (Prev/Next links)', 'builder_2046'),
		// gui
		'gui' => array(
			array(
				'ui_note' => __('Separator', 'builder_2046'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('Prev label', 'builder_2046'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('Next label', 'builder_2046'),
				'ui_type' => 'input', // 0 input, 1 select box, 2 multiple select box, 3 check box, 4 radio button, 5 textarea
				'choices' => '',
				'value' =>'',
				'esc' => 'esc_attr'
			),
			array(
				'ui_note' => __('class', 'builder_2046'),
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

