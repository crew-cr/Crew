<?php

/**
 *	"Commit already used" exception class
 *
 * @author Mikael Randy <mikael.randy@gmail.com>
 * @since 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 * @version 1.0 - 1 jul 2012 - Mikael Randy <mikael.randy@gmail.com>
 */
class CommitAlreadyUsedException extends ApiException
{
	protected $httpCode = 200;
	protected $message = "Commit already used";
}