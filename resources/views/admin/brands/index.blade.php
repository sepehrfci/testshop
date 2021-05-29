@extends("admin.layout.master")
@section('title','مدیریت برندها')
@section("content",)
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">برند ها</h4>
                                <a class="btn btn-success font-14 mb-4" href="{{ route("brands.create") }}">
                                    اضافه کردن برند جدید
                                </a>


                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام</th>
                                        <th>عکس</th>
                                        <th>تایخ ایجاد</th>
                                        <th>حذف</th>
                                        <th>ویرایش</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->id }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td><img src="{{ str_replace('public','/storage', $brand->image)}}" width="60px" alt="{{$brand->name}}"></td>
                                            <td>{{ $brand->created_at }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalScrollable{{ $brand->id }}">
                                                    حذف
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalScrollable{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">آیا از حذف برند  {{ $brand->name }} مطمنئید؟</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                توجه داشته باشید که برای حذف یک برند از قبل باید تمامی محصولات موجود در آن برند را حذف کرده باشید در غیر اینصورت برند حذف نخواهد شد.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                                <form action="{{route('brands.destroy',$brand)}}" method="POST">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="{{route('brands.edit',$brand)}}">
                                                    ویرایش
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>

@endsection
