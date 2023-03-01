@extends('layout.app')

@section('content')

<div id="articleAddForm" class="container" style="margin-top: 30px; margin-left: 10px;">
    <label for="articleHeadlineAddID">Article Headline</label>
    <div class="card form-group">
        <div class="card-body">
            <input type="text" id="articleHeadlineAddID" class="form-control" placeholder="Write Article Headline" style="border-color: #c8ffcf;">
        </div>
    </div>

    <label for="articleDescriptionAddID">Article Description</label>
    <div class="card form-group">
        <textarea class="card" id="articleDescriptionAddID"></textarea>
        {{-- <textarea type="text" id="articleDescriptionAddID" class="form-control" placeholder="Description"></textarea> --}}
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="Category">Select Category</label>
            <select class="selectpicker form-control" id="articleCategoryAddID" data-live-search="true" data-width="99%">
                @foreach ($categories as $catagory)
                <option>{{$catagory->category_name}}</option>
                @endforeach

            </select>
          </div>
    </div>


        <div class="form-group">
            <label for="Category">Select Sub Category</label>
            <select class="selectpicker form-control" id="articleCategoryAddID" data-live-search="true" data-width="99%">
              <option>Select Sub category</option>
              <option>Category 1</option>
              <option>Category 2</option>
              <option>Category 3</option>
            </select>
          </div>


    <label for="articleVideoAddID">Upload Video</label>
    <div class="card form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="articleVideoAddID" accept="video/*">
            <label class="custom-file-label" for="articleVideoAddID">Choose file</label>
        </div>
        {{-- <video class="imgPreview mt-3" id="imgPreview" src="{{asset('images/default-image.png')}}"> --}}
            </div>

    <label for="articleThumbnailAddID">Upload Thumbnail</label>
    <div class="card form-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="articleThumbnailAddID" accept="image/*">
            <label class="custom-file-label" for="articleThumbnailAddID">Choose file</label>
        </div>
    </div>
    <button type='button' id='articleAddConfirmBtn' class='btn btn-primary'>Publish</button>

</div>
@endsection

@section('script')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy='origin'></script>
<script>
   $('#articleVideoAddID').change(function () {
            var reader=new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload=function (event) {
               var ImgSource= event.target.result;
                $('#imgPreview').attr('src',ImgSource)
            }
        })

    tinymce.init({

        selector: '#articleDescriptionAddID',
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


    //article Add Button Save Click
$('#articleAddConfirmBtn').click(function(){
    var article_headline = $('#articleHeadlineAddID').val();
    var content = tinymce.get('articleDescriptionAddID').getContent();
    var article_description = content.replace(/<p>/g, "").replace(/<\/p>/g, "");
    // var article_description = $('#articleDescriptionAddID').val();
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
					toastr.success('Save Done');
                    setTimeout(function() {
                    // Redirect to the new page
                    window.location = "{{ route('upload_article') }}";
                    }, 3000);
				}
				else
				{
					toastr.error('Save Failed');
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
