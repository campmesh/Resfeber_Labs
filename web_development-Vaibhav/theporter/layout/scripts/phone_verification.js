$(document).ready(function()
{
	$("#enter_number").submit(function(e) 
	{
          e.preventDefault();
          initiateCall();
    });
});

function initiateCall() 
{
	$.post("call.php", { customer_mobile : $("#customer_mobile").val() }, 
    function(data) { showCodeForm(data.verification_code); }, "json");
    checkStatus();
}
function showCodeForm(code) 
{
	$("#verification_code").text(code);
    $("#verify_code").fadeIn();
    $("#enter_number").fadeOut();
}

function checkStatus() 
{
	$.post("status.php", { customer_mobile : $("#customer_mobile").val() }, 
    function(data) { updateStatus(data.status); }, "json");
}

function updateStatus(current) 
{
	if (current === "unverified") 
	{
    	$("#status").append(".");
        setTimeout(checkStatus, 3000);
    }
    else 
	{
          success(); 
    }
}

function success() 
{
	$("#status").text("Verified!");
}