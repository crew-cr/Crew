<?php

/**
 * Specific exception for api module
 *
 * Easilly handle REST API response from exception
 */
class ApiException extends Exception
{
	/**
	 * HTTP status code associated to this exception
	 */
	protected $httpCode = 500;

	/**
	 * httpCode attribute setter
	 *
	 * @author Mikael Randy <mikael.randy@gmail.com>
	 * @since 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
	 * @version 1.0 - 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
	 */
	public function setHttpCode()
	{
		$this->httpCode = $httpCode;
	} 

	/**
	 * httpCode attribute getter
	 *
	 * @author Mikael Randy <mikael.randy@gmail.com>
	 * @since 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
	 * @version 1.0 - 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
	 * @return string
	 */
	public function getHttpCode()
	{
		return $this->httpCode;
	}
}