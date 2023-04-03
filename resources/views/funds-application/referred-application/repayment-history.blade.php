@extends ('layouts.admin')

@section('title', 'Loan Repayment History')

@section('content')

@inject('loanService', 'App\Services\LoanService')



<div class="row">
    <div class="col-sm-12">
      <h3 class="display-5 mt-4 mb-4 ml-1">{{__('loan repayment history')}} </h3>
      <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
            <tr style="font-weight: bold; background-color:#8a84a6; color:white;">
                <td>{{__('amount paid')}}</td>
                <td>{{__('Date')}}</td>
                 <td>{{__('payment method')}}</td>
                <td>{{__('loan balance')}}</td>
            </tr>
            </thead>
            <tbody>
         @if(count($loanRepayInfo) > 0 )    <!-- check if applications exist then loop through -->
            @foreach($loanRepayInfo as $loanRepay)
                <tr>
                    <td>${{$loanRepay->amount_paid}}</td>
                    <td>{{$loanRepay->payment_date}}</td>
                    <td>{{$loanService->paymentMethodShow($loanRepay->payment_method)}}</td>
                    <td><strong>${{$loanRepay->balance}}</strong></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <br><br>
        <a type="button" href="{{url()->previous()}}"
            class="btn btn-outline-primary ml-1"> <i class="fas fa-arrow-left"></i>
             {{__('back to loans')}}
         </a>

         {{--
         <div class="float-right">
            {{$loanRepayInfo->links()}} <!-- print pagination links -->
         </div> --}}

         <br><br><br><br><br><br><br>

        </div>
        <div>
        </div>


    @else
    <h2>{{__('no repayments exist')}}</h2>

 @endif


    </div>

@endsection

