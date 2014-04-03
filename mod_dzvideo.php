<?php
/**
 * @version     1.0.0
 * @package     mod_dzvideo
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      DZ Team <dev@dezign.vn> - dezign.vn
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$videos = modDZVideoHelper::getList($params);
$videos_per_row = $params->get('videos_per_row', 4);
$mode = $params->get('mode', 'normal');

// Display template
require JModuleHelper::getLayoutPath('mod_dzvideo', $params->get('layout', 'default'));
