<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// JLoader::import('joomla.filesystem.file');
// $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/jquery-ui.min.css', $type = 'text/css', $media = 'screen,projection');
// $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/jquery-ui.structure.min.css', $type = 'text/css', $media = 'screen,projection');
// $doc->addStyleSheet(JUri::base() . 'templates/' . $this->template . '/css/jquery-ui.theme.min.css', $type = 'text/css', $media = 'screen,projection');
// $doc->addScript(JUri::base() . '/templates/' . $this->template . '/javascript/jquery-ui.min.js', 'text/javascript');

//$deviceCode = JUtility::getDeviceCode();


?>

<script type="text/javascript">
// function iEsc(){ return false; }
// function iRec(){ return true; }
// function DisableKeys() {
// if(event.ctrlKey || event.shiftKey || event.altKey) {
// window.event.returnValue=false;
// iEsc();}
// }
// document.ondragstart=iEsc;
// document.onkeydown=DisableKeys;
// document.oncontextmenu=iEsc;
// if (typeof document.onselectstart !="undefined")
// document.onselectstart=iEsc;
// else{
// document.onmousedown=iEsc;
// document.onmouseup=iRec;
// }
// function DisableRightClick(qsyzDOTnet){
// if (window.Event){
// if (qsyzDOTnet.which == 2 || qsyzDOTnet.which == 3)
// iEsc();}
// else
// if (event.button == 2 || event.button == 3){
// event.cancelBubble = true
// event.returnValue = false;
// iEsc();}
// }
</script>
<script src="<?php echo $this->baseurl; ?>/templates/beez3/javascript/jquery.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/beez3/javascript/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript">
  	jQuery(document).ready(function(){
		var linkElement = document.createElement("link");
		linkElement.rel = "stylesheet";
		linkElement.href = "/templates/beez3/css/jquery-ui.css"; //Replace here
		document.head.appendChild(linkElement);

		var linkElement2 = document.createElement("link");
		linkElement2.rel = "stylesheet";
		linkElement2.href = "/templates/beez3/css/jquery-ui.structure.css"; //Replace here
		document.head.appendChild(linkElement2);

		var linkElement3 = document.createElement("link");
		linkElement3.rel = "stylesheet";
		linkElement3.href = "/templates/beez3/css/jquery-ui.theme.css"; //Replace here
		document.head.appendChild(linkElement3);
		
      	jQuery("article > h2").css("font-family","Arial, Helvetica, sans-serif, '微軟正黑體'");
		jQuery( "#accordion" ).accordion({
		  	collapsible: true,
          	active: false,
          	heightStyle: "content",
          	create: function( event, ui ) { 
              jQuery(".faq-wrapper").css("display","block");
              jQuery("article > h2").css("display","block");
            }
		});
	});
</script>
<div class="category-module">

</div>

<div class="faq-wrapper" style="height:auto;font-family: Arial, Helvetica, sans-serif,'微軟正黑體'!important; display:none;">
	<div id="accordion" style="font-family: Arial, Helvetica, sans-serif,'微軟正黑體'!important;">
		<?php foreach ($list as $item) : ?>
			<h3>
			  <span class="faq-underline" style="font-family: Arial, Helvetica, sans-serif,'微軟正黑體'!important; color:red; font-size: 1em;" ><?php echo $item->title;  ?></span>
			</h3>
			<div style="height:auto;">
				<?php echo $item->introtext; ?>
			</div>
		<?php endforeach; ?>
	</div>
 <div>
   
  
   
</div>
