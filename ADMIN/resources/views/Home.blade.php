@extends('layout.app')

@section('title','Home')
@section('content')


<div class="container">
	<div class="row">

		<div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Article Published</h6>
                    <h2 class="text-right"><i class="fas fa-newspaper f-left"></i><span>486</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Category</h6>
                    <h2 class="text-right"><i class="fas fa-folder f-left"></i><span>486</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Users</h6>
                    <h2 class="text-right"><i class="fas fa-users f-left"></i><span>486</span></h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Tags</h6>
                    <h2 class="text-right">  <i class="fa fa-hashtag f-left"></i><span>486</span></h2>
                </div>
            </div>
        </div>
	</div>


@endsection 