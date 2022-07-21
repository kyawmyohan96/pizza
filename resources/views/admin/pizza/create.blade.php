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
                                <legend class="text-center">Add Pizza</legend>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <form action="{{route('admin#insertPizza')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name">
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
                                                    <input type="number" class="form-control" id="inputName" name="price" placeholder="price">
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
                                                        <option value="1">publish</option>
                                                        <option value="0">unpublish</option>
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
                                                        <option value="">choose category..</option>
                                                        @foreach($category as $item)
                                                        <option value="{{$item->category_id}}">{{$item->category_name}}</option>


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
                                                    <input type="number" class="form-control" id="inputName" name="discount" placeholder="discount">


                                                    @if($errors->has('discount'))
                                                    <p class="text-danger">{{$errors->first('discount')}}</p>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Buy 1 Get 1</label>
                                                <div class="col-sm-10">


                                                    <input type="radio" class="form-input-check ms-2" name="buyOneGetOne" value="1">Yes
                                                    <input type="radio" class="form-input-check ms-2" name="buyOneGetOne" value="0">No

                                                    @if($errors->has('buyOneGetOne'))
                                                    <p class="text-danger">{{$errors->first('buyOneGetOne')}}</p>
                                                    @endif
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">WatingTime</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="inputName" name="watingTime" placeholder="watingTime">
                                                    @if($errors->has('watingTime'))
                                                    <p class="text-danger">{{$errors->first('watingTime')}}</p>
                                                    @endif
                                                </div>
                                            </div>





                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label ">Description</label>
                                                <div class="col-sm-10">

                                                    <textarea class="form-control" rows="3" placeholder="Leave a comment here" name="description"></textarea>

                                                    @if($errors->has('description'))

                                                    <p class="text-danger">{{$errors->first('description')}}</p>
                                                    @endif
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn bg-dark text-white float-end">Add</button>
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
