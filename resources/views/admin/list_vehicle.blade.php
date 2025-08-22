@extends('admin.layouts.app')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>List of Vehicles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Home</a></li>
          {{-- <li class="breadcrumb-item">Tables</li> --}}
          <li class="breadcrumb-item active">List of Vehicles</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Vehicles</h5>
              <p><select name="" id="" class="">  
                    <option value="">--Search--</option>
                    <option value="Admin">Availability</option>
                    <option value="User">Approval</option>
                 </select>
              </p>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Vehicle Name</th>
                    <th scope="col">Vehicle Category</th>
                    <th scope="col">Owner</th>
                    <th scope="col"></th>
                    <th scope="col">Availability</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($list_vehicle as $items)
                  <tr>
                    <th scope="row">{{$items->id}}</th>
                    <td>{{$items->model_name}}</td>
                    <td>{{$items->category}}</td>
                    <td><a href="">{{$items->name}}</a></td>
                    <th scope="col"><a href="{{url('/admin/vehicle_details')}}/{{$items->id}}">Details</a></th>
                    <td>{{$items->availability}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </main>
@endsection