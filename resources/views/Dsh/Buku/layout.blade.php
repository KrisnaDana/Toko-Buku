@extends('layouts.adm_panel')

@section('title', 'Toko Buku | Master')

@section('body')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Tables Buku</h6>
    </div>
    <div class="mt-1 ml-4">
        <a type="button" class="btn btn-primary" href={{ route('adm-buku-add') }}>Add</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Book Rate</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $buku)
                    <tr>
                        <th scope="row">{{ $loop->index+1+($data->currentPage()-1)*5 }}</th>
                        <td>{{ $buku->book_name }}</td>
                        <td>{{number_format($buku->price) }}</td>
                        <td>{{ $buku->description }}</td>
                        <td>{{ $buku->book_rate }}</td>
                        <td>{{ $buku->stock }}</td>
                        <td>{{ $buku->weight }} kg</td>
                        <td>
                            <div class="btn-group " role="group">
                                @csrf
                                <a type="button" class="btn btn-warning" href="{{ route('adm-buku-edit',$buku->id) }}">Edit</a>
                            </div>
                            <form action="{{ route('adm-buku-delete',$buku->id) }}" method="post" class="d-inline" onsubmit="return confirm('apakah kamu ingin menghapus buku ini ?')">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 text-center">
                Showing
                {{ $data->firstItem() }}
                To
                {{ $data->lastItem() }}
                Of
                {{ $data->total() }}
            </div>
            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@endsection