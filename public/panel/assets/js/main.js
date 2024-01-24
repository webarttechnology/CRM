$(function(){

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });


	  getTaskList();

	function getTaskList() {
		$.ajax({
			type: 'POST',
			url: '/workhistory/get-task-list',
			success:function(data){
				$('.task-list-section').html(data); 
			},
		});
	}


	function printErrorMsg(msg) {
        $.each( msg, function( key, value ) {
            toastr.error(value);
        });
    }


	$(document).on("submit", ".save", function(e) {
        e.preventDefault();
       
          var url = $(this).attr('action');
          var method = $(this).attr('method');  
          var data = new FormData($(this)[0]);
          $.ajax({
            url: url,
            type: method,
            data: data,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {  
                
              if(data.status == 'success'){

                if(data.type == 'store'){
                    $(".save")[0].reset();
                }

				$('#add_module_form').modal('hide');

                toastr.success(data.message);

                if(data.type == 'update' || data.type == 'store' || data.type == 'clockout'){
                    setTimeout(function(){ // wait for 1 secs(1000)
                        location.reload(); // then reload the page
                   }, 1000);
                }
                
            }else if(data.status == 'error'){
                toastr.error(data.message);
            }else if(data.status == 'errors'){
                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": true,
                    "progressBar": true,
                };
                var html ='<ul>';
                $.each( data.message, function( key, value ) {
                html +='<li>'+value+'</li>';
                });
                html +='<ul>';
                toastr.error(html);
            }
            }
          });
    });


});


