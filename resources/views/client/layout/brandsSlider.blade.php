<div id="carousel" class="owl-carousel nxt">
    @foreach($brands as $brand)
        <div class="item text-center"> <a href="#"><img src="{{ str_replace('public','/storage',$brand->image) }}" alt="{{$brand->name}}" class="img-responsive" /></a> </div>
    @endforeach
</div>
