<?php
class Skeleton_New {

	public $skeleton;

	public function __construct($skeleton) {
		$this->skeleton = $skeleton;
	}

	/**
	 * Creates a new endpoint entity/object
	 * @param String $endpointName Name of the entity
	 */
	public function Endpoint($endpointName, $callback = null) {
		if(is_callable($endpointName)) {
			// endpointName is callback, generate a id for endpoint at time of use
			$callback = $endpointName;
			$trace = debug_backtrace();
			$endpointName = basename($trace[0]['file'], EXT);
			$this->skeleton->router->addToMap($endpointName, $endpointName);
		}
		if(!is_string($endpointName)) {
			return false;
		}
		if($this->skeleton->router->getPreloadFlag() == true) {
			$callback = false;
		}
		$endpoint = new Endpoint_Entity($endpointName, $callback, $this->skeleton);
		// save to skeleton
		$this->skeleton->{'endpoint_'.$endpointName} = $endpoint;
		return $endpoint;
	}
}