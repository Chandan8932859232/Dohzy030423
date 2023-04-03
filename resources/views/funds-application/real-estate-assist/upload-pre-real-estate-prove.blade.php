@extends('layouts.user')

@section('title', 'Real Estate Verification')

@section('content')


    <div class="row">
        <div class="col-sm-8">
         
           <h4 class="text-center mt-3  mb-4 form_title">{{__('real estate assist')}} : {{__('upload prove')}}</h4><hr>

        
            <div class="container">

            <div class="card mt-5">

                <div class="card-header"> <h4 style="color:#251F4F; font-size:17px; font-weight: 500;">
                    <i class="fas fa-arrow-circle-right site_points"></i> {{__('please upload a document that proves you will own real estate')}}
                    </h4>
                </div>

                <div class="card-body">
                    <strong>{{__('accepted document types are')}}</strong>
                    <ul>
                        <li> {{__('mortgage approval document')}}</li>
                    </ul>
                </div>
            </div>
            </div>

            <div class="container">
            <form action="{{ route('real-estate-prove.handle') }}" enctype="multipart/form-data"  method="POST">
                @csrf
                <div class="form-row mt-5">

                    <div class="form-group col-md-4">
                        <select id="inputState"  name="documentType"  class="form-control">
                            <option value ="choose">{{__('choose document type')}}</option>
                            <option value ="1" >{{__('notarized warranty deed')}}</option>
                            <option value ="2" >{{__('purchase document')}}</option>
                            <option value ="3" >{{__('mortgage statement')}}</option>
                            <option value ="4" >{{__('property tax bill')}}</option>

                             <option value ="0" >{{__('other')}}</option>
                        </select>

                        @if ($errors->has('documentType'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('documentType') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="form-group col-md-8  custom-file">

                        {{-- <label>{{__('upload verification document')}}</label> --}}
                        <input type="file" name="realEstateProveDocument"
                               class="custom-file-input"
                               id="customFile"
                               value="{{ old('realEstateProveDocument') }}" >
                        <label class="custom-file-label" for="customFile">{{__('choose file to upload')}} </label>

                        @if($errors->has('realEstateProveDocument'))
                            <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('realEstateProveDocument') }}</strong>
                            </span>
                        @endif

                    </div>


                </div>

        
                 <a type="button" href="{{route('real-estate-ownership.status')}}"
                    class="btn btn-outline-dark mt-5 float-left"> 
                    <i class="fas fa-arrow-left"></i>  {{__('back')}}
                 </a>

                 <button type="submit" class="btn btn-primary mt-5 float-right buttons_style">
                    <i class="fas fa-upload"></i> {{__('upload')}} 
                  </button>




            </form> <br><br><br>
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
