@extends('layout.app')

@section('content')
<div id = "mainDiv" class="container d-none">
	<div class="row">
		<div class="col-md-12 p-5">
			<table id="articleDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
			    <tr>
			      <th class="th-sm">news_headline</th>
					  <th class="th-sm">news_description</th>
					  <th class="th-sm">category</th>
					  {{-- <th class="th-sm">Sub category</th> --}}
					  <th class="th-sm">upload_video</th>
					  <th class="th-sm">thumbnail</th>
                      <th class="th-sm">Created at</th>
                      <th class="th-sm">Edit</th>
                      <th class="th-sm">Delete</th>
			    </tr>
			  </thead>

			  <tbody id = 'article_table'>

			  </tbody>
			</table>
		</div>
	</div>
</div>

<div id = "loaderDiv" class="container">
	<div class="row">
		<div class="col-md-12 text-center p-5">
			<img class='loading-icon m-5' src="{{asset('images/loader.svg')}}">
		</div>
	</div>
</div>

<div id = "wrongDiv" class="container d-none">
	<div class="row">
		<div class="col-md-12 text-center p-5">
			<h3>Somthing went wrong!</h3>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
      	<h4 class="mt-4">Do you want to Delete?</h4>
      	<h4 id = 'articleDeleteID' class="mt-4 d-none"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id = 'articleDeleteConfirmBtn' type="button" class="btn btn-sm btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog p-5">
    <div class="modal-content">
    	<div class="modal-header">
        <h5 class="modal-title">Update article</h5>
        <h5 id = 'courseEditID' class = "d-none"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-3" style="max-height: 400px; overflow-y: auto;">
      	<h5 id = 'articleEditID' class = "d-none"></h5>
      	<div id = 'articleEditForm' class = 'w-100 d-none'>

			<label for="articleHeadlineAddID" style="text-align: left;">Update Article Headline</label>
    		<div class="card form-group">
        	<div class="card-body">
            <input type="text" id="articleHeadlineAddID" class="form-control" style="border-color: #c8ffcf;">
        	</div>
    		</div>
			
			<label for="articleDescriptionAddID">Update Article Description</label>
			<div class="card form-group">
				<textarea class="card" id="articleDescriptionEditID"></textarea>
				{{-- <textarea type="text" id="articleDescriptionAddID" class="form-control" placeholder="Description"></textarea> --}}
			</div>

        	<div class="form-group">
            <label for="Category">Update Category</label>
            <select class="selectpicker form-control" id="articleCategoryAddID" data-live-search="true" data-width="99%">
              <option>Select category</option>
              <option>Category 1</option>
              <option>Category 2</option>
              <option>Category 3</option>
            </select>
          	</div>

        	{{-- <div class="form-group">
            <label for="Category">Select Sub Category</label>
            <select class="selectpicker form-control" id="articleCategoryAddID" data-live-search="true" data-width="99%">
              <option>Select Sub category</option>
              <option>Category 1</option>
              <option>Category 2</option>
              <option>Category 3</option>
            </select>
          	</div> --}}

    		<label for="articleVideoAddID">Update Video</label>
   	 		<div class="card form-group">
        	<div class="custom-file">
            <input type="file" class="custom-file-input" id="articleVideoAddID" accept="video/*">
            <label class="custom-file-label" for="articleVideoAddID">Choose file</label>
        	</div>
    		</div>

    		<label for="articleThumbnailAddID">Update Thumbnail</label>
    		<div class="card form-group">
       	 	<div class="custom-file">
            <input type="file" class="custom-file-input" id="articleThumbnailAddID" accept="image/*">
            <label class="custom-file-label" for="articleThumbnailAddID">Choose file</label>
        	</div>
    		</div>

      		{{-- <input type="text" id = 'articleHeadlineID' class = 'form-control mb-4' placeholder="Article Name">
	      	<input type="text" id = 'articleDescriptionID' class = 'form-control mb-4' placeholder="Description">
	      	<input type="text" id = 'articleCategoryID' class = 'form-control mb-4' placeholder="Category">
              <input type="text" id = 'articleVideoID' class = 'form-control mb-4' placeholder="video">
	      	<input type="text" id = 'articleThumbnailID' class = 'form-control mb-4' placeholder="Thumbnail"> --}}

      	</div>

      	<img id = 'articleEditLoader' class='loading-icon m-5' src="{{asset('images/loader.svg')}}">
      	<h3 id = 'articleEditWrong' class = 'd-none'>Somthing went wrong!</h3>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id = 'articleEditConfirmBtn' type="button" class="btn btn-sm" style="background-color: black; color: white;">Update</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
	<script type="text/javascript">

tinymce.init({

selector: '#articleDescriptionEditID',
plugins: 'link image lists',
toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
branding: false,
menubar: false,
height: 300,
statusbar: false,
init_instance_callback: function(editor) {
	setTimeout(function() {

		editor.ui.registry.get('logo').hide();
	}, 100);
}
});



		getArticleData();

//For articles Table
function getArticleData()
{
	axios.get('/getArticleData')
	.then(function(response){
		if(response.status == 200)
		{
			$('#mainDiv').removeClass('d-none');
			$('#loaderDiv').addClass('d-none');

			$('#articleDataTable').DataTable().destroy();
			$('#article_table').empty();

			var jsonData = response.data;
			$.each(jsonData, function(i,item){
				$('<tr>').html(
					// "<td><img src="+jsonData[i].article_img+"></td>"+
					"<td>"+ jsonData[i].news_headline.substring(0, 20) +"...</td>" +
					"<td>"+ jsonData[i].news_description +"</td>" +
                    "<td>"+ jsonData[i].news_category +"</td>" +
                    "<td><video width='100' height='100' controls><source src='"+ jsonData[i].upload_video+"' type='video/mp4'></video></td>" +
                    "<td><img src='"+ jsonData[i].thumbnail+"' width='100' height='100'></td>" +
                    "<td>"+ jsonData[i].created_at +"</td>" +
					"<td><a class = 'articleEditBtn' data-id="+ jsonData[i].id +"><i class='fas fa-edit'></i></a></td>" +
					"<td><a class = 'articleDeleteBtn' data-id="+ jsonData[i].id +" ><i class='fas fa-trash-alt'></i></a></td>"
					).appendTo('#article_table')
			});

			//articles delete button click
			$('.articleDeleteBtn').click(function(){
				var id = $(this).data('id');
				//$('#articleDeleteConfirmBtn').attr('data-id',id);
				$('#articleDeleteID').html(id);
				$('#deleteModal').modal('show');
			})

			//article Edit button Click
			$('.articleEditBtn').click(function(){
				var id = $(this).data('id');
				$('#articleEditID').html(id);
				articleUpdateDetails(id);
				$('#editModal').modal('show');
			})

			$('#articleDataTable').DataTable();
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

//article Delete Button Yes click
$('#articleDeleteConfirmBtn').click(function(){
	//var id = $(this).data('id');
	var id = $('#articleDeleteID').html();
	articleDelete(id);
});

//article Delete
function articleDelete(deleteId)
{
	$('#articleDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Loading Animation

	axios.post('/articleDelete',{id:deleteId})
	.then(function(response){
		$('#articleDeleteConfirmBtn').html("Yes");

		if(response.status == 200)
		{
			if(response.data == 1)
			{
				$('#deleteModal').modal('hide');
				toastr.success('Delete Success');
				getArticleData();
			}
			else
			{
				$('#deleteModal').modal('hide');
				toastr.error('Delete Failed');
				getArticleData();
			}
		}
		else
		{
			$('#deleteModal').modal('hide');
			toastr.error('Hmm, Seems like Something is definatly Not Right');
		}
	})
	.catch(function(error){
		$('#deleteModal').modal('hide');
		toastr.error('Hmm, Catch');
	});
}

//Each article Update Details
function articleUpdateDetails(detailsId)
{
	axios.post('/articleDetails',{id:detailsId})
	.then(function(response){
		if(response.status==200)
		{
			$('#articleEditForm').removeClass('d-none');
			$('#articleEditLoader').addClass('d-none');
			var jsonData = response.data;
			$('#articleHeadlineID').val(jsonData[0].news_headline);
			$('#articleDescriptionID').val(jsonData[0].news_description);
			$('#articleCategoryID').val(jsonData[0].news_category);
            $('#articleVideoID').val(jsonData[0].upload_video);
			$('#articleThumbnailID').val(jsonData[0].thumbnail);
		}
		else
		{
			$('#articleEditWrong').removeClass('d-none');
			$('#articleEditLoader').addClass('d-none');
		}

	})
	.catch(function(error){

	});
}

//article Edit Button Save Click
$('#articleEditConfirmBtn').click(function(){
	//var id = $(this).data('id');
	var id = $('#articleEditID').html();
	var article_headline 	 = 	$('#articleHeadlineID').val();
	var	article_description	 =	$('#articleDescriptionID').val();
	var	article_category	 =	$('#articleCategoryID').val();
    var article_video        =	$('#articleVideoID').val();
	var	article_thumbnail	 =  $('#articleThumbnailID').val();
	var	article_created_time =	$('#CreatedAtID').val();

	articleUpdate(id, article_headline, article_description, article_category, article_video, article_thumbnail, article_created_time);
});

function articleUpdate(id, article_headline, article_description, article_category, article_video, article_thumbnail, article_created_time)
{
	if(article_headline.length == 0)
	{
		toastr.error('article Name is Empty');
	}
	else if(article_description.length == 0)
	{
		toastr.error('article Description is Empty');
	}
	else if(article_category.length == 0)
	{
		toastr.error('article Image is Empty');
	}
	else
	{
		$('#articleEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Loading Animation
		axios.post('/articleUpdate',{
			id:id,
			article_headline:article_headline,
			article_description:article_description,
			article_category:article_category,
            article_video:article_video,
            article_thumbnail:article_thumbnail

		})
		.then(function(response){
			if(response.status == 200)
			{
				$('#articleEditConfirmBtn').html("Yes");
				if(response.data == 1)
				{
					$('#editModal').modal('hide');
					toastr.success('Update Success');
					getArticleData();
				}
				else
				{
					$('#editModal').modal('hide');
					toastr.error('Update Failed');
					getArticleData();
				}
			}
			else
			{
				$('#editModal').modal('hide');
				toastr.error('Hmm, Seems like Something is definatly Not Right');
			}
		})
		.catch(function(error){
			$('#editModal').modal('hide');
			toastr.error('Hmm, Catch');
		});
	}
}

//article Add new Button click

$('#addNewBtnId').click(function(){
	$('#addModal').modal('show');
});

</script>
@endsection
