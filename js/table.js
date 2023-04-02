$(document).ready(function() {
    var dataTable = $('#filtertable').DataTable({
        "pageLength":5,
        'aoColumnDefs':[{
            'bSortable':false,
            'aTargets'🙁'nosort'],
        }],
        "language": {
			"decimal":        "",
			"emptyTable":     "Không có dữ liệu ",
			"info":           "Showing START to END of TOTAL entries",
			"infoEmpty":      "Showing 0 to 0 of 0 entries",
			"infoFiltered":   "(filtered from MAX total entries)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Hiện thị MENU Người",
			"loadingRecords": "Đang Tìm...",
			"processing":     "",
			"search":         "Tìm kiếm:",
			"zeroRecords":    "Không tìm thấy kết quả",
			"paginate": {
				"first":      "First",
				"last":       "Last",
				"next":       "Tiếp",
				"previous":   "Trước"
			},
			// "aria": {
			// 	"sortAscending":  ": activate to sort column ascending",
			// 	"sortDescending": ": activate to sort column descending"
			// },
			
			
		},
        "order":false,
        "bLengthChange":false,
        "dom":'<"top">ct<"top"p><"clear">'
    });
    $("#filterbox").keyup(function(){
        dataTable.search(this.value).draw();
    });

   

} );