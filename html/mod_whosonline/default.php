<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_whosonline
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php
//$totalUser = $count['guest'] + $count['user'];//20150603改動部分
$totalUser = $count;//20150603改動部分
echo '<div><i class="fa fa-paw"></i>&nbsp;目前線上人數 <span id="online_count" class="animated">'.$totalUser.'</span> 人</div>';
?>
