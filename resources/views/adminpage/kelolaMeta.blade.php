@extends('adminpage.dashboard_layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="row" style="margin:20px">
                            <div class="col">
                                <div class="ms-md-auto pe-md-3 d-flex align-items-right">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" style="width: 200px;"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fa fa-plus "></i>
                                        Tambah Data</button>
                                </div>
                            </div>

                            <div class="col col-lg-2">
                                    <form class="input-group" action="/kelolaMetaland" method="get">
                                        @csrf
                                        <span class="input-group-text text-body search" style="z-index:0"><i
                                                class="fas fa-search" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" placeholder="Type here..."
                                            name="search_me">
                                        <input type="submit" hidden />
                                    </form>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Metaverse Land</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="inputMetaland" action="/inputMetaland" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="owner_land">Title Land</label>
                                                <input type="text" class="form-control" id="owner_land" name="owner_land"
                                                    placeholder="#Owner Landmark" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name_land">Title Land</label>
                                                <input type="text" class="form-control" id="name_land" name="name_land"
                                                    placeholder="#Adventure Landmark" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="desc_land">Description Land</label>
                                                <textarea class="form-control" id="desc_land" name="desc_land" placeholder="#Lets Adventure Begin" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="url_land">URL Land</label>
                                                <input type="text" class="form-control" id="url_land" name="url_land"
                                                    placeholder="#opense.com/xxx" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="price_land">Price Land</label>
                                                <input type="text" class="form-control" id="price_land" name="price_land"
                                                    placeholder="#0.2" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="img_land">Picture Land</label>
                                                <input type="file" class="form-control" id="img_land" name="img_land"
                                                    placeholder="#no image selected" required>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button class="btn bg-gradient-primary" onclick="$('#inputMetaland').submit()">Tambah Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Update -->
                        <div class="modal fade" id="exampleModal_update" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Metaverse Land</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="updateMetaland" method="POST" action="/updateMetaland"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" class="form-control" id="id" name="id">
                                            <div class="form-group">
                                                <label for="owner">Owner Land</label>
                                                <input type="text" class="form-control" id="owner" name="owner"
                                                    placeholder="#Owner Landmark" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Title Land</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="#Adventure Landmark" style="white-space: pre;" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="desc">Description Land</label>
                                                <textarea class="form-control" id="desc" name="desc" placeholder="#Lets Adventure Begin" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="url">URL Land</label>
                                                <input type="text" class="form-control" id="url" name="url"
                                                    placeholder="#opense.com/xxx" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Price Land</label>
                                                <input type="text" class="form-control" id="price" name="price"
                                                    placeholder="#0.2" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="img">Picture Land</label>
                                                <input type="file" class="form-control" id="img" name="img"
                                                    placeholder="#no image selected" required>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button class="btn bg-gradient-primary"
                                            onclick="$('#updateMetaland').submit()">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 searchable sortable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NFT Land
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Owner</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            price</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($landmark as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset("$item->image") }}"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->title }}</h6>
                                                        <p class="text-xs text-secondary mb-0"
                                                            style="text-overflow:ellipsis;overflow:hidden;white-space:nowrap;max-width:200px;">
                                                            {{ $item->description }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $item->owner }}</h6>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <h6 class="mb-0 text-sm"><i class="fa-brands fa-ethereum"></i>
                                                    {{ '  ' . $item->price }}</h6>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($item->created_at)) }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-warning"
                                                    onclick="get_data({{ $item->id }})"><i
                                                        class="fa-solid fa-file-pen"></i>
                                                    Update Data</button>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="delete_landmark({{ $item->id }})"> <i
                                                        class="fa-solid fa-ban"></i>
                                                    Delete Data</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <form action="/delete_landmark" method="POST" id="delete_it">
                                        @csrf
                                        <input type="hidden" name="id_data" id="id_data" value="{{ isset($item->id) ? $item->id : "" }}">
                                    </form>
                                </tbody>

                            </table>
                        </div>


                        <nav aria-label="Page navigation example" style="margin-top: 20px">
                            <ul class="pagination justify-content-end">
                                <form action="/kelolaMetaland" method="get" id="findpage">
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
                url: "/getData/" + id,
                success: function(data) {

                    if ($.isEmptyObject(data.error)) {
                        // alert(data.data.owner);
                        $('#id').val(id);
                        $('#owner').val(data.data.owner);
                        $('#name').val(data.data.title);
                        $('#desc').val(data.data.description);
                        $('#url').val(data.data.url);
                        $('#price').val(data.data.price);
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
