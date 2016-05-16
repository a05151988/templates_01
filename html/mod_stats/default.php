<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_stats
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<?php //注意: mod_stats 只能開啟Hit Counter的部分，其他的不能開，否則版面會走樣 ?>
<?php foreach ($list as $item) : ?>
<div class="header_info_right_content"><i class="fa fa-eye"></i>&nbsp;<?php echo $item->title; ?> <span id="etc_total_count" class="animated"><?php echo $item->data; ?></span> 次</div>
<?php endforeach; ?>

