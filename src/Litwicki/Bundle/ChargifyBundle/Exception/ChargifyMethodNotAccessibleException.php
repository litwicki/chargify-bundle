<?php

namespace Litwicki\Bundle\ChargifyBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @author jake.litwicki@vennli.com
 */
class ChargifyMethodNotAccessibleException extends HttpException
{
    /**
     * Constructor.
     *
     * @param string $message      The internal exception message
     * @param \Exception $previous The previous exception
     * @param int $code            The internal exception code
     */
    public function __construct($message = NULL, \Exception $previous = NULL, $code = 0)
    {
        parent::__construct(403, $message, $previous, array(), $code);
    }
}
