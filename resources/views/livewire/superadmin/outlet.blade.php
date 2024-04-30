<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-end mb-2">
        {{-- <h1 class="h3 mb-0 text-gray-800">Outlet</h1> --}}
        {{-- breadcrumb --}}
        <nav aria-label="breadcrumb" class="align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('superadmin.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Outlet</li>
            </ol>
        </nav>

    </div>
    <div class="row">

        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary mr-1">Outlet</h6>
                    <div class="row">
                        <div class="d-sm-flex align-items-center mb-2 gap-2">
                            {{-- <a href="#" class="d-none d-sm-inline btn btn-sm mr-1 btn-success shadow-sm" wire:click="exportExcel" data-toggle="toltipe" title="Export Excel"> <i class="fas fa-file-export fa-sm text-white-70"></i> Excel</a> --}}
                            <a href="#" class="d-none d-sm-inline btn btn-sm mr-1 btn-success shadow-sm" data-toggle="modal" data-target="#modalImport" title="Import Excel"> <i class="fas fa-file-import fa-sm text-white-70"></i> Excel</a>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus fa-sm text-white-70"></i> Tambah Outlet</a>
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
                                <tr class="text-center pointer">
                                    <th wire:click="sortBy('id')" width="5%">ID</th>
                                    <th wire:click="sortBy('kode_outlet')">Kode</th>
                                    <th wire:click="sortBy('cabang_id')">Cabang</th>
                                    <th wire:click="sortBy('nama_outlet')">Nama Outlet</th>
                                    <th wire:click="sortBy('nama_pemilik')">Pemilik / Telp.</th>
                                    <th wire:click="sortBy('alamat_outlet')">Alamat Outlet</th>
                                    <th width="10%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($outlets as $outlet)
                                <tr class="text-center">
                                    <td>{{ $outlet->id }}</td>
                                    <td>{{ $outlet->kode_outlet }}</td>
                                    <td>{{ $outlet->cabang->nama_cabang }}</td>
                                    <td>{{ $outlet->nama_outlet }}</td>
                                    <td>{{ $outlet->nama_pemilik }} / 0{{ $outlet->telepon_pemilik }}</td>
                                    <td>{{ $outlet->alamat_outlet }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info" wire:click="edit({{ $outlet->id }})" data-toggle="modal" data-target="#modalUpdate"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $outlet->id }})"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="float-left text-muted">
                                Menampilkan {{ $outlets->firstItem() }} hingga {{ $outlets->lastItem() }} dari
                                {{ $outlets->total() }} entries
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                {{ $outlets->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <div wire:ignore.self class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel">Update Cabang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your form fields here -->
                    <form wire:submit.prevent="update">
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
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modalImport --}}
    <div wire:ignore.self class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalImportLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImportLabel">Import Excel Outlet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- contoh file download dsni --}}
                    <a href="#" class="btn btn-success btn-block btn-sm mb-2" wire:click='download'>Download Contoh Format Excel</a>
                    <!-- Add your form fields here -->
                    <form wire:submit.prevent="import">
                        @csrf
                        <div class="form-group @error('file') has-error @enderror">
                            <label for="file">File Excel</label>
                            <input type="file" wire:model="file" class="form-control" id="file" placeholder="File Excel">
                            @error('file')
                            <span class="help-block
                                text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
