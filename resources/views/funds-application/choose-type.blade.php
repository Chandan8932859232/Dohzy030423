@extends ('layouts.user')

@section('title', 'Apply For Funds')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-1">
            <h3 class="text-center mt-2 form_title">Choose Application Type</h3> <hr>


                <form action="{{ route('application-type.display') }}" method="POST" >
                    @csrf

                    <label for="">Do you belong to a savings group ( "Njangi", "Tontine" )
                        @component('partials._helpers')
                            @slot('title')
                                title of help
                            @endslot

                            @slot('explain')
                                explain help
                            @endslot
                        @endcomponent
                    </label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userBelongsToGroup"
                                   value="yes" {{ old('userBelongsToGroup')=="yes" ?'checked':''}}  >
                            <label class="form-check-label" for="exampleRadios1">Yes </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio"  name="userBelongsToGroup"
                                   value ="no" {{ old('userBelongsToGroup')=="no" ?'checked':''}} >
                                   {{--value="no" {{{ (isset($application->userBelongsToGroup) && $application->userBelongsToGroup == 'no') ? "checked" : "" }}}  > --}}
                            <label class="form-check-label" for="exampleRadios2">No</label>
                        </div>

                 {{--
                     <label for=" " class="mt-2"> Do you want to apply through the group to ?
                         @component('partials._helpers')
                            @slot('title')
                               Another title
                             @endslot

                             @slot('explain')
                                    Another explain
                                @endslot
                         @endcomponent

                     </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="applyThroughGroup" id="exampleRadios1" value="yes" checked>
                            <label class="form-check-label" for="exampleRadios1">Yes </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="applyThroughGroup" id="exampleRadios2" value="no">
                            <label class="form-check-label" for="exampleRadios2">No</label>
                        </div>
                        --}}

                    <button type="submit"  class="btn btn-success my-3 buttons_style">
                        Next Step <i class="fas fa-arrow-right"></i></button>

                </form>
            </div>
        </div>



@endsection
