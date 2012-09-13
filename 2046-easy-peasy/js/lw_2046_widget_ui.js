/*jQuery(function() {
	//jQuery( "#general_bank" ).accordion();
	//jQuery("#general_bank").click(function () {
	//called before .sortable(); 

	// define remove function
	jQuery.fn.removeStep = function() {
		 // `this` is now a reference to the jQuery Object on which `.removeStep()` was invoked 
		 this.closest('li').remove();
		 jQuery('#cart').sortable('refresh');
		 // Allow chaining
		 return this;
	} 
	// remove item from sorted list
	jQuery('.rem').live('click', function() {
		jQuery(this).removeStep();
	});
	// make it sortable
	jQuery("#cart ol").sortable();
	//

	jQuery( "#view_bank li" ).draggable({
		appendTo: "body",
		helper: "clone"
	});
	// append new item in the list - after it's draged in the div
	jQuery( "#cart ol" ).droppable({
		activeClass: "ui-state-default",
		hoverClass: "ui-state-hover",
		accept: ":not(.ui-sortable-helper)",
		drop: function( event, ui ) {
			jQuery( this ).find( ".placeholder" ).remove();
			jQuery( '<li class="me"></li>' ).html( ui.draggable.html() ).appendTo( this );
		}
	}).sortable({
		items: "li:not(.placeholder)",
		sort: function() {
			// gets added unintentionally by droppable interacting with sortable
			// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
			jQuery( this ).removeClass( "ui-state-default" );
		}
	});


});*/
