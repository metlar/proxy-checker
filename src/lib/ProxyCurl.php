<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib;
	
	use Metlar\Proxy\ProxyCheckerParams;
	
	class ProxyCurl
	{
		/**
		 * @var array
		 */
		private $channels = array();
		
		/**
		 * @var array
		 */
		private $result = array();
		
		/**
		 * @var ProxyCheckerParams
		 */
		private $params;
		
		/**
		 * ProxyCurl constructor.
		 *
		 * @param ProxyCheckerParams $params
		 */
		public function __construct(ProxyCheckerParams $params)
		{
			$this->params = $params;
		}
		
		/**
		 * Start threads
		 */
		public function execute(): void
		{
			foreach ($this->params->getListProxy() as $arrayproxy) {
				$query_result = $this->getMultiResult(
					$this->params->getUrl(),
					$arrayproxy
				);
				$this->result = array_merge($this->result, $query_result);
			}
			$this->params->setResultArray($this->result);
		}
		
		/**
		 * Sending querys curl
		 *
		 * @param string $link
		 * @param array  $arrayproxy
		 *
		 * @return array
		 */
		public function getMultiResult($link, $arrayproxy)
		{
			/**
			 * @var resource
			 */
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
					$this->result = $this->arrayMapping($proxy, $status = 1);
				} elseif ($info) {
					$this->result = $this->arrayMapping($proxy, $status = 0);
				}
				
				curl_multi_remove_handle($multi, $channel);
				$this->channels = array();
			}
			curl_multi_close($multi);
			
			return $this->result;
		}
		
		/**
		 * Mapping data for result
		 *
		 * @param string $proxy
		 * @param int    $status
		 * @return array
		 */
		public function arrayMapping($proxy, $status)
		{
			$status_proxy = array(
				0 => 'disabled',
				1 => 'enabled',
			);
			$this->logging("$status_proxy[$status]\t{$proxy}\n");
			
			//colorizing data in console
			echo ColorConsole::color(
				$status_proxy[$status],
				"$status_proxy[$status] \t{$proxy}\n"
			);
			
			$this->result[$status_proxy[$status]]['full'][] = [
				'url' => $proxy,
				'date' => date("Y-m-d H:i:s"),
			];
			$this->result[$status_proxy[$status]]['short'][] = $proxy;
			
			return $this->result;
		}
		
		/**
		 * Save data to log
		 *
		 * @param string $msg
		 */
		public function logging($msg): void
		{
			if ($this->params->isLog()) {
				$this->params->getLogger()->info($msg);
			}
		}
		
	}

