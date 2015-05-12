<?php

/**
 * @file
 * Employment Law's theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
 
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  
 <!--  <?php 
if ($page){
  if ($node->type=='article'){?>
  <div id="nextPrevPosts">
<?php 
	$next = node_sibling('next',$node,'← PREVIOUS ARTICLE',NULL,NULL,FALSE); 
	$previous = node_sibling('previous',$node,'NEXT ARTICLE →',NULL,NULL,FALSE); 
	if($previous){?>
    <p class="alignright"><?php print $previous;?></p>
<?php } if($next){?>
    <p><?php print $next; ?></p>
    <div class="clear"></div>
    <?php } ?>
  </div> 
 
<?php } 
} ?>
end nextPrevPosts-->
 
  <?php print render($title_prefix); ?>
  <?php if ($page){ ?>
  <h1<?php print $title_attributes; ?> class="posttitleD"> <?php print $node->title; ?></h1>
  <?php }else{ ?>
    <h2<?php print $title_attributes; ?> class="posttitle"> <a href="<?php print $node_url; ?>"><?php print $title; ?></a> </h2>
    
  <?php } print render($title_suffix); ?>
  
  <?php if ($display_submitted): ?>
  <p class="metaStuff <?php echo $node->type; ?>"> <?php print $user_picture; ?> <?php print $submitted; ?>&nbsp; 
  <?php
  $catarr = $node->field_categories[$node->language];
  $numItems = count($catarr);
  $i = 0;
   foreach ($catarr as $key=>$catval){
	   if(isset($catval['taxonomy_term'])){
		   $source = 'taxonomy/term/'.$catval['taxonomy_term']->tid;
		   $alias = db_query('SELECT alias FROM {url_alias} WHERE source = :source',array(':source' => $source))->fetchField();
	 print_r('<a href="'.$alias.'" title="View all posts in '.$catval['taxonomy_term']->name.'" rel="category tag">'.$catval['taxonomy_term']->name.'</a>  ');
	   if(++$i !== $numItems) {
			echo ", ";
		  }
	   }
 }
  ?> </p>
  <?php endif; ?>
  
  <div class="content clearfix"<?php print $content_attributes; ?>>
    <?php 
	if ($page){
	if ($node->type=='article'){?>
    <div class="socialButton" id="facebookLike">
      <div id="fb-root"></div>
      <fb:like href="<?php echo $GLOBALS['base_url'].base_path().drupal_get_path_alias(); ?>" send="true" width="450" height="21" show_faces="true" action="like" colorscheme="light"></fb:like>
    </div>
    <?php } } ?>
    <?php
	
		// Only display the wrapper div if there are links...
		//echo '<pre>';
		//print_r($content['field_image']);
		//die;
		if ($page){
			if ($node->type=='article'){
				unset($content['field_image']);
			}
		}
		
		print render($content);
    ?>
    <?php
	// Only display the wrapper div if there are links.
	$links = render($content['links']);
	if ($links):
	?>
    <a class="readMore" href="<?php print $node_url; ?>">Read More →</a>
    <!--<div class="readMore"><?php //print $links; ?> </div>-->
    <?php endif; ?>
    
    <div class="clear"></div>
    
<?php if ($page){ 
	if ($node->type=='article'){?>
    <div id="shareThis"> <span class="st_sharethis" displayText="Share"></span><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script> &nbsp; <a href="javascript:window.print()" title="Print Article"><img src="<?php echo base_path().path_to_theme()?>/images/print.gif" alt="">&nbsp; Print</a> &nbsp;&nbsp;&nbsp; <a href="mailto:?subject=<?php print $title; ?>&amp;body=<?php echo $GLOBALS['base_url'].base_path().drupal_get_path_alias(); ?>" title="Email Article"><img src="<?php echo base_path().path_to_theme()?>/images/email.gif" alt="">&nbsp; Email</a> </div>
    <?php } } ?>
  </div>
  
  <?php if ($region['related_articles']){ ?>
  <div class="entry">
    <div style="margin-bottom:10px;"><b>You might also be interested in reading : </b></div>
    <div id="postExcerpt"> </div>
    <div class="related_topics" style="line-height:20px;"> <?php print render($region['related_articles']);?> <br class="clear"/>
    </div>
  </div>
  <?php }?>
</div>
<!--<div id="postExcerpt"></div>-->
