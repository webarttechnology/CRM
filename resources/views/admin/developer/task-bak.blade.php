<x-header-component/> 
{{-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Load Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

{{-- <link rel="stylesheet" href="{{ asset('assets/css/filter_multi_select.css') }}" /> --}}
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
{{-- <script src="{{ asset('assets/js/filter-multi-select-bundle.min.js') }}"></script> --}}

{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet">
<script src="{{ asset('select2/select2.min.js') }}"></script>
<style>
.select2-container--default .select2-selection--single .select2-selection__rendered {
    width: 190px !important;
}
.select2-container--default .select2-selection--multiple {
    width: 190px !important;
}
</style>
<x-nav-component/>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ __("Task Details") }}</h4>
        <div class="card">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h5 class="card-header">{{ __("Task Details") }}</h5>
            </div>
            <div class="col-md-4 text-end">
                <div class="me-4">
                @if(in_array(Auth::user()->id , [1,2,3]))    
                    <a href="javascript:void(0)" id="openpopup" class="btn btn-primary">Add Task</a>
                @endif
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="text-nowrap table-responsive">
            <span class="text-success">{{ Session::get('successmsg') }}</span>
            <span class="text-danger">{{ Session::get('errmsg') }}</span>
            <table class="table table-striped table-responsive ">
                <thead>
                    <tr>
                    <th>Sales name</th>
                    <th>Assign By</th>
                    <th>Task title</th>
                    <th>Start date & time</th>             
                    <th>End date & time</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($data as $val)               
                    <tr>
                        <td>{{ $sales[$val->sale_id] }}</td>
                        <td>{{ $assignBy[$val->assign_by] }}</td>
                        <td>{{ $val->title }}</td>
                        <td>{{ date("d/m/Y h:i:s A", strtotime($val->start_date)) }}</td>
                        <td>{{ date("d/m/Y h:i:s A", strtotime($val->end_date)) }}</td>
                         <td>{{ getProjectStatus($val->status) }}</td>
                         <td>{{ $val->created_at->format('d-M-Y') }}</td>
                        <td>
                            <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if($isEdit == 1)
                                <a class="dropdown-item clickEdit" href="javascript:void(0)" data-id="{{ $val->id }}"><i class="bx bx-edit-alt me-1"></i>Edit</a>                               
                                @endif
                                @if($isDelete == 1)
                                <a class="dropdown-item" onclick="return confirm('Do you really want to delete this data?')" href="{{ route('developer.task.delete', ['deleteid' => $val->id ]) }}"
                                ><i class="bx bx-trash me-1"></i> Delete</a>
                                @endif
                                @if($isShow == 1)
                                <a class="dropdown-item" href="{{ route('developer.task.show', ['id' => $val->id ]) }}"
                                    ><i class="bx bx-trash me-1"></i> Show</a>
                                @endif
                            </div>
                            </div>
                        </td>
                    </tr> 
                    @endforeach
                                   
                </tbody>
                </table>
            </div>
        </div>
        </div>             
    </div>    


@include('admin.developer.add');
<x-footer-component/>

<script>
    // CKEDITOR.replace( 'details' );


var mySelect = $(".js-example-basic-multiple").select2({
    dropdownParent: $("#exampleModal"),
    placeholder: "Select",
    allowClear: true,                                 
});


    // $(function () {      
    //     var shapes = $('#assign_to').filterMultiSelect({
    //       selectAllText: 'all...',
    //       placeholderText: 'click to select a shape',
    //       filterText: 'search',
    //       labelText: 'Shapes',
    //       caseSensitive: true,
    //     });
    //   }); 

</script>


<script>
   $(document).ready(function(){   
    
            var mySelect = $(".js-example-basic-multiple").select2({
            dropdownParent: $("#exampleModal"),
            placeholder: "Select",
            allowClear: true,                                 
        });

        $("#openpopup").click(function(){
            $('input').val('');
            $('select').val('');
            // CKEDITOR.instances['details'].setData('');
            $('#exampleModal').modal('show');
            $('input[name="submit"]').val('Submit');
            $("#details").val('');
            $("#remarks").val('');
            $('#assign_to').val(null).trigger('change');
            // mySelect.trigger('query');
        });

        $("#assign_type").change(function(){

             if($(this).val()){
                 $('#assign_to').val(null).trigger('change');
             }

            $.ajax({
                  url: "{{ route('developer.get-assign-to') }}",
                  type:"POST",
                  data:{
                    "_token": "{{ csrf_token() }}",
                    id:  $(this).val(),
                  },
                  success:function(response){
                    $('#assign_to').html(response);
                  }
            });
        })



        $("#taskform").on("submit", function(){         
            event.preventDefault();
            // CKEDITOR.instances.details.updateElement();
            $('[id*=_formerrmsg]').text('');
            if($("#sale_id").val() == ""){
                $('#sale_id_formerrmsg').text("Sale name is a required field");
                $('#sale_id').focus();
                return false;
            }else if($("#assign_type").val() == ""){
                $('#assigntype_formerrmsg').text("Assign type is a required field");
                return false;
            }else if($("#assign_to").val() == ""){
                $('#assignto_formerrmsg').text("Assign to is a required field");
                return false;
            }else if($("#title").val() == ""){
                $('#title_formerrmsg').text("Title is a required field");
                return false;
            }else if($("#start_date").val() == ""){
                $('#start_date_formerrmsg').text("Start date is a required field");
                return false;
            }else if($("#end_date").val() == ""){
                $('#end_date_formerrmsg').text("End date is a required field");
                return false;
            }else{
                $.ajax({
                  url: "{{ route('developer.task.success') }}",
                  type:"POST",
                  data:{
                    "_token": "{{ csrf_token() }}",
                    sale_id:$("#sale_id").val(),
                    assign_to:$("#assign_to").val(),
                    title:$("#title").val(),
                    details:$("#details").val(),
                    start_date: $("#start_date").val(),
                    end_date: $("#end_date").val(),
                    remarks: $("#remarks").val(),
                    update_id: $("#update_id").val(),
                  },
                    success:function(response){
                        if(response.status == 1){
                            $(".text-success").text(response.successmsg)
                            $('#exampleModal').modal('hide');
                            window.location.href = "/developer/task";                          
                        }else{
                            $(".text-err").text(response.errmsg)
                        }
                    },
                    error: function(response) {  
                        $('#sale_id_formerrmsg').text(response.responseJSON.errors.sale_id);
                        $('#assignto_formerrmsg').text(response.responseJSON.errors.assign_to);
                        $('#title_formerrmsg').text(response.responseJSON.errors.title);
                        $('#details_formerrmsg').text(response.responseJSON.errors.details);
                        $('#start_date_formerrmsg').text(response.responseJSON.errors.start_date);
                        $('#end_date_formerrmsg').text(response.responseJSON.errors.end_date);
                    },
                })
            }

        });



        $(".clickEdit").on('click', function(){  
            var id = $(this).data('id');
            $('#assign_to').val(null).trigger('change');

            $.ajax({
                    url: "{{ route('developer.task.edit') }}",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        task_id: $(this).data('id'),
                    },
                        success:function(response){
                            if(response.status == 1){
                                $("#update_id").val(response.data.id);
                                $("#sale_id").val(response.data.sale_id);
                                $("#assign_type").val(response.role);
                                // $("#assign_to").val(response.data.assign_to);
                                $("#title").val(response.data.title);
                                $("#start_date").val(response.data.start_date);
                                $("#end_date").val(response.data.end_date);
                                $("#remarks").val(response.data.remarks);
                                $("#details").val(response.data.details);
                                $('#exampleModal').modal('show');
                                
                                var assignedTo = JSON.parse(response.data.assign_to);

                                $('#assign_to').val(assignedTo).trigger('change');
                                

                                // CKEDITOR.instances['details'].setData(response.data.details)
                            }else{
                                $(".text-err").text(response.errmsg)
                            }
                        },
                        error: function(response) {  
                            alert(response);
                            return false;
                        },
                });
        });


   });

  
 
</script>