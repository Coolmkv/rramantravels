@extends('layouts.dashboardLayout')
@section('title', 'FAQ')
@section('content')
    <x-content-div heading="FAQ">
        <x-card-element header="Add FAQ">
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" action="javascript:">
                <x-input type="hidden" name="id" id="id" value=""></x-input>
                <x-input type="hidden" name="action" id="action" value="insert"></x-input>


            <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="faq_question"
                    placeholder="Please Write Question" label="FAQ Name" name="faq_question"
                     ></x-text-area-with-label>

            <x-text-area-with-label div_class="col-md-12 col-sm-12 mb-3" id="faq_answer"
                    placeholder="Please Write Answer" label="FAQ Details" name="faq_answer"
                     ></x-text-area-with-label>

                <x-form-buttons></x-form-buttons>
            </x-form-element>

        </x-card-element>

        <x-card-element header="FAQ Data">
            <x-data-table>

            </x-data-table>
        </x-card-element>
    </x-content-div>
@endsection

@section('script')

    <script type="text/javascript">
        $('#faq_question').summernote({
            placeholder: 'Please Write Question',
            tabsize: 2,
            height: 100
        });
        $('#faq_answer').summernote({
            placeholder: 'Please Write Answer',
            tabsize: 2,
            height: 100
        });
        let site_url = '{{ url('/') }}';
        let table = "";
        $(function() {
             table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                ajax: {
                    url: "{{ route('homeFaq.data') }}",
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
                        data: 'id',
                        name: 'id',
                        title: 'Id',
                        visible: false
                    },
                    {
                        data: 'faq_question',
                        name: 'faq_question',
                        title: 'Question'
                    },
                    {
                        data: 'faq_answer',
                        name: 'faq_answer',
                        title: 'Answer'
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
            $.ajax({
                type: 'GET',
                url: "{{ route('homeFaqDataBy.id') }}",
                data: {
                    id: $(this).data("row_id"),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                     if (response.status) {
                        let row = response.data;
                        $("#id").val(row['id']);
                        $("#faq_question").val(row['faq_question']);
                        // $("#p_img").val(row['p_img']);
                        $("#faq_answer").val(row['faq_answer']);
                        $('#faq_answer').summernote('destroy');
                        $('#faq_answer').summernote({
                            focus: true
                        });
                        $('#faq_question').summernote('destroy');
                        $('#faq_question').summernote({
                            focus: true
                        });

                         $("#action").val("update");

                scrollToDiv();
                    } else {
                        errorMessage(response.message);
                    }
                },
                failure: function(response) {
                    errorMessage(response.message);
                }
            });


        });

        function DeleteData(id){
             Swal.fire({
                    title: 'Are you sure?',
                    text: "This item will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, deleted it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                          if(id !== null & id !== undefined){
                           $.ajax({
                            type:'GET',
                             url:"{{ route('homeFaq.delete') }}",
                              data:{
                                id:id,
                                '_token': '{{ csrf_token() }}'
                              },
                              success: function(response){
                                if(response !== null && response !== undefined){
                                    //  console.log(response);
                                    window.location.reload();
                                }
                              }
                           })
                          }
                    }
                })
        }


    


        $(document).ready(function() {
            $("#submitForm").on("submit", function() {
                var form = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('homeFaq.save.master') }}",
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
