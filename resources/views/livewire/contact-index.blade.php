<div>

    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{session('message')}}
    </div>

    @endif

    @if($statusUpdate)
    <livewire:contact-update></livewire:contact-update>
    @else
    <livewire:contact-create></livewire:contact-create>
    @endif
    <hr>

    <div class="row mb-3">
        <div class="col">
            <select wire:model="paginate" name="" id="" class="form-select form-select-sm w-auto">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>

        <div class="col">
            <input wire:model="search" type="text" class="form-control form-control-sm" placeholder="Search">
        </div>
    </div>
    <table class="table">
        <thead class="table-dark">
            {{-- <caption>Contact List</caption> --}}
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            @foreach ($contacts as $contact )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    <button wire:click="getContact({{ $contact->id }})"
                        class="btn btn-sm btn-info text-white">Edit</button>
                    <button wire:click="destroy({{ $contact->id }})"
                        class="btn btn-sm btn-danger text-white">Delete</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $contacts->links() }}
</div>
