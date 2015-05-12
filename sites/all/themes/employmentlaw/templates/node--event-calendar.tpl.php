<?php
error_reporting(0);
/**
 * @file
 * Bartik's theme implementation to display a node.
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
drupal_add_css(path_to_theme() . '/css/tribe-events-full.min.css', array('group' => CSS_THEME,'preprocess' => FALSE));
drupal_add_css(path_to_theme() . '/css/tribe-events-theme.min.css', array('group' => CSS_THEME,'preprocess' => FALSE));
 

if(count($node->event_calendar_date)!=0){
	$eventS = date('F j',strtotime($node->event_calendar_date[$node->language][0]['value']));
	$eventE = date('F j',strtotime($node->event_calendar_date[$node->language][0]['value2']));
	$calendarDate1 = date('Ymd',strtotime($node->event_calendar_date[$node->language][0]['value']));
	$calendarDate2 = date('Ymd',strtotime($node->event_calendar_date[$node->language][0]['value2']));
	$calendarDate11 = date('Y-m-d',strtotime($node->event_calendar_date[$node->language][0]['value']));
	$calendarDate12 = date('Y-m-d',strtotime($node->event_calendar_date[$node->language][0]['value2']));
}

//for image

if(isset($node->field_event_image[$node->language][0]['uri'])){
	$style = 'medium';
	$filePath = $node->field_event_image[$node->language][0]['uri'];
	$imageSrc = image_style_url($style, $filePath);
}else
{
	$imageSrc = base_path().path_to_theme().'/images/default.jpg';
}
if($node->body){
	$Description = $node->body[$node->language][0]['value'];
	$Description = strip_tags($Description, '');
}

if(count($node->field_organizer_name)!=0){
	$field_organizer_name = $node->field_organizer_name[$node->language][0]['value'];
}

if(count($node->field_organizer_website)!=0){
	$field_organizer_website = $node->field_organizer_website[$node->language][0]['value'];
}

 if(count($node->field_venue_website)!=0){
	$field_venue_website = $node->field_venue_website[$node->language][0]['value'];
}

?>

<div id="tribe-events" class="tribe-events-single vevent hentry">
  <p class="tribe-events-back"><a href="http://systemsjunctiondemo.com/employmentlaw/events"> « All Events</a></p>
  <!-- Notices --> 
  <?php print render($title_prefix); ?>
  <?php if ($page): ?>
  <h2 class="tribe-events-single-event-title summary entry-title"><?php print $title; ?></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <div id="node-<?php print $node->nid; ?>" class="single-tribe_events <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <div class="content clearfix"<?php print $content_attributes; ?>>
      <div class="tribe-events-schedule updated published tribe-clearfix">
        <h3><span class="date-start dtstart">
          <?php if(count($node->event_calendar_date)!=0) print $eventS; ?>
          <span class="value-title" title="<?php if(count($node->event_calendar_date)!=0) echo $calendarDate11; ?>"></span></span> - <span class="date-end dtend">
          <?php if(count($node->event_calendar_date)!=0) print $eventE; ?>
          <span class="value-title" title="<?php if(count($node->event_calendar_date)!=0) echo $calendarDate12; ?>"></span></span></h3>
      </div>
      <div class="tribe-events-event-image"><img src="<?php if(isset($imageSrc)) echo $imageSrc; ?>" title="<?php print $title; ?>"></div>
      <div class="tribe-events-single-event-description tribe-events-content entry-content description">
        <p><span style="color: #404040;">
          <?php if(isset($Description)) echo $Description;?>
          </span></p>
        <a href="mailto:info@aventedge.com?bcc=" class="tribe-events-gcal tribe-events-button">Enquire Now</a> </div>
      <div class="tribe-events-cal-links"><a class="tribe-events-gcal tribe-events-button" href="http://www.google.com/calendar/event?action=TEMPLATE&amp;text=<?php if(isset($title)) print $title; ?>&amp;dates=<?php if(count($node->event_calendar_date)!=0) print $calendarDate1; ?>/<?php if(count($node->event_calendar_date)!=0) print $calendarDate2; ?>&amp;details=<?php if(count($node->event_calendar_date)!=0) print $Description; ?>&amp;location&amp;sprop=website:http://systemsjunctiondemo.com/employmentlawmatters&amp;trp=false" title="Add to Google Calendar">+ Google Calendar</a><a class="tribe-events-ical tribe-events-button" href="http://systemsjunctiondemo.com/employmentlawmatters/events/?ical=1">+ iCal Import</a></div>
      <div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
        <div class="tribe-events-meta-group tribe-events-meta-group-details">
          <h3 class="tribe-events-single-section-title"> Details </h3>
          <dl>
            <dt> Start: </dt>
            <dd> <abbr class="tribe-events-abbr updated published dtstart" title="<?php if(count($node->event_calendar_date)!=0) print $calendarDate11; ?>">
              <?php if(count($node->event_calendar_date)!=0) print $eventS; ?>
              </abbr> </dd>
            <dt> End: </dt>
            <dd> <abbr class="tribe-events-abbr dtend" title="<?php if(isset($calendarDate12)) print $calendarDate12; ?>">
              <?php if(count($node->event_calendar_date)!=0) print $eventE; ?>
              </abbr> </dd>
            <dt> Website: </dt>
            <dd class="tribe-events-event-url"> <a href="<?php if(count($node->field_venue_website)!=0) print $field_venue_website?>" target="self">
              <?php if(count($node->field_venue_website)!=0) print $field_venue_website?>
              </a> </dd>
          </dl>
        </div>
        <div class="tribe-events-meta-group tribe-events-meta-group-organizer">
          <h3 class="tribe-events-single-section-title"> Organizer </h3>
          <dl>
            <dd class="fn org">
              <?php if(count($node->field_organizer_name)!=0) print $field_organizer_name;?>
            </dd>
            <dt> Website: </dt>
            <dd class="url"> <a href="<?php if(count($node->field_organizer_website)!=0) print $field_organizer_website?>" target="self">
              <?php if(count($node->field_organizer_website)!=0) print $field_organizer_website?>
              </a> </dd>
          </dl>
        </div>
      </div>
      <?php
      //print render($content);
    ?>
    </div>
  </div>
  <div id="tribe-events-footer"> 
      <!-- Navigation --> 
    <!-- Navigation -->
    <h3 class="tribe-events-visuallyhidden">Event Navigation</h3>
  <?php 
if ($page){?>
<?php 
	$next = event_node_sibling('next',$node,NULL,NULL,'<span> »</span>',FALSE); 
	$previous = event_node_sibling('previous',$node,NULL,'<span>« </span>',NULL,FALSE); 
	?>
   <ul class="tribe-events-sub-nav">
	<?php
	if($previous){?>
      <li class="tribe-events-nav-previous">
      <?php print $previous;?></li>
<?php } if($next){?>
      <li class="tribe-events-nav-next">
      <?php print $next; ?></li>
    <?php } ?>
        </ul>
    <!-- .tribe-events-sub-nav -->
<?php } ?>

  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('#block-views-calendar-block-1').remove();
$('#block-views-archiven-block').remove();
$('#block-widgets-s-calender').remove();
$('#block-views-featured-events-block').remove();

$('#main').css('width','812px');
$('.main_cnt').css('width','815px');

$('#sidebar-second').css('width','auto');
});
</script>
<?php 
//echo '<pre>';
//print_r($node);
//die;?>
