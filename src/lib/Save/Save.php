<?php
	/**
	 * @author   Metlar <metlarr@yandex.ru>
	 * @datetime 2020
	 */
	namespace Metlar\Proxy\lib\Save;
	
	
	class Save extends SaveAbstract
	{
		private $data;
		private $type;
		private $file_name = 'result';
		private $file_path = __DIR__.'/../../../logs/';
		
		protected $type_class;
		
		/**
		 * Set type
		 *
		 * @param $type
		 *
		 * @return $this
		 */
		public function setType($type)
		{
			$this->type = $type;
			
			return $this;
		}
		
		/**
		 * Set data
		 *
		 * @param $data
		 *
		 * @return $this
		 */
		public function setData($data)
		{
			$this->data = $data;
			
			return $this;
		}
		
		/**
		 * Factory method
		 *
		 * @return TypeInterface
		 */
		public function create(): TypeInterface
		{
			$nameClass = __NAMESPACE__.'\\'.ucfirst($this->type);
			if (!class_exists($nameClass)) {
				throw new \InvalidArgumentException("Type not found");
			}
			
			$this->type_class = new $nameClass($this->data, $this->type);
			
			return $this->type_class;
		}
		
		/**
		 * Get TypeClass
		 *
		 * @return mixed
		 */
		public function getTypeClass()
		{
			return $this->type_class;
		}
		
		/**
		 * Saving data to file.
		 *
		 * @return $this
		 */
		public function saveToFile()
		{
			$result = $this->create()->getData();
			file_put_contents($this->getFullNameFile(), $result);
			
			return $this;
		}
		
		/**
		 * Creating full path and name file.
		 *
		 * @return string
		 */
		public function getFullNameFile()
		{
			return $this->file_path.$this->file_name.'.'.$this->type;
		}
		
	}