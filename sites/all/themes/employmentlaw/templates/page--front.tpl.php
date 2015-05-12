<?php



/**

 * @file

 * Employment Law's theme implementation to display a single Drupal page.

 *

 * The doctype, html, head and body tags are not in this template. Instead they

 * can be found in the html.tpl.php template normally located in the

 * modules/system directory.

 *

 * Available variables:

 *

 * General utility variables:

 * - $base_path: The base URL path of the Drupal installation. At the very

 *   least, this will always default to /.

 * - $directory: The directory the template is located in, e.g. modules/system

 *   or themes/bartik.

 * - $is_front: TRUE if the current page is the front page.

 * - $logged_in: TRUE if the user is registered and signed in.

 * - $is_admin: TRUE if the user has permission to access administration pages.

 *

 * Site identity:

 * - $front_page: The URL of the front page. Use this instead of $base_path,

 *   when linking to the front page. This includes the language domain or

 *   prefix.

 * - $logo: The path to the logo image, as defined in theme configuration.

 * - $site_name: The name of the site, empty when display has been disabled

 *   in theme settings.

 * - $site_slogan: The slogan of the site, empty when display has been disabled

 *   in theme settings.

 * - $hide_site_name: TRUE if the site name has been toggled off on the theme

 *   settings page. If hidden, the "element-invisible" class is added to make

 *   the site name visually hidden, but still accessible.

 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the

 *   theme settings page. If hidden, the "element-invisible" class is added to

 *   make the site slogan visually hidden, but still accessible.

 *

 * Navigation:

 * - $main_menu (array): An array containing the Main menu links for the

 *   site, if they have been configured.

 * - $secondary_menu (array): An array containing the Secondary menu links for

 *   the site, if they have been configured.

 * - $breadcrumb: The breadcrumb trail for the current page.

 *

 * Page content (in order of occurrence in the default page.tpl.php):

 * - $title_prefix (array): An array containing additional output populated by

 *   modules, intended to be displayed in front of the main title tag that

 *   appears in the template.

 * - $title: The page title, for use in the actual HTML content.

 * - $title_suffix (array): An array containing additional output populated by

 *   modules, intended to be displayed after the main title tag that appears in

 *   the template.

 * - $messages: HTML for status and error messages. Should be displayed

 *   prominently.

 * - $tabs (array): Tabs linking to any sub-pages beneath the current page

 *   (e.g., the view and edit tabs when displaying a node).

 * - $action_links (array): Actions local to the page, such as 'Add menu' on the

 *   menu administration interface.

 * - $feed_icons: A string of all feed icons for the current page.

 * - $node: The node object, if there is an automatically-loaded node

 *   associated with the page, and the node ID is the second argument

 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not

 *   comment/reply/12345).

 *

 * Regions:

 * - $page['header']: Items for the header region.

 * - $page['featured']: Items for the featured region.

 * - $page['highlighted']: Items for the highlighted content region.

 * - $page['help']: Dynamic help text, mostly for admin pages.

 * - $page['content']: The main content of the current page.

 * - $page['sidebar_first']: Items for the first sidebar.

 * - $page['sidebar_second']: Items for the second sidebar.

 * - $page['triptych_first']: Items for the first triptych.

 * - $page['triptych_middle']: Items for the middle triptych.

 * - $page['triptych_last']: Items for the last triptych.

 * - $page['footer_firstcolumn']: Items for the first footer column.

 * - $page['footer_secondcolumn']: Items for the second footer column.

 * - $page['footer_thirdcolumn']: Items for the third footer column.

 * - $page['footer_fourthcolumn']: Items for the fourth footer column.

 * - $page['footer']: Items for the footer region.

 *

 * @see template_preprocess()

 * @see template_preprocess_page()

 * @see template_process()

 * @see bartik_process_page()

 * @see html.tpl.php

 */

?>

 <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>



<div style="width:1150px;" id="wrapper">

  <div style="width:1150px;" id="content">

    <div style="width:1150px;" id="header" class="<?php print $secondary_menu ? 'with-secondary-menu': 'without-secondary-menu'; ?>">

      <div class="section clearfix">

        <div id="logoTagline">

          <?php if ($logo): ?>

          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo"> <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /> </a>

          <?php endif; ?>

          <!--end logo-->

          <?php if ($site_name || $site_slogan): ?>

          <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) { print ' class="element-invisible"'; } ?>>

            <?php if ($site_name): ?>

            <?php if ($title): ?>

            <div id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>> <strong> <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a> </strong> </div>

            <?php else: /* Use h1 when the content title is empty */ ?>

            <h1 id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>> <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a> </h1>

            <?php endif; ?>

            <?php endif; ?>

            <?php if ($site_slogan): ?>

            <div id="site-slogan"<?php if ($hide_site_slogan) { print ' class="element-invisible"'; } ?>> <?php print $site_slogan; ?> </div>

            <?php endif; ?>

          </div>

          <!-- /#name-and-slogan -->

          <?php endif; ?>

          <div class="advertising"> <a target="_blank" href="#">

            <?php	print '<img src="'.base_path().path_to_theme().'/images/animated-banner-600X100.gif">';?>

            </a> </div>

          <!--end advertisting--> 

          

        </div>

        <!-- search section -->

        <?php if ($page['top_search']){ 

			print render($page['top_search']);

		}?>

        <!-- search section --> 

        <?php print render($page['header']); ?>

        <?php if ($main_menu): ?>

        <div id="navigation" class="menu-main-container">

          <?php

			$menu_name = variable_get('menu_main_links_source', 'main-menu');

			$tree = menu_tree($menu_name);

			print render($tree);

		?>

          <!--<?php print theme('links__system_main_menu', array(

          'links' => $main_menu,

          'attributes' => array(

            'id' => 'dropmenu',

            'class' => array('menu'),

          ),

          'heading' => array(

            'text' => t('Main menu'),

            'level' => 'h2',

            'class' => array('element-invisible'),

          ),

        )); ?>--> 

        </div>

        <!-- /#main-menu -->

        <?php endif; ?>

      </div>

    </div>

    <!-- /.section, /#header -->

    

    <?php if ($messages): ?>

    <div id="messages">

      <div class="section clearfix"> <?php print $messages; ?> </div>

    </div>

    <!-- /.section, /#messages -->

    <?php endif; ?>

    <div id="content" class="clearfix">

      <div id="main" class="clearfix">

        <?php if ($breadcrumb): ?>

        <div id="crumbs"><div id="loading" style="display: none;">Loading...</div><?php print $breadcrumb; ?></div>

        <?php endif; ?>

        <?php if ($page['sidebar_first']): ?>

        <div id="sidebar-first" class="column sidebar">

          <div class="section"> 

		  <?php print render($page['sidebar_first']); ?> 

        </div>

        <!-- /.section, /#sidebar-first -->

        <?php endif; ?>

        <div id="content" class="column">

          <div class="section">

            <?php if ($page['highlighted']): ?>

            <div id="highlighted"><?php print render($page['highlighted']); ?></div>

            <?php endif; ?>

            

            <a id="main-content"></a> <?php print render($title_prefix); ?>

           <?php if (!$page): ?>

            <?php if ($title): ?>

            <h1 class="title" id="page-title"> <?php print $title; ?> </h1>

            <?php endif; ?>

            <?php endif; ?>

            <?php print render($title_suffix); ?>

            

            <?php if ($tabs): ?>

            <div class="tabs"> <?php print render($tabs); ?> </div>

            <?php endif; ?>

            <?php print render($page['help']); ?>

            <?php if ($action_links): ?>

            <ul class="action-links">

              <?php print render($action_links); ?>

            </ul>

            <?php endif; ?>

            <?php

			//check the home page...

			if (drupal_is_front_page()) {

			//for News category

			$categoryNArr = taxonomy_select_nodes($tid = 11, $pager = TRUE, $limit = 8, $order = array('t.sticky' => 'DESC', 't.created' => 'DESC'));

			

			//for Features category

			$categoryFArr = taxonomy_select_nodes($tid = 32, $pager = TRUE, $limit = 8, $order = array('t.sticky' => 'DESC', 't.created' => 'DESC'));

			?>

            <!--News-->

            <h2 class="catName" style="border-top:none"><a title="View All <?php echo 'News'; ?> Articles" href="<?php echo $GLOBALS['base_url'].'/news'; ?>"><?php echo 'News'; ?> <span>View All &rarr;</span></a></h2>

            <div class="cn_wrapper">

              <div class="cn_preview">

                <?php

			foreach($categoryNArr as $key=>$post){

				$posts = node_load($nid = NULL, $vid = $post, $reset = FALSE);

				

				$Description = $posts->body[$posts->language][0]['safe_value'];

				$Description = strip_tags($Description, '');

				//for image

				if(isset($posts->field_image[$posts->language][0]['uri'])){

					$style = 'medium';

					$filePath = $posts->field_image[$posts->language][0]['uri'];

					$imageSrc = image_style_url($style, $filePath);

				}else

				{

					$imageSrc = base_path().path_to_theme().'/images/default.jpg';

				}

				

				//get alias for URL

				$infoArr = path_load('node/'.$posts->vid);

				//print_r($infoArr);

				if(isset($infoArr['alias']))

				{

					$alias = $infoArr['alias'];

				}else

				{

					$alias = 'node/'.$posts->vid;

				}

				

				?>

                

                <div class="cn_content">

                  <h2><a href="<?php echo $GLOBALS['base_url'].'/'.$alias;?>"><?php echo substr(stripslashes($posts->title), 0, 150);?><?php //echo $posts->title;?></a></h2>

                  <a href="<?php echo $GLOBALS['base_url'].'/'.$alias;?>" title="<?php echo $posts->title;?>"> <img width="260" height="184" src="<?php echo $imageSrc; ?>" class="" alt="<?php echo $posts->title;?>"></a>

                  <p><?php echo substr(stripslashes($Description), 0, 500);?></p>

                  <a class="readMore" href="<?php echo $GLOBALS['base_url'].'/'.$alias;?>">Read More &rarr;</a> </div>

                <?php } ?>

              </div>

              <div class="cn_list"></div>

            </div>

            

            <!--Features-->

            <h2 class="catName"><a title="View All <?php echo 'Features'; ?> Articles" href="<?php echo $GLOBALS['base_url'].'/features'; ?>"><?php echo 'Features'; ?> <span>View All &rarr;</span></a></h2>

            <div class="cn_wrapper">

              <div class="cn_preview">

                <?php

			foreach($categoryFArr as $key=>$fpost){

				$fposts = node_load($nid = NULL, $vid = $fpost, $reset = FALSE);

				

				$Description = $fposts->body[$fposts->language][0]['value'];

				$Description = strip_tags($Description, '');

				

				//for image

				if(isset($fposts->field_image[$fposts->language][0]['uri'])){

					$Fstyle = 'medium';

					$fileFPath = $fposts->field_image[$fposts->language][0]['uri'];

					$FimageSrc = image_style_url($Fstyle, $fileFPath);

				}else

				{

					$FimageSrc = base_path().path_to_theme().'/images/default.jpg';

				}

				

				//get alias for URL

				$infoArr = path_load('node/'.$fposts->vid);

				if(isset($infoArr['alias']))

				{

					$alias = $infoArr['alias'];

				}else

				{

					$alias = 'node/'.$fposts->vid;

				}

				?>

                <div class="cn_content">

                  <h2><a href="<?php echo $GLOBALS['base_url'].'/'.$alias;?>"><?php echo substr(stripslashes($fposts->title), 0, 150);?><?php //echo $fposts->title;?></a></h2>

                  <a href="<?php echo $GLOBALS['base_url'].'/'.$alias;?>" title="<?php echo $fposts->title;?>"> <img width="260" height="184" src="<?php echo $FimageSrc; ?>" class="" alt="<?php echo $fposts->title;?>"></a>

                  <p><?php echo substr(stripslashes($Description), 0, 560);?></p>

                  <a class="readMore" href="<?php echo $GLOBALS['base_url'].'/'.$alias;?>">Read More &rarr;</a> </div>

                <?php } ?>

              </div>

              <div class="cn_list"></div>

            </div>

            <?php

			}else{

				//print render($page['content']);

			}

			?>

            <?php //print $feed_icons; ?>

          </div>

        </div>

        <!-- /.section, /#content -->

      </div>

      <!-- /#main, /#main-wrapper -->

      

      <?php if ($page['sidebar_second']): ?>

      <div id="sidebar-second" style="float:right;overflow:hidden;width: 546px;" class="column sidebar">

        <div class="section"> <?php print render($page['sidebar_second']); ?> 

          <?php

          //check the home page...

			if (!$is_front) { ?>

            <div id="block-views-featured-events-block">

                <h2>FEATURED EVENTS</h2>

                <?php

			//for FEATURED EVENTS category

			$categoryFEArr = taxonomy_select_nodes($tid = 46, $pager = TRUE, $limit = 3, $order = array('t.sticky' => 'DESC', 't.created' => 'DESC'));



				foreach($categoryFEArr as $key=>$fpost){

					$fposts = node_load($nid = NULL, $vid = $fpost, $reset = FALSE);

					

					$Description = $fposts->body[$fposts->language][0]['value'];

					$Description = strip_tags($Description, '');

					

					//for image

					if(isset($fposts->field_event_image[$fposts->language][0]['uri'])){

						$Fstyle = 'medium';

						$fileFPath = $fposts->field_event_image[$fposts->language][0]['uri'];

						$FimageSrc = image_style_url($Fstyle, $fileFPath);

					}else

					{

						$FimageSrc = base_path().path_to_theme().'/images/default.jpg';

					}

					

					//get alias for URL

					$infoArr = path_load('node/'.$fposts->vid);

					if(isset($infoArr['alias']))

					{

						$alias = $infoArr['alias'];

					}else

					{

						$alias = 'node/'.$fposts->vid;

					}

					?>

                    <div style="display: block;width: 100%;overflow: hidden;">

			<div style="padding: 20px 0 20px 15px;float: left;margin-right: 10px;"><img width="108" height="108" src="<?php echo $FimageSrc; ?>" class="" alt="<?php echo $fposts->title;?>"></div>

			<div style="display:block;float:left;padding-top:10px;width:410px;"><a href="<?php echo $GLOBALS['base_url'].'/'.$alias;?>" style="font-family:verdana;font-size:11px;color:#0a67b3;"><?php echo $fposts->title;?></a><br/><p style="font-family:verdana;font-size:11px;color:#555;"><?php //echo substr(stripslashes($Description), 0, 356);?></p></div>

		</div>

                    <?php

				}

				?>

                </div>

                <?php

			}//end of home cond

		  ?>

        </div>

      </div>

      <!-- /.section, /#sidebar-second -->

      <?php endif; ?>

    </div>

    <div id="footer">

      <hr style="display:block;width:95%;border-top:4px solid #055a97;border-bottom:0px;border-left:0px;border-right:0px;margin: 20px 25px;">

      <div id="footer_copyright_search">

        <?php if ($page['footer_copyright']): ?>

        <?php print render($page['footer_copyright']); ?>

        <?php endif; ?>

        

        <!-- search section -->

        <?php

		$block = module_invoke('search', 'block_view');

		 if ($block){ 

		 ?>

        <div class="footer_search"> <?php print render($block['content']);?> </div>

        <?php } ?>

        <!-- search section --> 

      </div>

      <?php 

		if ($page['footer_firstcolumn']){

			print render($page['footer_firstcolumn']);

		}

		if ($page['footer_secondcolumn']){ 

	      print render($page['footer_secondcolumn']);

		} 

		if ($page['footer_thirdcolumn']){

		  print render($page['footer_thirdcolumn']);

		} 

	    if ($page['footer_fourthcolumn']){

			 print render($page['footer_fourthcolumn']);

		} 

		if ($page['footer_fifthcolumn']){

			 print render($page['footer_fifthcolumn']);

		} 

		if ($page['footer']): ?>

      <div id="footer" class="clearfix"> <?php print render($page['footer']); ?> </div>

      <?php endif; ?>

      

      <!-- /#footer --> 

    </div>

    <!-- /.section, /#footer-wrapper --> 

    

  </div>

</div>

<!-- /#page, /#page-wrapper --> 

<script type="text/javascript">

$(document).ready(function(){

	$('#navigation > ul ').attr('id', 'dropmenu');

	$('#block-menu-menu-topic-areas > .content > ul ').attr('class', 'topic_areas_');

});

</script>