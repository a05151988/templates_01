<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.strapped
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		3.0
 */
 
// no direct access
defined('_JEXEC') or die;

// get important objects
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu 	= $app->getMenu();
$lang 	= JFactory::getLanguage();
// Add current user information
$user = JFactory::getUser();
// getting User ID
$userID = $user->get('id');

// get the option and view value
$option = JRequest::getCmd('option');
$view = JRequest::getCmd('view');
$ItemId = JRequest::getCmd('Itemid');
$sidebarOverride = json_decode($this->API->get('sidebar_override', ''));
$sidebarRules = array();
if (empty($sidebarRules)) {
	if(isset($sidebarOverride)){
		foreach($sidebarOverride as $rule => $obj) {
			$sidebarRules[$obj->option] = $obj;
		}
	}
}

// defines if com_users
define('GK_COM_USERS', $option == 'com_users' && ($view == 'login' || $view == 'registration'));

$current_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$current_url = preg_replace('@%[0-9A-Fa-f]{1,2}@mi', '', htmlspecialchars($current_url, ENT_QUOTES, 'UTF-8'));

// username-less login
if($this->API->get('usernameless_login', 0)) {
	if(
		$user->id != 0 && 
		(!isset($_COOKIE['gkusernameless']) || $_COOKIE['gkusernameless'] != md5(strtolower(trim($user->email))) . ',' . $user->name . ',' . $user->username)
	) {
		setcookie('gkusernameless', md5(strtolower(trim($user->email))) . ',' . $user->name . ',' . $user->username, time()+60*60*24*365, '/');
	}
}
// Adjusting content width
$span = 12;
if(isset($sidebarRules[$option]) || isset($sidebarRules[$ItemId])) {
	if(isset($sidebarRules[$ItemId])) {
		if($sidebarRules[$ItemId]->position == 'left') {
			$this->API->addCSSRule('#gk-content { float: right} #sidebar { margin: 0 1.418438719% 0 0}');
		}
		$sidebar_width = str_replace('span', '', $sidebarRules[$ItemId]->width);
	} else {
		if($sidebarRules[$option]->position == 'left') {
			$this->API->addCSSRule('#gk-content { float: right} #sidebar { margin: 0 1.418438719% 0 0}');
		}
		$sidebar_width = str_replace('span', '', $sidebarRules[$option]->width);
	}
} else {
	if(isset($this->layout->manager['sidebar']) && $this->layout->manager['sidebar']->float == 'left') {
		$this->API->addCSSRule('#gk-content { float: right} #sidebar { margin: 0 1.418438719% 0 0}');
		$sidebar_width = str_replace('span', '', $this->layout->manager['sidebar']->width);
	}
}
if ($this->API->modules('sidebar')) {
	$span = 12 - $sidebar_width;
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->APITPL->language; ?>" prefix="og: http://ogp.me/ns#">
<head>
	<?php if($this->browser->get('browser') == 'ie8' || $this->browser->get('browser') == 'ie7' || $this->browser->get('browser') == 'ie6') : ?>
	<meta http-equiv="X-UA-Compatible" content="IE=9">
	<?php endif; ?>
	<?php if($this->API->get("chrome_frame_support", '0') == '1' && ($this->browser->get('browser') == 'ie8' || $this->browser->get('browser') == 'ie7' || $this->browser->get('browser') == 'ie6')) : ?>
	<meta http-equiv="X-UA-Compatible" content="chrome=1"/>
	<?php endif; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="<?php echo $this->API->URLtemplate();?>/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">jQuery.noConflict();</script>
    <script type="text/javascript" src="<?php echo $this->API->URLbase(); ?>media/system/js/mootools-core.js"></script>
	<jdoc:include type="head" />
	<?php $this->layout->loadBlock('head'); ?>
	<?php $this->layout->loadBlock('cookielaw'); ?>
</head>

<body<?php if($this->browser->get("tablet") == true) echo ' data-tablet="true"'; ?><?php if($this->browser->get("mobile") == true) echo ' data-mobile="true"'; ?>>
	<header class="row">
		<?php $this->layout->loadBlock('logo'); ?>
		<div class="header-right">
			<jdoc:include type="modules" name="mod_whosonline" style="none" />
			<jdoc:include type="modules" name="mod_stat" style="none" />
		</div>
		<div></div>
	</header>
	<section class="menu-section row">
		<?php if((($userID == 0) || $this->API->modules('login')) && !GK_COM_USERS) : ?>
		<div id="gk-user-area">
			<?php if($this->API->modules('login')) : ?>
			<a href="#loginModal" role="button" data-toggle="modal"><?php echo ($userID == 0) ? JText::_('TPL_GK_LANG_LOGIN') : $user->get('username'); ?></a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		
		<div class="gk-mainmenu-toggle">
			<a href="#" data-toggle="collapse" data-target=".nav-collapse">
				<?php echo JText::_('TPL_GK_LANG_MAINMENU'); ?>
			</a>
		</div>
		
		<div class="nav-collapse collapse gk-main-menu">
			<jdoc:include type="modules" name="menu" style="none" />
		</div>
	</section>
	<?php if($this->API->modules('header')) : ?>
	<section id="gk-header">
		<div class="container-fluid">
			<jdoc:include type="modules" name="header" style="none" />
		</div>
	</section>
	<?php endif; ?>

	<section id="gk-main">
		<section class="container-fluid">
			<?php if($this->API->modules('top')) : ?>
			<section id="gk-top" class="row-fluid">
				<jdoc:include type="modules" name="top" modpos="top" modnum="<?php echo $this->API->modules('top'); ?>" style="gk_style" settings="<?php echo htmlspecialchars(json_encode($this->layout->manager['top'])); ?>"/>	
			</section>
			<?php endif; ?>
			
			<section class="gk-content-wrap row-fluid">
				<section id="gk-content" class="<?php if ($this->API->modules('sidebar + search')): ?>span9<?php else: ?>span12<?php endif; ?>">
					<?php if($this->API->modules('breadcrumb')) : ?>
					<section id="gk-breadcrumb">
						<jdoc:include type="modules" name="breadcrumb" style="none" modules="<?php if(isset($this->layout->manager['breadcrumb'])) $this->layout->manager['breadcrumb']; ?>" />
					</section>
					<?php endif; ?>
					
					<?php if($this->API->modules('mainbody_top')) : ?>
					<section id="gk-mainbody-top">
						<jdoc:include type="modules" name="mainbody_top" style="gk_style" modpos="mainbody_top" modnum="<?php echo $this->API->modules('mainbody_top'); ?>" settings="<?php echo htmlspecialchars(json_encode($this->layout->manager['mainbody_top'])); ?>"/>
					</section>
					
					<?php endif; ?>
					<?php if(count($app->getMessageQueue())) : ?>
					<div class="container-fluid gk-message">
						<jdoc:include type="message" />
					</div>
					<?php endif; ?>
					<?php if($this->layout->isFrontpage() && $this->API->modules('mainbody')) : ?>
					<section id="gk-mainbody">
						<jdoc:include type="modules" name="mainbody" style="gk_style" />
					</section>
					<?php else : ?>
					<section id="gk-component">
						<jdoc:include type="component" />
					</section>
					<?php endif; ?>
					<section class="span12">
						<?php if($this->layout->isFrontpage() && $this->API->modules('mainbody-left')) : ?>
						<section id="gk-mainbody-left" class="span6">
							<jdoc:include type="modules" name="mainbody-left" style="gk_style" />
						</section>
						<?php endif; ?>
						<?php if($this->layout->isFrontpage() && $this->API->modules('mainbody-right')) : ?>
						<section id="gk-mainbody-right" class="span6">
							<jdoc:include type="modules" name="mainbody-right" style="gk_style" />
						</section>
						<?php endif; ?>
					</section>
					<?php if($this->API->modules('mainbody_bottom')) : ?>
					<section id="gk-mainbody-bottom">
						<jdoc:include type="modules" name="mainbody_bottom" modpos="mainbody_bottom" style="gk_style" modnum="<?php echo $this->API->modules('mainbody_bottom'); ?>" settings="<?php echo htmlspecialchars(json_encode($this->layout->manager['mainbody_bottom'])); ?>"/>	
					</section>
					<?php endif; ?>
				</section>
				
				<?php if ($this->API->modules('sidebar + search')): ?>
				<aside id="sidebar" class="span3">
					<?php if ($this->API->modules('search')): ?>	
					<div class="sidebar-search">
						<jdoc:include type="modules" name="search" style="gk_style"/>
					</div>
					<?php endif; ?>
					
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="sidebar" style="gk_style" />
					</div>
				</aside>
				<?php endif; ?>
			</section>
			<?php if($this->API->modules('bottom')) : ?>
			<section id="gk-bottom">
				<jdoc:include type="modules" name="bottom" modpos="bottom" modnum="<?php echo $this->API->modules('bottom'); ?>" style="gk_style" settings="<?php echo htmlspecialchars(json_encode($this->layout->manager['bottom'])); ?>"/>
			</section>
			<?php endif; ?>
		</section>
	</section>
	
	<footer class="row">
		<?php if($this->API->modules('footer')) : ?>
		<div class="container-fluid">
			<jdoc:include type="modules" name="footer" modpos="footer" style="none" modnum="<?php echo $this->API->modules('footer'); ?>" settings="<?php echo htmlspecialchars(json_encode($this->layout->manager['footer'])); ?>"/>
		</div>
		<?php endif; ?>
	</footer>
		
	<?php if($this->API->modules('social')) : ?>
	<div id="gk-social-icons" class="<?php echo $this->API->get('social_pos', 'left'); ?>">
		<jdoc:include type="modules" name="social" style="none" />
	</div>
	<?php endif; ?>
	
	<script type="text/javascript">
		jQuery('*[rel=tooltip]').tooltip();
		jQuery('*[rel=popover]').popover();
		jQuery('.tip-bottom').tooltip({placement: "bottom"});
	</script>
	
	<?php $this->layout->loadBlock('social'); ?>
	<?php $this->layout->loadBlock('tools/login'); ?>
	<jdoc:include type="modules" name="debug" style="none" />
	<div id="goto-top"><i class="fa fa-arrow-up fa-fw"></i>&nbsp;<?php echo JText::_('JTEMPLATE_GOTOTOP'); ?></div>
</body>
</html>
<?php

// Rules to remove predefined jQuery and Bootstrap and MooTools More
GKParser::$customRules['/<script src="(.*?)media\/jui\/js\/jquery.min.js" type="text\/javascript"><\/script>/mi'] = '';
GKParser::$customRules['/<script src="(.*?)media\/jui\/js\/jquery-noconflict.js" type="text\/javascript"><\/script>/mi'] = '';
GKParser::$customRules['/<script src="(.*?)media\/jui\/js\/bootstrap.min.js" type="text\/javascript"><\/script>/mi'] = '';
//GKParser::$customRules['/<script src="(.*?)media\/system\/js\/mootools-more.js" type="text\/javascript"><\/script>/mi'] = '';

// EOF