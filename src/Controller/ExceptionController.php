<?php

namespace App\Controller;

use App\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionController extends AbstractController
{
    use ControllerTrait;

    public function ShowAction(Request $request, $exception, DebugLoggerInterface $logger = null)
    {
        if ($exception instanceof ValidationException) {
            return $this->getView($exception->getStatusCode(), json_decode($exception->getMessage(), true));
        }

        if ($exception instanceof HttpException) {
            return $this->getView($exception->getStatusCode(),$exception->getMessage());
        }

        return $this->getView(null, 'Unexpected error occured');
    }

    private function getView(?int $statusCode, $message): View
    {
        $data = [
            'code' => $statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message
        ];

        return $this->view($data, $statusCode ?? Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}