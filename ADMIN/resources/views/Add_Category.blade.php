@extends('Layout.app')

@section('content')

<!-- Button to open add category modal -->

  
  <!-- DataTable to display category data -->
  <div id = "mainDiv" class="container">
		<div class="col-md-12 p-5">
            <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addCategoryModal" style="margin-bottom: 20px;">
                Add Category
              </button>
            <div class="row">

			<table id="CategoryTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
			    <tr>
			      <th class="th-sm">Category Name</th>
					  <th class="th-sm">Category Description</th>
                      <th class="th-sm">Edit</th>
                      <th class="th-sm">Delete</th>
			    </tr>
			  </thead>

			  <tbody id = 'category_table'>

			  </tbody>
			</table>
		</div>
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
                <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter category name" required>
            </div>
            <div class="mb-3">
                <label for="categoryDescription" class="form-label">Category Description</label>
                <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3" placeholder="Enter category description"></textarea>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
            </div>
            </div>
        </div>
         

@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection