@extends('Layout.app')

@section('content')
<div id = "mainDiv" class="container d-none">
	<div class="row">
		<div class="col-md-12 p-5">
			<button id = "addNewBtnId" class = "btn my-3 btn-sm btn-danger">Add New</button>
			<table id="articleDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
			    <tr>
			      <th class="th-sm">Image</th>
					  <th class="th-sm">Name</th>
					  <th class="th-sm">Description</th>
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
      		<input type="text" id = 'articleNameID' class = 'form-control mb-4' placeholder="article Name">
	      	<input type="text" id = 'articleDesID' class = 'form-control mb-4' placeholder="article Description">
	      	<input type="text" id = 'articleImgID' class = 'form-control mb-4' placeholder="article Image Link">
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
      		<input type="text" id = 'articleNameAddID' class = 'form-control mb-4' placeholder="article Name">
	      	<input type="text" id = 'articleDesAddID' class = 'form-control mb-4' placeholder="article Description">
	      	<input type="text" id = 'articleAddImgID' class = 'form-control mb-4' placeholder="article Image Link">
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
                    "<td>"+ jsonData[i].news_catagory +"</td>" +
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

	axios.post('/deletearticle',{id:deleteId})
	.then(function(response){
		$('#articleDeleteConfirmBtn').html("Yes");

		if(response.status == 200)
		{
			if(response.data == 1)
			{
				$('#deleteModal').modal('hide');
				toastr.success('Delete Success');
				getarticleData();
			}
			else
			{
				$('#deleteModal').modal('hide');
				toastr.error('Delete Failed');
				getarticleData();
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
			$('#articleNameID').val(jsonData[0].article_name);
			$('#articleDesID').val(jsonData[0].article_des);
			$('#articleImgID').val(jsonData[0].article_img);
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
	var article_name = $('#articleNameID').val();
	var article_des = $('#articleDesID').val();
	var article_img = $('#articleImgID').val();

	articleUpdate(id, article_name, article_des, article_img);
});

function articleUpdate(articleID, articleName, articleDes,articleImg)
{
	if(articleName.length == 0)
	{
		toastr.error('article Name is Empty');
	}
	else if(articleDes.length == 0)
	{
		toastr.error('article Description is Empty');
	}
	else if(articleImg.length == 0)
	{
		toastr.error('article Image is Empty');
	}
	else
	{
		$('#articleEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Loading Animation
		axios.post('/articleUpdate',{
			id:articleID,
			article_name:articleName,
			article_des:articleDes,
			article_img:articleImg
		})
		.then(function(response){
			if(response.status == 200)
			{
				$('#articleEditConfirmBtn').html("Yes");
				if(response.data == 1)
				{
					$('#editModal').modal('hide');
					toastr.success('Update Success');
					getarticleData();
				}
				else
				{
					$('#editModal').modal('hide');
					toastr.error('Update Failed');
					getarticleData();
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
	var article_name = $('#articleNameAddID').val();
	var article_des = $('#articleDesAddID').val();
	var article_img = $('#articleAddImgID').val();

	articleAdd(article_name, article_des, article_img);
});

//article Add Method
function articleAdd(articleName, articleDes,articleImg)
{
	if(articleName.length == 0)
	{
		toastr.error('article Name is Empty');
	}
	else if(articleDes.length == 0)
	{
		toastr.error('article Description is Empty');
	}
	else if(articleImg.length == 0)
	{
		toastr.error('article Image is Empty');
	}
	else
	{
		$('#articleAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Loading Animation
		axios.post('/articleAdd',{
			article_name:articleName,
			article_des:articleDes,
			article_img:articleImg
		})
		.then(function(response){
			if(response.status == 200)
			{
				$('#articleAddConfirmBtn').html("Yes");
				if(response.data == 1)
				{
					$('#addModal').modal('hide');
					toastr.success('Save Success');
					getarticleData();
				}
				else
				{
					$('#addModal').modal('hide');
					toastr.error('Save Failed');
					getarticleData();
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
