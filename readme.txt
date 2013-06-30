=== Easy ===
Plugin name: Easy
Contributors: o----o
Plugin URI: http://wordpress.org/extend/easy
Donate Link: http://2046.cz/
Tags: admin, widget, loop, page, post, custom, type, taxonomy, tag, category, comments, content, drag, drop, gallery, image
Requires at least: 3.4.1
Tested up to: 3.6-beta1
Stable tag: 0.9.4.6

Easy, but complex widget website builder.

== Description ==

Easy is a multi-functional widget covering most of the native Wordpress functions commonly used in templates.
You can place almost any part of your content anywhere in your sidebars.

The widget is made out of drag&drop bits (bricks) and is totally up to you what you want to show on your website.

Showcase:

http://www.youtube.com/watch?v=N8KoQmQmXB0

Easy widget has variety of bricks representing the content and its logic. You can make simple or complex layout simply by dragging the bricks in to their slots and define on what cases it has to be shown or not.

Content bricks are:

 * title
 * content
 * featured image
 * categories
 * tags
 * taxonomies
 * custom meta
 * comments
 * author
 * date
 * shortcode
 * post gallery
 * sidebar
 * WPpagenavi (when installed)
 * ...
 * and even your own content bricks if you like
 
The resulting content is displayed based on the logic you build the same way as you did the content.
You just drag the logical bricks to their slot and the content will be shown based on that logic.
Logical bricks are:

 * Number of posts
 * post type chooser
 * offset
 * hierarchical logic (for pages and alike) 
 * category filter
 * custom meta filter
 * post status
 * edit link
 * permissions
 * meta filter
 * taxonomy filter
 * ...
 * and even your own logic bricks if you like
 
In adition to that the result can be designed to your needs. You can add your own classes to the whole widget (the HTML structure) and also to each content brick (a part of the content).
Then again it is totally up to you how you design your website.

Does it reminds you something?
Yes, it is exactly what you do when you design your template; you loop through the post or pages in your template, but this time without touching the code.
All the content and logical bricks are only graphical representation of the Wordpress functions.

The aim of this plugin is to speed up common programming work, so we do not have to repeat our selves.
Imagine a website made out of "sidebars" filled with widgets representing the list of last posts, menu, the image gallery, any content that is actually the website.
All built out of widgets that you can re-arrange anyway you or your client like right out of the admin area. That is the main purpose of the widgets anyway, Easy makes it real.

= Notice =
In order to have the website fast as light even with the Easy plugin heavily in charge use the W3TC caching plugin [[1](http://wordpress.org/extend/plugins/w3-total-cache/)]

= Documentation =

 * <a href="http://2046.cz/easy/">Easy</a>
 * <a href="http://2046.cz/blog">Tutorials</a>
 * <a href="http://2046.cz/easy/general">General description</a>
 * <a href="http://2046.cz/easy/view">View description</a>
 * <a href="http://2046.cz/easy/control">Control description</a>
 * <a href="http://2046.cz/easy/extend">Extend</a>

 = Compatible with: =
 <a href="http://wpml.org/">WPML</a>, <a href="http://wordpress.org/plugins/qtranslate/">qTranslate</a>, <a href="https://www.google.com/url?q=http://wordpress.org/plugins/custom-content-type-manager/&sa=U&ei=R-DNUcKJIM2B4AT7xoGwDQ&ved=0CAcQFjAA&client=internal-uds-cse&usg=AFQjCNE2SU-CT1WLx80VKYlh4e1w6ZIcbg">CCTM</a>, <a href="http://wordpress.org/plugins/wp-pagenavi/">WP-pagenavi</a>, <a href="http://wordpress.org/plugins/w3-total-cache/">W3TC</a>, <a href="http://wordpress.org/plugins/fancybox-for-wordpress/">fancybox</a> and others.

== Installation ==

As usual. If you don't know how, check out the <a href="http://codex.wordpress.org/Managing_Plugins">official how-to</a>.

== Frequently Asked Questions ==
 

= Why I cannot use more then one instance of some control bricks? =

Yep, you cannot. You can do it only for some control bricks where it "makes sense".

= Why did you make such a thing for free? =

This is my reward to the WP community

= What if I want my to make my own function part of the Easy widget? =

It is possible and even more, it's easy. Check out the documentation <a href="http://2046.cz/easy/extend">Extend</a>.

== Upgrade Notice ==

* Please if you encounter any misbehavior, let my know on the forum. I'll be happy to fix it!
* If the widget behaves differently after the upgrade check out the particullar brick, if it hasn't have some new feature(s), which did not exist before. If so, correct values and re-save the widget.
* Always back up your widgets, do not let the sky fall. Use the <a href="http://wordpress.org/extend/plugins/widget-saver/">Widget saver</a> plugin.

== Screenshots ==
 
1. Screenshot of the version 0.5

== Change log ==

= 0.9.4.6 = 
 * FIX a small fix on line 893, nothing cruicial
 * FIX - GLOBAL - class "one per row" has been multiplied
 * FIX - the edit link has been visible to non-logged in users (the edit did not point to admin area, but the html has been visible)

= 0.9.4.5 = 
 * NEW - VIEW - Content brick has input filed wherre you can set the "Read more" text wich run through localization filter for the possible localizations.
 * NEW - CONTROL - filter posts made by an author xyz.

= 0.9.4.4 = 
 * FIX - calls for undefined values in process of "On templeta type" brick
 * FIX - Hierarchical brick - the depth no loger goes too deep.. in other words the depth can be set up to 9999... and it wont consume more time than the actual hierarchy structure needs for the process. The page will simply go faster, the hoster stops to hate you,.. if you over exaggerated.

= 0.9.4.3 = 
 * FIX - a typo causes the media library disapear, sorry for that. 

= 0.9.4.2 = 
 * FIX - .. guess what .. Show/hide based on hierarchical structure got mad on 404 page

= 0.9.4.1 = 
 * FIX - Show/hide based on hierarchical structure got mad on home page

= 0.9.4 = 
 * FIX - resitors have wrong user input sorting, it mismatched the values
 * NEW - CONTROL - Resistor - Show/hide based on hierarchical structure
 
= 0.9.3 =
 * NEW - CONTROL - you can control on what taxonomy (category) the result will be shown
 * NEW - CONTROL - the controllers that act as resistors have a "R" mark
 
= 0.9.2.1 = 
 * NEW - VIEW - new "target" option for links "Featured image" brick and "Title" brick

= 0.9.2 =
 * NEW - VIEW - "Title" brick can be a link to custom field value
 * NEW - VIEW - "Featured image" brick can be a link to custom field value
 {If you have not used Featured image bricks and title bricks class fields, you can stay cool, otherwise You have to reset all your Featured image bricks and title bricks (after the update - the class values will shift to a custom field values..)}

= 0.9.1 =
 * the Hierarchical CONTROL no longer forces to the query "page" type. The type have to be set explicitly!
 * FIX - show-hide on ID - there was a bug when multipple IDs where defined.
 
= 0.9 =
* FIX - Featured image did not point to where it has to !!! you should deactivate and reactivate the plugin, in order to see all image versions as they exists. Otherwise you'll se a weird mix of "same" sizes !!!

= 0.8.9 =
 * FIX - CONTROL - Show-Hide on ID
 * NEW - CONTROL - Meta - a custom meta filter
 * NEW - VIEW - sidebar - shows sidebar within sidebar :O . Grate if you would like to use the Easy control logic for widgets that have no controls of that kind.. about 99.99% ;) DO NOT include a sidebar within it self!

= 0.8.8 =
 * NEW - CONTROL brick - Taxonomy matcher - it gets terms from the main post/page and adjusts the Easy widget query according to it. You can show post on the side that are in the same category as the actual post ..or something like that.  
= 0.8.7 =
* FIX - array_combine error
* NEW - Author VIEW brick - shows the author or his/her name, url, ... 

= 0.8.6 =
* FIX - another fix for "Post gallery brick"
= 0.8.5 =
 * FIX - Invalid argument supplied for foreach() in ..easy/includes/EasyItems.php 
= 0.8.4 =
* FIX - the "Post gallery" brick really lists all registred image sizes now.

= 0.8.3 =
* NEW - VIEW - "Prev/Next link" - mimics the native posts_nav_link() function

= 0.8.2 =
* Previous , next link fix
* Permission bricks does not echo it's state :)
* NEW - CONTROL brick - "Exclude actual post/page" - excludes currently visible post/page/custom from the widget loop  

= 0.8.1 =
* small fix (before & after widget)
* text Brick allows html tags, same as you can use in post content

= 0.8 =
 * The security time comes.
    All the input fields are now automatically escaped during the widget saving process. All the escapes techniques are defined for each field separately.
    If you define your own item (meaning, if you extend the Easy of by your own bricks), doesn't matter if View or Control you can choose from any Wordpress built in sanitize, escape function as well as native PHP functions and functions that comes with this plug-in (more in the Documentation).

= 0.7.4 =
 * You can exclude the featured image from the gallery in "Post gallery" brick. Warning! All "Post gallery" bricks has to be updated!

= 0.7.3 =
 * FIX -small javascript fix needed for upcoming WP 3.5.

= 0.7.2 =

 * NEW - select box in "Post gallery" that lets you select where from the image title will be taken or if any. choices: empty title attribute, image as image title attribute, caption as image title attribute. The title is used in the img HTML tag.. and is used by most lightboxes.
 * FIX - VIEW - Taxonomies (Categories) - the class has not been considered when the number check box has not been checked
 * FIX - CONTROL - "For actual post/page" - the brick worked only for posts. From now on it guesses the actual post/page/... type and so you can make gallery for any post type automatically
 * FIX - CONTROL - sorting - this functin doesn't sorted att all, now it does.. can't believe nobody complained so far.
 
= 0.7.1 =

 * to be more precise I have renamed the "Image" brick to "Featured image" (no function change)
 * NEW - VIEW brick - "Post gallery" - you can now take all the post images for the post/pages defined in the control logic and build a image gallery. 
 * NEW - CONTROL - "For actuallly viewed "post/page" - it will "guess" the actually visible post/page ID and shows the elements defined in the CONTENT slot. 
 This is usefull especially together with the  "Post gallery" VIEW brick. When you use them together it creates a gallery out of all images uploaded in that particular post/page automatically.

= 0.7 =

 * NEW - VIEW brick: internal type which is rendered after the view content.. (interesting only for developers)
 * NEW - VIEW brick: WP-Page navigation brick (Works when the <a href="http://wordpress.org/extend/plugins/wp-pagenavi/">WP-Pagenavi</a> plugin is active
 * NEW - VIEW brick - prev link
 * CHANGE - Couple changes in inner function names and structure (it should not affect your actual setup)
 * CHANGE - the function "f2046_front_end_builder" that actualy renders the loop content is given the whole query object instead the post->ID. Which means you can get more data to play with.. if you are developer
 
 
= 0.6.5 =

 * FIX - I've been mixing an instance calls with static calls .) , which triggers errors on some server setups

= 0.6.4 =
 * NEW - CONTROL - show pages based on hierarchy level (like: child pages of the parent page by ID, child pages of current page etc.)
 * FIX - resorting the settings aray was not a good idea - removed and so the CONTROL taxonomy has been rewriten a bit
 
= 0.6.3 =

 * FIX - no "big" changes for today. I have fixed the UI CSS. The widget looks good .) on all major browsers. Chrome (v.21), Firefox (v.15+) and also the Explorer (v 8+)
  
= 0.6.2 =

 * NEW - VIEW brick - link to archive (taxonomy, post_type (if is allowed))
 * FIX - jQuery droppable did not accept larger bricks.
 * FIX - I did not realized how ugly it looks under the Firefox ;/ It's bit polished now :) {Chrome is perfect.. Don't know about the ancient pseudo browser Explorer though.. will check it later.}
 
= 0.6.1 = 
 
 * NEW - Controler: show post/page based on ID or IDS only
 * NEW - Controler: Debug a flexible debug feature (Though it is in the control slot, it doesn't change anything it just outputs the debug.).
 * FIX - The post type has been broken, it doesn't reflect the user "post type" value, sorry for that.

= 0.6 =

 * NEW - "Classic" widget title
 * NEW - Date view bricks
 * NEW - Status controller
 * NEW - category view bricks changed to multi-functional taxonomy brick (category as default)
 * NEW - Controller restrictor - restrictor is a pseudo-controller. Unlike the controller which controls the wp_query the resistor runs before the query and let it be executed or not... in cases such as show or not on homepage etc. (Restrictors are type of controller, and so are naturally part of the Controls )
 * NEW - Controller restrictor: show on (conditionals), show - hide on template types, 
 * NEW - Controller restrictor: Show/hide on ID (linear, and Hierarchical), 
 * NEW - Controller restrictor: show hide on taxonomies, 
 * NEW - Controller restrictor: on/off pagination, 
 * NEW - Controller restrictor: Taxonomy controler 
 * NEW - content brick has 2 more options.. show the content "above the more tag", and content "below the more tag"
 * CHANGE - the post types are not automatically populated, a simple input is used instead
 * .. plus code fixes

= 0.5.2 =
 * Controls some control bricks are repeatable - If they can or cannot is defined in the item array
 * The code is cleaned a bit
 * jQuery is bit polished
 
= 0.5.1 =
 * NEW - the full size of the image was misisng in the list of available image sizes, Now the list is complete. btw.. it reads all the registred image sizes automatically :)

= 0.5 =
 * NEW - Many new view blocks (shortcode, text, meta, comments number, comments)
 * NEW - All blocks have class input (if "necessary")
 * NEW - new control blocks (offset, category, post_status)
 * FIX - Control are not rewriting the query args, but adds new, as it supposed to
 * FIX - Values from checkboxes do not causes problem anymore
 * ...
    
= 0.4 =
 * NEW - all bricks can have multi input (select box, texarea, check box) -- hidden input, and radio in next release
 * the EasyItem array structure changed a bit
 * there are some more bricks generally
 * the brain fu.. is behind me, from now on.. everything will be just fun to add :)
 * more in next release..
 
