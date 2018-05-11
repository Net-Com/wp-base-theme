<?php 

/**
 * assets class
 */

class Assets
{
	private $styles;
	private $scripts;

	public function __construct()
	{
		$this->styles = $this->scripts = [];
	}

	private function add($type , $link , $name)
	{
		if ( !is_null($link) )
		{
			if ( is_null($name) ) $name = sanitize_title($link);

			$this->{$type}[$name] = $link;
		}
	}
	
	public function addStyle($link=null,$name=null)
	{
		$this->add('styles', $link, $name);
		return $this;
	}

	public function getStyles()
	{
		return $this->styles;
	}

	public function addScript($link=null,$name=null)
	{
		$this->add('scripts', $link,$name);
		return $this;
	}

	public function getScripts()
	{
		return $this->scripts;
	}
}
