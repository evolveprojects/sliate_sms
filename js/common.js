function selectState(br_group){
	if(br_group!="-1"){
		loadData('branch',br_group);
		$("#category_dropdown").html("<option value='-1'>Select Category</option>");
	}else{
		$("#branch_dropdown").html("<option value='-1'>Select Branch</option>");
		$("#category_dropdown").html("<option value='-1'>Select Category</option>");
	}
}

function selectCity(br_id){
	if(br_id!="-1"){
		loadData('category',br_id);
	}else{
		$("#category_dropdown").html("<option value='-1'>Select Category</option>");
	}
}

function loadData(loadType,loadId){
	var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
	$("#"+loadType+"_loader").show();
    $("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="image/loading.gif"/>');
	$.ajax({
		type: "POST",
		url: "kia_feecategory/loadData",
		data: dataString,
		cache: false,
		success: function(result){
			$("#"+loadType+"_loader").hide();
			$("#"+loadType+"_dropdown").html("<option value='-1'>Select "+loadType+"</option>");  
			$("#"+loadType+"_dropdown").append(result);  
		}
	});
}