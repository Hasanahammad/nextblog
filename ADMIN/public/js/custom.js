//******************************For Courses Table***********************************
function getCourseData()
{
	axios.get('/getCourseData')
	.then(function(response){
		if(response.status == 200)
		{
			$('#mainDivCourse').removeClass('d-none');
			$('#loaderDivCourse').addClass('d-none');

			$('#courseDataTable').DataTable().destroy();
			$('#course_table').empty();

			var jsonData = response.data;
			$.each(jsonData, function(i,item){
				$('<tr>').html(
					"<td>"+ jsonData[i].course_name +"</td>"+
					"<td>"+ jsonData[i].course_fee +"</td>" +
					"<td>"+ jsonData[i].course_totalclass +"</td>" +
					"<td><a class = 'courseViewDetailsBtn' data-id="+ jsonData[i].id +"><i class='fas fa-eye'></i></a></td>" +
					"<td><a class = 'courseEditBtn' data-id="+ jsonData[i].id +"><i class='fas fa-edit'></i></a></td>" +
					"<td><a class = 'courseDeleteBtn' data-id="+ jsonData[i].id +" ><i class='fas fa-trash-alt'></i></a></td>"
					).appendTo('#course_table')
			});

			$('.courseDeleteBtn').click(function(){
				var id = $(this).data('id');
				$('#courseDeleteID').html(id);
				$('#deleteCourseModal').modal('show');
			});

			$('.courseEditBtn').click(function(){
				var id = $(this).data('id');
				$('#courseEditID').html(id);
				courseUpdateDetails(id);
				$('#updateCourseModal').modal('show');
			});

			$('#courseDataTable').DataTable();
			$('.dataTables_length').addClass('bs-select');

		}
		else
		{
			$('#wrongDivCourse').removeClass('d-none');
			$('#loaderDivCourse').addClass('d-none');
		}
	})
	.catch(function(error){
		$('#wrongDivCourse').removeClass('d-none');
		$('#loaderDivCourse').addClass('d-none');
	});
}

//Open Course Modal Button
$('#addNewCourseBtnId').click(function(){
	$('#addCourseModal').modal('show');
});


$('#CourseAddConfirmBtn').click(function(){
	var CourseName = $('#CourseNameId').val();
	var CourseDes = $('#CourseDesId').val();
	var CourseFee = $('#CourseFeeId').val();
	var CourseEnroll = $('#CourseEnrollId').val();
	var CourseClass = $('#CourseClassId').val();
	var CourseLink = $('#CourseLinkId').val();
	var CourseImg = $('#CourseImgId').val();
	CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);
});

//Course Add Method
function CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg)
{
	if(CourseName.length == 0)
	{
		toastr.error('Course Name is Empty');
	}
	else if(CourseDes.length == 0)
	{
		toastr.error('Course Description is Empty');
	}
	else if(CourseFee.length == 0)
	{
		toastr.error('Course Fee is Empty');
	}
	else if(CourseEnroll.length == 0)
	{
		toastr.error('Course Enroll is Empty');
	}
	else if(CourseClass.length == 0)
	{
		toastr.error('Course Class is Empty');
	}
	else if(CourseLink.length == 0)
	{
		toastr.error('Course Link is Empty');
	}
	else if(CourseImg.length == 0)
	{
		toastr.error('Course Image is Empty');
	}
	else
	{
		$('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Loading Animation
		axios.post('/CourseAdd',{
			course_name:CourseName,
			course_des:CourseDes,
			course_fee:CourseFee,
			course_totalenroll:CourseEnroll,
			course_totalclass:CourseClass,
			course_link:CourseLink,
			course_img:CourseImg
		})
		.then(function(response){
			if(response.status == 200)
			{
				$('#CourseAddConfirmBtn').html("Yes");
				if(response.data == 1)
				{
					$('#addCourseModal').modal('hide');
					toastr.success('Save Success');
					getCourseData();
				}
				else
				{
					$('#addCourseModal').modal('hide');
					toastr.error('Save Failed');
					getCourseData();
				}
			}
			else
			{
				$('#addCourseModal').modal('hide');
				toastr.error('Hmm, Seems like Something is definatly Not Right');
			}
		})
		.catch(function(error){
			$('#addCourseModal').modal('hide');
			toastr.error('Hmm, Catch');
		});
	}
}

//Course Delete Button Yes click
$('#courseDeleteConfirmBtn').click(function(){
	//var id = $(this).data('id');
	var id = $('#courseDeleteID').html();
	courseDelete(id);
});

//Course Delete
function courseDelete(deleteCourseId)
{
	$('#courseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Loading Animation

	axios.post('/deleteCourse',{id:deleteCourseId})
	.then(function(response){
		$('#courseDeleteConfirmBtn').html("Yes");

		if(response.status == 200)
		{
			if(response.data == 1)
			{
				$('#deleteCourseModal').modal('hide');
				toastr.success('Delete Success');
				getCourseData();
			}
			else
			{
				$('#deleteCourseModal').modal('hide');
				toastr.error('Delete Failed');
				getCourseData();
			}
		}
		else
		{
			$('#deleteCourseModal').modal('hide');
			toastr.error('Hmm, Seems like Something is definatly Not Right');
		}
	})
	.catch(function(error){
		$('#deleteModal').modal('hide');
		toastr.error('Hmm, Catch');
	});
}

//Each Course Update Details
function courseUpdateDetails(detailsId)
{
	axios.post('/CourseDetails',{id:detailsId})
	.then(function(response){
		if(response.status==200)
		{
			$('#courseEditForm').removeClass('d-none');
			$('#courseEditLoader').addClass('d-none');

			var jsonData = response.data;
			$('#CourseNameUpdateId').val(jsonData[0].course_name);
			$('#CourseDesUpdateId').val(jsonData[0].course_des);
			$('#CourseFeeUpdateId').val(jsonData[0].course_fee);
			$('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
			$('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
			$('#CourseLinkUpdateId').val(jsonData[0].course_link);
			$('#CourseImgUpdateId').val(jsonData[0].course_img);
		}
		else
		{
			$('#courseEditWrong').removeClass('d-none');
			$('#courseEditLoader').addClass('d-none');
		}
		
	})
	.catch(function(error){
		$('#courseEditWrong').removeClass('d-none');
		$('#courseEditLoader').addClass('d-none');
	});
}

//Service Edit Button Save Click
$('#CourseUpdateConfirmBtn').click(function(){
	var CourseID 		= $('#courseEditID').html();
	var CourseName 		= $('#CourseNameUpdateId').val();
	var CourseDes 		= $('#CourseDesUpdateId').val();
	var CourseFee 		= $('#CourseFeeUpdateId').val();
	var CourseEnroll 	= $('#CourseEnrollUpdateId').val();
	var CourseClass 	= $('#CourseClassUpdateId').val();
	var CourseLink 		= $('#CourseLinkUpdateId').val();
	var CourseImg 		= $('#CourseImgUpdateId').val();
	courseUpdate(CourseID, CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);
});

function courseUpdate(CourseID, CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg)
{
	if(CourseName.length == 0)
	{
		toastr.error('Course Name is Empty');
	}
	else if(CourseDes.length == 0)
	{
		toastr.error('Course Description is Empty');
	}
	else if(CourseFee.length == 0)
	{
		toastr.error('Course Fee is Empty');
	}
	else if(CourseEnroll.length == 0)
	{
		toastr.error('Course Enroll is Empty');
	}
	else if(CourseClass.length == 0)
	{
		toastr.error('Course Class is Empty');
	}
	else if(CourseLink.length == 0)
	{
		toastr.error('Course Link is Empty');
	}
	else if(CourseImg.length == 0)
	{
		toastr.error('Course Image is Empty');
	}
	else
	{
		$('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>") //Loading Animation
		axios.post('/CourseUpdate',{
			id:CourseID,
			course_name:CourseName,
			course_des:CourseDes,
			course_fee:CourseFee,
			course_totalenroll:CourseEnroll,
			course_totalclass:CourseClass,
			course_link:CourseLink,
			course_img:CourseImg
		})
		.then(function(response){
			if(response.status == 200)
			{
				$('#CourseUpdateConfirmBtn').html("Yes");
				if(response.data == 1)
				{
					$('#updateCourseModal').modal('hide');
					toastr.success('Update Success');
					getCourseData();
				}
				else
				{
					$('#updateCourseModal').modal('hide');
					toastr.error('Update Failed');
					getCourseData();
				}
			}
			else
			{
				$('#updateCourseModal').modal('hide');
				toastr.error('Hmm, Seems like Something is definatly Not Right');
			}
		})
		.catch(function(error){
			$('#updateCourseModal').modal('hide');
			toastr.error('Hmm, Catch');
		});
	}
}




//******************************For Projects Section***********************************