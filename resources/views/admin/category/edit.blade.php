@extends("admin.layout.master")
@section('title','ویرایش موضوع')
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
                                <h4 class="card-title">ویرایش موضوع {{ $category->title }}</h4>
                                <form action="{{route('category.update',$category)}}" method="POST">
                                    @csrf
                                    @method("PATCH")
                                    @if($errors)
                                        @foreach ($errors->all() as $error)
                                            <div class="alert bg-danger">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none';">× </span>
                                                <strong>خطا -</strong> {{$error}}
                                            </div>
                                        @endforeach
                                    @endif
                                    <label for="fname">عنوان موضوع</label>
                                    <input type="text" id="fname" name="title" placeholder="عنوان موضوع را وارد کنید" value="{{ $category->title }}">
                                    <label for="country">موضوع والد</label>
                                    <select id="country" name="category_id">
                                        <option value="">--بدون موضوع--</option>
                                        @if($categories->count()>0)
                                            @foreach($categories as $parent)
                                                <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                                @if(!is_null($parent->children))
                                                    @foreach($parent->children as $child)
                                                        <option value="{{ $child->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ $child->title }}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>

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
