$(document).ready(function()
{
	
	let dialog = $('#dialog-form').dialog({
		autoOpen: false,
		buttons: {
			"Login": function(){
				if    ($("#email").val()=='user' && $("#password").val()=='pass'){
					window.location.href = "file/soal.html";
				}
				else{
					alert("UserName or Password is not correct");
				}
			},
			Cancel: function(){
				dialog.dialog("close");
			}
		},
		close: function(){
			$("form")[0].reset();
		}
	});
	$('.loginButton').on('click', function(btn)
	{
		dialog.dialog('open');
	});
});
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope) {
    $scope.firstname = "John";
    $scope.lastname = "Doe";    
});




















