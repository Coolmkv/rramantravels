@extends('layouts.dashboardLayout')

@section('title', 'Destinations')

@section('content')

<x-content-div heading="Manage Destinations">
    <x-card-element header="Add Destinations">
        <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
            <x-input type="hidden" name="id" id="id" value=""></x-input>
            <x-input type="hidden" name="action" id="action" value="insert"></x-input>

            <x-input-with-label-element id="destination_name" label="Destination Name" placeholder="Destination Name" name="destination_name" required></x-input-with-label-element>

            <x-input-with-label-element div_id="destination_image_div" id="destination_image" label="Destination Image" type="file" accept="image/*" placeholder="Destination Image" name="destination_image[]" multiple></x-input-with-label-element>

            <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="destination_details" placeholder="Destination Details" label="Destination Details" name="destination_details" ></x-text-area-with-label>

            <x-input-with-label-element id="meta_keyword" label="Meta Keyword" name="meta_keyword"></x-input-with-label-element>
            <x-input-with-label-element id="meta_title" label="Meta Title" name="meta_title"></x-input-with-label-element>
            <x-input-with-label-element id="meta_description" label="Meta Description" name="meta_description"></x-input-with-label-element>

            <x-input-with-label-element id="sorting_number" label="Sorting Number" type="numeric" minVal="1" placeholder="Sorting Number" name="position" required="true"></x-input-with-label-element>

            {{-- Status Dropdown --}}
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" name="status" id="status" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <x-form-buttons></x-form-buttons>
        </x-form-element>
    </x-card-element>

    <x-card-element header="Destinations Data">
        <x-data-table></x-data-table>
    </x-card-element>
</x-content-div>

@endsection

@section('script')
<script type="text/javascript">
$('#destination_details').summernote({
    placeholder: 'Destination Details',
    tabsize: 2,
    height: 100
});

let site_url = '{{ url('/') }}';
let table = "";

// CSRF setup
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

// Initialize DataTable
$(function() {
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        "scrollX": true,
        ajax: {
            url: "{{ route('DestinationsData') }}",
            type: 'POST',
            data: { '_token': '{{ csrf_token() }}' }
        },
        columns: [
            { data: "DT_RowIndex", orderable: false, searchable: false, title: "Sr.No." },
            { data: '{{ \App\Models\DestinationsModel::ID }}', visible: false, title: 'Id' },
            { data: '{{ \App\Models\DestinationsModel::DESTINATION_NAME }}', title: 'Destination Name' },
            {
                data: '{{ \App\Models\DestinationsModel::DESTINATION_IMAGE }}',
                render: function(data) {
                    return data ?? '';
                },
                orderable: false,
                searchable: false,
                title: "Destination Image"
            },
            { data: '{{ \App\Models\DestinationsModel::DESTINATION_DETAILS }}', title: 'Destination Details' },
            { data: 'position', title: 'Destination Position' },
            { data: 'meta_keyword', title: 'Meta Keyword' },
            { data: 'meta_title', title: 'Meta Title' },
            { data: 'meta_description', title: 'Meta Description' },
            { data: 'action', orderable: false, searchable: false, title: 'Action' },
        ],
        order: [[1, "desc"]]
    });
});

// Edit button click
$(document).on("click", ".edit", function() {
    let row = $.parseJSON(atob($(this).data("row")));
    
    if (row['id']) {
        $("#destination_image_old_div").remove();

        $("#id").val(row['id']);
        $("#destination_name").val(row['destination_name']);
        $("#sorting_number").val(row['position']);

        // Summernote reset
        $('#destination_details').summernote('destroy');
        $("#destination_details").val(row['destination_details']);
        $('#destination_details').summernote({focus: true});

        $("#meta_keyword").val(row['meta_keyword']);
        $("#meta_title").val(row['meta_title']);
        $("#meta_description").val(row['meta_description']);

        // Set status as integer


        // Old images preview
        $("#destination_image_div").parent().append(`
            <div class="col-md-4 col-sm-12 mb-3" id="destination_image_old_div">
                <label class="form-label">Current Destination Image</label>
                <div>${renderImages(row['destination_image'])}</div>
            </div>
        `);

        $("#action").val("update");
        scrollToDiv();
    } else {
        errorMessage("Something went wrong. Code 101");
    }
});

// Render old images
function renderImages(images) {
    let html = '';
    if (images) {
        let imagePaths = JSON.parse(images);
        imagePaths.forEach(image => {
            html += `<img src="${site_url}/storage/${image}" class="img-thumbnail" style="width: 80px; margin-right: 5px;">`;
        });
    }
    return html;
}

// Form submit
$(document).ready(function() {
    $("#submitForm").on("submit", function(e) {
        e.preventDefault();
        var form = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route('saveDestinations') }}',
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
            error: function(xhr) {
                errorMessage("Error: " + xhr.responseText);
            }
        });
    });
});

// Toggle status
$(document).on("click", ".toggle-status", function() {
    let id = $(this).data("id");
    let status = parseInt($(this).data("status")); // ensure integer

    $.ajax({
        url: "{{ route('toggleDestinationStatus') }}",
        type: "POST",
        data: { id: id, status: status, _token: "{{ csrf_token() }}" },
        success: function(response) {
            if (response.status) {
                successMessage(response.message);
                table.ajax.reload(null, false); // reload table without resetting page
            } else {
                errorMessage(response.message);
            }
        },
        error: function(xhr) {
            errorMessage("Error: " + xhr.responseText);
        }
    });
});
</script>

@include('Dashboard.include.dataTablesScript')
@endsection
