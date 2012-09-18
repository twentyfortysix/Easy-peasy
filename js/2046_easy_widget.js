/*
* This sript handles the Drag&Drop function
* it is also tightly connected to the php widget core.
* It manipulates the HTML within the widget ..mainly position values
*/
jQuery(document).ready(function($){ 
	
	var EasyDrag = function(){
		
		//~  For VIEWS
		$( ".view_bank li" ).draggable({
			appendTo: "body",
			helper: "clone",
			opacity: 0.7,
			//~ axis: "y"
		});
		$( ".control_bank li" ).draggable({
			appendTo: "body",
			helper: "clone",
			opacity: 0.7,
			//revert: true,
			//scroll:false,
			//containment: "#control_container"
			//~ axis: "y"
		});
		// append new item in the list - after it's draged in the div
		$( "#view_container ol" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ".view_bank li:not(.ui-sortable-helper)",
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
				var temp = name[0] + '][b2046_bricks][' + $(clone).index(),i;
				// combine it all in one
				for(i=1; i<l; i++){
					temp = temp + '][' + name[i];
				}
				// this touches the oroginal draged element ;/
				// $(ui.draggable).find('input,select,textarea').attr('name',temp);
				// changes the name of all inner inputs :)
				$(clone).find('input,select,textarea').attr('name',temp);
				
			
			}
		}).sortable({
			items: "li:not(.placeholder)",
			sort: function() {
				// gets added unintentionally by droppable interacting with sortable
				// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
				$( this ).removeClass( "ui-state-default" );
				
			}
		});
		
		//~  For CONTROLS
		// append new item in the list - after it's draged in the div
		$( "#control_container ol" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ".control_bank li:not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				// define the actual clone
				var clone = $(ui.draggable).clone();
				// add a class - not necessary
				//$(clone).attr('class', 'me')
				// add the clone to the final div
				var clone_name = $(clone).attr('class');
				//~ var existing_li = $(this).find('li').attr('class');
				//~ console.log(existing_li);
				//~ console.log(clone_name);
				if(!$(this).find("li").hasClass(clone_name)){
					//~ }
				//~ do not let them use same control twice
				//~ console.log(match);
				//~ if($('#control_container ol:contains').hasClass(existing_li) == false){
					
					$(this).append(clone);
					// remove the dummy object 
					
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
					var temp = name[0] + '][b2046_controls',i;
					// combine it all in one
					for(i=1; i<l; i++){
						temp = temp + '][' + name[i];
					}
					// this touches the oroginal draged element ;/
					// $(ui.draggable).find('input,select,textarea').attr('name',temp);
					// changes the name of all inner inputs :)
					$(clone).find('input,select,textarea').attr('name',temp);
				}
			}
		}).sortable({
			items: "li:not(.placeholder)",
			sort: function() {
				// gets added unintentionally by droppable interacting with sortable
				// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
				$( this ).removeClass( "ui-state-default" );
				
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
