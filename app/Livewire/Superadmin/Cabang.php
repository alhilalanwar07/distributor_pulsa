<?php

namespace App\Livewire\Superadmin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class Cabang extends Component
{
    // alert
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;

    protected $cabangs;

    public $sortField = 'created_at';
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

    // livewire 3 title
    #[Title('Cabang')]

    public $kode_cabang, $nama_cabang, $cabang_id;

    public function render()
    {
        return view('livewire.superadmin.cabang', [
            'cabangs' => \App\Models\Cabang::where('nama_cabang', 'like', '%'.$this->search.'%')
                    ->orWhere('kode_cabang', 'like', '%'.$this->search.'%')
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage)
        ]);
    }

    public function store()
    {
        $this->validate([
            'kode_cabang' => 'required|unique:cabangs',
            'nama_cabang' => 'required',
        ],[
            'kode_cabang.required' => 'Kode cabang tidak boleh kosong',
            'kode_cabang.unique' => 'Kode cabang sudah ada',
            'nama_cabang.required' => 'Nama cabang tidak boleh kosong',        ]);

        \App\Models\Cabang::create([
            'kode_cabang' => $this->kode_cabang,
            'nama_cabang' => $this->nama_cabang,
        ]);

        $this->reset('kode_cabang', 'nama_cabang');
        // alert
        $this->alert('success', 'Data berhasil disimpan');
    }

    public function edit($id){
        $cabang = \App\Models\Cabang::find($id);
        $this->cabang_id = $cabang->id;
        $this->kode_cabang = $cabang->kode_cabang;
        $this->nama_cabang = $cabang->nama_cabang;
    }

    public function update()
    {
        $this->validate([
            'kode_cabang' => 'required|unique:cabangs,kode_cabang,'.$this->cabang_id,
            'nama_cabang' => 'required',
        ],[
            'kode_cabang.required' => 'Kode cabang tidak boleh kosong',
            'kode_cabang.unique' => 'Kode cabang sudah ada',
            'nama_cabang.required' => 'Nama cabang tidak boleh kosong',
        ]);

        \App\Models\Cabang::find($this->cabang_id)->update([
            'kode_cabang' => $this->kode_cabang,
            'nama_cabang' => $this->nama_cabang,
        ]);

        $this->reset('kode_cabang', 'nama_cabang');
        // alert
        $this->alert('success', 'Data berhasil diperbaharui');
    }

    public function delete($id)
    {
        \App\Models\Cabang::find($id)->delete();
        // alert
        $this->alert('success', 'Data berhasil dihapus');
    }
}
