@extends('layouts.user')

@section('title', 'Upload Verification')

@section('content')


    <div class="row">
        <div class="col-sm-8">
            <h3 class="text-center mt-3 form_title">Upload Identification Document</h3>
            <hr class="mb-5">

            <div class="container">
                <div class="card">
                    <div class="card-header"> <h4 style="color:#251F4F; font-size:18px; font-weight: 600;">
                            <i class="fas fa-info-circle"></i> Please take a clear picture of a Photo Id and upload it below
                        </h4>
                    </div>
                    <div class="card-body">
                        <strong>Accepted Document Types Are</strong>
                        <ul>
                            <li> National identity card</li>
                            <li> Birth Certificate</li>
                        </ul>

                        {{--  <strong> Maximum file size is : NA </strong> --}}

                    </div>
                </div>
            </div>

            <div class="container">
                <form action="{{ route('upload.document') }}" enctype="multipart/form-data"  method="POST">
                    @csrf
                    <div class="form-row mt-5">

                        <div class="form-group col-md-4">
                            {{--<label>Phone type</label> --}}

                            <select id="inputState"  name="documentType"  class="form-control">
                                <option value ="choose">Choose Document Type</option>
                                <option value ="national_identity_card" >National Identity Card</option>
                                <option value ="birth_certificate" >Birth Certificate</option>
                            </select>

                            @if ($errors->has('documentType'))
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('documentType') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group col-md-8  custom-file">

                            {{-- <label>{{__('upload verification document')}}</label> --}}
                            <input type="file" name="image"
                                   class="custom-file-input"
                                   id="customFile"
                                   value="{{ old('image') }}" >
                            <label class="custom-file-label" for="customFile">Choose file to upload</label>

                            @if($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif

                        </div>


                    </div>

                    <button type="submit" class="btn btn-success btn-block  mt-3 mb-3 buttons_style">
                        <i class="fas fa-upload"></i> Upload</button>
                </form>
            </div>



        </div>

        @include('notes.identity-upload-notes')


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
