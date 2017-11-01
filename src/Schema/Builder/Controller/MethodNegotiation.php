<?php

namespace Apitte\Core\Schema\Builder\Controller;

final class MethodNegotiation
{

	/** @var string */
	private $suffix;

	/** @var bool */
	private $default = FALSE;

	/** @var string */
	private $callback;

	/**
	 * @return string
	 */
	public function getSuffix()
	{
		return $this->suffix;
	}

	/**
	 * @param string $suffix
	 * @return void
	 */
	public function setSuffix($suffix)
	{
		$this->suffix = $suffix;
	}

	/**
	 * @return bool
	 */
	public function isDefault()
	{
		return $this->default;
	}

	/**
	 * @param bool $default
	 * @return void
	 */
	public function setDefault($default)
	{
		$this->default = $default;
	}

	/**
	 * @return string
	 */
	public function getCallback()
	{
		return $this->callback;
	}

	/**
	 * @param string $callback
	 * @return void
	 */
	public function setCallback($callback)
	{
		$this->callback = $callback;
	}

}
