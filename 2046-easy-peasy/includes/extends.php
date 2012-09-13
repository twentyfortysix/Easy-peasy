<?php 
// extends the widget parts
// w2046_main_loop



echo '---------';
class B extends w2046_main_loop {
    function form() {
    	$default = array(
		'the_post_type' => 'page', // 
		'the_widget_title' => '', // false, true
		);
    	parent::form();//$default = array();
    	//var_dump(parent::form);
    	//var_dump( $this->form);
    }
}

$test2 = new B;
var_dump($test2->form());
echo '---end---<br>';
/*
id
def value
window
	type (input, select,..)
	heading
	text
	note
	esc_attr
	
	builder
		view
			position
	logic
		type
		...

*/
