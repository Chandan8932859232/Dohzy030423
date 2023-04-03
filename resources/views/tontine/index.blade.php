@extends('layouts.user')

@section('title', 'Tontine')

@section('content')


<h1 class="mt-3 ml-4 form_title">{{__('tontine')}}</h1>

<div class="col-md-8 offset-sm-0">

    <div class="container mt-5 mb-5">

        <div class="card  wallet_balance_background_deco">

            <div class="card-body">


                <div class="row">

                   <div class="col-md-8">


                      <p style="color:#685EA6; font-size: 28px; font-weight:700;"> ${{number_format($tontineInformation->receive_amount)}}</p>
                      <p style="font-size:18px; color:#000000; font-weight:500;"> {{__('receive amount')}}</p>

                   </div>

                   <div class="col-md-4">


                    <a class="card-link" href="{{route('tontine.contribute')}}">
                        <button type="button" class="btn btn-success my-5  float-left buttons_style">
                             {{__('contribute')}}
                        </button>
                    </a>

                  </div>

                </div>


            </div>

        </div>

    </div>




   <br>

    <div class="container mt-4">

        <h1 class="mt-4 ml-3 mb-3 text-center form_title">{{__('tontine information')}}</h1>

        <table class="table ">

            <tbody>

               <tr>


                  <td>{{__('status')}}:

                    @if($tontineInformation->status == 0)
                      <span class="badge badge-warning">{{__('inactive')}}</span>
                    @endif

                   @if($tontineInformation->status  ==1)
                      <span class="badge badge-success">{{__('active')}}</span>
                   @endif

                  </td>

                  <td> {{__('contribution deadline')}} : <strong>{{__('25 of the month')}}</strong></td>

                </tr>

              <tr>
                 <td> {{__('monthly contribution')}} : <strong> ${{$tontineInformation->contribution_amount}} </strong> </td>

                <td> {{ __('receive date')}} : <strong> {{$tontineInformation->receive_date}}</strong> </td>

              </tr>

              <tr>
                <td> {{ __('start date')}} : <strong> {{$tontineInformation->start_date}} </strong></td>
                <td> {{__('end date')}} : <strong> {{$tontineInformation->end_date}} </strong></td>
              </tr>

            </tbody>

        </table>
    </div>




    <br>

    <div class="container">

        <h2 class="mt-5 mb-4 form_title">{{__('transaction history')}}</h2>

             @if(count($tontineTransactions ) > 0 )    <!-- check if transactions exist then loop through -->

             <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">

                      <tr style="font-weight: bold; background-color:#685EA6; color:#ffffff;">
                        <td>{{__('amount')}}</td>
                        <td>{{__('reason')}}</td>
                        <td>{{__('date')}}</td>
                        <td>{{__('status')}}</td>
                      </tr>

                    </thead>
                    <tbody>


               @foreach($tontineTransactions  as $tontineTransaction )
                     <tr>
                        <td>${{$tontineTransaction->amount_paid}}</td>

                        <td>
                            @if($tontineTransaction->transaction_type==1)
                               {{__('contribution')}}
                            @endif

                            @if($tontineTransaction->transaction_type==0)
                                {{__('receive')}}
                            @endif


                        </td>

                        <td>{{$tontineTransaction->contribute_date}}</td>


                        <td>
                           @if($tontineTransaction->contribute_status==1)
                           <span class="badge badge-warning"> {{__('received, to be verified')}} </span>
                           @endif

                           @if($tontineTransaction->contribute_status==2)
                           <span class="badge badge-success"> {{__('complete')}} </span>
                           @endif
                        </td>

                      </tr>
                 @endforeach
                     </tbody>
                   </table>


                   <div class="float-right">
                       {{$tontineTransactions->links()}} <!-- print pagination links -->
                   </div>


            @else <!-- no transactions -->
              <div class="card mt-5">
                  <h2 class="card-body text-center" style="color:#251F4F; font-size: 18px; font-weight:400;"> {{__('no tontine transactions exist')}} </h2>
              </div>

            @endif

            <br><br><br><br><br><br><br>
            <a type="button" href="{{url('/')}}"
                class="btn btn-outline-dark ml-1"> <i class="fas fa-arrow-left"></i>
                 {{__('back to home')}}
             </a>



             <br><br><br><br><br><br><br>

        </div>




    </div>


</div>




{{--@include('notes.real-estate-loan-notes')--}}


@endsection


@section('scripts')




@endsection
