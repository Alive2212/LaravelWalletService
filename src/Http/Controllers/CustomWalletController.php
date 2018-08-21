<?php

namespace Alive2212\LaravelWalletService\Http\Controllers;

use Alive2212\LaravelSmartResponse\ResponseModel;
use Alive2212\LaravelSmartResponse\SmartResponse\SmartResponse;
use Alive2212\LaravelSmartRestful\BaseController;
use Alive2212\LaravelTicketService\AliveTicket;
use Alive2212\LaravelWalletService\AliveWalletPayment;
use Alive2212\LaravelWalletService\LaravelWalletService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomWalletController extends BaseController
{
    protected $localPrefix = 'laravel-wallet-service';
    /**
     * @var
     */
    protected $wallet;

    /**
     * @var array
     */
    protected $userDebitValidateParams = [
        'amount' => 'required',
        'stuff_title' => 'required',
        'description' => 'required',
        'extra_value' => 'required | json',
    ];

    protected $userCreditValidateParams = [
        'amount' => 'required',
        'stuff_title' => 'required',
        'description' => 'required',
        'extra_value' => 'required | json',
    ];

    /**
     *
     */
    public function initController()
    {
        $this->model = new AliveWalletPayment();
        $this->wallet = new LaravelWalletService();

        $this->middleware([
            'auth:api',
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentList(Request $request)
    {
        // get all payments records
        $data = $this->wallet->getUserPaymentList(
            $request->has('user_id') ?
                $request['user_id'] :
                auth()->id()
        );

        // return response
        return $this->response($data, __FUNCTION__);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function credit(Request $request)
    {
        // create response object
        $response = new ResponseModel();

        // validate
        $response = $this->validateRequest($request, $response, $this->userCreditValidateParams);

        // show error if has any error
        if (!is_null($response->getError())) {
            return SmartResponse::response($response);
        }


        // create wallet object and credit to user
        $data = $this->wallet->credit(
            $request->has('user_id') ?
                $request['user_id'] :
                auth()->id(),
            $request['amount'],
            $request['stuff_title'],
            $request['description'],
            json_decode($request['extra_value'], true),
            auth()->id()
        );

        // return response
        return $this->response($data, __FUNCTION__);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function debit(Request $request)
    {
        // create response object
        $response = new ResponseModel();

        // validate
        $response = $this->validateRequest($request, $response, $this->userDebitValidateParams);

        // show error if has any error
        if (!is_null($response->getError())) {
            // return false response
            return SmartResponse::response($response);
        }

        // create wallet object and debit from user
        $data = $this->wallet->debit(
            $request->has('user_id') ?
                $request['user_id'] :
                auth()->id(),
            $request['amount'],
            $request['stuff_title'],
            $request['description'],
            json_decode($request['extra_value'], true),
            auth()->id()
        );

        // return response
        return $this->response($data, __FUNCTION__);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function balance(Request $request)
    {
        // get user balance
        $data = (array) $this->wallet->getUserBalance(
            $request->has('user_id') ?
                (int)$request['user_id'] :
                auth()->id()
        );

        // return response
        return $this->response($data, __FUNCTION__);
    }

    /**
     * @param Request $request
     * @param ResponseModel $response
     * @param array $validationArray
     * @return ResponseModel
     */
    private function validateRequest(Request $request, ResponseModel $response, array $validationArray)
    {
        $validationErrors = $this->checkRequestValidation($request, $validationArray);
        if ($validationErrors != null) {
            if (env('APP_DEBUG', false)) {
                $response->setData(collect($validationErrors->toArray()));
            }
            $response->setMessage($this->getTrans(__FUNCTION__, 'validation_failed'));
            $response->setStatus(false);
            $response->setError(99);
        }
        return $response;
    }

    /**
     * @param $data
     * @param $methodName
     * @param string $statusTag
     * @param bool $status
     * @return JsonResponse
     */
    public function response(array $data, $methodName, $statusTag = 'successful', $status = true): JsonResponse
    {
        // create response object
        $response = new ResponseModel();

        // initialize response
        $response->setStatus($status);
        $response->setData(collect($data));
        $response->setMessage($this->getTrans($methodName, $statusTag));
        $response->setStatus(true);

        // return result
        return SmartResponse::response($response);
    }
}