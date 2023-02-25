@extends('Layout.app')

@section('content')

<div id="articleAddForm" class="container" style="margin-top: 30px; margin-left: 10px;">
    <div class="form-group">
      <label for="articleHeadlineAddID">Article Name</label>
      <input type="text" id="articleHeadlineAddID" class="form-control" placeholder="Article Name">
    </div>
    <div class="form-group">
      <label for="articleDescriptionAddID">Article Description</label>
      
      <textarea  id="articleDescriptionAddID"></textarea>
      {{-- <textarea type="text" id="articleDescriptionAddID" class="form-control" placeholder="Description"></textarea> --}}
    </div>
    <div class="form-group">
      <label for="articleCatagoryAddID">Article Category</label>
      <input type="text" id="articleCategoryAddID" class="form-control" placeholder="Category">
    </div>
    <div class="form-group">
      <label for="articleVideoAddID">Upload Video</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="articleVideoAddID" accept="video/*">
        <label class="custom-file-label" for="articleVideoAddID">Choose file</label>
      </div>
    </div>
    <div class="form-group">
      <label for="articleThumbnailAddID">Upload Thumbnail</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="articleThumbnailAddID" accept="image/*">
        <label class="custom-file-label" for="articleThumbnailAddID">Choose file</label>
      </div>
    </div>
    <button type='button' id='articleAddConfirmBtn' class='btn btn-primary'>Publish</button>

  </div>
  
  @section('script')
  <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy='origin'></script>
    <script>
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

    alert(article_headline + article_description + article_category + article_video + article_thumbnail + article_created_time);
});

    </script>


   @endsection
  

@endsection