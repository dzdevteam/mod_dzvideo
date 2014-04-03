<?php
/**
 * @version     1.0.0
 * @package     mod_dzvideo
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      DZ Team <dev@dezign.vn> - dezign.vn
 */

// no direct access
defined('_JEXEC') or die;
?>
<div class="dzvideo-module<?php echo $moduleclass_sfx; ?>">
  <?php
    $videos_chunks = array_chunk($videos, $videos_per_row);
    foreach ($videos_chunks as $chunk) : ?>
  <ul>
    <?php foreach ($chunk as $video) : ?>
    <li><a href="<?php echo $video->videolink; ?>"><?php echo $video->title; ?></a></li>
    <?php endforeach; ?>
  </ul>
  <?php endforeach; ?>
</div>