@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-10 offset-2 mt-5">
                    <div class="col-md-10">
                        <a href="{{route('admin#pizza')}}" class="text-decoration-none">
                            <div class="mb-4 text-dark"><i class="fa-solid fa-arrow-left-long"></i> back</div>
                        </a>
                        <div class="card">
                            <div class="card-header p-2">
                                <legend class="text-center">Edit Pizza</legend>
                            </div>
                            <div class="card-body">

                            <div class="text-center">
                            <img src="{{asset('uploads/'.$pizza->image)}}" class="img-thumbnail mb-3" width="120px">

                            </div>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <form action="{{route('admin#updatePizza',$pizza->pizza_id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{old('name',$pizza->pizza_name)}}">
                                                    @if($errors->has('name'))
                                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Image</label>
                                                <div class="col-sm-10">
                                                    <input type="file" class="form-control" id="inputName" name="image" placeholder="image">
                                                    @if($errors->has('image'))
                                                    <p class="text-danger">{{$errors->first('image')}}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Price</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="inputName" name="price" placeholder="price" value="{{old('price',$pizza->price)}}">
                                                    @if($errors->has('price'))
                                                    <p class="text-danger">{{$errors->first('price')}}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Pulish Status</label>
                                                <div class="col-sm-10">
                                                    <select name="publish" id="" class="form-control">
                                                        <option value="">choose...</option>
                                                        @if($pizza->publish_status == 0)
                                                        <option value="1">publish</option>
                                                        <option value="0" selected>unpublish</option>

                                                        @else
                                                        <option value="1" selected>publish</option>
                                                        <option value="0" >unpublish</option>

                                                        @endif

                                                    </select>
                                                    @if($errors->has('publish'))
                                                    <p class="text-danger">{{$errors->first('publish')}}</p>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Catrgory</label>
                                                <div class="col-sm-10">
                                                    <select name="category" id="" class="form-control">
                                                        <option value="{{$pizza->category_id}}">{{$pizza->category_name}}</option>
                                                        @foreach($category as $item)

                                                        @if($item->category_id != $pizza->category_id)
                                                        <option value="{{$item->category_id}}">{{$item->category_name}}</option>

                                                        @endif


                                                        @endforeach

                                                    </select>
                                                    @if($errors->has('category'))
                                                    <p class="text-danger">{{$errors->first('category')}}</p>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Discount</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="inputName" name="discount" placeholder="discount" value="{{old('discount',$pizza->discount_price)}}">


                                                    @if($errors->has('discount'))
                                                    <p class="text-danger">{{$errors->first('discount')}}</p>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Buy 1 Get 1</label>
                                                <div class="col-sm-10">

                                                @if($pizza->buy_one_get_one_status == 1)
                                                <input type="radio" class="form-input-check ms-2" name="buyOneGetOne" value="1" checked>Yes
                                                @else()
                                                <input type="radio" class="form-input-check ms-2" name="buyOneGetOne" value="1">Yes
                                                @endif


                                                @if($pizza->buy_one_get_one_status == 0)
                                                <input type="radio" class="form-input-check ms-2" name="buyOneGetOne" value="0" checked>No
                                                @else()
                                                <input type="radio" class="form-input-check ms-2" name="buyOneGetOne" value="0">No
                                                @endif



                                                    @if($errors->has('buyOneGetOne'))
                                                    <p class="text-danger">{{$errors->first('buyOneGetOne')}}</p>
                                                    @endif
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">WatingTime</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="inputName" name="watingTime" placeholder="watingTime" value="{{old('watingTime',$pizza->wating_time)}}">
                                                    @if($errors->has('watingTime'))
                                                    <p class="text-danger">{{$errors->first('watingTime')}}</p>
                                                    @endif
                                                </div>
                                            </div>





                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Description</label>
                                                <div class="col-sm-10">

                                                    <textarea class="form-control" rows="3" placeholder="Leave a comment here" name="description">{{old('description',$pizza->description)}}</textarea>

                                                    @if($errors->has('description'))

                                                    <p class="text-danger">{{$errors->first('description')}}</p>
                                                    @endif
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn bg-dark text-white float-end">Update</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

@endsection
