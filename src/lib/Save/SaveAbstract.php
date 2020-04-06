<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	use Metlar\Proxy\ProxyCheckerParams;
	
	abstract class SaveAbstract
	{
		/**
		 * @var ProxyCheckerParams
		 */
		public $params;
		
		/**
		 * Factory method
		 *
		 * @return TypeInterface
		 */
		abstract public function create();
		
		/**
		 * Saving data to file.
		 *
		 * @return $this
		 */
		public function saveToFile()
		{
			$result = $this->create();
			file_put_contents($this->getFullNameFile(), $result->getDataType());
			
			return $this;
		}
		
		/**
		 * Creating full path and name file.
		 *
		 * @return string
		 */
		public function getFullNameFile()
		{
			$params = $this->params;
			
			return $params->getResultPathFile().$params->getResultFileName().'.'
				.$params->getSave();
		}
	}