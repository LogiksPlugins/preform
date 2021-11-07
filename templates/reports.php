<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$formConfig['actions'] = [
				"submit"=> [
					"label"=>"Filter",
					//"class"=>"",
					"type"=>"submit",
					"icon"=>"fa fa-search",
				]
			];

echo '<div class="formbox"><div class="formbox-content">';
echo '<form class="form validate1 '.$formConfig['mode'].' '.($formConfig['simpleform']?"simple-form":"").'" method="POST" enctype="multipart/form-data" data-formkey="'.$formConfig["formkey"].'" action="'.$formConfig["form-target"].'">';
echo "<div class='row'>";
echo getFormFieldset($formConfig['fields'],$formData,$formConfig['dbkey'],$formConfig['mode']);
echo "</div>";
echo '<hr class="hr-normal">';
echo '<div class="form-actions form-actions-padding"><div class="text-right">';
echo getFormActions($formConfig['actions'],$formConfig);
echo '</div></div>';
echo '</form></div></div>';
echo "<script>if(typeof initFormUI=='function') initFormUI(); else $(function() {initFormUI();});</script>";
?>
<script>
$(function() {
	$("form.validate1").validate({
		  //debug:true,
		  ignore: ".ignore",
		  errorClass: "error",
		  validClass: "success",
		  //wrapper: "li",
		  //errorContainer: "#messageBox1, #messageBox2",
		  //errorLabelContainer: "#messageBox1 ul",
		  //wrapper: "li",
		  //ignoreTitle: false,
		  //onsubmit: false,
		  //onfocusout: false,
		  //onkeyup: false,
		  //focusCleanup: true,
		  submitHandler: function(form) {
		  	form.submit();
		  },
		  invalidHandler: function(event, validator) {
		  		if(typeof lgksToast=="function") lgksToast("Some required fields are invalid. They have been marked.<br>Please fix them to submit.");
		  		else if(typeof lgksAlert=="function") lgksAlert("Some required fields are invalid. They have been marked.<br>Please fix them to submit.");
		  		else {
		  			alert("Some required fields are invalid. They have been marked.<br>Please fix them to submit.");
		  		}
		  		//console.log(event);
		  		// 'this' refers to the form
			    // var errors = validator.numberOfInvalids();
			    // if (errors) {
			    //   var message = errors == 1
			    //     ? 'You missed 1 field. It has been highlighted'
			    //     : 'You missed ' + errors + ' fields. They have been highlighted';
			    //   $("div.error span").html(message);
			    //   $("div.error").show();
			    // } else {
			    //   $("div.error").hide();
			    // }
		  }
			// ,rules: {
			//     // simple rule, converted to {required:true}
			//     name: "required",
			//     // compound rule
			//     email: {
			//       required: true,
			//       email: true
			//     }
			// }
			// ,messages: {
			//     name: "Please specify your name",
			//     email: {
			//       required: "We need your email address to contact you",
			//       email: "Your email address must be in the format of name@domain.com"
			//     }
			// }
		});
});
</script>