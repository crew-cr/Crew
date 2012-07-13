<?php

/**
 *	No valid project exception class
 *
 * @author Mikael Randy <mikael.randy@gmail.com>
 * @since 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 * @version 1.0 - 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 */
class NoValidProjectException extends ApiException
{
	protected $httpCode = 400;
	protected $message = "No valid project";
}