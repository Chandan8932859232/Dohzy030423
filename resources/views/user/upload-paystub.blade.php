@extends('layouts.user')

@section('title', 'Upload PayStub')

@section('content')

    <div class="row">
        <div class="col-sm-8">


            <h3 class="form_title ml-3 mt-2" >{{__('upload pay stub')}}</h3>



            <div class="container">

                <div class="card mt-5 mb-5 notes_style">
                    <div class="card-body">

                      <p class="ml-3 mt-3"> <i class="fas fa-arrow-circle-right site_points"></i> {{__('in order to keep using our services, we need you to upload')}} <span style="color:#312A5C; font-weight:900; font-size:15px;">{{__('your most recent')}}</span> {{__('pay stub as prove of employment. This is document is usually provided by your employer')}}.

                    </div>
                </div>



                <form action="{{route('pay-stub.provided')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-row">

                        <div class="form-group col-md-8 custom-file">

                            <input type="file" name="payStub"
                                   class="custom-file-input form-control {{ $errors->has('payStub') ? ' is-invalid' : '' }}"
                                   id="customFile"
                                   value="{{ old('payStub') }}" >
                            <label class="custom-file-label" for="customFile">{{__('choose file to upload')}} </label>

                            @if($errors->has('payStub'))
                                <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('payStub') }}</strong>
                            </span>
                            @endif

                        </div>

                    </div>

                    <br><br>




                    <button type="submit"   class="btn btn-success buttons_style">
                     <i class="fas fa-upload"></i> {{__('upload pay stub')}}
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
