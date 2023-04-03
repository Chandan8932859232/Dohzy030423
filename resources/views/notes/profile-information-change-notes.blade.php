<div class="col-sm-4 mt-2">
    <div class="container">
    <ul class="list-group" >
        <li class="list-group-item side_note_heading">
            <h5><i class="far fa-edit"></i> {{ __('related services')}} </h5> </li>
        <li class="list-group-item"><i class="fas fa-lock site_points"></i>
            <a href="{{route('show-password.form')}}"  style="text-decoration: none;"> {{ __('change password')}}</a>
        </li>
       {{--
        <li class="list-group-item"><i class="fas fa-mobile-alt site_points"></i>
            <a href="{{route('phone.provide')}}" style="text-decoration: none;"> {{ __('change phone number')}}</a>
        </li>

        <li class="list-group-item"><i class="fas fa-at site_points"></i>
            <a href="{{route('phone.provide')}}" style="text-decoration: none;"> {{__('change login email')}}</a>
        </li>
        --}}

    </ul>
    </div>
</div>

