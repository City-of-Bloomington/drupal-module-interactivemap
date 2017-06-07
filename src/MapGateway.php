<?php
/**
 * @copyright 2017 City of Bloomington, Indiana
 * @license https://www.gnu.org/licenses/old-licenses/gpl-2.0 GNU/GPL2, see LICENSE
 *
 * This file is part of the COB Interactive Maps drupal module.
 *
 * The Maps module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * The Maps module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with the Maps module.  If not, see <https://www.gnu.org/licenses/old-licenses/gpl-2.0/>.
 */
namespace Drupal\interactivemap;

use Drupal\Core\Site\Settings;

class MapGateway
{
    /**
     * @param  string $url
     * @return array        The JSON data
     */
    private static function doJsonQuery($url)
    {
        $client = \Drupal::httpClient();
        try {
            $response = $client->get($url);
            return json_decode($response->getBody(), true);
        }
        catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return array The json data from the maps application
     */
    public static function maps()
    {
        $config = \Drupal::config('interactivemap.settings');
        return self::doJsonQuery($config->get('interactivemap_url').'?format=json');
    }
}
