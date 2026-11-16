@extends('layouts.dashboardLayout')
@section('title', 'WebSite Elements')
@section('content')

<x-content-div heading="WebSiteElements" >
    <x-card-element header="Add WebSite Element" >
        <x-form-element method="POST" enctype="multipart/form-data"  id="submitForm" action="javascript:" >
            <x-input type="hidden" name="id" id="id" value="" ></x-input>
            <x-input type="hidden" name="action" id="action" value="insert" ></x-input>
                 
            <x-select-with-label id="element_id" name="element" label="Select Element" required="true" >
                @foreach ($titles as $item)
                <option value="{{$item}}">{{$item}}</option>                    
                @endforeach
            </x-select-with-label>
            
            <x-select-with-label id="element_type" name="element_type" label="Select Element Type" required="true" >
                <option value="Text">Text</option>
                <option value="Image">Image</option>
            </x-select-with-label>
            
            <x-input-with-label-element id="element_type_file" label="Upload Element details" name="element_details_image" type="file" accept="image/*"></x-input-with-label-element>
            <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="element_type_text"
                    placeholder="Element details" label="Element details" name="element_details_text"></x-text-area-with-label>
            <x-form-buttons></x-form-buttons> 
        </x-form-element>

    </x-card-element>
    
    <x-card-element header="WebSite Element Data" >
        <x-data-table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Element</th>
                    <th>Element Type</th>
                    <th>Element Details</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </x-data-table>
    </x-card-element>    
</x-content-div>

<div class="modal fade" id="elementDetailsModal" tabindex="-1" aria-labelledby="elementDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="elementDetailsModalLabel">Element Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="elementDetailsImage" class="img-fluid d-none" alt="Element details image">
                <iframe id="elementDetailsEmbed" class="w-100 d-none" height="450" title="Embedded element preview"
                    sandbox="allow-scripts allow-forms allow-presentation" allowfullscreen loading="lazy"
                    referrerpolicy="no-referrer"></iframe>
                <div id="elementDetailsText" class="d-none" style="white-space: pre-wrap; overflow-wrap: anywhere;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
    
    let site_url = '{{ url('/') }}';
    let table="";
        function getEmbedUrl(details, element) {
            const parsedDetails = new DOMParser().parseFromString(details || '', 'text/html');
            const iframeSource = parsedDetails.querySelector('iframe[src]')?.getAttribute('src');
            const text = (parsedDetails.body.textContent || '').trim();
            const candidate = iframeSource || (element === 'Map_link' ? text : '');

            if (!candidate) {
                return null;
            }

            try {
                const url = new URL(candidate, window.location.origin);
                if (!['http:', 'https:'].includes(url.protocol)) {
                    return null;
                }

                const host = url.hostname.toLowerCase();
                const isKnownEmbed = url.pathname.includes('/embed') ||
                    url.pathname.includes('/video/') ||
                    url.searchParams.get('output') === 'embed' ||
                    host === 'youtu.be' ||
                    (host.includes('google.') && url.pathname.includes('/maps'));

                return iframeSource || element === 'Map_link' || isKnownEmbed ? url.href : null;
            } catch (error) {
                if (error instanceof TypeError) {
                    return null;
                }
                throw error;
            }
        }

        $(function() {
            $('#element_type_text').summernote({
                placeholder: 'ElementText',
                tabsize: 2,
                height: 100
            });
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('webSiteElementsData') }}",
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: '{{ \App\Models\WebSiteElements::ID }}',
                        name: '{{ \App\Models\WebSiteElements::ID }}'
                    },
                    {
                        data: '{{ \App\Models\WebSiteElements::ELEMENT }}',
                        name: '{{ \App\Models\WebSiteElements::ELEMENT }}'
                    },
                    {
                        data: '{{ \App\Models\WebSiteElements::ELEMENT_TYPE }}',
                        name: '{{ \App\Models\WebSiteElements::ELEMENT_TYPE }}'
                    },
                    {
                        data: '{{ \App\Models\WebSiteElements::ELEMENT_DETAILS }}',
                        render: function(data, type, row) {
                            if (row.element_type === 'Image') {
                                return '<button type="button" class="view-details btn btn-link btn-sm">View image</button>';
                            }

                            if (getEmbedUrl(data, row.element)) {
                                return '<button type="button" class="view-details btn btn-link btn-sm">View details</button>';
                            }

                            const parsedDetails = new DOMParser().parseFromString(data || '', 'text/html');
                            const text = parsedDetails.body.innerText || parsedDetails.body.textContent || '';
                            const words = text.trim().split(/\s+/).filter(Boolean);

                            if (words.length > 100) {
                                const preview = $('<div>').text(words.slice(0, 100).join(' ') + '...').html();
                                return preview + ' <button type="button" class="view-details btn btn-link btn-sm">View details</button>';
                            }

                            return $('<div>').text(text).html();
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $(document).on('click', '.view-details', function() {
                const row = table.row($(this).closest('tr')).data();
                const isImage = row.element_type === 'Image';
                const embedUrl = !isImage ? getEmbedUrl(row.element_details, row.element) : null;
                $('#elementDetailsModalLabel').text(row.element + ' Details');
                $('#elementDetailsImage').toggleClass('d-none', !isImage);
                $('#elementDetailsEmbed').toggleClass('d-none', isImage || !embedUrl);
                $('#elementDetailsText').toggleClass('d-none', isImage || Boolean(embedUrl));
                $('#elementDetailsEmbed').removeAttr('src');

                if (isImage) {
                    $('#elementDetailsImage').attr('src', site_url + row.element_details);
                } else if (embedUrl) {
                    $('#elementDetailsEmbed').attr('src', embedUrl);
                } else {
                    const parsedDetails = new DOMParser().parseFromString(row.element_details || '', 'text/html');
                    $('#elementDetailsText').text(parsedDetails.body.innerText || parsedDetails.body.textContent || '');
                }

                bootstrap.Modal.getOrCreateInstance(document.getElementById('elementDetailsModal')).show();
            });

            $('#elementDetailsModal').on('hidden.bs.modal', function() {
                $('#elementDetailsEmbed').removeAttr('src');
            });

        });
        $(document).on("click", ".edit", function() {
            let row = $.parseJSON(atob($(this).data("row")));
            if (row['id']) {
                $("#id").val(row['id']);
                $("#element_id").val(row['element']);
                $("#element_type").val(row['element_type']);
                if(row['element_type']=="Text"){
                    $("#element_type_text").val(row['element_details']);                
                }
                $("#action").val("update");
                $('#element_type_text').summernote('destroy');
            $('#element_type_text').summernote({
                focus: true
            });
                scrollToDiv();
            } else {
                errorMessage("Something went wrong. Code 101");
            }
        });
        function Disable(id){
            changeAction(id,"disable","This item will be disabled!","Yes, disable it!");
        }
        function Enable(id){
            changeAction(id,"enable","This item will be enabled!","Yes, enable it!");
        } 
        function changeAction(id,action,text,confirmButtonText) {
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
                            url: '{{ route('saveWebSiteElement') }}',
                            data: {
                                id: id,
                                action: action,
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status) {
                                    successMessage(response.message,true);
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
                    url: '{{ route('saveWebSiteElement') }}',
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response.status){
                            successMessage(response.message,"reload");
                        }else{
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
