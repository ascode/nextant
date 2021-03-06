<?php

/**
 * Nextcloud - nextant
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Maxence Lange <maxence@pontapreta.net>
 * @copyright Maxence Lange 2016
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
namespace OCA\Nextant\Cron;

use \OCA\Nextant\AppInfo\Application;

class BackgroundIndex extends \OC\BackgroundJob\TimedJob
{

    private $configService;

    private $solrAdmin;

    private $miscService;

    private $sourceService;

    public function __construct()
    {
        $this->setInterval(5); // 2 minutes
    }

    protected function run($argument)
    {
        $app = new Application();
        $c = $app->getContainer();
        
        $this->configService = $c->query('ConfigService');
        
        if ($this->configService->getAppValue('use_cron') !== '1')
            return;
        
        $backgroundService = $c->query('BackgroundService');
        $backgroundService->run();
    }
}
