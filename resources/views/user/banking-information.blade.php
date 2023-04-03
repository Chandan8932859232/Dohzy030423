@extends('layouts.user')

@section('title', 'Banking Information')

@section('content')

    <div class="row">
        <div class="col-sm-8">


            <h3 class="text-center mt-3 form_title">{{__('banking information')}}</h3>

            <hr>

            <div class="container">

                <div class="container mt-5 mb-4">
                    <div class="card text-dark notes_style">
                        <div class="card-body">
                            <h3  style="color:#251F4F; font-size:19px; font-weight:500; margin-bottom:20px;"> {{__('the banking information will be used for')}} </h3>

                                <p class="ml-3 mb-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('taking out the loan repayment on the agreed upon payback day')}}</li>
                                <p class="ml-3 mb-2"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('depositing the loan into your account')}}</li>

                        </div>
                    </div>
                </div>

                <form action="{{route('banking-info.provided')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-12 mt-3">
                            <label class="form_text required">{{__('institution number')}}</label>
                            <input type="text" class="form-control {{ $errors->has('institutionNumber') ? ' is-invalid' : '' }}" name="institutionNumber"
                                   value="{{ old('institutionNumber') }}"  >
                            <small>{{__('three digits for most canadian banks')}}</small>
                            @if ($errors->has('institutionNumber'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('institutionNumber') }}</strong>
                               </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 mt-2">
                            <label class="form_text required">{{__('transit number')}}/{{__('branch number')}}</label>
                            <input type="text" class="form-control {{ $errors->has('transitNumber') ? ' is-invalid' : '' }}" name="transitNumber"
                                   value="{{ old('transitNumber') }}"  >
                            <small>{{__('five digits for most canadian banks')}}</small>
                            @if ($errors->has('transitNumber'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('transitNumber') }}</strong>
                               </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 mt-2 mb-4">
                            <label class="form_text required">{{__('account number')}}</label>
                            <input type="text" class="form-control {{ $errors->has('accountNumber') ? ' is-invalid' : '' }}" name="accountNumber"
                                   value="{{ old('accountNumber') }}"  >
                            <small>{{__('seven to 12 digits for most canadian banks')}}</small>
                            @if ($errors->has('accountNumber'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('accountNumber') }}</strong>
                               </span>
                            @endif
                        </div>



                        <label class="form_text required">{{__('upload void cheque of bank account')}}</label>
                        <div class="form-group col-md-12   mb-3 custom-file">

                            <input type="file" name="voidChequeImage"
                                   class="custom-file-input form-control {{ $errors->has('voidChequeImage') ? ' is-invalid' : '' }}"
                                   id="customFile"
                                   value="{{ old('voidChequeImage') }}" >
                            <label class="custom-file-label" for="customFile">{{__('choose file to upload')}} </label>

                            @if($errors->has('voidChequeImage'))
                                <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('voidChequeImage') }}</strong>
                            </span>
                            @endif

                        </div>

                    </div>

                    <br><br>

                    <a type="button" href="{{url()->previous()}}"
                        class="btn btn-outline-dark float-left">
                        <i class="fas fa-arrow-left"></i>  {{__('back')}}
                     </a>


                    <button type="submit"   class="btn btn-success float-right buttons_style">
                        {{__('next')}} <i class="fas fa-arrow-right"></i>
                    </button>

                </form>
            </div>

        </div>


        {{--@include('notes.complete-registration-notes') --}}


    </div>  <br><br><br><br><br><br><br><br>

@endsection

<!--page specific scripts (script for datepicker) -->
@section('scripts')

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>




{{-- check if session exist before displaying pop up. this is used to display pop just once(one page) load --}}
@if(!session()->has('bankModal'))
   <script>
	$(document).ready(function(){
		$("#myBankInfoPopUp").modal('show');
	});
   </script>

 {{ session()->put('bankModal','shown') }} {{--put value into session so that after pop displays once its not displayed again --}}

 <div class="modal" id="myBankInfoPopUp">
    <div class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color:#312A5C;">{{__('almost there the last steps are')}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

             <!-- Modal body -->
            <div class="modal-body">

                <div class="card bg-white text-dark border-0">
                    <div class="card-body">
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('provide bank account information')}}</p>
                        <p class="ml-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('agree to loan terms and conditions')}} </p>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('close')}}</button>
            </div>

        </div>
    </div>
 </div>

 @endif


@endsection
