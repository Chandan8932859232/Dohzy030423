@extends('layouts.user')

@section('title', 'Upload Center')

@section('content')

    <div class="row">
        <div class="col-sm-8">


            <h3 class="form_title ml-3" >{{__('uploads')}}</h3>

             <br><br><br>



            <div class="container">



                <form action="{{route('upload.process')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-row">


                        <div class="form-group col-md-4">

                           <select id="inputState"  name="documentType"  class="form-control">
                                <option value =" ">{{__('choose document type')}}</option>
                                <option value ="5">{{__('pay stub')}}</option>
                                <option value ="1" >{{__('drivers licence')}}</option>
                                <option value ="2" >{{__('health care card')}}</option>
                                <option value ="3">{{__('permanent resident card')}}</option>
                                <option value ="4">{{__('passport')}}</option>
                                <option value ="6">{{__('void cheque')}}</option>
                                <option value ="7">{{__('letter of employment')}}</option>
                            </select>

                            @if ($errors->has('documentType'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('documentType') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group col-md-8 custom-file">

                            <input type="file" name="uploadedFile"
                                   class="custom-file-input form-control {{ $errors->has('uploadFile') ? ' is-invalid' : '' }}"
                                   id="customFile"
                                   value="{{ old('uploadFile') }}" >
                            <label class="custom-file-label" for="customFile">{{__('choose file to upload')}} </label>

                            @if($errors->has('uploadFile'))
                                <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('uploadFile') }}</strong>
                            </span>
                            @endif

                        </div>

                    </div>

                    <br><br>




                    <button type="submit"   class="btn btn-success buttons_style">
                     <i class="fas fa-upload"></i> {{__('upload')}}
                    </button>

                </form>
            </div>

        </div>


        {{--@include('notes.complete-registration-notes') --}}


    </div>  <br><br><br><br><br><br>

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



@endsection
