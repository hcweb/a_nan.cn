<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018/2/1
 * Time: 16:54
 */

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{
    protected $statusCode = Response::HTTP_OK;

    /**
     * 获取状态码
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * 设置状态码
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }


    /**
     * @param $data
     * @param array $header
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $header = [])
    {
        return \Response::json($data, $this->getStatusCode(), $header);
    }


    /**
     * @param $status
     * @param array $data
     * @param null $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function status($status, array $data, $code = null)
    {
        if ($code) {
            $this->setStatusCode($code);
        }

        $status = [
            'status' => $status,
            'code' => $this->getStatusCode()
        ];

        $data = array_merge($status, $data);

        return $this->respond($data);
    }

    /**
     * @param $message
     * @param int $code
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function failed($message, $code = Response::HTTP_BAD_REQUEST, $status = 'error')
    {
        return $this->setStatusCode($code)->message($message, $status);
    }


    /**
     * @param $message
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function message($message, $status = "success")
    {

        return $this->status($status, [
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function internalError($message = "Internal Error!")
    {

        return $this->failed($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function created($message = "created")
    {
        return $this->setStatusCode(Response::HTTP_CREATED)
            ->message($message);

    }

    /**
     * @param $data
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data, $status = "success")
    {

        return $this->status($status, compact('data'));
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFond($message = 'Not Fond!')
    {
        return $this->failed($message, Response::HTTP_NOT_FOUND);
    }
}