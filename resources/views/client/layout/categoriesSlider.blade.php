@foreach($categories as $category)
        @continue($category->productCount()==0)
    <h3 class="subtitle">{{ $category->title }} - <a class="viewall" href="category.html">نمایش همه</a></h3>
    <div class="owl-carousel latest_category_carousel">
        @foreach($category->getProducts() as $product)
            <div class="product-thumb clearfix">
                <div class="image"><a href="{{route('client.product.index',$product)}}"><img src="{{ str_replace('public','/storage',$product->image) }}" alt="{{ $product->title }}" title="{{ $product->title }}" class="img-responsive" /></a></div>
                <div class="caption">
                    <h4><a href="{{route('client.product.index',$product)}}">{{ $product->title }}</a></h4>
                    <p class="price">
                        @if($product->has_discount)
                            <span class="price-new">{{$product->cost_with_discount}} تومان</span>
                            <span class="price-old">{{$product->cost}} تومان</span>
                            <span class="saving">-{{$product->discount->value}}%</span> </p>
                        @else
                        <span class="price-new">{{$product->cost}} تومان</span>
                        @endif
                    <div class="rating"> <span class="fa fa-stack">
                            <i class="fa fa-star fa-stack-2x"></i>
                            <i class="fa fa-star-o fa-stack-2x"></i>
                        </span>
                        <span class="fa fa-stack">
                            <i class="fa fa-star fa-stack-2x"></i>
                            <i class="fa fa-star-o fa-stack-2x"></i>
                        </span>
                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x">
                            </i><i class="fa fa-star-o fa-stack-2x"></i>
                        </span>
                        <span class="fa fa-stack">
                            <i class="fa fa-star fa-stack-2x"></i>
                            <i class="fa fa-star-o fa-stack-2x"></i>
                        </span>
                        <span class="fa fa-stack">
                            <i class="fa fa-star-o fa-stack-2x"></i>
                        </span>
                    </div>
                </div>
                <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                        <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endforeach
