<?php

include 'LogLevel.php';
include 'LoggerConfig.php';

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
 * Class Logger v. 1.0
 * created by Paolo Montalto
 * p.montalto@xabaras.it
 */
class Logger {
	private $path;
	private $name;
	private $caller;
	private $config;

    public function __construct($c, LoggerConfig $config = null) {
        $this->config = $config;
        if ( $this->config == null )
            $this->config = LoggerConfig::getDefaultConfig();

        $this->caller = $c;
        $this->path = $this->config->logFilePath;
        $this->name = $this->config->logNamePrefix . "_" . date("y-m-d") . ".log";
    }
	
	public function info($text){
		try {
			if (LogLevel::INFO >= $this->logLevel){
				$this->append("I/" . get_class($this->caller) .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
			}
		} catch (Exception $e) {
			print $e->getMessage();
		}
	}
	
	public function debug($text){
		try {
			if (LogLevel::DEBUG >= $this->logLevel){
				$this->append("D/" . get_class($this->caller) .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
			}
		} catch (Exception $e) {
			print $e->getMessage();
		}
	}
	
	public function error($text){
		try {
			if (LogLevel::ERROR >= $this->logLevel){
				$this->append("E/" . get_class($this->caller) .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
			}
		} catch (Exception $e) {
			print $e->getMessage();
		}
	}
	
	public function fatal($text){
		try {
			if (LogLevel::FATAL >= $this->logLevel){
				$this->append("F/" . get_class($this->caller) .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
			}
		} catch (Exception $e) {
			print $e->getMessage();
		}
	}
	
	public function warn($text){
		try {
			if (LogLevel::WARN >= $this->logLevel){
				$this->append("W/" . get_class($this->caller) .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
			}
		} catch (Exception $e) {
			print $e->getMessage();
		}
	}
	
	public function trace($text){
		try {
			if (LogLevel::TRACE >= $this->logLevel){
				$this->append("T/" . get_class($this->caller) .  " [ " . date("d/M/y H:i:s") . " ]: " . utf8_decode($text));
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
		$this->logFile = fopen($this->path . $this->name, 'a+');
		fwrite($this->logFile, $text);
		fwrite($this->logFile, "\n");
		fclose($this->logFile);
	}
}
	
?>