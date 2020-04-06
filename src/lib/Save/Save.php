<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	use Metlar\Proxy\ProxyCheckerParams;
	
	class Save extends SaveAbstract
	{
		/**
		 * @var ProxyCheckerParams
		 */
		public $params;
		
		/**
		 * Save constructor.
		 *
		 * @param ProxyCheckerParams $params
		 */
		public function __construct(ProxyCheckerParams $params)
		{
			$this->params = $params;
		}
		
		/**
		 * @return ProxyCheckerParams
		 */
		public function getParams()
		{
			return $this->params;
		}
		
		/**
		 * Factory method
		 *
		 * @return TypeInterface
		 */
		public function create(): TypeInterface
		{
			$nameClass = __NAMESPACE__.'\\'.ucfirst($this->params->getSave());
			if (!class_exists($nameClass))
				throw new \InvalidArgumentException("Type not found");
			
			return new $nameClass($this->params->getResultArray(), $this->params->getSave());
			
		}
		
	}