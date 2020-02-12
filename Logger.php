<?php

require_once 'LogLevel.php';
require_once 'LoggerConfig.php';

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
class Logger {
    private $path;
    private $name;
    private $config;

    public function __construct(LoggerConfig $config = null) {
        $this->updateConfiguration($config);
    }

    public function updateConfiguration(LoggerConfig $config = null) {
        try {
            $this->config = $config;
            if ( $this->config == null )
                $this->config = LoggerConfig::getDefaultConfig();

            $this->path = $this->config->logFilePath;
            $this->name = $this->config->logNamePrefix . "_" . date("y-m-d") . ".log";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function info($tag, $text){
        try {
            if (LogLevel::INFO >= $this->config->logLevel){
                $this->append("I/" . $tag .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function debug($tag, $text){
        try {
            if (LogLevel::DEBUG >= $this->config->logLevel){
                $this->append("D/" . $tag .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function error($tag, $text){
        try {
            if (LogLevel::ERROR >= $this->config->logLevel){
                $this->append("E/" . $tag .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function fatal($tag, $text){
        try {
            if (LogLevel::FATAL >= $this->config->logLevel){
                $this->append("F/" . $tag .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function warn($tag, $text){
        try {
            if (LogLevel::WARN >= $this->config->logLevel){
                $this->append("W/" . $tag .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function trace($tag, $text){
        try {
            if (LogLevel::TRACE >= $this->config->logLevel){
                $this->append("T/" . $tag .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    private function append($text) {
        //Check if the destination directory already exists.
        if(!is_dir($this->path)){
            //Directory does not exist, lets create it recursively.
            mkdir($this->path, 0755, true);
        }
        $logFile = fopen($this->path . $this->name, 'a+');
        fwrite($logFile, $text);
        fwrite($logFile, "\n");
        fclose($logFile);
    }
}

?>