@extends("admin.layout.master")
@section('title','ایجاد محصول جدید')
@section("content")
    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Basic Form area Start -->
        <div class="container-fluid">
            <!-- Form row -->
            <div class="row">
                <div class="col-xl-12 box-margin height-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="stacked-form-area">
                                <h4 class="card-title">محصول جدید </h4>
                                <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            <div class="alert bg-danger">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none';">× </span>
                                                <strong>خطا -</strong> {{$error}}
                                            </div>
                                        @endforeach
                                    @endif
                                    <label for="fname">عنوان محصول</label>
                                    <input type="text" id="fname" name="title" placeholder="عنوان محصول را وارد کنید">
                                    <label for="slug">اسلاگ محصول</label>
                                    <input type="text" id="slug" name="slug" placeholder="اسلاگ محصول را وارد کنید">
                                    <label for="cost">قیمت محصول</label>
                                    <input type="number"
                                            style="width: 100%;
                                            padding: 12px 20px;
                                            margin: 8px 0;
                                            display: inline-block;
                                            border: 1px solid #e8ebf1;
                                            border-radius: 4px;
                                            box-sizing: border-box;"
                                           id="cost" name="cost" placeholder="قیمت محصول را وارد کنید">
                                    <label for="country">موضوع محصول</label>
                                    <select id="country" name="category_id">
                                        <option value="">--بدون محصول--</option>
                                        @if($categories->count()>0)
                                            @foreach($categories as $parent)
                                                <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                                @if($parent->children)
                                                    @foreach($parent->children as $child)
                                                        <option value="{{ $child->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ $child->title }}</option>
                                                        @if($child->children)
                                                            @foreach($child->children as $child2)
                                                                <option value="{{ $child2->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ $child2->title }}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="brand">برند محصول</label>
                                    <select id="brand" name="brand_id">
                                        <option value="">--بدون برند--</option>
                                        @if($brands->count()>0)
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label for="image">عکس محصول</label>
                                    <input class="file" type="file" name="image" id="image">
                                    <label for="description">توضیحات محصول</label>
                                    <textarea name="description"
                                              style="
                                                    width: 100%;
                                                    padding: 12px 20px;
                                                    margin: 8px 0;
                                                    display: inline-block;
                                                    border: 1px solid #e8ebf1;
                                                    border-radius: 4px;
                                                    box-sizing: border-box;
                                                    "
                                              id="description"></textarea>


                                    <input class="btn btn-primary btn-block mt-15" type="submit" value="ارسال">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
