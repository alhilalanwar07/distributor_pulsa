<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">Cabang</h1>
        {{-- breadcrumb --}}
        <nav aria-label="breadcrumb" class="align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('superadmin.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cabang</li>
            </ol>
        </nav>

    </div>
    <div class="row">

        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Cabang</h6>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus fa-sm text-white-70"></i> Tambah Cabang</a>

                    <!-- Modal -->
                    <div wire:ignore.self class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahLabel">Tambah Cabang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add your form fields here -->
                                    <form wire:submit.prevent="store">
                                        @csrf
                                        <div class="form-group @error('kode_cabang') has-error @enderror">
                                            <label for="kode_cabang">Kode Cabang</label>
                                            <input type="text" wire:model="kode_cabang" class="form-control" id="kode_cabang" placeholder="Kode Cabang">
                                            @error('kode_cabang')
                                            <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('nama_cabang') has-error @enderror">
                                            <label for="nama_cabang">Nama Cabang</label>
                                            <input type="text" wire:model="nama_cabang" class="form-control" id="nama_cabang" placeholder="Nama Cabang">
                                            @error('nama_cabang')
                                            <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- perpage, search --}}
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group
                            @error('perPage') has-error @enderror">
                                {{-- <label for="perPage">Per Page</label> --}}
                                <select wire:model.live="perPage" class="form-control">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                </select>
                                @error('perPage')
                                <span class="help-block
                                    text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group @error('search') has-error @enderror">
                                {{-- <label for="search">Search</label> --}}
                                <input wire:model.live="search" type="text" class="form-control" placeholder="Search...">
                                @error('search')
                                <span class="help-block
                                    text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- end perpage, search --}}
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th wire:click="sortBy('id')" width="5%">ID</th>
                                    <th wire:click="sortBy('kode_cabang')">Kode</th>
                                    <th wire:click="sortBy('nama_cabang')">Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cabangs as $cabang)
                                <tr class="text-center">
                                    <td>{{ $cabang->id }}</td>
                                    <td>{{ $cabang->kode_cabang }}</td>
                                    <td>{{ $cabang->nama_cabang }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="float-left text-muted">
                                Menampilkan {{ $cabangs->firstItem() }} hingga {{ $cabangs->lastItem() }} dari
                                {{ $cabangs->total() }} entries
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                {{ $cabangs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
