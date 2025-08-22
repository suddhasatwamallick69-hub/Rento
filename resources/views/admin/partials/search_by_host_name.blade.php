@php
                      $id=1;
                  @endphp
                  @foreach ($verify_vehicle as $items)
                  <tr>
                    <th scope="row">{{$id}}</th>
                    <td>{{$items->model_name}}</td>
                    <td><a href="">{{$items->name}}</a></td>
                    <td>@if ($items->availability=='No' || $items->approval=='No')
                      <a href="{{url('/admin/vehicle_details')}}/{{$items->id}}"  class="btn btn-primary">Verify Details</a>
                    @else
                       <a href="{{url('/admin/vehicle_details')}}/{{$items->id}}"  class="btn btn-success"> Details</a>
                    @endif</td>
                    <td>@if ($items->availability=='No' && $items->approval=='No')
                       <p class="badge bg-danger">Not Verified</p>
                    @else
                    <p class="badge bg-success">Verified</p>
                    @endif</td>
                    <td>@if ($items->availability=='Yes')
                            <p class="text-success">Vehicle Listed</p>
                        @else
                            <p class="badge bg-danger">Unlisted</p>
                        @endif
                    </td>
                    <td>
                      @php
                        date_default_timezone_set('Asia/Kolkata');
                        $current_date = date("Y-m-d");
                      @endphp
                      @if ($current_date>=$items->validity_date)
                           <span class="badge bg-danger">Vehicle Invalid</span>
                      @else
                          <span>Vehicle Valid</span>
                      @endif
                    </td>
                  </tr>
                  @php
                      $id++;
                  @endphp
                  @endforeach