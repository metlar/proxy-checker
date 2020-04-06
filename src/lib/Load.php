<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib;
	
	use Metlar\Proxy\ProxyCheckerParams;
	
	class Load
	{
		/**
		 * @var ProxyCheckerParams
		 */
		private $params;
		
		/**
		 * Load constructor.
		 *
		 * @param ProxyCheckerParams $params
		 */
		public function __construct(ProxyCheckerParams $params)
		{
			$this->params = $params;
		}
		
		/**
		 * Load files
		 * @return string
		 */
		public function loadFile()
		{
			$file = $this->params->getLoadPathFile().$this->params->getLoad();
			if (file_exists($file)) {
				return  (string)file_get_contents($file);
			}
			
			return '';
		}
		
		/**
		 * Explode data and trim
		 * @param string $data
		 *
		 * @return array
		 */
		public function addToArray($data)
		{
			$array_proxy = explode("\n", $data);
			return array_map('trim', $array_proxy);
		}
		
		/**
		 * @return array list proxy
		 */
		public function getData()
		{
			$result = array();
			if (is_array($this->params->getLoad()))
				$result = $this->params->getLoad();
			
			if (is_string($this->params->getLoad())) {
				$result = $this->addToArray($this->loadFile());
			}
			return $result;
		}
		
	}