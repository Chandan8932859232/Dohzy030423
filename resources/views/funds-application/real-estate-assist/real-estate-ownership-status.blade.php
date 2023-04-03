@extends ('layouts.user')

@section('title', 'Real Estate Status')

@section('content')


     <div class="row">

        <div class="col-md-8 offset-sm-0">

            <div class="container mt-4 mb-4">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                      <p class="ml-1" style="font-size: 19px; font-weight:600; color:#251F4F;">{{__('what is the real estate assistance loan')}} ?</p>
                      <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i>  {{__('this is a loan we offer to our clients to help them get into real estate or cover real estate related expenses')}}</p>
                    </div>
                </div>
            </div>

            <h3 class="text-center mt-5 form_title">{{__('real estate assist')}} : {{__('ownership status')}}</h3>
            <hr>

            <div class="container">

                <form method="post" action="{{route('real-estate-redirect')}}" >
                    @csrf

                  <div class="form-row">

                    <div class="form-group col-md-6 mt-4" >
                        <label class="form_text mt-2"> {{__('do you already own the property you need assistance for')}} ? </label>

                         <div class="form-check ml-3 mt-2 mb-2">
                            <input class="form-check-input {{ $errors->has('realEstateOwnershipStatus') ? ' is-invalid' : '' }}"
                                  type="radio" name="realEstateOwnershipStatus"
                                  value="1" {{ old('realEstateOwnershipStatus')=="1" ?'checked':''}} >
                             <label class="form-check-label">{{__('yes')}} </label>
                         </div>

                         <div class="form-check ml-3 mb-3">
                            <input class="form-check-input {{ $errors->has('realEstateOwnershipStatus') ? ' is-invalid' : '' }}"
                                 type="radio" name="realEstateOwnershipStatus"
                                 value="0" {{ old('realEstateOwnershipStatus')=="0" ?'checked':''}} >
                             <label class="form-check-label">{{__('no')}}</label>

                             @if ($errors->has('realEstateOwnershipStatus'))
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('realEstateOwnershipStatus') }}</strong>
                                </span>
                             @endif
                        </div>
                    </div>



                </div> <br><br>


                     <button type="submit" class="btn btn-primary float-left buttons_style">
                        {{__('next step')}} <i class="fas fa-arrow-right"></i>
                      </button>

                </form>
            </div>
        </div>

   {{--@include('notes.loan-apply-notes')--}}



    </div>


@endsection


@section('scripts')
    <script>




    </script>
@endsection
