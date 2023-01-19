<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class WithdrawalsFilter extends ApiFilter{
   protected $safeParams =[
      'user_id' => ['eq'],

   ];

   //transfrom into db column
   protected $columnMap = [
       'user_id' => 'user_id',
   ];
}
