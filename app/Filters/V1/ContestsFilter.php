<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class ContestsFilter extends ApiFilter{
   protected $safeParams =[
      'is_finished' => ['eq'],
      'duration' => ['eq'],
      'prize' => ['lt','eq','gt'], //less than , equal , greater than

   ];

   //transfrom into db column
   protected $columnMap = [
       'is_finished' => 'is_finished',
       'duration' => 'duration',
       'prize' => 'prize'
   ];
}
