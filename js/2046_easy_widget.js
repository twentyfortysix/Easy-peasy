/*
* This sript handles the Drag&Drop function
* it is also tightly connected to the php widget core.
* It manipulates the HTML within the widget ..mainly position values
*/
jQuery(document).ready(function($){ 
	
	//~ find in each clone(li) inputs
	//~ split the naes of each input
	//~ add to it the clone(li) ID and also each input ID
	//~ the result is something like: 
	//~ widget-builder_2046_main_loop-widget[20][b2046_bricks][0][b2046_post_title][gui][1][value]
	var manipulate_dropped_item_input_names = function(slot, slot_name){
		$(slot).find('input, select, textarea').each( function(input_index){
			//~  get the name of the input
			var input_name = this.name;
			//~ split the name in to chunks
			var name_parts = input_name.split('][');
			//~ cont he chunks
			l = input_name.split('][').length;
			//~ put the name base together
			//~ console.log(name_parts);
			if(slot_name == 'b2046_bricks'){
				var temp = name_parts[0] + '][' + slot_name + '][' + $(slot).index();
			}else{
				//~ var temp = name_parts[0] + '][' + slot_name ;
				var temp = name_parts[0] + '][' + slot_name + '][' + $(slot).index();
			}
			//~ append the rest to the name
			for(i=1; i<l; i++){
				temp = temp + '][' + name_parts[i];
			}
			//~ write the manipulated name back to the inputs
			$(this).attr('name',temp);
			//~ console.log(temp);
		});
	};
	
	//~ this function is similar to function "manipulate_dropped_item_input_names" but it it is used 
	//~ when user resort bricks
	//~ So we have to manipulate the "input" names bit more
	var manipulate_sorted_item_input_names = function(slot, slot_name, li_index){
		$(slot).find('input, select, textarea').each( function(input_index){
			//~  get the name of the input
			var input_name = this.name;
			//~ split the name in to chunks
			var name_parts = input_name.split('][' + slot_name + '][');
			//~ put the name base together
			//~ console.log(name_parts);
			if(slot_name == 'b2046_bricks'){
				var temp = name_parts[0] + '][' + slot_name + '][' + li_index;
			}else{
				//~ var temp = name_parts[0] + '][' + slot_name;
				var temp = name_parts[0] + '][' + slot_name + '][' + li_index;
			}
			//~ split the second part in to pieces, --- then through away the '0' chunk which is the old index
			var second_chunks = name_parts[1].split('][');

			//~ count the second part chunks
			var l = name_parts[1].split('][').length;
			//~ join all pieces together
			for(i=1; i<l; i++){
				 temp = temp + '][' + second_chunks[i];
			}
			//~ write the manipulated name back to the inputs
			$(this).attr('name',temp);
			//~ console.log(temp);
			//~ example of the result: widget-builder_2046_main_loop-widget[21][b2046_bricks][0][b2046_post_title][gui][1][value]
		});
	};
	
	var EasyDrag = function(){
		
		//~  For VIEWS
		$( ".view_bank li" ).draggable({
			appendTo: "body",
			helper: "clone",
			opacity: 0.7,
		});
		$( ".control_bank li" ).draggable({
			appendTo: "body",
			helper: "clone",
			opacity: 0.7,
		});
		//~ needed fix for droppable not able to handle large objects over smaller slots
		//~  getter
		//~ check if the div exist already
		if($("#view_container ol").lenght > 0 && $("#control_container ol").lenght > 0){
			var tolerance = $( "#view_container ol,#control_container ol" ).droppable( "option", "tolerance" );
		}
		// append new item in the list - after it's draged in the div
		$( "#view_container ol" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ".view_bank li:not(.ui-sortable-helper)",
			tolerance: "touch",
			drop: function( event, ui ) {  
				// define the actual clone
				var clone = $(ui.draggable).clone();
				// add a class - not necessary
				//$(clone).attr('class', 'me')
				// add the clone to the final div
				$(this).append(clone);
		
				// remove the dummy object from the ol
				$( this ).find( ".placeholder" ).remove();
				
				 manipulate_dropped_item_input_names(clone, 'b2046_bricks');
			}
		}).sortable({
			items: "li:not(.placeholder)",
			sort: function() {
				// gets added unintentionally by droppable interacting with sortable
				// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
				$( this ).removeClass( "ui-state-default" );
				//~ console.log('sort');
				
			},
			//~ start: function(event, ui) {
					//~ var start_pos = ui.item.index();
					//~ ui.item.data('start_pos', start_pos);
				//~ },
			update: function (event, ui) {
				//~ var start_pos = ui.item.data('start_pos');
				var end_pos = ui.item.index();
				//~ this is 'ol'(.droppable .sortable)
					
				//~ for each parent li find index
				$(this).find('li').each( function(index){
					//~ this is 'li'
					var li_index = index;
					
					manipulate_sorted_item_input_names(this, 'b2046_bricks', li_index);
				});
			}
		});
		
		//~  For CONTROLS

		// append new item in the list - after it's draged in the div
		$( "#control_container ol" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ".control_bank li:not(.ui-sortable-helper)",
			tolerance: "touch",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				// define the actual clone
				var clone = $(ui.draggable).clone();
				var clone_class = $(clone).attr('class');
				var clone_rel = $(clone).attr('rel');
				var clonable = true;
				
				$(this).find('li').each( function(each_item){
					var this_rel = $(this).attr('rel');
					var this_class = $(this).attr('class');
					if((typeof this_rel != 'undefined') && (this_rel == clone_rel) && (this_class == clone_class)){
						clonable = false;
						//~ console.log(this_rel + ' * ' + clone_rel);
						//~ console.log(this_class + ' * ' + clone_class);
					}
				});
				//~ if it is forbiden > do not let them use same control twice 
				if(clonable == true){
					$(this).append(clone);
					manipulate_dropped_item_input_names(clone, 'b2046_controls');
				}
			}
		}).sortable({
			/*
			items: "li:not(.placeholder)",
			sort: function() {
				// gets added unintentionally by droppable interacting with sortable
				// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
				$( this ).removeClass( "ui-state-default" );
				
			}
			* */
			
			items: "li:not(.placeholder)",
			sort: function() {
				// gets added unintentionally by droppable interacting with sortable
				// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
				$( this ).removeClass( "ui-state-default" );
				
				
			},
			//~ start: function(event, ui) {
					//~ var start_pos = ui.item.index();
					//~ ui.item.data('start_pos', start_pos);
				//~ },
			update: function (event, ui) {
				//~ var start_pos = ui.item.data('start_pos');
				var end_pos = ui.item.index();
				//~ this is 'ol'(.droppable .sortable)
					
				//~ for each parent li find index
				$(this).find('li').each( function(index){
					//~ this is 'li'
					var li_index = index;
					
					manipulate_sorted_item_input_names(this, 'b2046_controls', li_index);
				});
			}
			
		});
		//~ add dummy objects if the container is empty
		$("#view_container ol:empty").html('<li class="placeholder">Drag the view object here.</li>');
		$("#control_container ol:empty").html('<li class="placeholder">Drag the control object here.</li>');
	}; // END of EasyDrag 
	
	
	
	//~ define remove function
	$.fn.removeStep = function() {
		 // `this` is now a reference to the $ Object on which `.removeStep()` was invoked 
		 this.closest('li').remove();
		 $('#view_container').sortable('refresh');
		 // Allow chaining
		 return this;
	} 
	//~ remove item from sorted list
	$('.rem').live('click', function() {
		$(this).removeStep();
	});
	
	// style the widget a bit
	$( ".easy_2046_lw").closest(".widget-inside").addClass("style_me");
	
	//~ run the core function
	//~ 
	EasyDrag();
	//~ 
	//~ ********************
	
/****************************************************************************************************
 * 
 * NECESSARY HACK -  when the widget is saved define it all again, otherwice it just doesn't work!
 * 
 * ******************************************************************************************
 */
	$('#widgets-right').ajaxComplete(function(event, XMLHttpRequest, ajaxOptions){
		//~ run the core function
		//~ 
		EasyDrag();
		//~ 
		//~ ********************
	});
});
