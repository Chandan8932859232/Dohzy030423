@extends('layouts.user')

@section('title', 'Upload Verification')

@section('content')


    <div class="row">
        <div class="col-sm-8">
            <h4 class="text-center mt-3 form_title">{{__('upload identification documents')}}</h4>
            <hr class="mb-5">

            <div class="container">

            <div class="card notes_style">

                <div class="card-header"> <h4 style="color:#251F4F; font-size:18px; font-weight: 500;">
                        <i class="fas fa-info-circle"></i> {{__('please take a clear picture')}}
                    </h4>
                </div>

                <div class="card-body">

                    <strong>{{__('accepted document types are')}}</strong>

                    <ul>
                        <li class="mt-1"> {{__('drivers licence')}}</li>
                        <li class="mt-1"> {{__('health care card')}}</li>
                        <li class="mt-1"> {{__('permanent resident card')}}</li>
                        {{--<li class="mt-1"> {{__('passport page')}} </li> --}}
                    </ul>
                </div>

            </div>
            </div>

            <div class="container">
            <form action="{{ route('upload.document') }}" enctype="multipart/form-data"  method="POST">
                @csrf
                <div class="form-row mt-5">

                    <div class="form-group col-md-4 mt-3">

                        <select id="inputState"  name="documentType"  class="form-control">
                            <option value ="choose">{{__('choose document type')}}</option>
                            <option value ="drivers_licence" >{{__('drivers licence')}}</option>
                            <option value ="health_care_card" >{{__('health care card')}}</option>
                            <option value ="permanent_resident_card">{{__('permanent resident card')}}</option>
                            {{--<option value ="passport_page">{{__('passport')}}</option>--}}
                        </select>

                        @if ($errors->has('documentType'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('documentType') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group col-md-8 mt-3  custom-file">

                        {{-- <label>{{__('upload verification document')}}</label> --}}
                        <input type="file" name="image"
                               class="custom-file-input"
                               id="customFile"
                               value="{{ old('image') }}" >
                        <label class="custom-file-label" for="customFile">{{__('choose file to upload')}} </label>

                        @if($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif

                    </div>


                </div>

                <button type="submit" class="btn btn-success  my-5 buttons_style">
                    <i class="fas fa-upload"></i> {{__('upload')}}</button>
            </form>
            </div>



        </div>

         <br><br>

        {{-- @include('notes.identity-upload-notes')--}}


    </div>

    <br><br>


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
