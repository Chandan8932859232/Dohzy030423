
            <div class="container">

                <form method="post" action="{{route('wallet.withdraw-process')}}">
                    @csrf

                    <div class="form-row">


                        <div class="col-md-12 mt-4">

                            <label class="form_text"> {{__('amount')}} </label>

                            <div class="input-group">
                               <div class="input-group-prepend">
                                 <span class="input-group-text">$CAD</span>
                               </div>

                             <input type="text"  name="withdrawAmount"  value="{{old('withdrawAmount', $wallet->getWalletBalance('816490370960d4b41dd86d7'))}}" class="form-control {{ $errors->has('withdrawAmount') ? ' is-invalid' : '' }}" />

                                @if($errors->has('withdrawAmount'))
                                    <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('withdrawAmount') }}</strong>
                                 </span>
                                @endif
                            </div>

                        </div>

                            <div class="form-group col-md-12 mt-5">
                                @php
                                    $userEmail = Auth::user()->email; //email that used to create account and login
                                @endphp

                                <label class="form_text">{{__('email address for')}} {{__('interac etransfer')}}  </label>
                                <input type="email"  name="interactEmail"
                                       value="{{old('interactEmail', $userEmail)}}"
                                       class="form-control {{ $errors->has('interactEmail') ? ' is-invalid' : '' }}" />

                                @if ($errors->has('interactEmail'))
                                    <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('interactEmail') }}</strong>
                                 </span>
                                @endif

                            </div>


                        </div>



                    <br>

                    <a type="button" href="{{route('wallet.index', $user->getUserId())}}"
                    class="btn btn-outline-dark mt-5 float-left">
                    <i class="fas fa-arrow-left"></i> {{__('back to wallet')}}
                    </a>

                       <button type="submit" class="btn btn-primary mt-5 float-right buttons_style" >

                           {{__('withdraw funds')}}

                        </button>

                    </div>

                    </div>






                </form>

            </div>

        </div>
