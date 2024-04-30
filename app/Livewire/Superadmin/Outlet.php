<?php

namespace App\Livewire\Superadmin;

use App\Imports\OutletsImport;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Outlet as ModelsOutlet;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Outlet extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;

    protected $outlets;

    public $sortField = 'created_at';
    public $sortAsc = true;

    public $file;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortField = $field;
            $this->sortAsc = true;
        }
    }

    // livewire 3 title
    #[Title('Outlet')]

    public $kode_outlet, $nama_outlet, $nama_pemilik, $alamat_outlet, $telepon_pemilik, $cabang_id;

    public function render()
    {
        return view('livewire.superadmin.outlet',[
            'outlets' => \App\Models\Outlet::where('nama_outlet', 'like', '%'.$this->search.'%')
                    ->orWhere('kode_outlet', 'like', '%'.$this->search.'%')
                    ->orWhere('nama_pemilik', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage)
        ]);
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new OutletsImport, $this->file->getRealPath());

        $this->alert('success', 'Data berhasil diimport');

        return redirect()->back();
    }

    public function download(){
        // download dari /img
        return response()->download(public_path('img/format_import_outlet.xlsx'));
    }
}
