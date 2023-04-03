@extends ('layouts.guest')

@section('title', 'Help')

@section('description', 'A platform that helps people in financial need ')
@section('keywords', 'Africa, Money, Help, Credit')
<!--
@section('robots', 'index, follow')
@section('revisit-after', 'content="3 days') -->

@section('content')

<style>
.help_center_header{
    background:linear-gradient(to right, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),url('{{asset('/images/common-questions-desktop-dohzy.jpg')}}');
    background-repeat: no-repeat;
    background-size:100% 100%;
    height:350px;
}

</style>

    <div class="jumbotron jumbotron-fluid help_center_header">
        <p class="text-center text-white mt-5 static_page_topic">{{ __('frequently asked questions') }} </p>
    </div>

    <div class="container mb-4">
        <p class="lead">{{__('have a question')}}</p>
    </div>

    <div class="container">

        <h1 class="mb-5 mt-5 text-center" style="color:#312A5C;"> {{__('frequently asked questions')}}</h1>

    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h1 class="mb-0">
                    <button class="btn btn-link help_center_questions" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    {{__('how do i apply for a loan')}} ?
                    </button>
                </h1>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                {{__('our application')}}.
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingTwelve">
                <h1 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                    {{__('what are the possible loan amounts')}}
                    </button>
                </h1>
            </div>
            <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordionExample">
                <div class="card-body">

                    <h5 class="mt-3">{{__('the are different loan limits for personal, business and real estate loans. The loan ranges and loan level are listed below')}} </h5>

                    <table class="table">

                        <thead  class="thead-light">

                           <tr>
                              <p style="margin-bottom:10px; font-size:18px; color:#312A5C; margin-top:30px;">{{__('possible loan limits for personal loans')}} </p>
                            </tr>
                        </thead>

                        <thead  class="thead-light mt-5">

                          <tr>
                            <th> {{__('loan span')}}  </th>
                            <th> {{__('loan level')}} </th>
                          </tr>
                        </thead>

                        <tbody>

                          <tr>
                            <td> $100 - $200</td>
                            <td class="mt-4">1</td>
                          </tr>

                          <tr>
                            <td> $100 - $300</td>
                            <td>2</td>
                          </tr>

                          <tr>
                            <td> $100 - $500</td>
                            <td>3</td>
                          </tr>

                          <tr>
                            <td> $100 - $700</td>
                            <td>4</td>
                          </tr>

                          <tr>
                            <td> $100 - $1,000</td>
                            <td>5</td>
                          </tr>

                          <tr>
                            <td> $100 - $1,500</td>
                            <td>6</td>
                          </tr>

                          <tr>
                            <td> $100 - $2,000</td>
                            <td>7</td>
                          </tr>

                        </tbody>
                      </table>




                      <table class="table">

                        <thead  class="thead-light">

                           <tr>
                              <p style="margin-bottom:10px; font-size:18px; color:#312A5C; margin-top:30px;">{{__('possible loan limits for business loans')}} </p>
                            </tr>
                        </thead>

                        <thead  class="thead-light mt-5">

                          <tr>
                            <th> {{__('loan span')}}  </th>
                            <th> {{__('loan level')}} </th>
                          </tr>
                        </thead>

                        <tbody>

                          <tr>
                            <td> $1,000 - $2,000</td>
                            <td class="mt-4">1</td>
                          </tr>

                          <tr>
                            <td> $1,000 - $3,000</td>
                            <td>2</td>
                          </tr>

                          <tr>
                            <td> $1,000 - $5,000</td>
                            <td>3</td>
                          </tr>

                          <tr>
                            <td> $1,000 - $7,000</td>
                            <td>4</td>
                          </tr>

                          <tr>
                            <td> $1,000 - $10,000</td>
                            <td>5</td>
                          </tr>

                        </tbody>
                      </table>

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingThirteen">
                <h1 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                    {{__('after i repay a loan how long do i have to wait to apply for another loan')}} ?
                    </button>
                </h1>
            </div>
            <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
                <div class="card-body">

                    {{__('there is a waiting period of')}}  : <strong class="font-size:20px;">{{__('1 week')}} </strong> {{__('before you can apply for another loan')}}
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingTwo">
                <h1 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    {{__('condition to qualify')}} ?
                    </button>
                </h1>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                {{__('communual approach')}} {{__('in order to be considered for a loan')}} {{__('referral code from us')}}
                </div>
            </div>
        </div>


        <div class="card">

            <div class="card-header" id="headingEight">
                <h1 class="mb-0">
                    <button class="btn btn-link help_center_questions" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        {{__('how to repay a loan')}} ?
                    </button>
                </h1>
            </div>

            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">

                <div class="card-body">
                   <p><strong>{{__('there are two principal ways of repaying a loan')}}</strong></p>

                   <ol>
                    <li class="mt-2">{{__('automatic bank withdrawal')}}</li>
                    <li class="mt-2">{{__('interac etransfer')}} </li>
                   </ol>

                   <p>{{__('when you complete a loan request, we shall ask for your banking information. this will be used to withdraw money on the due date. However, you can repay the loan ahead of the time by interac etransfer')}}.</p>

                   <p><strong class="mt-2">{{__('how to repay a loan by interac eTransfer')}}</strong></p>

                   <ul>
                       <li class="mb-1">{{__('send an interac eTransfer to')}} <strong><span style="font-size:16px; color:#312A5C;">pay@dohzy.com </span></strong> ({{__('please note the password')}})</li>
                       <li class="mb-1">{{__('log into dohzy and go to')}}</li>
                       <li class="mb-1">{{__('on the repay loans page')}}</li>
                   </ul>

                    <p><strong>{{__('how to repay a loan through automatic bank withdrawal')}}</strong></p>

                    <ul>
                        <li class="mt-2">{{__('the system will collect your banking information during the loan application process')}}</li>
                        <li class="mt-2">{{__('the loan balance will be withdrawn from your bank account on the due date')}}</li>
                    </ul>


                </div>

            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingNine">
                <h1 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        {{__('how to contact dohzy')}} ?
                    </button>
                </h1>
            </div>
            <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                <div class="card-body">
                    <p> {{__('send an email to')}} <strong>info@dohzy.com</strong> {{__('and we shall get bacl to you promptly')}}.</p>

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingSeven">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    {{__('what is a dohzy score')}} ?
                    </button>
                </h2>
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                <div class="card-body">
                {{__('a dohzy score is similar to credit score')}}.<br><br>{{__('a high dohzy score leads to the following')}}
                <ul>
                    <li>{{__('a high loan approval rate')}}</li>
                    <li>{{__('faster processing time for request')}}</li>
                    <li>{{__('qualification for the real estate assistance loan')}}</li>
                </ul>

                {{__('behaviours that impact dohzy score')}}
                <ul>
                    <li>{{__('timely loan repayments')}}</li>
                    <li>{{__('payment accuracy')}}</li>
                    <li>{{__('prompt response to communication efforts')}}</li>
                </ul>

                </div>
            </div>
        </div>







        <div class="card">
            <div class="card-header" id="headingThree">
                <h1 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    {{__('how long does it take to get money after i apply')}} ?
                    </button>
                </h1>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                {{__('from the time of approval it takes an average of')}} <strong>{{__('twenty four hrs weekends included')}}</strong> {{__('to receive money from us after you apply')}}.
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingFour">
                <h1 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                    {{__('what is the maximum and minimum amount i can receive')}} ?
                    </button>
                </h1>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                {{__('how much you get from us is dependent on how well you use our system')}} {{__('loan range')}} {{__('how much you get')}}.

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    {{__('is interest charged to the money i get')}} ?
                    </button>
                </h2>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                {{__('yes we charge an interest')}}
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingTen">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                     {{__('how does interest work at dohzy')}} ?
                    </button>
                </h2>
            </div>
            <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                <div class="card-body">
                 {{__('the moment you become a member')}}

                  <ul class="mt-2">
                      <li class="mt-1"> Dohzy Score </li>
                      <li class="mt-1"> {{__('amount requested')}} </li>
                      <li class="mt-1"> {{__('number of installments')}} </li>
                      <li class="mt-1"> {{__('loan time frame')}} </li>
                  </ul>

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed help_center_questions" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    {{__('can i repay in installments')}} ?
                    </button>
                </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                {{__('yes but it depends on the amount burrowed and how well you use the system')}}.

                </div>
            </div>
        </div>




    </div>

    </div>

    <br><br><br><br>

@endsection
