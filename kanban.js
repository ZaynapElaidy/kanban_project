$(function () {
    var kanbanCol = $('.panel-body');
    kanbanCol.css('max-height', (window.innerHeight - 150) + 'px');

    var kanbanColCount = parseInt(kanbanCol.length);
    $('.container-fluid').css('min-width', (kanbanColCount * 350) + 'px');

    draggableInit();

    $('.panel-heading').click(function() {
        var $panelBody = $(this).parent().children('.panel-body');
        $panelBody.slideToggle();
    });
});

  var allTasks = function() {
                $.ajax({
                    url: "./api/alltasks.php",
                    type: "POST",
                    success: function(response) {
                        var data = JSON.parse(response);
                        console.log(data);
                        $("#TODO").empty();
                        $("#DOING").empty();
                        $("#REVISION").empty();
                        $("#DONE").empty();
                        data.forEach(function(value, index) {
                            if(value.statue=="todo"){
                            $("#TODO").append("<div class='kanban-entry grab' id='"+value.id+"' draggable='true'><div class='kanban-entry-inner'>"+
                                "<div class='kanban-label'>"+value.title+"</div><div>"+
                                value.content+"</div></div>");
                        }else if(value.statue=="doing"){
                            $("#DOING").append("<div class='kanban-entry grab' id='"+value.id+"' draggable='true'><div class='kanban-entry-inner'>"+
                                "<div class='kanban-label'>"+value.title+"</div><div>"+
                                value.content+"</div></div>");
                        }else if(value.statue=="revision"){
                            $("#REVISION").append("<div class='kanban-entry grab' id='"+value.id+"' draggable='true'><div class='kanban-entry-inner'>"+
                                "<div class='kanban-label'>"+value.title+"</div><div>"+
                                value.content+"</div></div>");
                        }else if(value.statue=="done"){
                            $("#DONE").append("<div class='kanban-entry grab' id='"+value.id+"' draggable='true'><div class='kanban-entry-inner'>"+
                                "<div class='kanban-label'>"+value.title+"</div><div>"+
                                value.content+"</div></div>");
                        }

                        });

                    }
                })


            }


 function draggableInit() {
   
    $('.grab').bind('dragstart', function (event) {
        sourceId = $(this).parent().attr('id');
        
        console.log(event);
        // console.log($(this));

        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
    });

    $('.panel-body').bind('dragover', function (event) {
        event.preventDefault();
    });

     $('.panel-body').bind('drag', function (event) {
        event.preventDefault();
        taskId = event.target.id;
        
    });

    $('.panel-body').bind('drop', function (event) {
        event.preventDefault();

        var children = $(this).children(),
            targetId = children.attr('id');

        // if (taskId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle'); //before post


            // Post data 
            setTimeout(function () {
                var element = document.getElementById(elementId);
                children.prepend(element);
                $('#processing-modal').modal('toggle'); // after post
            }, 1000);

		$.ajax({
			url : "./api/updateType.php",
			data : {
				id : taskId,
				type : targetId
			},
			type : "POST",
			success : function(response) {
				// 
			},
			beforeSend : function() {
				$('#processing-modal').modal('toggle'); // before post
				setTimeout(function() {
					allTasks();
					$('#processing-modal').modal('toggle'); // after post
				}, 1000);
			}
		});
	});
}
