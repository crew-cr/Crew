<?php

/**
 *	"Too many files in a branch for review request" exception class
 *
 * @author Mikael Randy <mikael.randy@gmail.com>
 * @since 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 * @version 1.0 - 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 */
class NoValidProjectException extends ApiException
{
	protected $httpCode = 500;
	protected $message = "Your branch has too many files";
}