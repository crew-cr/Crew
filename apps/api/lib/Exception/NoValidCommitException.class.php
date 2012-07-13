<?php

/**
 *	"No valid commit" exception class
 *
 * @author Mikael Randy <mikael.randy@gmail.com>
 * @since 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 * @version 1.0 - 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 */
class NoValidCommitException extends ApiException
{
	protected $httpCode = 422;
	protected $message = "No valid commit";
}