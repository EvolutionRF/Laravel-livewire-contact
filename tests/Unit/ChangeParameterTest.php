<?php

namespace Tests\Unit;

use App\Http\Livewire\ContactIndex;
use Livewire\Livewire;
use Tests\TestCase;

use App\Http\Livewire\ContactCreate;
use App\Http\Livewire\CreateContact;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;

class ChangeParameterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_change_pagination_parameter()
    {
        $paginate = 10;
        $component = Livewire::test(ContactIndex::class, ['paginate' => $paginate]);

        $this->assertTrue($component->paginate == $paginate);
    }

    public function test_change_search_parameter()
    {
        $search = 'testing';
        $component = Livewire::test(ContactIndex::class, ['search' => $search]);

        $this->assertTrue($component->search == $search);
    }

    public function test_reset_parameter_name_and_phone_after_store()
    {
        $this->actingAs(User::factory()->create());
        $data = [
            'name' => 'testing',
            'phone' => '+62718272'
        ];
        $component = Livewire::test(ContactCreate::class);

        $component->set($data)->call('store');

        $this->assertTrue($component->name == "" && $component->phone == "");
    }
}
