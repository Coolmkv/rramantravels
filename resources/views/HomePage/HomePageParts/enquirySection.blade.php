<div class="col-md-3">
    <div class="query-form">
        <div class="site-title pb-1">
            <h2 class="text-center">Enquiry</h3>
        </div>
        <div class="query-form-section row">
            <div class="col-md-6 col-sm-6 col-6">
                <div class="form-group">
                    <label for="">Full Name</label>
                    <input placeholder="Full Name" type="text" name="name" id="enquiry_name" class="form-control">
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                <div class="form-group">
                    <label for="">E-mail ID</label>
                    <input placeholder="Email" type="email" name="email" id="enquiry_email" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Mobile No</label>
                    <input placeholder="Phone No" type="tel" name="phone_number" id="enquiry_mobile" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Services</label>
                    <select class="form-control" name="services" id="enquiry_service">
                        <option>Select Services</option>
                        <option>Educational School Tours</option>
                        <option>Leadership and Management Skill Programs</option>
                        <option>Corporate Individual & Group Tours</option>
                        <option>Adventure Tourism</option>
                        <option>Apartment & Villa Vacations</option>
                        <option>Participate in International Conventions</option>
                        <option>International Rail Holidays</option>
                        <option>Individual Family Tours</option>
                        <option>International & Domestic Tours</option>
                        <option>International & Domestic Flight Bookings</option>
                        <option>Visa Assistance</option>
                        <option>Travel Insurance</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Message</label>
                    <textarea placeholder="Message" name="message" class="form-control" id="enquiry_message" rows="3" placeholder="Message"></textarea>
                </div>
            </div>
            <x-input-with-label-element div_class="col-md-12 col-sm-12 mb-3" id="captcha_enquiry_form" type="text" label="Captcha" name="captcha" required placeholder="Captcha"></x-input-with-label-element>
            <div class="row">
                <div class="col-md-8 col-sm-12 text-center">
                    <img  class="img-thumbnail" style="max-width: 150px" src="{{ captcha_src() }}" id="captcha_img_id_enquiry_form">
                    
                </div>
                <div class="col-md-4 col-sm-12 text-center">
                    <button type="button" class="btn btn-icon btn-light"  onclick="refreshCapthca('captcha_img_id_enquiry_form','captcha_enquiry_form')">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="form-group mt-2 text-center">
                    <button type="submit" onclick="SubmitFormData()" id="submitEnquiry" class="btn submit-form">Submit <i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>