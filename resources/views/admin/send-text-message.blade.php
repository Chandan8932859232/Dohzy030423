@extends ('layouts.admin')

@section('title', 'Admin Home')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-1">

              @include('pop-ups.email-samples')

            <h2 class="form_title   display-5 mt-4"> Send Text Message </h2> <hr>
            <div>

                <form method="post" action="{{ route('admin.send-text')}}">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-12">
                            <label> Phone number </label>
                            <input type="text" name="phoneNumber" class="form-control {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                   value="{{ old('phoneNumber') }}" />
                                   <small>
                                     <ul>
                                      <li>Please add country code to the number </li>
                                      <li>Do not add spaces or dash </li>
                                       <li>example : 15147776534</li>
                                     </ul>
                                     
                                    </small>

                            @if($errors->has('phoneNumber'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phoneNumber') }}</strong>
                            </span>
                            @endif
                        </div>



                        <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Message</label>
                            <textarea name="textMessage" class="form-control {{ $errors->has('textMessage') ? ' is-invalid' : '' }}"  rows="4"></textarea>

                            @if($errors->has('textMessage'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('textMessage') }}</strong>
                            </span>
                            @endif

                        </div>


                    </div>

                    <button type="submit" class="btn btn-info mb-3">Send Text</button>
                </form>
            </div>
        </div>
    </div>

@endsection

<!--page specific scripts -->
@section('scripts')

@endsection
