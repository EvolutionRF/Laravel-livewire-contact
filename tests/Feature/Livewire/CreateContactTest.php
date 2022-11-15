<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\ContactCreate;
use App\Http\Livewire\CreateContact;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateContactTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(ContactCreate::class);
        $component->assertStatus(200);
    }

    /** @test */
    function can_create_contact()
    {
        $this->actingAs(User::factory()->create());

        $component = Livewire::test(ContactCreate::class);

        $component->set([
            'name' => 'Ahdirmai',
            'phone' => '+72919292'
        ])->call('store');

        $this->assertTrue(Contact::where('name', 'Ahdirmai')->exists());
    }

    /** @test */
    function name_is_required()
    {
        $this->actingAs(User::factory()->create());

        $component = Livewire::test(ContactCreate::class);

        $component->set([
            'name' => '',
            'phone' => '+72912329292'
        ])->call('store')
            ->assertHasErrors(['name' => 'required']);
    }


    /** @test */
    function phone_is_required()
    {
        $this->actingAs(User::factory()->create());

        $component = Livewire::test(ContactCreate::class);

        $component->set([
            'name' => 'Ajsjsjs',
            'phone' => ''
        ])->call('store')
            ->assertHasErrors(['phone' => 'required']);
    }

    /** @test */
    function phone_is_max_lenght_15()
    {
        $this->actingAs(User::factory()->create());

        $component = Livewire::test(ContactCreate::class);

        $component->set([
            'name' => 'Ajsjsjs',
            'phone' => '+12313123123123223'
        ])->call('store')
            ->assertHasErrors(['phone' => 'max:15']);
    }
}
