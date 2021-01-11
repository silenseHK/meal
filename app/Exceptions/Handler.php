<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof BaseException) {
            // 如果是自定义的异常
            $this->code    = $exception->code;
            $this->message = $exception->message;
        }
        elseif($exception instanceof ValidatorException){
            $this->code = 400; //坏请求[如参数错误]
            $this->message = $exception->message;
        }
        else {
            // 定义异常开关
            if (config('app.debug')) {
                return parent::render($request, $exception);
            }

            $this->code    = 0;
            $this->message = '服务器内部错误';
            // todo 记录日志 和 消息通知（邮件短信等）
            Log::channel('error')->error(filterException($exception));
        }

        $result = [
            'code'  => $this->code,
            'msg'   => $this->message,
        ];

        // 显示中文
        return response()->json($result)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
