<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class TicketTypeTest extends TestCase
{
    use DatabaseTransactions;

    public function testTicketTypesViewWithLoggedInUser()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-types')
           ->see('Ticket Types');
    }

    public function testCreateNewTicketType()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-types')
           ->see('Create Ticket Type')
           ->type('Random Type', 'type')
           ->press('Add New Ticket Type')
           ->seePageIs('/admin/ticket-types')
           ->see('Successfully created')
           ->seeInDatabase('tickets_types', ['type' => 'Random Type']);
    }

    public function testEditTicketType()
    {
      $user = User::get()->first();

      $this->actingAs($user)
           ->visit('/admin/ticket-types')
           ->see('Create Ticket Type')
           ->type('Random Type', 'type')
           ->press('Add New Ticket Type')
           ->seePageIs('/admin/ticket-types')
           ->see('Successfully created')
           ->seeInDatabase('tickets_types', ['type' => 'Random Type']);

      $ticketType = App\TicketsType::get()->last();

      $this->actingAs($user)
           ->visit('/admin/ticket-types/' . $ticketType->id . '/edit')
           ->see('Random Type')
           ->type('Different Type', 'type')
           ->press('Edit Ticket Type')
           ->seePageIs('/admin/ticket-types')
           ->see('Successfully updated')
           ->seeInDatabase('tickets_types', ['type' => 'Different Type']);
    }
}
