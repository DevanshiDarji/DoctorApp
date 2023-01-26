$(document).ready(function(){
	$("#check_all").change(function(){
		$('input:checkbox').prop('checked', this.checked);         
	});

    $("#check_inactiveall").change(function(){
        $('input:checkbox').prop('checked', this.checked);         
    });

	$("#btn-active").click(function() {
		$("#action").val("Active");
        /*alert();*/
		var atLeastOneIsChecked = $('input[name="iId[]"]:checked').length > 0;
		if(atLeastOneIsChecked == false){
			//$(".modal-body").html( "<p>Please Select Atleast One Record </p>" );
    	    $("#ModalForm").modal('show');
        	return false;
        }
        $('#frmlist').submit();
	});
	$("#btn-inactive").click(function() {
        $("#action").val("Inactive");
        var atLeastOneIsChecked = $('input[name="iId[]"]:checked').length > 0;
        if(atLeastOneIsChecked == false){
           // $(".modal-body").html( "<p>Please Select Atleast One Record </p>" );
            $("#ModalForm").modal('show');
            return false;
        }
        $('#frmlist').submit();
    });
    $("#btn-delete").click(function() {
		$("#action").val("Delete");
		var atLeastOneIsChecked = $('input[name="iId[]"]:checked').length > 0;
		if(atLeastOneIsChecked == false){
	        //$(".modal-body").html( "<p>Please Select Atleast One Record </p>" );
    	    $("#ModalForm").modal('show');
        	return false;
        }
        $('#frmlist').submit();
	});
});

function addme(url)
{
	window.location.href=url;
}

function sendnow(url)
{
	var atLeastOneIsChecked = $('input[name="iId[]"]:checked').length > 0;
		if(atLeastOneIsChecked == false){
			//$(".modal-body").html( "<p>Please Select Atleast One Notification </p>" );
    	    $("#ModalForm").modal('show');
        	return false;
        }
        else {
        	var allcheckids = '';
        	$('.listcheckbox').each(function() { //loop through each checkbox
        		 var sThisVal = (this.checked ? $(this).val() : "");
        		 if(sThisVal){
        		 	if(allcheckids==''){
        		 		allcheckids = sThisVal;
        		 	}
        		 	else {
        		 		allcheckids = allcheckids +','+ sThisVal;
        		 	}            		 	
        		 }
		    });
        	var fullurl = url+'?getiNotificationId='+allcheckids;
        	window.location.href=fullurl;
        }
}


                
            


    
