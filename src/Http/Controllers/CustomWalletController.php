<?php

namespace Alive2212\LaravelWalletService\Http\Controllers;

use Alive2212\LaravelSmartResponse\ResponseModel;
use Alive2212\LaravelSmartResponse\SmartResponse\SmartResponse;
use Alive2212\LaravelSmartRestful\BaseController;
use Alive2212\LaravelTicketService\AliveTicket;
use Alive2212\LaravelWalletService\AliveWalletPayment;
use Alive2212\LaravelWalletService\LaravelWalletService;
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
        'extra_value' => 'required',
    ];

    protected $userCreditValidateParams = [
        'amount' => 'required',
        'stuff_title' => 'required',
        'description' => 'required',
        'extra_value' => 'required',
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

    public function paymentList(Request $request)
    {
        // create response object
        $response = new ResponseModel();

        // get all payments records
        $data = $this->wallet->getUserPaymentList(auth()->id());

        // initialize response
        $response->setData(collect($data));
        $response->setMessage($this->getTrans(__FUNCTION__, 'successful'));
        $response->setStatus(true);

        // return response
        return SmartResponse::response($response);
    }

    public function credit(Request $request)
    {
        // create response object
        $response = new ResponseModel();

        // validate
        $response = $this->validateRequest($request, $response,$this->userCreditValidateParams);

        // show error if has any error
        if (!is_null($response->getError())){
            return SmartResponse::response($response);
        }


        // create wallet object and credit to user
        $data = $this->wallet->credit(
            auth()->id(),
            $request['amount'],
            $request['stuff_title'],
            $request['description'],
            json_decode($request['extra_value'],true),
            auth()->id()
        );

        // initialize response
        $response->setData(collect($data));
        $response->setMessage($this->getTrans(__FUNCTION__, 'successful'));
        $response->setStatus(true);

        // return response
        return SmartResponse::response($response);
    }

    public function debit(Request $request)
    {
        // create response object
        $response = new ResponseModel();

        // validate
        $response = $this->validateRequest($request, $response,$this->userDebitValidateParams);

        // show error if has any error
        if (!is_null($response->getError())){
            return SmartResponse::response($response);
        }

        // create wallet object and debit from user
        $data = $this->wallet->debit(
            auth()->id(),
            $request['amount'],
            $request['stuff_title'],
            $request['description'],
            json_decode($request['extra_value'],true),
            auth()->id()
        );

        // initialize response
        $response->setData(collect($data));
        $response->setMessage($this->getTrans(__FUNCTION__, 'successful'));
        $response->setStatus(true);

        // return response
        return SmartResponse::response($response);
    }

    public function balance(Request $request)
    {
        // create response object
        $response = new ResponseModel();

        // get user balance
        $data =  $this->wallet->getUserBalance(auth()->id());

        // initialize response
        $response->setData(collect($data));
        $response->setMessage($this->getTrans(__FUNCTION__, 'successful'));
        $response->setStatus(true);

        // return response
        return SmartResponse::response($response);
    }

    /**
     * @param Request $request
     * @param ResponseModel $response
     * @param array $validationArray
     * @return ResponseModel
     */
    private function validateRequest(Request $request, ResponseModel $response,array $validationArray)
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
}