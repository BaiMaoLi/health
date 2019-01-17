<link rel="stylesheet" type="text/css" href="{{asset('public/user/css/documents.css')}}">


@extends('user.template')
@section('content')
    <div id="all-alert-main">
        <h4 id="employee-name">{{$user->first_name}}  {{$user->last_name}}</h4>
        <div class="row">
            <h4 id="employee-id-name">Employee ID</h4>
            <h4 id="employee-id-number">{{$user->employee_number}}</h4>
        </div>
        <div>
        <div class="row">
            <i class="demo-icon icon-doc-icon" id="my-alert-icon" aria-hidden="true"></i>
            <h4 id="my-alert-txt">Health Forms</h4>
        </div>
        </div>        <div class="line"></div>
        <div id="AllDocuments">
            <div class="container-fluid">
                <div class="row doc-container">
                    @foreach($document as $temp)
                        <div class="col-md-6">
                            <div class="row doc-file-container">
                                @php($ext=substr($temp->url,-3))
                                @if ($ext=='pdf')
                                    <a class="doc-anchor" href="download/{{$temp->id}}"><i class="demo-icon icon-pdf-file doc-icon"></i></a>
                                @else
                                    <a class="doc-anchor" href="download/{{$temp->id}}"><i class="demo-icon icon-doc-file doc-icon"></i></a>
                                @endif
                                    <a href="download/{{$temp->id}}" class="doc-title">{{$temp->title}}</a>
                             </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    {{--<script>--}}
        {{--window.history.pushState("/new-url");--}}
    {{--</script>--}}



@endsection