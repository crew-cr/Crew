<?php

/**
 *	"Unknown branch" exception class
 *
 * @author Mikael Randy <mikael.randy@gmail.com>
 * @since 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 * @version 1.0 - 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 */
class UnknownBranchException extends ApiException
{
	protected $httpCode = 404;
	protected $message = "Unknown branch in project";
}