<?php

namespace App\Livewire\Superadmin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Cabang extends Component
{
    // alert
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;

    protected $cabangs;

    public $sortField = 'id';
    public $sortAsc = true;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortField = $field;
            $this->sortAsc = true;
        }
    }
    public $kode_cabang, $nama_cabang;

    public function render()
    {
        return view('livewire.superadmin.cabang', [
            'title' => 'Cabang',
            'cabangs' => \App\Models\Cabang::where('nama_cabang', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage)
        ]);
    }

    public function store()
    {
        $this->validate([
            'kode_cabang' => 'required',
            'nama_cabang' => 'required',
        ]);

        \App\Models\Cabang::create([
            'kode_cabang' => $this->kode_cabang,
            'nama_cabang' => $this->nama_cabang,
        ]);

        $this->reset('kode_cabang', 'nama_cabang');
        // alert
        $this->alert('success', 'Data berhasil disimpan');
    }
}
