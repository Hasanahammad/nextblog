@extends('Layout.app')

@section('content')

<!-- Button to open add category modal -->


  <!-- DataTable to display category data -->
  <div id = "mainDiv" class="container">
		<div class="col-md-12 p-5">
            <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addSubCategoryModal" style="margin-bottom: 20px;">
                Add Sub-Category
              </button>
            <div class="row">

			<table id="CategoryTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
			    <tr>
			      <th class="th-sm">Sub Category Name</th>
					  <th class="th-sm">Under the category</th>
                      <th class="th-sm">Edit</th>
                      <th class="th-sm">Delete</th>
			    </tr>
			  </thead>

			  <tbody id = 'sub_category_table'>
			  </tbody>
			</table>
		</div>
	</div>
</div>

  <!-- Add Category Modal -->
  <div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addSubCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addSubCategoryModalLabel">Add Sub-Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addSubCategoryForm">
          <div class="modal-body">
            <div class="form-group">
              <label for="subcategoryName">Sub-Category Name</label>
              <input type="text" class="form-control" id="subcategoryName" name="subcategoryName" placeholder="Enter sub-category name" required>
            </div>
            <div class="form-group">
              <label for="subCategoryCategory">Select Category</label>
              <select class="selectpicker form-control" id="subCategoryCategory" data-live-search="true" data-width="98%">
                @foreach ($categories as $category)
                    <option>{{$category->category_name}}</option>
                @endforeach
                            </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Sub-Category</button>
          </div>
        </form>
      </div>
    </div>
  </div>



@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection
