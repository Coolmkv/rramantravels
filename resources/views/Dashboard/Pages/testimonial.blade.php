@extends('layouts.dashboardLayout')
@section('title', 'Testimonials')
@section('content')

    <x-content-div heading="Manage Testimonials">
        <x-card-element header="Add Testimonial">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                <x-input-with-label-element id="image" label="Upload Testimonial Image" name="image" type="file" accept="image/*"></x-input-with-label-element>
                
                {{-- Add the YouTube link input field here --}}
                <x-input-with-label-element id="youtube_link" label="YouTube Video Link (Optional)" name="youtube_link" type="url"></x-input-with-label-element>

                <x-text-area-with-label id="heading_middle" label="Testimonial Text"
                    name="heading_middle"></x-text-area-with-label>

                <x-input-with-label-element id="heading_bottom" label="Testimonial Name"
                    name="heading_bottom"></x-input-with-label-element>

                <x-select-with-label id="slide_status" name="slide_status" label="Select Testimonial Status" required="true">
                    <option value="live">Live</option>
                    <option value="disabled">Disabled</option>
                </x-select-with-label>
                <x-input-with-label-element id="slide_sorting" label="Testimonial Sorting" type="numeric"
                name="slide_sorting"></x-input-with-label-element>

                <x-form-buttons></x-form-buttons>
            </x-form-element>

        </x-card-element>

        <x-card-element header="Testimonials Data">
            <x-data-table>

            </x-data-table>
        </x-card-element>
    </x-content-div>
@endsection

@section('script')
    <script type="text/javascript">
        let site_url = '{{ url('/') }}';
        let table = "";
        $(function() {
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                ajax: {
                    url: "{{ route('testimonialData') }}",
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        title: "Sr.No."
                    },
                    {
                        data: '{{ \App\Models\TestimonialModel::ID }}',
                        name: '{{ \App\Models\TestimonialModel::ID }}',
                        title: 'Id',
                        visible: false
                    },
                    // Add the image column
                    {
                        data: '{{ \App\Models\TestimonialModel::IMAGE }}',
                        name: '{{ \App\Models\TestimonialModel::IMAGE }}',
                        title: 'Image',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (data) {
                                return '<img src="{{ asset('storage') }}/' + data + '" class="img-fluid" style="max-height: 50px;">';
                            }
                            return 'No Image';
                        }
                    },
                    // Add the YouTube link column
                    {
                        data: '{{ \App\Models\TestimonialModel::YOUTUBE_LINK }}',
                        name: '{{ \App\Models\TestimonialModel::YOUTUBE_LINK }}',
                        title: 'YouTube Link',
                        render: function(data, type, row) {
                            if (data) {
                                return '<a href="' + data + '" target="_blank">' + data + '</a>';
                            }
                            return 'N/A';
                        }
                    },
                    {
                        data: '{{ \App\Models\TestimonialModel::HEADING_MIDDLE }}',
                        name: '{{ \App\Models\TestimonialModel::HEADING_MIDDLE }}',
                        title: 'Testimonial Text'
                    },
                    {
                        data: '{{ \App\Models\TestimonialModel::HEADING_BOTTOM }}',
                        name: '{{ \App\Models\TestimonialModel::HEADING_BOTTOM }}',
                        title: 'Testimonial Name'
                    },
                    {
                        data: '{{ \App\Models\TestimonialModel::SLIDE_STATUS }}',
                        name: '{{ \App\Models\TestimonialModel::SLIDE_STATUS }}',
                        title: 'Testimonial Status'
                    },
                    {
                        data: '{{ \App\Models\TestimonialModel::SLIDE_SORTING }}',
                        name: '{{ \App\Models\TestimonialModel::SLIDE_SORTING }}',
                        title: 'Testimonial Sorting'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: 'Action'
                    },
                ],
                order: [
                    [1, "desc"]
                ]
            });

        });
        $(document).on("click", ".edit", function() {
            let row = $.parseJSON(atob($(this).data("row")));
            if (row['id']) {
                $("#id").val(row['id']);
                $("#heading_middle").val(row['heading_middle']);
                $("#heading_bottom").val(row['heading_bottom']);
                $("#youtube_link").val(row['youtube_link']);
                $("#slide_status").val(row['slide_status']);
                $("#slide_sorting").val(row['slide_sorting']);
                $("#action").val("update");
                scrollToDiv();
            } else {
                errorMessage("Something went wrong. Code 101");
            }
        });
 

        function Disable(id) {
            changeAction(id, "disable", "This item will be disabled!", "Yes, disable it!");
        }

        function Enable(id) {
            changeAction(id, "enable", "This item will be enabled!", "Yes, enable it!");
        }

        function changeAction(id, action, text, confirmButtonText) {
            if (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirmButtonText
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('testimonialSaveSlide') }}',
                            data: {
                                id: id,
                                action: action,
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    successMessage(response.message, true);
                                    table.ajax.reload();
                                } else {
                                    errorMessage(response.message);
                                }
                            },
                            failure: function(response) {
                                errorMessage(response.message);
                            }
                        });
                    }
                });
            } else {
                errorMessage("Something went wrong. Code 102");
            }
        }


        $(document).ready(function() {
            $("#submitForm").on("submit", function() {
                var form = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('testimonialSaveSlide') }}',
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            successMessage(response.message, "reload");
                        } else {
                            errorMessage(response.message);
                        }

                    },
                    failure: function(response) {
                        errorMessage(response.message);
                    }
                });
            });
        });
    </script>
    @include('Dashboard.include.dataTablesScript')
    {{-- @include('Dashboard.include.summernoteScript') --}}
@endsection