@extends('adminpage.dashboard_layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">

                <div class="card mb-4">


                    <div class="card-body px-0 pt-0 pb-2">

                        <div class="row" style="margin:20px">

                            <div class="col col-lg-2">
                                <form class="input-group" action="/contactUs_admin" method="get">
                                    @csrf
                                    <span class="input-group-text text-body search" style="z-index:0"><i
                                            class="fas fa-search" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" placeholder="Type here..." name="search_me">
                                    <input type="submit" hidden />
                                </form>
                            </div>
                        </div>


                        <!-- Modal Update -->
                        <div class="modal fade" id="exampleModal_update" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Balas Pesan</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="updateMetaland" method="POST" action="/answereMail"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" class="form-control" id="id" name="id">
                                            <div class="form-group">
                                                <label for="owner">Name</label>
                                                <input type="text" class="form-control" id="owner" name="owner"
                                                    placeholder="#Owner Landmark" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Email</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="#Adventure Landmark" style="white-space: pre;" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="desc">Message</label>
                                                <textarea class="form-control" id="desc" name="desc" placeholder="#Lets Adventure Begin" required></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="desc">Reply Message</label>
                                                <textarea class="form-control" id="reply" name="reply" placeholder="#Lets Adventure Begin" required></textarea>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button class="btn bg-gradient-primary" onclick="$('#updateMetaland').submit()">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 searchable sortable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Message</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Receive at</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mail as $item)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $item->username }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $item->email }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm"
                                                    style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;max-width:200px;">
                                                    {{ $item->message }}</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($item->created_at)) }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="badge badge-sm  {{ $item->status == 1 ? 'bg-gradient-warning' : 'bg-gradient-success' }}">
                                                    {{ $item->status == 2 ? 'Answered' : 'Unanswered' }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-warning"
                                                    onclick="get_data({{ $item->id }})"><i
                                                        class="fa-solid fa-file-pen"></i> Reply Message</button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="delete_landmark({{ $item->id }})"> <i
                                                        class="fa-solid fa-ban"></i> Delete Message</button>
                                                    <button type="button" class="btn btn-primary"
                                                    onclick="print_contacUs({{ $item->id }})"> <i
                                                        class="fa-solid fa-print"></i>Print</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <form action="/contactUs_delete" method="post" id="delete_it">
                                        @csrf
                                        <input type="hidden" name="id_data" id="id_data"
                                            value="">
                                    </form>
                                </tbody>

                            </table>
                            <form action="/contactUs_print" method="get" id="print_it">
                                @csrf
                                <input type="hidden" name="id_data1" id="id_data1"
                                    value="">
                            </form>
                        </div>
                        

                        <nav aria-label="Page navigation example" style="margin-top: 20px">
                            <ul class="pagination justify-content-end">
                                <form action="/contactUs_admin" method="get" id="findpage">
                                    @csrf
                                    <input type="hidden" name="page" id="page">
                                </form>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:{{ $pagin . ' ' . $page_now }};"
                                        onclick="pagination({{ ($page_now == null ? 1 : $page_now) <= 1 ? $page_now : $page_now - 1 }})">
                                        < </a>
                                </li>
                                @for ($i = 1; $i <= $pagin; $i++)
                                    <li class="page-item"><a
                                            class="page-link {{ $i == ($page_now == null ? 1 : $page_now) ? 'active' : '' }}"
                                            href="javascript:;"
                                            onclick="pagination({{ $i }})">{{ $i }}</a></li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="javascript:{{ $pagin . ' ' . $page_now }};"
                                        onclick="pagination({{ $pagin == $page_now ? $page_now : ($page_now == null ? $page_now + 2 : $page_now + 1) }})">
                                        > </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function pagination(params) {
            $('#page').val(params);
            $('#findpage').submit();
        }
        $(document).ready(function() {
            $('#example').DataTable();
        });
        var id_data;

        function get_data(id) {
            id_data = id;
            $('#exampleModal_update').modal('show');
            $.ajax({
                type: 'GET',
                url: "/getData_mail/" + id,
                success: function(data) {

                    if ($.isEmptyObject(data.error)) {
                        // alert(data.data.owner);
                        $('#id').val(id);
                        $('#owner').val(data.data.username);
                        $('#name').val(data.data.email);
                        $('#desc').val(data.data.message);
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        }

        function delete_landmark(id) {
            $('#id_data').val(id);
            $('#delete_it').submit();
        }
        function print_contacUs(params) {
            $('#id_data1').val(params);
            $('#print_it').submit();
        }
        // function update_land() {
        // alert($('#img').val());
        // $('#updateMetaland').submit();
        // // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // $.ajax({
        //     type: 'POST',
        //     url: "/updateMetaland",
        //     data: {
        //         // _token: CSRF_TOKEN,
        //         id: id_data,
        //         owner:$('#owner').val(),
        //         name:$('#name').val(),
        //         desc:$('#desc').val(),
        //         url:$('#url').val(),
        //         price:$('#price').val(),
        //         img:$('#img').val(),
        //     },
        //     success: function(data) {
        //         if ($.isEmptyObject(data.error)) {
        //             alert(id_data);                        
        //             // location.reload();
        //         } else {
        //             alert(data.error);
        //             // printErrorMsg(data.error);
        //         }
        //     }
        // });
        // }
    </script>
@endsection
