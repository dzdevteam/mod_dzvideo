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

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_dzvideo/models/');

abstract class modDZVideoHelper
{
    public static function getList($params)
    {
        $model = JModelLegacy::getInstance('Videos', 'DZVideoModel', array('ignore_request' => true));
        $items = array();

        // Set application parameters in model
        $app = JFactory::getApplication();
        $appParams = $app->getParams();
        $model->setState('params', $appParams);

        // Set the filters based on the module params
        $model->setState('list.start', 0);
        $model->setState('list.limit', (int) $params->get('count', 0));
        $model->setState('filter.published', 1);

        switch ($params->get('mode', 'normal')) {
        case 'dynamic':
            $option = $app->input->get('option');
            $view = $app->input->get('view');
            $video_id = $app->input->get('id');

            if ($option == 'com_dzvideo' && $view = 'video' && (int) $video_id) {
                $tags = new JHelperTags;
                $tagIds = $tags->getTagIds($video_id, 'com_dzvideo.video');
                if (!empty($tagIds)) {
                    $model->setState('filter.tag_ids', $tagIds);
                    $model->setState('filter.exclude_id', (int) $video_id);
                } else {
                    return $items;
                }
            } else {
                return $items;
            }
            break;
        case 'normal':
            // Blah blah blah here
        default:
            break;
        }

        $catid = $params->get('catid');
        $model->setState('category.id', (int) $catid);

        // Ordering
        $model->setState('list.ordering', $params->get('video_ordering', 'a.created'));
        $model->setState('list.direction', $params->get('video_ordering_direction', 'DESC'));

        // Filter by featured
        $model->setState('featured', $params->get('only_featured', 0));

        // Date Filtering
        $date_filtering = $params->get('date_filtering', 'off');
        if ($date_filtering !== 'off')
        {
          $model->setState('filter.date_filtering', $date_filtering);
          $model->setState('filter.date_field', $params->get('date_field', 'a.created'));
          $model->setState('filter.start_date_range', $params->get('start_date_range', '1000-01-01 00:00:00'));
          $model->setState('filter.end_date_range', $params->get('end_date_range', '9999-12-31 23:59:59'));
          $model->setState('filter.relative_date', $params->get('relative_date', 30));
        }

        // Filter by language
        $model->setState('filter.language', $app->getLanguageFilter());

        $items = $model->getItems();

        return $items;
    }
}
