<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $statusUpdate = false;
    public $paginate = 5;
    public $search;

    protected $listeners = [
        'contactStored' => 'handleStored',
        'contactUpdated' => 'handledUpdate'
    ];

    protected $queryString = [
        'search'
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }


    public function render()
    {

        $data = [
            'contacts' => $this->search === null ?
                Contact::latest()->paginate($this->paginate) :
                Contact::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)


        ];
        return view('livewire.contact-index', $data);
    }


    public function getContact($id)
    {
        $this->statusUpdate = true;
        $contact = Contact::findOrFail($id);
        $this->emit('getContact', $contact);
    }

    public function destroy($id)
    {
        if ($id) {
            $data = Contact::findOrFail($id);
            $data->delete();
            session()->flash('message', 'Contact was Delete');
        }
    }


    public function handleStored($contact)
    {
        session()->flash('message', 'Contact ' . $contact['name'] . ' Was Stored!');
    }


    public function handledUpdate($contact)
    {
        session()->flash('message', 'Contact ' . $contact['name'] . ' Was Updated!');
    }
}
