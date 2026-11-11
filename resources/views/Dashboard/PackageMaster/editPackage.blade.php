@extends('layouts.dashboardLayout')
@section('title', 'Edit Package')
@section('content')
    <x-dashboard-container container_header="Manage Package">
        <x-card>
            <x-card-header>Edit Package</x-card-header>
            <x-card-body>
                <x-form>
                    <x-input type="hidden" name="id" id="id" value="{{ $packageData->id }}"></x-input>
                    <x-input type="hidden" name="action" id="action" value="edit"></x-input>

                    <x-input-with-label-element required name="package_name" id="package_name" placeholder="Package Name"
                        label="Package Name"
                        value="{{ old('package_name', $packageData->package_name) }}"></x-input-with-label-element>

                    {{-- <x-input-with-label-element name="old_image" id="old_image" type="image" src="{{ asset($packageData->package_image) }}"
                        label="Old Image"  ></x-input-with-label-element> --}}
                    <x-input-with-label-element name="old_image" id="old_image" type="image"
                        src="{{ isset($packageData->package_image[0]) ? asset('storage/' . $packageData->package_image[0]) : '' }}"
                        label="Old Image">
                    </x-input-with-label-element>

    <x-select-label-group name="destinations[]" id="destinations" label_text="Destinations" multiple>
    @foreach ($allDestinations as $destination)
        <option value="{{ $destination }}"
            {{ in_array($destination, (array) $packageData->destinations) ? 'selected' : '' }}>
            {{ $destination }}
        </option>
    @endforeach
</x-select-label-group>

<x-select-label-group name="activities[]" id="activities" label_text="Activities" multiple>
    @foreach ($allActivities as $activity)
        <option value="{{ $activity }}"
            {{ in_array($activity, (array) $packageData->activities) ? 'selected' : '' }}>
            {{ $activity }}
        </option>
    @endforeach
</x-select-label-group>



                    <x-text-area-with-label id="description" label="Package Description" name="description">
                        {{ old('description', $packageData->description) }}</x-text-area-with-label>
                    <x-input-with-label-element name="package_image[]" id="package_image" type="file"
                        label="Upload Package Image" placeholder="Images" accept="image/*"
                        multiple></x-input-with-label-element>

                    {{-- <x-input-with-label-element name="package_destination" id="package_destination" placeholder="Package Destination" label="Package Destination" ></x-input-with-label-element> --}}

                    <x-select-label-group required name="package_type" id="package_type" label_text="Package Type">
                        @if (!empty($package_types))
                            @foreach ($package_types as $item)
                                <option {{ old('package_name', $packageData->package_type) == $item ? 'selected' : '' }}
                                    value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        @endif
                    </x-select-label-group>

                    {{-- <x-select-label-group required name="package_travel_category" id="package_travel_category" label_text="Package Travel Category">
                        @if (!empty($package_travel_categories))
                            @foreach ($package_travel_categories as $item)
                                <option {{ old('package_name',$packageData->package_travel_category)==$item?'selected':'' }}value="{{$item}}">{{$item}}</option>
                            @endforeach
                        @endif
                    </x-select-label-group> --}}
                    <x-input-with-label-element name="package_country" id="package_country" placeholder="Package Country"
                        label="Package Country"
                        value="{{ old('package_country', $packageData->package_country) }}"></x-input-with-label-element>

                    <x-input-with-label-element type="number" min="0"
                        value="{{ old('package_price', $packageData->package_price) }}" name="package_price"
                        id="package_price" placeholder="Package Price" label="Package Price"></x-input-with-label-element>

                    <x-input-with-label-element type="number" min="0" name="package_offer_price"
                        value="{{ old('package_offer_price', $packageData->package_offer_price) }}" id="package_offer_price"
                        placeholder="Package Offer Price" label="Package Offer Price"></x-input-with-label-element>

                    <x-input-with-label-element type="number" min="0" name="package_duration_days"
                        value="{{ old('package_duration_days', $packageData->package_duration_days) }}"
                        id="package_duration_days" placeholder="Package Duration Days"
                        label="Package Duration Days"></x-input-with-label-element>

                    <x-input-with-label-element type="number" min="0" name="package_duration_nights"
                        value="{{ old('package_duration_nights', $packageData->package_duration_nights) }}"
                        id="package_duration_nights" placeholder="Package Duration Nights"
                        label="Package Duration Nights"></x-input-with-label-element>

                    <x-input-with-label-element type="url" name="package_external_link"
                        value="{{ old('package_external_link', $packageData->package_external_link) }}"
                        id="package_external_link" placeholder="Package External Link"
                        label="Package External Link"></x-input-with-label-element>

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
                    {{-- <x-content-div heading="Package Itinerary">
                        <div id="itinerarySection">
                            @foreach ($packageData->itinerary_titles ?? [['title' => '', 'description' => '']] as $key => $item)
                                <div class="row itinerary-block" id="itinerary-block-{{ $key }}">
                                    <x-input-with-label-element type="text" name="itinerary_titles[]"
                                        placeholder="Itinerary Title" label="Itinerary Title"
                                        value="{{ $item['title'] ?? '' }}"></x-input-with-label-element>
                                    <x-text-area-with-label name="itinerary_descriptions[]"
                                        placeholder="Itinerary Description"
                                        label="Itinerary Description">{{ $item['description'] ?? '' }}</x-text-area-with-label>

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
                    </x-content-div> --}}
                    <x-content-div heading="Package Itinerary">
                        <div id="itinerarySection">
                            {{-- @php
                                // Check for old input or fallback to packageData
                                $itineraries = old('itinerary_titles') || old('itinerary_descriptions') 
                                    ? array_map(null, old('itinerary_titles', []), old('itinerary_descriptions', [])) 
                                    : ($packageData->itinerary_titles ?? [['title' => '', 'description' => '']]);
                            @endphp --}}
                            @php
                                // Check if there is old input, otherwise fallback to package data
                                $itineraries =
                                    old('itinerary_titles') && old('itinerary_descriptions')
                                        ? array_map(null, old('itinerary_titles'), old('itinerary_descriptions'))
                                        : (!empty($packageData->itinerary_titles) &&
                                        !empty($packageData->itinerary_descriptions)
                                            ? array_map(
                                                null,
                                                $packageData->itinerary_titles,
                                                $packageData->itinerary_descriptions,
                                            )
                                            : [['title' => '', 'description' => '']]);
                            @endphp

                            @foreach ($itineraries as $key => $item)
                                @php
                                    // Ensure title and description are extracted properly
                                    $title = is_array($item) ? $item['title'] ?? ($item[0] ?? '') : $item;
                                    $description = is_array($item) ? $item['description'] ?? ($item[1] ?? '') : '';
                                @endphp

                                <div class="row itinerary-block" id="itinerary-block-{{ $key }}">
                                    <x-input-with-label-element type="text" name="itinerary_titles[]"
                                        placeholder="Itinerary Title" label="Itinerary Title"
                                        value="{{ $title }}">
                                    </x-input-with-label-element>

                                    <x-text-area-with-label name="itinerary_descriptions[]"
                                        placeholder="Itinerary Description" label="Itinerary Description">
                                        {{ $description }}
                                    </x-text-area-with-label>

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
                    name="meta_keyword" value="{{ old('meta_keyword', $packageData->meta_keyword) }}"></x-input-with-label-element>
                    <x-input-with-label-element id="meta_title" label="Meta Title"
                    name="meta_title" value="{{ old('meta_title', $packageData->meta_title) }}"></x-input-with-label-element>
                    <x-input-with-label-element id="meta_description" label="Meta Description"
                    name="meta_description" value="{{ old('meta_description', $packageData->meta_description) }}"></x-input-with-label-element>
                    <x-form-buttons></x-form-buttons>
                </x-form>
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

    $('#destinations').select2({
    placeholder: "Select Destinations",
    width: '100%'
});

$('#activities').select2({
    placeholder: "Select Activities",
    width: '100%'
});
        $('#description').summernote({
            placeholder: 'Description',
            tabsize: 2,
            height: 100
        });
        let itinerary = $.parseJSON(`{!! json_encode($packageData->itinerary) !!}`);
        let days_old = $.parseJSON(`{!! json_encode(old('days', [])) !!}`);
        let city_id_old = $.parseJSON(`{!! json_encode(old('city_id', [])) !!}`);
        $(document).ready(function() {
            if (days_old.length) {
                let element = 0;
                days_old.forEach(day => {
                    if (element == 0) {
                        $("#days").val(day);
                        $("#city_id").val(city_id_old[0]).select2();
                    } else {
                        insertNewItinary(day, city_id_old[element]);
                    }
                    element++;
                });
            } else {
                if (itinerary.length) {
                    let number = 0;
                    itinerary.forEach(element => {
                        if (number == 0) {
                            $("#days").val(element.days);
                            $("#city_id").val(element.city_id);
                        } else {
                            insertNewItinary(element.days, element.city_id);
                        }
                        number++;
                    });
                }
            }
        });

        function removeItinary(id) {
            $("#" + id).remove();
        }

        function insertNewItinary(day_val = '', city_id_val = '') {
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
                    '<input class="form-control" type="number" min="0" name="days[]" value="' + day_val + '" id="days' +
                    intinary_row_length + '" placeholder="Package Itinerary Days" >' +
                    '</div>' +
                    '<div class="col-md-4 col-sm-12 mb-3">' +
                    '<label class="form-label" for="city_id">City</label>' +
                    '<select class="form-control cityList" name="city_id[]" id="city_id' + intinary_row_length +
                    '" label_text="City">' + getCityOption(city_id_val) +
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

        function CityMasterOptionsUpdate(data, returnOption = false, remove_selected = false, city_id_val) {
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
                        options += '<option ' + (city_id_val == element.id ? 'selected' : '') + ' value="' + element
                            .id + '">' + element.city_name + '</option>';
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
                            successMessage(response.message, false,
                                '{{ route('packageMaster.index') }}');

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


        let cityList = $.parseJSON(`{!! json_encode($city_master) !!}`);

        function getCityOption(city_id_val = '') {
            return CityMasterOptionsUpdate(cityList, true, true, city_id_val)
        }
    </script>

@endsection
