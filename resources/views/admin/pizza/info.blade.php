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
                                <legend class="text-center"> Pizza Info</legend>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane d-flex justify-content-center" id="activity">

                                        <div class=" text center me-5 mt-2 p-3">
                                            <img src="{{asset('uploads/'.$info->image)}}" alt="" class="img-thumbnail " style="width:300px;height:250px">
                                        </div>

                                        <div class="">
                                        <div class="mt-3">
                                            <b>Name</b> : <span>{{$info->pizza_name}}</span>
                                        </div>

                                        <div class="mt-3">
                                            <b>Price</b> : <span>{{$info->price}} Kyats</span>
                                        </div>

                                        <div class="mt-3">
                                            <b>Publish Status</b> : <span>
                                                @if($info->publish_status ==1)
                                                YES
                                                @else
                                                NO
                                                @endif
                                            </span>
                                        </div>


                                        <div class="mt-3">
                                            <b>Category</b> : <span>{{$info->category_id}}</span>
                                        </div>

                                        <div class="mt-3">
                                            <b>Discount Price</b> : <span>{{$info->discount_price}}</span>
                                        </div>
                                        <div class="mt-3">
                                            <b>Buy One Get One Status</b> : <span>
                                                @if($info->buy_one_get_one_status ==1)
                                                YES
                                                @else
                                                NO
                                                @endif
                                            </span>
                                        </div>

                                        <div class="mt-3">
                                            <b>Description</b> : <span>{{$info->description}}</span>
                                        </div>
                                        </div>










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
