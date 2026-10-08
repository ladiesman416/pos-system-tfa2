<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index(): string
    {
        $model = new CustomerModel();

        return view('customers/index', [
            'title'     => 'Customer Accounts',
            'customers' => $model->findAll(),
        ]);
    }
}