@extends('Layout.app')

@section('content')

<!-- Button to open add category modal -->


  <!-- DataTable to display category data -->
  <div id = "mainDiv" class="container">
		<div class="p-5">
            <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addCategoryModal" style="margin-bottom: 20px;">
                Add Category
              </button>

			<table id="CategoryTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
			    <tr>
			      <th class="th-sm">Category Name</th>
					  <th class="th-sm">Category Description</th>
                      <th class="th-sm">Delete</th>
			    </tr>
			  </thead>

			  <tbody id = 'category_table'>

			  </tbody>
			</table>
		</div>
</div>

  <!-- Add Category Modal -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addCategoryForm">
          <div class="modal-body">
            <div class="mb-3">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" class="card form-control" id="categoryName" name="categoryName" placeholder="Enter category name" required>
            </div>
            <div class="mb-3">
                <label for="categoryDescription" class="form-label">Category Description</label>
                <textarea class="card form-control" id="categoryDescription" name="categoryDescription" rows="3" placeholder="Enter category description"></textarea>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id='categoryAddConfirmBtn'>Add Category</button>
            </div>
            </div>
            </div>
        </div>


@endsection

@section('script')
<script type="text/javascript">

getCategoryData();




function getCategoryData()
{
	axios.get('/getCategoryData')
	.then(function(response){
		if(response.status == 200)
		{
			$('#mainDiv').removeClass('d-none');
			$('#loaderDiv').addClass('d-none');

			$('#serviceDataTable').DataTable().destroy();
			$('#service_table').empty();

			var jsonData = response.data;
			$.each(jsonData, function(i,item){
				$('<tr>').html(
					"<td>"+ jsonData[i].category_name +"</td>" +
					"<td>"+ jsonData[i].category_description +"</td>" +
					"<td><a class = 'categoryDeleteBtn' data-id="+ jsonData[i].id +" ><i class='fas fa-trash-alt'></i></a></td>"
					).appendTo('#category_table')
			});

			//category delete button click
			$('.serviceDeleteBtn').click(function(){
				var id = $(this).data('id');
				$('#categoryDeleteID').html(id);
				$('#deleteModal').modal('show');
			})

			$('#CategoryTable').DataTable();
			$('.dataTables_length').addClass('bs-select');
		}
		else
		{
			$('#wrongDiv').removeClass('d-none');
			$('#loaderDiv').addClass('d-none');
		}
	})
	.catch(function(error){
		$('#wrongDiv').removeClass('d-none');
		$('#loaderDiv').addClass('d-none');
	});
}









$('#categoryAddConfirmBtn').click(function(){
	var category_name = $('#categoryName').val();
	var category_description = $('#categoryDescription').val();

	categoryAdd(category_name, category_description);
});

//Service Add Method
function categoryAdd(category_name, category_description)
{
	if(category_name.length == 0)
	{
		toastr.error('Category Name is Empty');
	}
	else if(category_description.length == 0)
	{
		toastr.error('Category Description is Empty');
	}
	else
	{
		$('#categoryAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Loading Animation
		axios.post('/categoryAdd',{
			category_name:category_name,
			category_description:category_description,
		})
		.then(function(response){
			if(response.status == 200)
			{
				$('#categoryAddConfirmBtn').html("Yes");
				if(response.data == 1)
				{
					$('#addCategoryModal').modal('hide');
					toastr.success('Save Success');
					getCategoryData();
				}
				else
				{
					$('#addCategoryModal').modal('hide');
					toastr.error('Save Failed');
					getCategoryData();
				}
			}
			else
			{
				$('#addCategoryModal').modal('hide');
				toastr.error('Hmm, Seems like Something is definatly Not Right');
			}
		})
		.catch(function(error){
			$('#addCategoryModal').modal('hide');
			toastr.error('Hmm, Catch');
		});
	}
}


</script>
@endsection
