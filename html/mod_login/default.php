<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$templateParams = JFactory::getApplication()->getTemplate(true)->params;
JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');
?>
<div class="module_style">
	<div class="module_name"><?php echo JText::_('MOD_LOGIN_MODULE_NAME'); ?></div>
	<form action="<?php echo JRoute::_(JUri::current(), true, $params->get('usesecure')); ?>" method="post" id="login-form" class="form-inline">
		<?php if ($params->get('pretext')): ?>
			<div class="pretext">
			<p><?php echo $params->get('pretext'); ?></p>
			</div>
		<?php endif; ?>
		<div class="userdata">
			<?php if($templateParams->get('usernameless_login', 0) && isset($_COOKIE['gkusernameless'])) : ?>
				<?php 
					$cookie_content = JFilterInput::clean($_COOKIE['gkusernameless'], 'USERNAME');
					$userData = explode(',', $cookie_content);
				?>
				<div id="gkuserless" data-username="<?php echo $userData[2]; ?>">
					<img src="http://www.gravatar.com/avatar/<?php echo $userData[0]; ?>?s=64" alt="<?php echo $userData[1]; ?>" />
					<h3>Login as:</h3>
					<p><strong><?php echo $userData[1]; ?></strong> (<?php echo $userData[2]; ?>)</p>
					<a href="#not" id="gkwronguserless">Not <strong><?php echo $userData[1]; ?></strong>? Click to input your username &raquo;</a>
				</div>
			<?php endif; ?>
			<div id="form-login-username" class="control-group">
				<div class="controls">
					<label for="modlgn-username" id="username" class="element-invisible"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
					<a id="user_forget_acc"  href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>"><i class="fa fa-question fa-fw"></i>&nbsp;<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
					<input id="modlgn-username" type="text" name="username" class="input-small" tabindex="1" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
				</div>
			</div>
			<div id="form-login-password" class="control-group">
					<label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
					<a id="user_forget_pwd" href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>"><i class="fa fa-unlock fa-fw"></i>&nbsp;<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
					<input id="modlgn-passwd" type="password" name="password" class="input-small" tabindex="2" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
				</div>
			</div>
			<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
			<div id="form-login-remember" class="control-group checkbox">
				<label for="modlgn-remember" class="control-label"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label> <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
			</div>
			<?php endif; ?>
			<div id="form-login-submit" class="control-group">
				<div class="controls">
					<button type="submit" tabindex="3" name="Submit" class="btn"><i class="fa fa-lock fa-fw"></i><?php echo JText::_('JLOGIN') ?></button>
					<gavern:fblogin><span id="fb-auth" class="btn btn-primary"><i class="fa fa-facebook"></i><?php echo JText::_('TPL_GK_LANG_FB_LOGIN_TEXT'); ?></span><gavern:fblogin>
					<?php echo JHtml::_('form.token'); ?>
					<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>
					<?php if ($usersConfig->get('allowUserRegistration')) : ?>
						  <a id="user_register" class="btn" href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>"><i class="fa fa-user-plus fa-fw"></i>&nbsp;<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
					<?php endif; ?>	
				</div>
			</div>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.login" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
		</div>
		<?php if ($params->get('posttext')): ?>
			<div class="posttext">
			<p><?php echo $params->get('posttext'); ?></p>
			</div>
		<?php endif; ?>
	</form>
</div>
