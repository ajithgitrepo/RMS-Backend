@extends('layouts.app', ['activePage' => 'user-management', 'menuParent' => 'laravel', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">group</i>
                </div>
                <h4 class="card-title">{{ __('Users') }}</h4>
              </div>
              <div class="card-body">
                @canany(['isAdmin','isTopManagement','manage-users'],App\User::class)
                  <!-- <div class="row">
                    <div class="col-12 text-right">
                      <a href="{{ route('user.create') }}" class="btn btn-sm btn-rose">{{ __('Add user') }}</a>
                    </div>
                  </div> -->
                @endcan
                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover">
                    <thead class="text-primary">

                    <th>
                          {{ __('#') }}
                      </th>
                      <th>
                          {{ __('Name') }}
                      </th>
                      <th>
                        {{ __('Email') }}
                      </th>
                      <th>
                        {{ __('Role') }}
                      </th>
                      <th>
                        {{ __('Creation date') }}
                      </th>
                      @canany(['isAdmin','isTopManagement','manage-users'],App\User::class)
                        <th class="text-right">
                          {{ __('Actions') }}
                        </th>
                      @endcan
                    </thead>

                    @php

                        $i = 1;

                    @endphp

                    <tbody>
                      @foreach($users as $user)
                        <tr>
                           <td>
                            {{ $i++ }}
                          </td>
                          <td>
                            {{ $user->name }}
                          </td>
                          <td>
                            {{ $user->email }}
                          </td>
                          <td>
                            {{ $user->role->name }}
                          </td>
                          <td>
                             {{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}
                          </td>
                          <!-- @canany(['isAdmin','isTopManagement','manage-users'],App\User::class) -->
                              <td class="td-actions text-right">

                                
                               <div class="togglebutton">
                              <label>

                                    @if($user->is_active ==1)
                                    <input type="checkbox" name="is_active-{{$user->id}}" class="" class="status"  checked="" onchange="status({{$user->id}})" id="is_active-{{$user->id}}" value="0">
                                    @endif
                                   

                      
                                    @if($user->is_active ==0)
                                    <input type="checkbox" name="is_active-{{$user->id}}"  class="" class="status" id="is_active-{{$user->id}}" onchange="status({{$user->id}})" value="1">
                                    @endif

                                    
                               
                                <span class="toggle"></span>
                               
                              </label>
                            </div>
                          </td>
                                <!-- @if ($user->id != auth()->id())
                                    <form action="{{ route('user.destroy', $user) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        
                                        
                                        @canany(['isAdmin','isTopManagement','manage-users'],App\User::class)
                                          <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">close</i>
                                              <div class="ripple-container"></div>
                                          </button>
                                        @endcan
                                    </form>
                                
                                @endif -->
                              </td>
                          <!-- @endcan -->
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
      $('#datatables').fadeIn(1100);
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search users",
        },
        "columnDefs": [
          { "orderable": false, "targets": 5 },
        ],
      });
    });
    
    // function status(id){

    //     var stsvalue = document.getElementById("is_active-"+id).value;

    //     alert(stsvalue);

    //     Swal.fire({
    //       title: 'Are you sure?',
    //       text: "You can able to revert this!",
    //       icon: 'warning',
    //       showCancelButton: true,
    //       confirmButtonColor: '#3085d6',
    //       cancelButtonColor: '#d33',
    //       confirmButtonText: 'Yes, change it!'
    //     }).then((result) => {
    //       // alert('dcj')
    //       if (result.isConfirmed) {
    //         alert('ndc')

    //          $.ajax({
    //               url: '/status',
    //               type: 'GET',
    //               data: {'id':id,'is_active':stsvalue, _token:'{{csrf_token()}}'},
    //               dataType: 'json',

    //               success: function( data ) {
    //                  alert(data);

    //                  if(data == 1){
    //                     Swal.fire(
    //                       'Updated!',
    //                       'status has been deactivated.',
    //                       'success'
    //                     );
    //                     return false;
    //                  }

    //                   Swal.fire(
    //                       'Error!',
    //                       'Something went wrong.',
    //                       'warning'
    //                     );

    //               }       
    //           })

           
    //       }
    //     })


    // }
function status(id) {
  var status = document.getElementById("is_active-"+id).value;

  if(status == 1)
  {
    $("#is_active-"+id).val('0');
    $("#is_active-"+id).prop('checked',true);
  }
  if(status == 0)
  {
    $("#is_active-"+id).val('1');
    $("#is_active-"+id).prop('checked',false);
  }
 // alert(status);
 Swal.fire({
          title: 'Are you sure?',
          text: "You can able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, change it!'
        }).then((result) => {
          // alert('dcj')
          if (result.isConfirmed) {
            alert('ndc')
  $.ajax({
    url:'/status',
    type:'get',
    data:{'id':id,'is_active':status,_token:'{{csrf_token()}}'},
    dataType:'json',
    success: function(data){
   //  alert(data);

                     if(data == 1){
                        Swal.fire(
                          'Updated!',
                          'status has been updated.',
                          'success'
                        );
                        return false;
                     }

                      Swal.fire(
                          'Error!',
                          'Something went wrong.',
                          'warning'
                        );
                     },


  });
}
 })

 }
  
  </script>
  
@endpush