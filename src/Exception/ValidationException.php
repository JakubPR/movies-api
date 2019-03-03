<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends HttpException
{
    public function __construct(ConstraintViolationListInterface $constraintViolationList)
    {
        $message = [];

        /** @var ConstraintViolationInterface $violation */
        foreach ($constraintViolationList as $violation) {
            $message[$violation->getPropertyPath()] = $violation->getMessage();
        }
        parent::__construct(Response::HTTP_BAD_REQUEST, json_encode($message));
    }
}