<form method="post" action="{{ route('search.request')}}">
    @csrf
    <div class="input-group p-2">
        <input type="text" name="searchTerm" class="form-control" placeholder="Search user by account id, name, email search loan by loan id " >
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </div>

    {{--<small class="input-group ml-2"><i class="fas fa-info-circle"></i> Search user by account id or name, search loan by loan id </small>--}}

</form>
