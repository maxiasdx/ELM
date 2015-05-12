<?php

/**
 * Add body classes if certain regions have content.
 */
function employmentlaw_preprocess_html(&$variables) {
	
	$options = array(
    'group' => JS_THEME,
	);
	drupal_add_js(drupal_get_path('theme', 'employmentlaw'). '/js/jquery.min.js', $options);
	drupal_add_js(drupal_get_path('theme', 'employmentlaw'). '/js/home_custom.js', $options);
  
  if (!empty($variables['page']['featured'])) {
    $variables['classes_array'][] = 'featured';
  }
  
  if (!empty($variables['page']['top_search'])){
    $variables['classes_array'][] = 'top_search';
  }
    
  if (!empty($variables['page']['footer_firstcolumn'])){
    $variables['classes_array'][] = 'footer_firstcolumn';
  }
  
  if (!empty($variables['page']['footer_secondcolumn'])){
	  $variables['classes_array'][] = 'footer_secondcolumn';
  }
    if (!empty($variables['page']['footer_thirdcolumn'])){
		$variables['classes_array'][] = 'footer_thirdcolumn';
  }
    if (!empty($variables['page']['footer_fourthcolumn'])){
		$variables['classes_array'][] = 'footer_fourthcolumn';
  }
    if (!empty($variables['page']['footer_fifthcolumn'])){
		$variables['classes_array'][] = 'footer_fifthcolumn';
  }
  
  if (!empty($variables['page']['footer_copyright'])) {
    $variables['classes_array'][] = 'footer_copyright';
  }
  
  if (!empty($variables['page']['related_articles'])) {
    $variables['classes_array'][] = 'related_articles';
  }  

  // Add conditional stylesheets for IE
  drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
  drupal_add_css(path_to_theme() . '/css/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 'preprocess' => FALSE));
}

function node_sibling($dir = 'next', $node, $next_node_text=NULL, $prepend_text=NULL, $append_text=NULL, $tid = FALSE){
  if($tid){
    $query = 'SELECT n.nid, n.title FROM {node} n INNER JOIN {term_node} tn ON n.nid=tn.nid WHERE '
           . 'n.nid ' . ($dir == 'previous' ? '<' : '>') . ' :nid AND n.type = :type AND n.status=1 '
           . 'AND tn.tid = :tid ORDER BY n.nid ' . ($dir == 'previous' ? 'DESC' : 'ASC');
    //use fetchObject to fetch a single row  
    $row = db_query($query, array(':nid' => $node->nid, ':type' => $node->type, ':tid' => $tid))->fetchObject();
  }else{
    $query = 'SELECT n.nid, n.title FROM {node} n WHERE '
           . 'n.nid ' . ($dir == 'previous' ? '<' : '>') . ' :nid AND n.type = :type AND n.status=1 '
           . 'ORDER BY n.nid ' . ($dir == 'previous' ? 'DESC' : 'ASC');
    //use fetchObject to fetch a single row      
    $row = db_query($query, array(':nid' => $node->nid, ':type' => $node->type))->fetchObject();
  }
  if(
$row) {     
    $text = $next_node_text ? $next_node_text : $row->title;
    return $prepend_text . l($text, 'node/'.$row->nid, array('rel' => $dir)) . $append_text;
  } else {
      return FALSE;
  }
}

function taxonomy_select_enodes($tid, $pager = TRUE, $limit = FALSE, $order = array('t.sticky' => 'DESC', 'event_date.event_calendar_date_value' => 'DESC')) {
  if (!variable_get('taxonomy_maintain_index_table', TRUE)) {
    return array();
  }
  
  $query = db_select('taxonomy_index', 't');
  
  $query->join('field_data_event_calendar_date', 'event_date', 't.nid = event_date.entity_id');
  
  $query->addTag('node_access');
  $query->condition('tid', $tid);
  if ($pager) {
    $count_query = clone $query;
    $count_query->addExpression('COUNT(t.nid)');

    $query = $query->extend('PagerDefault');
    if ($limit !== FALSE) {
      $query = $query->limit($limit);
    }
    $query->setCountQuery($count_query);
  }
  else {
    if ($limit !== FALSE) {
      $query->range(0, $limit);
    }
  }
  $query->addField('t', 'nid');
  $query->addField('t', 'tid');
  
  
  
  foreach ($order as $field => $direction) {
    $query->orderBy($field, $direction);
    // ORDER BY fields need to be loaded too, assume they are in the form
    // table_alias.name
    list($table_alias, $name) = explode('.', $field);
    $query->addField($table_alias, $name);
  }
  
  return $query->execute()->fetchCol();
}

function event_node_sibling($dir = 'next', $node, $next_node_text=NULL, $prepend_text=NULL, $append_text=NULL, $tid = FALSE){
  if($tid){
    $query = 'SELECT n.nid, n.title FROM {node} n INNER JOIN {term_node} tn ON n.nid=tn.nid WHERE '
           . 'n.nid ' . ($dir == 'previous' ? '<' : '>') . ' :nid AND n.type = :type AND n.status=1 '
           . 'AND tn.tid = :tid ORDER BY n.nid ' . ($dir == 'previous' ? 'DESC' : 'ASC');
    //use fetchObject to fetch a single row  
    $row = db_query($query, array(':nid' => $node->nid, ':type' => $node->type, ':tid' => $tid))->fetchObject();
  }else{
    $query = 'SELECT n.nid, n.title FROM {node} n WHERE '
           . 'n.nid ' . ($dir == 'previous' ? '<' : '>') . ' :nid AND n.type = :type AND n.status=1 '
           . 'ORDER BY n.nid ' . ($dir == 'previous' ? 'DESC' : 'ASC');
    //use fetchObject to fetch a single row      
    $row = db_query($query, array(':nid' => $node->nid, ':type' => $node->type))->fetchObject();
  }
  
  if($row) {     
    $text = $next_node_text ? $next_node_text : $row->title;
    return $prepend_text . l($text, 'node/'.$row->nid, array('rel' => $dir)) . $append_text;
  } else {
      return FALSE;
  }
}

function employmentlaw_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Adding the title of the current page to the breadcrumb.
    $breadcrumb[] = drupal_get_title();
    
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<span class="urhere">' . t('You are here') . '</span>';
	
	
	$breadcrumbarr = implode(' > ', $breadcrumb);
    $output .= '<span> ' . implode(' > ', $breadcrumb) . '</span>';
	
    return $output;
  }
}

function employmentlaw_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    $form['search_block_form']['#size'] = 40;  // define size of the textfield
    $form['search_block_form']['#default_value'] = t(''); // Set a default value for the textfield
    $form['actions']['submit']['#value'] = t('GO!'); // Change the text on the submit button
    $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/magglass.png');

    // Add extra attributes to the text box
    //$form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = 'Search Site...';}";
    //$form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Search Site...') {this.value = '';}";
    // Prevent user from searching the default text
    $form['#attributes']['onsubmit'] = "if(this.search_block_form.value==''){ alert('Please enter a search'); return false; }";

    // Alternative (HTML5) placeholder attribute instead of using the javascript
    $form['search_block_form']['#attributes']['placeholder'] = t('Search Site...');
  }
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function employmentlaw_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function employmentlaw_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
  // Since the title and the shortcut link are both block level elements,
  // positioning them next to each other is much simpler with a wrapper div.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
    // Add a wrapper div using the title_prefix and title_suffix render elements.
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }
}

/**
 * Override or insert variables into the node template.
 */
function employmentlaw_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
  
  // Get a list of all the regions for this theme
  foreach (system_region_list($GLOBALS['theme']) as $region_key => $region_name) {

    // Get the content for each region and add it to the $region variable
    if ($blocks = block_get_blocks_by_region($region_key)) {
      $variables['region'][$region_key] = $blocks;
    }
    else {
      $variables['region'][$region_key] = array();
    }
  }
  
}

/**
 * Override or insert variables into the block template.
 */
function employmentlaw_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Implements theme_menu_tree().
 */
function employmentlaw_menu_tree($variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}

function employmentlaw_menu_link(array $variables) {
  $element = $variables ['element'];
  $sub_menu = '';

  if ($element ['#below']) {
    $sub_menu = drupal_render($element ['#below']);
  }
  $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
  return '<li' . drupal_attributes($element ['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implements theme_field__field_type().
 */
function employmentlaw_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

  return $output;
}
