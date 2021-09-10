<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{


    public function validateRequestParams($request)
    {
        // validate all request params
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|max:255|email',
                'phone_number' => 'required|digits_between:8,25|numeric',
                'address' => 'required|max:255',
                'date_of_birth' => 'required|date|date_format:Y-m-d',
            ],
            [
                'first_name.required' => 'The :attribute field is required.',
                'last_name.required' => 'The :attribute field is required.',
                'email.required' => 'The :attribute field is required.',
                'phone_number.required' => 'The :attribute field is required.',
                'address.required' => 'The :attribute field is required.',
                'date_of_birth.required' => 'The :attribute field is required.',


                'first_name.max' => 'Exceed the limit of possible characters.',
                'last_name.max' => 'Exceed the limit of possible characters.',
                'email.max' => 'Exceed the limit of possible characters.',
                'address.max' => 'Exceed the limit of possible characters.',

                'email.email' => 'Not a valid email address.',
                'phone_number.numeric' => 'Not a valid phone number.',
                'date_of_birth.date' => 'Not a valid birth of date.',
                'date_of_birth.date_format' => 'Not a valid birth of date.',
            ]
        );
        return $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ?: 20;
        $search = $request->search;
        $orderBy = $request->orderBy ?: 'last_name';

        $customers = Customer::orderBy($orderBy);
        if (!is_null($request->search)) {
            $customers
                ->where('cust_code', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $search . '%')
                ->orWhere('address', 'LIKE', '%' . $search . '%')
                ->orWhere('date_of_birth', 'LIKE', '%' . $search . '%');
        }

        return $customers->paginate($page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validateRequestParams($request);
        if (!$validator->fails()) {
            $cust_code =  strtolower($request->last_name .
                $request->first_name .
                Carbon::parse($request->date_of_birth)->format('Ymd'));

            $isExistingCustomer = Customer::where('cust_code', $cust_code)->first();
            // check if customer's cust_code already exists in the record.
            if (is_null($isExistingCustomer)) {
                $customer = new Customer();
                $customer->cust_code = $cust_code;

                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->email = $request->email;
                $customer->phone_number = $request->phone_number;
                $customer->address = $request->address;
                $customer->date_of_birth = $request->date_of_birth;
                $customer->save();
                return $customer;
            } else {
                return response(["error" => ["record" => "Customer already exists."]], 400);
            }
        } else
            return response(["error" => $validator->errors()], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::where('cust_code', $id)->first();
        if ($customer)
            return $customer;
        abort(400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateRequestParams($request);
        if (!$validator->fails()) {
            $fieldToUpdate = $request->only([
                'first_name',
                'last_name',
                'email',
                'phone_number',
                'address',
                'date_of_birth',
            ]);

            $isExistingCustomer = Customer::where('cust_code', $id)->first();
            if (!is_null($isExistingCustomer)) {
                $isExistingCustomer->update($fieldToUpdate);
                return response(null, 204);
            }
        }
        abort(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return response(null, 204);
        }
        abort(400);
    }
}
