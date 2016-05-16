<?php
/**
 * EBR - Easybook Reloaded for Joomla! 3.x
 * License: GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * Author: Viktor Vogel <admin@kubik-rubik.de>
 * Projectsite: http://joomla-extensions.kubik-rubik.de/ebr-easybook-reloaded
 *
 * @license GNU/GPL
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Restricted access');
echo '<!-- Easybook Reloaded - Joomla! 3.x - Kubik-Rubik Joomla! Extensions -->';

require_once(JPATH_COMPONENT.'/helpers/smilie.php');
JPluginHelper::importPlugin('captcha');
$dispatcher = JDispatcher::getInstance();
$dispatcher->trigger('onInit','recaptcha');
?>
<div id="easybook">
    <?php if($this->params->get('show_page_title', 1)) : ?>
        <h2 class="article_title"><?php echo $this->heading ?></h2>
    <?php endif; ?>
    <div class="easy_entrylink">
        <div class="view">
            <strong>
                <a class="view" href="<?php echo JRoute::_('index.php?option=com_easybookreloaded&view=easybookreloaded&gbid='.$this->_gbid); ?>" style="text-decoration: none !important;">
                    <button class="btn">
                        <i class="fa fa-book"></i>&nbsp;<?php echo JText::_('COM_EASYBOOKRELOADED_READ_GUESTBOOK'); ?>
                    </button>
                </a>
            </strong>
        </div>
        <form class="form-horizontal" name="gbookForm" action="<?php JRoute::_('index.php'); ?>" target="_top" method="post">
            <?php if($this->params->get('enable_log', true)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbip"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_IP_ADDRESS'); ?></label>
                    <div class="controls">
                        <input type="text" name="gbip" id="gbip" value="<?php echo $this->entry->ip; ?>" disabled="disabled" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_IP_ADDRESS'); ?>" />
                    </div>
                </div>
            <?php endif; ?>
            <div class="control-group">
                <label class="control-label" for="gbname"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_NAME'); ?> <span class="small">*</span></label>
                <div class="controls">
                    <?php if($this->user->guest == 1) : ?>
                        <input type="text" name="gbname" id="gbname" value="<?php echo $this->user->name; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_NAME'); ?>" disabled="disabled "/>
                    <?php elseif($this->user->guest == 0 AND !EASYBOOK_CANEDIT) : ?>
                        <input type="text" name="gbname" id="gbname" value="<?php echo $this->user->name; ?>" disabled="disabled" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_NAME'); ?>"/>
                    <?php elseif(EASYBOOK_CANEDIT) : ?>
                        <input type="text" name="gbname" id="gbname" value="<?php echo $this->user->name; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_NAME'); ?>" disabled="disabled" />
                    <?php endif; ?>
					<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->user->id; ?>"/>
                </div>
            </div>
            <?php if($this->params->get('show_mail', true) OR $this->params->get('require_mail', true)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbmail"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_EMAIL'); ?>
                        <?php if($this->params->get('require_mail', true)) : ?>
                            <span class="small">*</span>
                        <?php endif; ?>
                    </label>
                    <?php if($this->user->guest == 1) : ?>
                        <div class="controls">
                            <input type="text" name="gbmail" id="gbmail" value="<?php echo $this->entry->gbmail; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_EMAIL'); ?>" />
                        </div>
                    <?php elseif($this->user->guest == 0 AND !EASYBOOK_CANEDIT) : ?>
                        <div class="controls">
                            <input type="text" name="gbmail" id="gbmail" value="<?php echo $this->entry->gbmail; ?>" disabled="disabled" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_EMAIL'); ?>" />
                        </div>
                    <?php elseif(EASYBOOK_CANEDIT) : ?>
                        <div class="controls">
                            <input type="text" name="gbmail" id="gbmail" value="<?php echo $this->entry->gbmail; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_EMAIL'); ?>" />
                        </div>
                    <?php endif; ?>
                </div>
                <?php if(!$this->entry->id) : ?>
                    <div class="control-group">
                        <label class="control-label" for="gbmailshow"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_SHOW_EMAIL_IN_PUBLIC'); ?></label>
                        <div class="controls">
                            <input type="checkbox" name="gbmailshow" id="gbmailshow" value="1" />
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($this->params->get('show_loca', true)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbloca"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_LOCATION'); ?></label>
                    <div class="controls">
                        <input type="text" name="gbloca" id="gbloca" value="<?php echo $this->entry->gbloca; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_LOCATION'); ?>" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->params->get('show_home', true)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbpage"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_HOMEPAGE'); ?></label>
                    <div class="controls">
                        <input type="text" name="gbpage" id="gbpage" value="<?php echo $this->entry->gbpage; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_HOMEPAGE'); ?>" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->params->get('show_icq', false)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbicq"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_ICQ_NUMBER'); ?></label>
                    <div class="controls">
                        <input type="text" name="gbicq" id="gbicq" value="<?php echo $this->entry->gbicq; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_ICQ_NUMBER'); ?>" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->params->get('show_aim', false)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbaim"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_AIM_NICKNAME'); ?></label>
                    <div class="controls">
                        <input type="text" name="gbaim" id="gbaim" value="<?php echo $this->entry->gbaim; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_AIM_NICKNAME'); ?>" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->params->get('show_msn', false)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbmsn"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_MSN_MESSENGER'); ?></label>
                    <div class="controls">
                        <input type="text" name="gbmsn" id="gbmsn" value="<?php echo $this->entry->gbmsn; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_MSN_MESSENGER'); ?>" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->params->get('show_yah', false)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbyah"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_YAHOO_MESSENGER'); ?></label>
                    <div class="controls">
                        <input type="text" name="gbyah" id="gbyah" value="<?php echo $this->entry->gbyah; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_YAHOO_MESSENGER'); ?>" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->params->get('show_skype', false)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbskype"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_SKYPE_NICKNAME'); ?></label>
                    <div class="controls">
                        <input type="text" name="gbskype" id="gbskype" value="<?php echo $this->entry->gbskype; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_SKYPE_NICKNAME'); ?>" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->params->get('show_rating', true)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbvote"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_WEBSITE_RATING'); ?></label>
                    <div class="controls stars">
                        <input type="hidden" name="gbvote" value="0" />
                        <?php for($i = 1; $i <= $this->params->get('rating_max', 5); $i++) : ?>
                            <?php if((isset($this->entry->gbvote)) AND ($i == $this->entry->gbvote)) : ?>
                                <input type="radio" name="gbvote" value="<?php echo $i; ?>" checked="checked">
                            <?php else : ?>
                                <?php if($i == $this->params->get('rating_max')) : ?>
                                    <input type="radio" name="gbvote" value="<?php echo $i; ?>" checked="checked">
                                <?php else : ?>
                                    <input type="radio" name="gbvote" value="<?php echo $i; ?>">
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php else : ?>
                <input type="hidden" name="gbvote" value="0" />
            <?php endif; ?>
            <?php if($this->params->get('show_title', true)) : ?>
                <div class="control-group">
                    <label class="control-label" for="gbtitle"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_TITLE'); ?>
                        <?php if($this->params->get('require_title', true)) :?>
                            <span class="small">*</span>
                        <?php endif; ?>
                    </label>
                    <div class="controls">
                        <input type="text" name="gbtitle" id="gbtitle" value="<?php echo $this->entry->gbtitle; ?>" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_TITLE'); ?>" />
                    </div>
                </div>
            <?php endif; ?>
                <div class="control-group">
                    <label class="control-label"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_SECRET'); ?></label>
                    <div class="controls">
                        <input type="radio" name="gbsecret" id="gbsecret_yes" value="1" <?php if($this->entry->gbsecret == 1) : ?>checked<?php endif;?> /><?php echo JTEXT::_('COM_EASYBOOKRELOADED_YES'); ?>
                        <input type="radio" name="gbsecret" id="gbsecret_no" value="0" <?php if($this->entry->gbsecret == 0) : ?>checked<?php endif;?> /><?php echo JTEXT::_('COM_EASYBOOKRELOADED_NO'); ?>
                    </div>
                </div>
            <?php if($this->params->get('support_bbcode', true)) : ?>
                <div class="control-group">
                    <label class="control-label"></label>
                    <div class="controls">
                        <div class="btn-group">
                            <?php if($this->params->get('support_link', true)) : ?>
                                <a href="javascript:x()" onclick="DoPrompt('url');"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/world_link.png" hspace="3" border="0" alt="" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_WEB_ADDRESS'); ?>" height="16" width="16" /></a>
                            <?php endif; ?>
                            <?php if($this->params->get('support_mail', true)) : ?>
                                <a href="javascript:x()" onclick="DoPrompt('email');"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/email_link.png" hspace="3" border="0" alt="" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_EMAIL_ADDRESS'); ?>" height="16" width="16" /></a>
                            <?php endif; ?>
                            <?php if($this->params->get('support_pic', true)): ?>
                                <a href="javascript:x()" onclick="DoPrompt('image_link');"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/picture_link.png" hspace="3" border="0" alt="" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_SHOW_IMAGE_WITH_A_LINK'); ?>" height="16" width="16" /></a>
                            <?php endif; ?>
                            <?php if($this->params->get('support_pic', true)) : ?>
                                <a href="javascript:x()" onclick="DoPrompt('image');"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/picture.png" hspace="3" border="0" alt="" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_SHOWS_IMAGE_FROM_AN_URL'); ?>" height="16" width="16" /></a>
                            <?php endif; ?>
                            <?php if($this->params->get('support_code', true)) : ?>
                                <a href="javascript:x()" onclick="DoPrompt('code');"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/code.png" hspace="3" border="0" alt="" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_ENTER_CODE'); ?>" height="16" width="16" /></a>
                            <?php endif; ?>
                            <?php if($this->params->get('support_youtube', true)) : ?>
                                <a href="javascript:x()" onclick="DoPrompt('youtube');"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/youtube.png" hspace="3" border="0" alt="" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_YOUTUBE'); ?>" height="16" width="16" /></a>
                            <?php endif; ?>
                            <a href="javascript:x()" onclick="insert('[B]', '[/B]')"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/text_bold.png" hspace="3" border="0" alt="Bold" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_BOLD'); ?>" height="16" width="16" /></a>
                            <a href="javascript:x()" onclick="insert('[I]', '[/I]')"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/text_italic.png" hspace="3" border="0" alt="Italic" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_ITALIC'); ?>" height="16" width="16" /></a>
                            <a href="javascript:x()" onclick="insert('[U]', '[/U]')"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/text_underline.png" hspace="3" border="0" alt="Underline" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_UNDERLINE'); ?>" height="16" width="16" /></a>
                            <a href="javascript:x()" onclick="insert('[CENTER]', '[/CENTER]')"><img src="<?php echo $this->baseurl ?>/components/com_easybookreloaded/images/text_align_center.png" hspace="3" border="0" alt="Center" title="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_CENTER'); ?>" height="16" width="16" /></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->params->get('support_smilie', true)) : ?>
                <div class="control-group">
                    <label class="control-label"></label>
                    <div class="controls smilies">
                        <div class="btn-group">
                            <?php $count = 1; ?>
                            <?php $smiley = EasybookReloadedHelperSmilie::getSmilies(); ?>
                            <?php foreach($smiley as $i => $sm) : ?>
                                <?php if($this->params->get('smilie_set') == 0) : ?>
                                    <a href="javascript:insertsmilie('<?php echo $i; ?>')" title="<?php echo $i; ?>"><?php echo JHTML::_('image', 'components/com_easybookreloaded/images/smilies/'.$sm, $sm, 'border="0"'); ?></a>&nbsp;
                                <?php else : ?>
                                    <a href="javascript:insertsmilie('<?php echo $i; ?>')" title="<?php echo $i; ?>"><?php echo JHTML::_('image', 'components/com_easybookreloaded/images/smilies2/'.$sm, $sm, 'border="0"'); ?></a>&nbsp;
                                <?php endif; ?>
                                <?php $count++; ?>
                                <?php if($count % 10 == 1) : ?>
                                    <br />
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="control-group">
                <label class="control-label" for="gbtext"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_GUESTBOOK_ENTRY'); ?>
                    <span class="small">*</span>
                </label>
                <div class="controls">
                    <textarea name="gbtext" id="gbtext" rows="10" placeholder="<?php echo JTEXT::_('COM_EASYBOOKRELOADED_GUESTBOOK_ENTRY'); ?>"><?php echo $this->entry->gbtext; ?></textarea>
                </div>
            </div>
            <?php if($this->params->get('enable_spam', true) AND ($this->params->get('enable_spam_reg') OR $this->user->guest)) : ?>
                <div class="control-group">
                    <label class="control-label" for="<?php echo $this->session->get('spamcheck_field_name', null, 'easybookreloaded'); ?>"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_SPAM'); ?> <?php echo $this->session->get('spamcheck1', null, 'easybookreloaded').' '.$this->session->get('operator', null, 'easybookreloaded').' '.$this->session->get('spamcheck2', null, 'easybookreloaded'); ?> = </label>
                    <div class="controls">
                        <input type="text" class="input-mini" name="<?php echo $this->session->get('spamcheck_field_name', null, 'easybookreloaded'); ?>" id="<?php echo $this->session->get('spamcheck_field_name', null, 'easybookreloaded'); ?>" size="3" value="" />
                    </div>
                </div>
            <?php endif; ?>
            <?php if($this->params->get('spamcheck_question') AND ($this->params->get('spamcheck_question_question') AND $this->params->get('spamcheck_question_answer')) AND ($this->params->get('enable_spam_reg') OR $this->user->guest)) : ?>
                <div class="control-group">
                    <label class="control-label" for="<?php echo $this->session->get('spamcheck_question_field_name', null, 'easybookreloaded'); ?>"><?php echo $this->params->get('spamcheck_question_question', true); ?></label>
                    <div class="controls">
                        <input type="text" name="<?php echo $this->session->get('spamcheck_question_field_name', null, 'easybookreloaded'); ?>" id="<?php echo $this->session->get('spamcheck_question_field_name', null, 'easybookreloaded'); ?>" value="" />						
                    </div>
                </div>
            <?php endif; ?>
			<div class="control-group">
                <label class="control-label" for="gbtext"><?php echo JTEXT::_('COM_EASYBOOKRELOADED_RECAPTCHA'); ?>
				<span class="small">*</span>
                </label>
                <div class="controls">
                    <div id="recaptcha" class="g-recaptcha" data-sitekey="6LfBmR8TAAAAABsmHItuTYTG_I-EAzS7m5im3ymg"></div>
                </div>
            </div>
			<div class="control-group">
                <label class="control-label" for="gbtext"></label>
                <div class="controls">
					<div><button type="submit" name="send" class="btn"><i class="fa fa-send"></i>&nbsp;<?php echo JTEXT::_('COM_EASYBOOKRELOADED_SUBMIT_ENTRY'); ?></button></div>
                </div>
            </div>
            <input type="hidden" name="option" value="com_easybookreloaded" />
            <input type="hidden" name="task" value="save" />
            <input type="hidden" name="controller" value="entry" />
            <input type="hidden" name="gbid" value="<?php echo $this->_gbid; ?>" />
            <?php echo JHTML::_('form.token'); ?>
            <?php //if($this->user->guest == 0 AND !EASYBOOK_CANEDIT) : ?>
                <input type="hidden" name="gbname" value="<?php echo $this->user->name; ?>" />
                <input type="hidden" name="gbmail" value="<?php echo $this->user->email; ?>" />
            <?php //endif; ?>
            <?php if($this->entry->id) : ?>
                <input type="hidden" name="id" value="<?php echo $this->entry->id; ?>" />
            <?php endif; ?>
        </form>
        <div class="easy_small_notice">
            <span>* <?php echo JTEXT::_('COM_EASYBOOKRELOADED_REQUIRED_FIELD'); ?></span>
            <?php if($this->params->get('enable_log_notice', true) == 1 AND $this->params->get('enable_log', true) == 1) : ?>
                <p><span><?php echo JTEXT::_('COM_EASYBOOKRELOADED_IP_LOGGING_NOTICE_FRONTEND'); ?></span></p>
            <?php endif; ?>
        </div>
    </div>
</div>