@extends('layouts.user')

@section('title', 'Upload Void Cheque')

@section('content')


    <div class="row">
        <div class="col-sm-8">
            <h4 class="text-center mt-3 form_title">{{__('upload void cheque of bank account')}}</h4>
            <hr class="mb-5">

            <div class="container">

                <div class="card">
                    <div class="card-body">
                        <strong><i class="fas fa-exclamation-triangle" style="color:orange;"></i> {{__('information should be the same')}}</strong>
                    </div>
                </div>

             </div>

            <div class="container">
                <form action="{{ route('void-cheque.process') }}" enctype="multipart/form-data"  method="POST">
                    @csrf
                    <div class="form-row mt-5">

                        <label>{{__('upload void cheque of bank account')}}</label>
                        <div class="form-group col-md-12  custom-file">

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

                    <button type="submit" class="btn btn-success btn-block  mt-3 mb-4 buttons_style">
                        <i class="fas fa-upload"></i> {{__('upload')}}</button>
                </form>
            </div>



        </div>

       {{-- @include('notes.identity-upload-notes') --}}


    </div>


@endsection

<!--page specific scripts for document upload -->
@section('scripts')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

@endsection
