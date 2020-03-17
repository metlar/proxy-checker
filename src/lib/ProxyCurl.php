<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib;
	
	use Monolog\Handler\StreamHandler;
	use Monolog\Logger;
	
	class ProxyCurl
	{
		private $channels = array();
		private $log;
		private $logging = false;
		private $result = array();
		
		
		/**
		 * @param mixed $save_log
		 */
		public function saveLog($save_log)
		{
			if ($this->isLogging()) {
				$this->log->info($save_log);
			}
		}
		
		/**
		 * @return bool
		 */
		public function isLogging()
		{
			if ($this->logging) {
				$this->log = new Logger('proxy-log');
				$this->log->pushHandler(
					new StreamHandler(__DIR__.'/../../logs/result-scan.log', Logger::INFO)
				);

			}
			
			return $this->logging;
		}
		
		/**
		 * @param $logging
		 *
		 * @return $this
		 */
		public function setLogging($logging)
		{
			$this->logging = $logging;
			
			return $this;
		}
		
		
		/**
		 * @return mixed
		 */
		public function getLog()
		{
			return $this->log;
		}
		
		/**
		 * @param $log
		 *
		 * @return $this
		 */
		public function setLog($log)
		{
			$this->log = $log;
			
			return $this;
		}
		
		/**
		 * @param $link
		 * @param $arrayproxy
		 *
		 * @return array
		 */
		public function getMultiResult($link, $arrayproxy)
		{
			
			$multi = curl_multi_init();
			
			foreach ($arrayproxy as $proxy) {
				$ch = curl_init();
				$linkd = $link;
				curl_setopt($ch, CURLOPT_URL, $linkd);
				curl_setopt($ch, CURLOPT_PROXY, $proxy);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				// таймаут соединения
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
				// таймаут ожидания
				curl_setopt($ch, CURLOPT_TIMEOUT, 9);
				curl_multi_add_handle($multi, $ch);
				$this->channels[$proxy] = $ch;
			}
			
			$active = null;
			do {
				$mrc = curl_multi_exec($multi, $active);
			} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			
			while ($active && $mrc == CURLM_OK) {
				if (curl_multi_select($multi) == -1) {
					continue;
				}
				do {
					$mrc = curl_multi_exec($multi, $active);
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}
			
			foreach ($this->channels as $proxy => $channel) {
				$info = curl_getinfo($channel);
				$status = $info['http_code'];
				
				if ($status == 200) {
					$this->arrayMapping($proxy, $status = 1);
				} elseif ($info) {
					$this->arrayMapping($proxy, $status = 0);
				}
				
				curl_multi_remove_handle($multi, $channel);
				$this->channels = array();
			}
			curl_multi_close($multi);
			
			return $this->result;
		}
		
		public function arrayMapping($proxy, $status)
		{
			$status_proxy = array(
				0 => 'disabled',
				1 => 'enabled',
			);
			
			$this->saveLog("$status_proxy[$status]\t{$proxy}\n");
			
			echo ColorConsole::color(
				$status_proxy[$status],
				"$status_proxy[$status] \t{$proxy}\n"
			);
			
			$this->result[$status_proxy[$status]]['full'][] = [
				'url' => $proxy,
				'date' => date("Y-m-d H:i:s"),
			];
			$this->result[$status_proxy[$status]]['short'][] = $proxy;
		}
		
	}

