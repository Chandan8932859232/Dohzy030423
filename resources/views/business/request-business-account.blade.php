@extends ('layouts.user')

@section('title', 'Request Business Account')

@section('content')

            <div class="row">

                <div class="col-md-8 offset-sm-0">
                    <h3 class="text-center mt-3 form_title">{{__('request business account')}} </h3>


                    <div class="container">

                        <div class="card mt-5 mb-5 notes_style">
                            <div class="card-body">
                               {{__('a business account is for established businesses in need of a cashflow injection to continue or improve operations. a dohzy business account gives the following')}}
                              <p class="ml-3 mt-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('high loan amounts')}}
                              <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('ability to market your products or services in the Dohzy ecosystem')}}
                            </div>
                        </div>

                        <form method="post" action="{{route('process.business-account-request')}}">
                            @csrf

                            <div class="form-row">

                                <div class="form-group mt-3  col-md-12">
                                    <label>{{__('for how long has your business been existing')}} </label>
                                    <select  name="businessAge" class="form-control {{ $errors->has('businessAge') ? ' is-invalid' : '' }}">
                                        <option value="">{{__('choose')}}</option>
                                        <option value="0-1" {{ old('businessAge')=="0-1" ?'selected':''}}>{{__('less than 1 year')}}</option>
                                        <option value="1-2" {{ old('businessAge')=="1-2" ?'selected':''}}>{{__('1 to 2 years')}}</option>
                                        <option value="3-4" {{ old('businessAge')=="3-4" ?'selected':''}}>{{__('3 to 4 years')}}</option>
                                        <option value="5-7" {{ old('businessAge')=="5-7" ?'selected':''}}>{{__('5 to 7 years')}}</option>
                                        <option value="8-9" {{ old('businessAge')=="8-9" ?'selected':''}}>{{__('8 to 9 years')}}</option>
                                        <option value="10+" {{ old('businessAge')=="10+" ?'selected':''}}>{{__('more than 10 years')}}</option>
                                    </select>
                                    @if ($errors->has('businessAge'))
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('businessAge') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group mt-4  col-md-12">
                                    <label>{{__('in what industry does your business operate')}}</label>
                                    <select  name="businessIndustry" class="form-control {{ $errors->has('businessIndustry') ? ' is-invalid' : '' }}">
                                        <option value="">{{__('choose')}}</option>
                                        <option value="3" {{ old('businessIndustry')=="3" ?'selected':''}}>{{__('health care')}}</option>
                                        <option value="4" {{ old('businessIndustry')=="4" ?'selected':''}}>{{__('educational services')}}</option>
                                        <option value="5" {{ old('businessIndustry')=="5" ?'selected':''}}>{{__('finance')}}</option>
                                        <option value="6" {{ old('businessIndustry')=="6" ?'selected':''}}>{{__('government')}}</option>
                                        <option value="7" {{ old('businessIndustry')=="7" ?'selected':''}}>{{__('information technology')}}</option>
                                        <option value="8" {{ old('businessIndustry')=="8" ?'selected':''}}>{{__('agriculture')}}</option>
                                        <option value="9" {{ old('businessIndustry')=="9" ?'selected':''}}>{{__('entertainment, arts')}}</option>
                                        <option value="10" {{ old('businessIndustry')=="10" ?'selected':''}}>{{__('construction')}}</option>
                                        <option value="11" {{ old('businessIndustry')=="11" ?'selected':''}}>{{__('real estate')}}</option>
                                        <option value="12" {{ old('businessIndustry')=="12" ?'selected':''}}>{{__('Transport')}}</option>
                                        <option value="13" {{ old('businessIndustry')=="13" ?'selected':''}}>{{__('retail')}}</option>
                                        <option value="14" {{ old('businessIndustry')=="14" ?'selected':''}}>{{__('mining')}}</option>
                                        <option value="15" {{ old('businessIndustry')=="15" ?'selected':''}}>{{__('other')}}</option>
                                    </select>
                                    @if ($errors->has('businessIndustry'))
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('businessIndustry') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group mt-4  col-md-12">
                                    <label>{{__('in what country does your business operate')}}</label>

                                    <select id="inputState"  name="businessCountry"  class="form-control {{ $errors->has('businessCountry') ? ' is-invalid' : '' }}">
                                        <option value="">{{__('choose')}}</option>

                                        @foreach($countryInfo as $code=> $country)

                                          <option value={{$code}} {{ old('businessCountry')==$code ?'selected':''}}>{{ucwords(strtolower($country['name']))}}</option>

                                        @endforeach

                                    </select>

                                    @if ($errors->has('businessCountry'))
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('businessCountry') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group mt-4  col-md-12">
                                    <label>{{__('what is the monthly revenue of the business')}}</label>
                                    <select  name="businessRevenue" class="form-control {{ $errors->has('businessRevenue') ? ' is-invalid' : '' }}">
                                        <option value="">{{__('choose')}}</option>
                                        <option value="1000_and_less" {{ old('businessRevenue')=="1000_and_less" ? 'selected' :''}}>{{__('less than')}} $1,000 </option>
                                        <option value="1000-3000" {{ old('businessRevenue')=="1000-3000" ? 'selected' :''}}>$1,000 - $3,000 </option>
                                        <option value="3000-6000" {{ old('businessRevenue')=="3000-6000" ? 'selected' :''}}>$3,000 - $6,000 </option>
                                        <option value="6000-9000" {{ old('businessRevenue')=="6000-9000" ? 'selected' :''}}>$6,000 - $9,000 </option>
                                        <option value="1000_and_above" {{ old('businessRevenue')=="10000_and_above" ? 'selected' :''}}>$10,000 {{__('and above')}} </option>
                                    </select>
                                    @if ($errors->has('businessRevenue'))
                                        <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('businessRevenue') }}</strong>
                                        </span>
                                    @endif
                                </div>


                            <label  class="mt-3"> {{__('what does your business do')}} ({{__('maximum words : 150')}}) </label>
                              <textarea name="businessSummary" cols="30" rows="5" class="form-control {{ $errors->has('businessSummary') ? ' is-invalid' : '' }}"></textarea>
                               @if ($errors->has('businessSummary'))
                                 <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('businessSummary') }}</strong>
                                 </span>
                               @endif



                            </div>

                            <button type="submit" class="btn btn-success mt-5 mb-4 mb-3 buttons_style">
                                {{__('request business account')}}
                            </button>
                        </form> <br><br>
                    </div>
                </div>



               {{-- @include('notes.recommend-user-notes') --}}



    </div>


@endsection



