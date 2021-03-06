<?php

#
# This file is part of Logger for PHP.

# The ASF licenses this file to You under the Apache License, Version 2.0
# (the "License"); you may not use this file except in compliance with
# the License.  You may obtain a copy of the License at
#
#    http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.
#

/**
 * Logger for PHP 1.2
 * created by Paolo Montalto <p.montalto[at]xabaras.it>
 */

class LoggerConfig
{
    public $logLevel;
    public $logFilePath;
    public $logNamePrefix;

    public static function getDefaultConfig() {
        $config = new LoggerConfig();
        $config->logLevel = LogLevel::ALL;
        $config->logFilePath = $_SERVER['DOCUMENT_ROOT'] . "log/";
        $config->logNamePrefix = "log";

        return $config;
    }
}