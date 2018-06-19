@extends('BackEnd.dashboard')
@section('content')

<div  class="quick-actions_homepage" style="margin-left: 20px;">
    <ul class="quick-actions">
        <li class="bg_lb"> <a href="#" style="font-size: 20px;">  Total Expenses </a> <span style="color: white; font-size: 18px;"><?php echo isset($totalexpenses->TotalExpense)? 'Rs.'. $totalexpenses->TotalExpense : '';  ?></span> </li>
        <li class="bg_lg"> <a href="#" style="font-size: 20px;"> Total Income</a><span style="color: white; font-size: 18px;"><?php echo isset($paid->paidCount)? 'Rs.'.$paid->paidCount:'';  ?></span> </li>
        <li class="bg_ly"> <a href="#" style="font-size: 20px;"> Pending Income </a><span style="color: white; font-size: 18px;"><?php echo isset($pending->pending)? 'Rs.'.$pending->pending:'';  ?></span>  </li>
        <li class="bg_lo"> <a href="#" style="font-size: 20px;"> Total House </a> <span style="color: white; font-size: 18px;"><?php echo isset($totalhouse->Totalhouse)? $totalhouse->Totalhouse:'';  ?></span>  </li>
    </ul>
  </div>
@stop