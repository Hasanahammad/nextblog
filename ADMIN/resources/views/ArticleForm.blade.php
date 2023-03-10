@extends('layout.app')

@section('content')
<div class="card" style="
margin-left: 35px;
margin-right: 35px;
margin-top: 105px;
">
  <div class="card-body" style="margin-bottom: 50px;">
<div id="articleAddForm" class="container" style="margin-top: 30px; margin-left: 10px;">
    <label for="articleHeadlineAddID">Article Headline</label>
    <div class="form-group">
        <div>
            <input type="text" id="articleHeadlineAddID" class="form-control" placeholder="Write Article Headline" style="border-color: #c8ffcf;">
        </div>
    </div>

    <label for="articleDescriptionAddID">Article Description</label>
    <div class="form-group">
        <textarea class="" id="articleDescriptionAddID"></textarea>
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


        {{-- <div class="form-group">
            <label for="Category">Select Sub Category</label>
            <select class="selectpicker form-control" id="articleCategoryAddID" data-live-search="true" data-width="99%">
              <option>Select Sub category</option>
              <option>Category 1</option>
              <option>Category 2</option>
              <option>Category 3</option>
            </select>
          </div> --}}

<div class="">
  <div class="">
          <div class="form-group">
            <b><label for="articleVideoAddID">Upload Video</label></b>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="articleVideoAddID" accept="video/*">
              <label class="custom-file-label" for="articleVideoAddID">Choose file</label>
            </div>
            <video id="video-preview" class="image_prev mt-2 d-none"></video>
          </div>
          {{-- <center><b><h5>OR</h5></b></center>
          <div>
            <div>
                <input type="text" id="youtube_video_link_ID" class="form-control" placeholder="Paste Youtube URL" style="border-color: #c8ffcf;">
            </div>
        </div> --}}
      </div>
    </div>

        <b><label for="articleThumbnailAddID" class="mt-3"><b>Upload Thumbnail</b></label>
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="articleThumbnailAddID" accept="image/*">
              <label class="custom-file-label" for="articleThumbnailAddID">Choose file</label>
            </div>
            <div id="thumbnailPreview" style="display:none">
              <img id="thumbnailImage" class="thumb_image mt-2" src="#" alt="Thumbnail Preview" />
            </div>
          </div>


    <button type='button' id='articleAddConfirmBtn' class='btn btn-primary'>Publish</button>

</div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy='origin'></script>
<script>

//Image Input Preview Starts here
// Listen for change event on the file input element
document.getElementById("articleThumbnailAddID").addEventListener("change", function() {
  // Get the selected file
  var file = this.files[0];

  // Check if the selected file is an image
  if(file && file.type.match(/^image\//)) {
    // Create a new FileReader object
    var reader = new FileReader();

    // Set up the reader to load the selected file
    reader.onload = function() {
      // Show the preview container
      document.getElementById("thumbnailPreview").style.display = "block";

      // Set the source of the preview image to the loaded data URL
      document.getElementById("thumbnailImage").src = reader.result;
    }

    // Read the selected file as a data URL
    reader.readAsDataURL(file);
  } else {
    // Clear the preview image if the selected file is not an image
    document.getElementById("thumbnailImage").src = "";
  }
});



//Video Input preview starts here
const fileInput = document.getElementById('articleVideoAddID');
const videoPreview = document.getElementById('video-preview');
fileInput.addEventListener('change', (event) => {
const file = event.target.files[0];
const fileURL = URL.createObjectURL(file);
videoPreview.src = fileURL;
videoPreview.classList.remove('d-none');
videoPreview.autoplay = true; // add autoplay attribute
});
document.addEventListener('dragover', (event) => {
event.preventDefault();
});

document.addEventListener('drop', (event) => {
event.preventDefault();
const file = event.dataTransfer.files[0];
const fileURL = URL.createObjectURL(file);
videoPreview.src = fileURL;
videoPreview.classList.remove('d-none');
videoPreview.autoplay = true; // add autoplay attribute
});


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
