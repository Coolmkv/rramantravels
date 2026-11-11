<script>
    function SubmitFormData(){
        let enquiry_name = $("#enquiry_name").val();
        if(!enquiry_name){
            errorMessage("Full name is required.");
            return false;
        }
        let enquiry_email = $("#enquiry_email").val();
        if(!enquiry_email){
            errorMessage("Email is required.");
            return false;
        }
        let enquiry_mobile = $("#enquiry_mobile").val();
        if(!enquiry_mobile){
            errorMessage("Mobile number is required.");
            return false;
        }
        let services = $("#enquiry_service").val();
        if(!services){
            errorMessage("Services is required.");
            return false;
        }

        let message = $("#enquiry_message").val();
        if(!message){
            errorMessage("Message is required.");
            return false;
        }
        let captcha_enquiry_form = $("#captcha_enquiry_form").val();
        if(!captcha_enquiry_form){
            errorMessage("Captcha is required.");
            return false;
        }
        $("#submitEnquiry").prop("disabled",true);
        $.ajax({
        type: 'POST',
        url: '{{ route("saveEnquiryFormData") }}',
        data: {
        "_token":"{{ csrf_token() }}",
        "name": enquiry_name,
        "email":enquiry_email,
        "phone_number":enquiry_mobile,
        "services":services,
        "message":message,
        "captcha":captcha_enquiry_form
        },
        success: function (response) {
            $("#submitEnquiry").prop("disabled",false);
            if (response.status) {
                successMessage(response.message,true);
            }else{
                refreshCapthca('captcha_img_id_enquiry_form','captcha_enquiry_form');
                errorMessage(response.message);
            }
        },
        failure: function (response) {
            errorMessage(response.message??"Something went wrong.");
            $("#submitEnquiry").prop("disabled",false);
            refreshCapthca('captcha_img_id_enquiry_form','captcha_enquiry_form');
        }
    });
    }
</script>