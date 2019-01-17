<style>
    .appear{
        transition: opacity 4s;
    }
</style>


@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <p class="alert alert-danger appear">{{ $error }}</p>
    @endforeach
@endif

@if (session()->has('message'))
    <p class="alert alert-success appear" style="margin-top:30px;">{{ session('message') }}</p>
@endif


