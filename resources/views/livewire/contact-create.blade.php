<div>
    <form wire:submit.prevent="store">
        <div class="row mb-3">
            <div class="col">
                <label for="" class="form-label">Name</label>
                <input type="text" wire:model="name" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror" placeholder="">
                @error('name')

                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>

                @enderror

            </div>

            <div class="col">
                <label for="" class="form-label">Phone</label>
                <input type="text" wire:model="phone" name="phone" id="phone"
                    class="form-control @error('phone') is-invalid @enderror" placeholder="">

                @error('phone')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <div class="text-end">
                <button class="btn btn-primary btn-sm" type="submit">Submit</button>
            </div>
        </div>
    </form>
    {{-- {{ $name }} --}}

</div>
