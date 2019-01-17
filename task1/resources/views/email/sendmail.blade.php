<div id="container" style="width: 400px;height: 370px;background-color: lightyellow;border-radius: 20px;border:1px solid brown">
    <div class="subject" style="width: 100px;margin:auto;">
        <h1>{{$subject}}</h1>
    </div>
    <div class="content" style="width: 300px;height: 100px;margin:auto;">
        <audio controls src="{{Session::get('urlo')}}"></audio>
    </div>
    <div class="content" style="width: 300px;height: 150px;margin:auto;background-color:lightblue;border-radius:5px;">
         {{$data}}
    </div>
</div>