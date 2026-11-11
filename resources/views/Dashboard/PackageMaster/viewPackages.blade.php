@extends('layouts.dashboardLayout')
@section('title', 'Package Master')
@section('content')
    <x-dashboard-container container_header="Manage Package">
        <x-card>
            <x-card-header>Add Package Master</x-card-header>
            <x-card-body>
                <x-form>
                    <x-input type="hidden" name="id" id="id" value=""></x-input>
                    <x-input type="hidden" name="action" id="action" value="insert"></x-input>

                    <x-input-with-label-element required name="package_name" id="package_name" placeholder="Package Name"
                        label="Package Name"></x-input-with-label-element>

                    <x-input-with-label-element name="package_image[]" id="package_image" type="file"
                        label="Upload Package Image" placeholder="Images" accept="image/*"
                        multiple></x-input-with-label-element>

                    <x-select-label-group required name="package_type" id="package_type" label_text="Package Type">
                        @if (!empty($package_types))
                            @foreach ($package_types as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        @endif
                    </x-select-label-group>

    <div class="col-md-12 col-sm-12 mb-3">
        <label for="destinations" class="form-label">Destinations</label>
        <select class="form-control select2-multiple" name="destinations[]" id="destinations" multiple="multiple" style="width: 100%;">
            @if(!empty($allDestinations))
                @foreach($allDestinations as $dest)
                    <option value="{{ $dest }}">{{ $dest }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
        <label for="activities" class="form-label">Activities</label>
        <select class="form-control select2-multiple" name="activities[]" id="activities" multiple="multiple" style="width: 100%;">
            @if(!empty($allActivities))
                @foreach($allActivities as $activity)
                    <option value="{{ $activity }}">{{ $activity }}</option>
                @endforeach
            @endif
        </select>
    </div>


                    <x-input-with-label-element name="package_country" id="package_country" placeholder="Package Country"
                        label="Package Country"></x-input-with-label-element>

                    {{-- <x-select-label-group required name="package_travel_category" id="package_travel_category" label_text="PPackage Travel Category">
                        @if (!empty($package_travel_categories))
                            @foreach ($package_travel_categories as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        @endif
                </x-select-label-group> --}}

                    <x-input-with-label-element type="number" min="0" name="package_price" id="package_price"
                        placeholder="Package Price" label="Package Price"></x-input-with-label-element>

                    <x-input-with-label-element type="number" min="0" name="package_offer_price"
                        id="package_offer_price" placeholder="Package Offer Price"
                        label="Package Offer Price"></x-input-with-label-element>

                    <x-input-with-label-element type="number" min="0" name="package_duration_days"
                        id="package_duration_days" placeholder="Package Duration Days"
                        label="Package Duration Days"></x-input-with-label-element>

                    <x-input-with-label-element type="number" min="0" name="package_duration_nights"
                        id="package_duration_nights" placeholder="Package Duration Nights"
                        label="Package Duration Nights"></x-input-with-label-element>

                    <x-input-with-label-element type="url" name="package_external_link" id="package_external_link"
                        placeholder="Package External Link" label="Package External Link"></x-input-with-label-element>
                    <x-text-area-with-label id="description" label="Package Description"
                        name="description"></x-text-area-with-label>
                    <x-content-div heading="Included Items">
                        <div id="includedSection">
                            @foreach ($packageData->package_included ?? [''] as $key => $item)
                                <div class="row included-block" id="included-block-{{ $key }}">
                                    <x-input-with-label-element type="text" name="package_included[]"
                                        placeholder="Included Item" label="Included Item"
                                        value="{{ $item }}"></x-input-with-label-element>
                                    <div class="col-md-2 col-sm-12 text-center">
                                        @if ($loop->last)
                                            <x-button type="button" onclick="addNewIncludedBlock()"
                                                class="btn btn-primary btn-icon mt-4">+</x-button>
                                        @else
                                            <x-button type="button"
                                                onclick="removeBlock('included-block-{{ $key }}')"
                                                class="btn btn-danger btn-icon mt-4">-</x-button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-content-div>

                    {{-- Excluded Section --}}
                    <x-content-div heading="Excluded Items">
                        <div id="excludedSection">
                            @foreach ($packageData->package_excluded ?? [''] as $key => $item)
                                <div class="row excluded-block" id="excluded-block-{{ $key }}">
                                    <x-input-with-label-element type="text" name="package_excluded[]"
                                        placeholder="Excluded Item" label="Excluded Item"
                                        value="{{ $item }}"></x-input-with-label-element>
                                    <div class="col-md-2 col-sm-12 text-center">
                                        @if ($loop->last)
                                            <x-button type="button" onclick="addNewExcludedBlock()"
                                                class="btn btn-primary btn-icon mt-4">+</x-button>
                                        @else
                                            <x-button type="button"
                                                onclick="removeBlock('excluded-block-{{ $key }}')"
                                                class="btn btn-danger btn-icon mt-4">-</x-button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-content-div>

                    {{-- Itinerary Section --}}
                    <x-content-div heading="Package Itinerary">
                        <div id="itinerarySection">
                            @foreach ($packageData->itinerary_titles ?? [['title' => '', 'description' => '']] as $key => $item)
                                <div class="row itinerary-block" id="itinerary-block-{{ $key }}">
                                    <x-input-with-label-element type="text" name="itinerary_titles[]"
                                        placeholder="Itinerary Title" label="Itinerary Title"
                                        value="{{ $item['title'] }}"></x-input-with-label-element>
                                    <x-text-area-with-label name="itinerary_descriptions[]"
                                        placeholder="Itinerary Description"
                                        label="Itinerary Description">{{ $item['description'] }}</x-text-area-with-label>
                                    <div class="col-md-2 col-sm-12 text-center">
                                        @if ($loop->last)
                                            <x-button type="button" onclick="addNewItineraryBlock()"
                                                class="btn btn-primary btn-icon mt-4">+</x-button>
                                        @else
                                            <x-button type="button"
                                                onclick="removeBlock('itinerary-block-{{ $key }}')"
                                                class="btn btn-danger btn-icon mt-4">-</x-button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-content-div>

                    <x-content-div heading="Package Itinerary">
                        <div class="row">
                            <x-input-with-label-element type="number" min="0" name="days[]" id="days"
                                placeholder="Package Itinerary Days"
                                label="Package Itinerary Days"></x-input-with-label-element>
                            <x-select-label-group class="form-control cityList" name="city_id[]" id="city_id"
                                label_text="City">
                                @if (!empty($city_master))
                                    @foreach ($city_master as $item)
                                        <option value="{{ $item->id }}">{{ $item->city_name }}</option>
                                    @endforeach
                                @endif
                            </x-select-label-group>
                            <div class="col-md-2 col-sm-12 mb-3 text-center">
                                <x-button type="button" name="insert_div" onclick="insertNewItinary()"
                                    class="btn btn-primary btn-icon mt-4">+</x-button>
                            </div>
                            <div class="col-md-2 col-sm-12 mb-3 text-center">
                                <x-button type="button" name="addCity" onclick="addCityModal()"
                                    class="btn btn-success mt-4">Add City</x-button>
                            </div>

                        </div>
                        <div id="addOnDivs">

                        </div>

                    </x-content-div>
                    <x-input-with-label-element id="meta_keyword" label="Meta Keyword"
                    name="meta_keyword"></x-input-with-label-element>
                    <x-input-with-label-element id="meta_title" label="Meta Title"
                    name="meta_title"></x-input-with-label-element>
                    <x-input-with-label-element id="meta_description" label="Meta Description"
                    name="meta_description"></x-input-with-label-element>
                    <x-form-buttons></x-form-buttons>
                </x-form>
            </x-card-body>
        </x-card>
        <x-card>
            <x-card-header>Packages Data</x-card-header>
            <x-card-body>
                <x-data-table>
                </x-data-table>
            </x-card-body>
        </x-card>
    </x-dashboard-container>
    <x-modal-component id="city_modal" modal_title="Add City">
        <x-form id="addCityForm">
            <div class="row">
                <x-input-with-label-element div_class="col-md-12" type="text" name="city_name" id="city_name_id"
                    placeholder="City Name" label="City Name"></x-input-with-label-element>

            </div>
            <div class="row mt-4">
                <x-form-buttons submit_text="Save City"></x-form-buttons>
            </div>

        </x-form>
    </x-modal-component>
@endsection

@section('script')

    @include('Dashboard.include.dataTablesScript')
    <script type="text/javascript">

$(document).ready(function() {
    // Initialize Select2 for multi-select
    $('.select2-multiple').select2({
        placeholder: "Select options",
        allowClear: true,
        width: 'resolve'
    });

    // Pre-select previously selected values (if editing)
    @if(!empty($packageData))
        let selectedDestinations = @json($packageData->destinations ?? []);
        let selectedActivities = @json($packageData->activities ?? []);
        $('#destinations').val(selectedDestinations).trigger('change');
        $('#activities').val(selectedActivities).trigger('change');
    @endif
});



        $('#description').summernote({
            placeholder: 'Description',
            tabsize: 2,
            height: 100
        });

        function removeItinary(id) {
            $("#" + id).remove();
        }

        function insertNewItinary() {
            let conitnueToMake = true;
            $(".cityList").each(function() {
                if (!$(this).val()) {
                    conitnueToMake = false;
                    errorMessage("Please select city before adding new item.");
                    return false;
                }
            });
            if (cityList.length < $(".cityList").length) {
                conitnueToMake = false;
                errorMessage("All city options are added.");
                return false;
            }
            if (conitnueToMake) {
                let intinary_row_length = $(".intinary_row").length + 1;
                let element = '<div class="row itinary_row" id="itinary_row' + intinary_row_length + '"  >' +
                    '<div class="col-md-4 col-sm-12 mb-3">' +
                    '<label class="form-label" for="days">Package Itinerary Days</label>' +
                    '<input class="form-control" type="number" min="0" name="days[]" id="days' + intinary_row_length +
                    '" placeholder="Package Itinerary Days" >' +
                    '</div>' +
                    '<div class="col-md-4 col-sm-12 mb-3">' +
                    '<label class="form-label" for="city_id">City</label>' +
                    '<select class="form-control cityList" name="city_id[]" id="city_id' + intinary_row_length +
                    '" label_text="City">' + getCityOption() +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-2 col-sm-12 mb-3 text-center">' +
                    '<button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-danger btn-icon mt-4" name="remove_div" onclick="removeItinary(\'itinary_row' +
                    intinary_row_length + '\')">-</button>' +
                    '</div>' +
                    '</div>';
                $("#addOnDivs").append(element);
            }


        }

        function addNewIncludedBlock() {
            const blockId = `included-block-${Date.now()}`;
            const newBlock = `
                <div class="row included-block" id="${blockId}">
                    <x-input-with-label-element type="text" name="package_included[]" placeholder="Included Item" label="Included Item"></x-input-with-label-element>
                    <div class="col-md-2 col-sm-12 text-center">
                        <x-button type="button" onclick="removeBlock('${blockId}')" class="btn btn-danger btn-icon mt-4">-</x-button>
                    </div>
                </div>`;
            document.getElementById('includedSection').insertAdjacentHTML('beforeend', newBlock);
        }

        function addNewExcludedBlock() {
            const blockId = `excluded-block-${Date.now()}`;
            const newBlock = `
                <div class="row excluded-block" id="${blockId}">
                    <x-input-with-label-element type="text" name="package_excluded[]" placeholder="Excluded Item" label="Excluded Item"></x-input-with-label-element>
                    <div class="col-md-2 col-sm-12 text-center">
                        <x-button type="button" onclick="removeBlock('${blockId}')" class="btn btn-danger btn-icon mt-4">-</x-button>
                    </div>
                </div>`;
            document.getElementById('excludedSection').insertAdjacentHTML('beforeend', newBlock);
        }

        function addNewItineraryBlock() {
            const blockId = `itinerary-block-${Date.now()}`;
            const newBlock = `
                <div class="row itinerary-block" id="${blockId}">
                    <x-input-with-label-element type="text" name="itinerary_titles[]" placeholder="Itinerary Title" label="Itinerary Title"></x-input-with-label-element>
                    <x-text-area-with-label name="itinerary_descriptions[]" placeholder="Itinerary Description" label="Itinerary Description"></x-text-area-with-label>
                    <div class="col-md-2 col-sm-12 text-center">
                        <x-button type="button" onclick="removeBlock('${blockId}')" class="btn btn-danger btn-icon mt-4">-</x-button>
                    </div>
                </div>`;
            document.getElementById('itinerarySection').insertAdjacentHTML('beforeend', newBlock);
        }

        function removeBlock(blockId) {
            document.getElementById(blockId).remove();
        }
        let site_url = '{{ url('/') }}';

        function addCityModal() {
            $("#city_modal").modal("show");
        }
        // $(function() {
        //     table = $('.data-table').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         "scrollX": true,
        //         ajax: {
        //             url: "{{ route('packageMasterDataTable') }}",
        //             type: 'POST',
        //             data: {
        //                 '_token': '{{ csrf_token() }}'
        //             }
        //         },
        //         columns: [{
        //                 data: "DT_RowIndex",
        //                 orderable: false,
        //                 searchable: false,
        //                 title: "Sr.No."
        //             },
        //             {
        //                 data: 'id',
        //                 name: 'id',
        //                 title: 'Id',
        //                 visible: false
        //             },
        //             {
        //                 data: 'package_name',
        //                 name: 'package_name',
        //                 title: 'Package Name'
        //             },
        //             {
        //                 data: 'package_image',
        //                 name:'package_image',
        //                 orderable: false,
        //                 searchable: false,
        //                 title: "Package Image"
        //             },
        //             {
        //                 data: 'package_type',
        //                 name: 'package_type',
        //                 title: 'Package Type'
        //             },
        //             {
        //                 data: 'package_country',
        //                 name: 'package_country',
        //                 title: 'Package country'
        //             },
        //             {
        //                 data: 'package_price',
        //                 name: 'package_price',
        //                 title: 'Package Price'
        //             },
        //             {
        //                 data: 'package_offer_price',
        //                 name: 'package_offer_price',
        //                 title: 'Package Offer Price'
        //             },
        //             {
        //                 data: 'package_duration_days',
        //                 name: 'package_duration_days',
        //                 title: 'Package Duration Days'
        //             },
        //             {
        //                 data: 'package_duration_nights',
        //                 name: 'package_duration_nights',
        //                 title: 'Package Duration Nights'
        //             },
        //             {
        //                 data: 'package_external_link',
        //                 name: 'package_external_link',
        //                 title: 'Package External Link'
        //             },
        //             {
        //                 data: 'description',
        //                 name: 'description',
        //                 title: 'Package Description'
        //             },
        //             {
        //                 data: 'package_included',
        //                 name: 'package_included',
        //                 title: 'Included Items'
        //             },
        //             {
        //                 data: 'package_excluded',
        //                 name: 'package_excluded',
        //                 title: 'Excluded Items'
        //             },
        //             {
        //                 data: 'itinerary_titles',
        //                 name: 'itinerary_titles',
        //                 orderable: false,
        //                 searchable: false,
        //                 title: 'Itinerary Titles'
        //             },
        //             {
        //                 data: 'itinerary_descriptions',
        //                 name: 'itinerary_descriptions',
        //                 orderable: false,
        //                 searchable: false,
        //                 title: 'Itinerary Descriptions'
        //             },
        //             {
        //                 data: 'itinerary_details',
        //                 name: 'itinerary_details',
        //                 orderable: false,
        //                 searchable: false,
        //                 title: 'Itinerary Details'
        //             },
        //             {
        //                 data: 'action',
        //                 name: 'action',
        //                 orderable: false,
        //                 searchable: false,
        //                 title: 'Action'
        //             },
        //         ],
        //         order: [
        //             [1, "desc"]
        //         ]
        //     });

        //     });
        $(function() {
            $('.data-table').DataTable({
                processing: true, // Show a processing indicator
                serverSide: true, // Enable server-side processing
                scrollX: true, // Enable horizontal scrolling if needed
                ajax: {
                    url: "{{ route('packageMasterDataTable') }}", // Laravel route for data
                    type: "POST", // Use POST method
                    data: {
                        _token: "{{ csrf_token() }}" // CSRF token
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText); // Log AJAX errors
                        alert("Error loading data. Check the console for details.");
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        title: "Sr. No."
                    },
                    {
                        data: 'package_name',
                        name: 'package_name',
                        title: 'Package Name'
                    },
                    {
                        data: 'package_image',
                        name: 'package_image',
                        orderable: false,
                        searchable: false,
                        title: 'Package Image'
                    },
                    {
                        data: 'package_type',
                        name: 'package_type',
                        title: 'Package Type'
                    },
                    {
                        data: 'package_country',
                        name: 'package_country',
                        title: 'Package Country'
                    },
                    {
                        data: 'package_price',
                        name: 'package_price',
                        title: 'Package Price'
                    },
                    {
                        data: 'package_offer_price',
                        name: 'package_offer_price',
                        title: 'Offer Price'
                    },
                    {
                        data: 'package_duration_days',
                        name: 'package_duration_days',
                        title: 'Duration Days'
                    },
                    {
                        data: 'package_duration_nights',
                        name: 'package_duration_nights',
                        title: 'Duration Nights'
                    },
                    {
                        data: 'package_external_link',
                        name: 'package_external_link',
                        title: 'External Link'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        title: 'Description'
                    },
                    {
                        data: 'package_included',
                        name: 'package_included',
                        title: 'Included Items'
                    },
                    {
                        data: 'package_excluded',
                        name: 'package_excluded',
                        title: 'Excluded Items'
                    },
                    {
                        data: 'itinerary_titles',
                        name: 'itinerary_titles',
                        orderable: false,
                        searchable: false,
                        title: 'Itinerary Titles'
                    },
                    {
                        data: 'itinerary_descriptions',
                        name: 'itinerary_descriptions',
                        orderable: false,
                        searchable: false,
                        title: 'Itinerary Descriptions'
                    },
                    {
                        data: 'meta_keyword',
                        name: 'meta_keyword',
                        title: 'Meta Keyword'
                    },
                    {
                        data: 'meta_title',
                        name: 'meta_title',
                        title: 'Meta Title'
                    },
                    {
                        data: 'meta_description',
                        name: 'meta_description',
                        title: 'Meta Description'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        title: 'Actions'
                    }
                ],
                order: [
                    [1, "desc"]
                ]
            });

            // Enable DataTables error logging
            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                console.error("DataTables Error:", message);
                alert("An error occurred while processing the table.");
            };
        });


        function CityMasterOptionsUpdate(data, returnOption = false, remove_selected = false) {
            let options = '<option value="">Select</option>';
            if (data.length) {
                data.forEach(element => {
                    let found = 0;
                    if (remove_selected) {
                        $(".cityList").each(function() {
                            if ($(this).val() == element.id) {
                                found = 1;
                            }
                        });
                    }

                    if (found == 0) {
                        options += '<option value="' + element.id + '">' + element.city_name + '</option>';
                    }

                });
            }
            if (returnOption) {
                return options;
            }
            $(".cityList").each(function() {
                let val = $(this).val();
                $(this).html(options).val(val).select2();
            });

        }
        $(document).ready(function() {
            $("#addCityForm").on("submit", function() {
                var form = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('add-city') }}',
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            successMessage(response.message);
                            $("#city_modal").modal("hide");
                            cityList = response.data;
                            CityMasterOptionsUpdate(response.data);
                        } else {
                            errorMessage(response.message);
                        }
                    },
                    failure: function(response) {
                        errorMessage(response.message);
                    }
                });
            });
            $("#submit_form").on("submit", function() {
                var form = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('packageMaster.store') }}',
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            successMessage(response.message, true);

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

        function enableDisable(id, action) {
            if (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: (action == "disable" ? "This item will be disabled!" : "This item will be enabled!"),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, ' + action + ' it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('enableDisablePackage') }}',
                            data: {
                                id: id,
                                action: action,
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    successMessage(response.message);
                                    table.ajax.reload()
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
        let cityList = $.parseJSON(`{!! json_encode($city_master) !!}`);

        function getCityOption() {
            return CityMasterOptionsUpdate(cityList, true, true)
        }

        function Disable(id) {
            enableDisable(id, "disable");
        }

        function Enable(id) {
            enableDisable(id, "enable")
        }
    </script>

@endsection
