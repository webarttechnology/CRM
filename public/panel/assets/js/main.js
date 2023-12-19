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



});


