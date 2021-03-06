<?php

declare(strict_types=1);

/*
 * Hivelvet open source platform - https://riadvice.tn/
 *
 * Copyright (c) 2022 RIADVICE SUARL and by respective authors (see below).
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation; either version 3.0 of the License, or (at your option) any later
 * version.
 *
 * Hivelvet is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with Hivelvet; if not, see <http://www.gnu.org/licenses/>.
 */

namespace Actions\Settings;

use Actions\Base as BaseAction;
use Base;
use Models\Setting;

/**
 * Class Collect.
 */
class Collect extends BaseAction
{
    /**
     * @param Base  $f3
     * @param array $params
     */
    public function execute($f3, $params): void
    {
        $data            = [];
        $setting         = new Setting();
        $defaultSettings = $setting->find([], ['limit' => 1])->current();

        if ($defaultSettings) {
            $data = [
                'company_name'    => $defaultSettings->company_name,
                'company_website' => $defaultSettings->company_website,
                'platform_name'   => $defaultSettings->platform_name,

                'primary_color'    => $defaultSettings->primary_color,
                'secondary_color'  => $defaultSettings->secondary_color,
                'accent_color'     => $defaultSettings->accent_color,
                'additional_color' => $defaultSettings->additional_color,
            ];
        }

        $this->logger->debug('collecting settings', ['data' => json_encode($data)]);
        $this->renderJson($data);
    }
}
