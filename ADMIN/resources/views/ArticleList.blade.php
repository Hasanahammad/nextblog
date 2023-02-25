@extends('Layout.app')

@section('content')
<div id = "mainDiv" class="container d-none">
	<div class="row">
		<div class="col-md-12 p-5">
			<button id = "addNewBtnId" class = "btn my-3 btn-sm btn-danger">Add New</button>
			<table id="articleDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
			    <tr>
			      <th class="th-sm">news_headline</th>
					  <th class="th-sm">news_description</th>
					  <th class="th-sm">news_category</th>
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
      <div class="modal-body text-center p-3">
      	<h5 id = 'articleEditID' class = "d-none"></h5>
      	<div id = 'articleEditForm' class = 'w-100 d-none'>
      		<input type="text" id = 'articleHeadlineID' class = 'form-control mb-4' placeholder="Article Name">
	      	<input type="text" id = 'articleDescriptionID' class = 'form-control mb-4' placeholder="Description">
	      	<input type="text" id = 'articleCategoryID' class = 'form-control mb-4' placeholder="Category">
              <input type="text" id = 'articleVideoID' class = 'form-control mb-4' placeholder="video">
	      	<input type="text" id = 'articleThumbnailID' class = 'form-control mb-4' placeholder="Thumbnail">

      	</div>

      	<img id = 'articleEditLoader' class='loading-icon m-5' src="{{asset('images/loader.svg')}}">
      	<h3 id = 'articleEditWrong' class = 'd-none'>Somthing went wrong!</h3>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id = 'articleEditConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog p-5">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
      	<div id = 'articleAddForm' class = 'w-100'>
			<label for="articleHeadlineAddID">Article Name</label>
            <input type="text" id = 'articleHeadlineAddID' class = 'form-control mb-4' placeholder="Article Name">
			<label for="articleDescriptionAddID">Article Description</label>
			<textarea type="text" id = 'articleDescriptionAddID' class = 'form-control mb-4' placeholder="Description"></textarea>
			<label for="articleCategoryAddID">Article Category</label>
			<input type="text" id = 'articleCategoryAddID' class = 'form-control mb-4' placeholder="Category">
			<label for="articleVideoAddID">Upload Video</label>
			<input type="file" id='articleVideoAddID' class='form-control mb-4' accept="video/*">
            <label for="articleThumbnailAddID">Upload Thumbnail</label>
			<input type="file" id='articleThumbnailAddID' class='form-control mb-4' accept="image/*">
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id = 'articleAddConfirmBtn' type="button" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
	<script type="text/javascript">
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
					"<td>"+ jsonData[i].news_headline +"</td>" +
					"<td>"+ jsonData[i].news_description +"</td>" +
                    "<td>"+ jsonData[i].news_category +"</td>" +
                    "<td>"+ jsonData[i].upload_video +"</td>" +
					"<td>"+ jsonData[i].thumbnail +"</td>" +
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


//article Add Button Save Click
$('#articleAddConfirmBtn').click(function(){
    var article_headline = $('#articleHeadlineAddID').val();
    var article_description = $('#articleDescriptionAddID').val();
    var article_category = $('#articleCategoryAddID').val();
    var article_video = $('#articleVideoAddID').prop('files')[0];
    var article_thumbnail = $('#articleThumbnailAddID').prop('files')[0];
    var article_created_time = $('#CreatedAtAddID').val();

    articleAdd(article_headline, article_description, article_category, article_video, article_thumbnail, article_created_time);
});

//article Add Method
function articleAdd(article_headline, article_description, article_category, article_video, article_thumbnail, article_created_time)
{
	if(article_headline.length == 0)
    {
        toastr.error('Article Name is Empty');
    }
    else if(article_description.length == 0)
    {
        toastr.error('Article Description is Empty');
    }
    else if(article_category.length == 0)
    {
        toastr.error('Article Category is Empty');
    }
    else if(!article_video || !article_thumbnail)
    {
        toastr.error('Please select both video and thumbnail');
    }
	else
	{
		$('#articleAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Loading Animation
		var formData = new FormData();
        formData.append('article_headline', article_headline);
        formData.append('article_description', article_description);
        formData.append('article_category', article_category);
        formData.append('article_video', article_video);
        formData.append('article_thumbnail', article_thumbnail);

        axios.post('/articleAdd', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
        })
		.then(function(response){
			if(response.status == 200)
			{
				$('#articleAddConfirmBtn').html("Yes");
				if(response.data == 1)
				{
					$('#addModal').modal('hide');
					toastr.success('Save Success');
					getArticleData();
				}
				else
				{
					$('#addModal').modal('hide');
					toastr.error('Save Failed');
					getArticleData();
				}
			}
			else
			{
				$('#addModal').modal('hide');
				toastr.error('Hmm, Seems like Something is definatly Not Right');
			}
		})
		.catch(function(error){
			$('#addModal').modal('hide');
			toastr.error('Hmm, Catch');
		});
	}
}
	</script>
@endsection
