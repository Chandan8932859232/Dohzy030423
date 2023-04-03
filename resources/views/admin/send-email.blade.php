@extends ('layouts.admin')

@section('title', 'Admin Home')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-1">

              @include('pop-ups.email-samples')

            <h2 class="form_title   display-5 mt-4"> Send Email</h2> <hr>
            <div>

                <form method="post" action="{{ route('admin.send-email')}}">
                    @csrf

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Receiver firstname </label>
                            <input type="text" name="receiverFirstName" class="form-control {{ $errors->has('receiverFirstName') ? ' is-invalid' : '' }}"
                                   value="{{ old('receiverFirstName') }}"  />

                            @if($errors->has('receiverFirstName'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('receiverFirstName') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label> Receiver lastname </label>
                            <input type="text" name="receiverLastName" class="form-control {{ $errors->has('receiverLastName') ? ' is-invalid' : '' }}"
                                   value="{{ old('receiverLastName') }}" />

                            @if($errors->has('receiverLastName'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('receiverLastName') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label> Receiver Email </label>
                            <input type="text" name="receiverEmail" class="form-control {{ $errors->has('receiverEmail') ? ' is-invalid' : '' }}"
                                   value="{{ old('receiverEmail') }}" />

                            @if($errors->has('receiverEmail'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('receiverEmail') }}</strong>
                            </span>
                            @endif
                        </div>


    

                        <div class="form-group col-md-6">
                            <label> Subject</label>

                            <input type="text" name="mailSubject" class="form-control {{ $errors->has('mailSubject') ? ' is-invalid' : '' }}"
                            value="{{ old('mailSubject') }}" />
                            <small>This is what appears in the inbox of the user(eg : Payment Reminder, Payment Complete, Divident paid)</small>
                        
                            @if($errors->has('mailSubject'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mailSubject') }}</strong>
                            </span>
                            @endif

                        </div>


                        <div class="form-group col-md-12">
                            <label> Greeting</label>

                            <input type="text" name="greeting" class="form-control {{ $errors->has('greeting') ? ' is-invalid' : '' }}"
                            value="{{ old('greeting') }}" />
                            <small>Examples: Hello Jane, Bonjour Jane</small>
                        
                            @if($errors->has('greeting'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('greeting') }}</strong>
                            </span>
                            @endif

                        </div>


                        <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Message</label>
                            <textarea name="mailMessage" class="form-control {{ $errors->has('mailMessage') ? ' is-invalid' : '' }}"  rows="5"></textarea>

                            @if($errors->has('mailMessage'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mailMessage') }}</strong>
                            </span>
                            @endif

                        </div>


                    </div>

                    <button type="submit" class="btn btn-info mb-3">Send Email</button>
                </form>
            </div>
        </div>
    </div>

@endsection

<!--page specific scripts -->
@section('scripts')

@endsection
