@extends('admin.layouts.app')

@section('content')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Vehicle Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
          {{-- <li class="breadcrumb-item">Forms</li> --}}
          <li class="breadcrumb-item active">add vehicle category</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Vehicle Category</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" action="{{route('vehicle_category_submit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                  <div class="form-floating mb-3">
                    <select class="form-select" name="parent_id" id="floatingSelect" aria-label="Parent Category">
                      <option selected>--Select Parent Category--</option>
                      <option value="0">Parent Category</option>
                      @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                      {{-- @foreach ($categories as $category)
                      <optgroup label="{{$category->name}}"></optgroup>
                      @foreach ($subcategories as $subcategory)
                      <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                      @endforeach
                        
                      @endforeach --}}
                    </select>
                    <label for="floatingSelect">Parent Category</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" name="name" class="form-control" id="floatingName" placeholder="Your Name">
                    <label for="floatingName">Category Name</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" name="description" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                    <label for="floatingTextarea">Category Description</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Category Image Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="image" multiple id="formFile">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection
@section('title')
    Admin Add Category
@endsection