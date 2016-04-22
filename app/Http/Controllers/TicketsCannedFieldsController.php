<?php

namespace App\Http\Controllers;

use App\TicketsCannedField;
use App\TicketsEntry;
use App\TicketsPriority;
use App\TicketsStatus;
use App\TicketsType;
use App\Location;
use App\User;
use App\Ticket;
use Illuminate\Http\Request;

use App\Http\Requests;

class TicketsCannedFieldsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'View Canned Tickets';
    $ticketsCannedFields = TicketsCannedField::all();
    return view('admin.ticket-canned-fields.index', compact('pageTitle', 'ticketsCannedFields'));
  }

  public function create()
  {
    $pageTitle = 'Create New Ticket Canned Fields';
    $ticketsPriorities = TicketsPriority::all();
    $ticketsStatuses = TicketsStatus::all();
    $ticketsTypes = TicketsType::all();
    $locations = Location::all();
    $users = User::all();
    return view('admin.ticket-canned-fields.create', compact('ticketsPriorities', 'ticketsStatuses', 'ticketsTypes', 'locations', 'users', 'pageTitle'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'user_id' => 'required',
      'location_id' => 'required',
      'ticket_status_id' => 'required',
      'ticket_type_id' => 'required',
      'ticket_priority_id' => 'required',
      'subject' => 'required',
      'description' => 'required'
    ]);

    $ticket = new TicketsCannedField();
    $ticket->user_id = $request->user_id;
    $ticket->location_id = $request->location_id;
    $ticket->ticket_status_id = $request->ticket_status_id;
    $ticket->ticket_type_id = $request->ticket_type_id;
    $ticket->ticket_priority_id = $request->ticket_priority_id;
    $ticket->subject = $request->subject;
    $ticket->description = $request->description;

    $ticket->save();

    return redirect('admin/ticket-canned-fields');
  }

  public function canned(Request $request)
  {
    $pageTitle = 'Create New Ticket';
    $ticketsPriorities = TicketsPriority::all();
    $ticketsStatuses = TicketsStatus::all();
    $ticketsTypes = TicketsType::all();
    $locations = Location::all();
    $users = User::all();

    $ticketsCannedField = TicketsCannedField::where('id', $request->subject)->first();

    return view('tickets.create-with-canned-fields', compact('ticketsPriorities', 'ticketsStatuses', 'ticketsTypes', 'locations', 'users', 'ticketsCannedFields', 'ticketsCannedField', 'pageTitle'));
  }

  public function edit(TicketsCannedField $ticketsCannedField)
  {
    $pageTitle = 'Edit Ticket - ' . $ticketsCannedField->subject;
    $ticketsPriorities = TicketsPriority::all();
    $ticketsStatuses = TicketsStatus::all();
    $ticketsTypes = TicketsType::all();
    $locations = Location::all();
    $users = User::all();
    return view('admin.ticket-canned-fields.edit', compact('ticketsCannedField', 'ticketsPriorities', 'ticketsStatuses', 'ticketsTypes', 'locations', 'users', 'pageTitle'));
  }

  public function update(Request $request, TicketsCannedField $ticketsCannedField)
  {
    $this->validate($request, [
      'user_id' => 'required',
      'location_id' => 'required',
      'ticket_status_id' => 'required',
      'ticket_type_id' => 'required',
      'ticket_priority_id' => 'required',
      'subject' => 'required',
      'description' => 'required'
    ]);

    $ticketsCannedField->user_id = $request->user_id;
    $ticketsCannedField->location_id = $request->location_id;
    $ticketsCannedField->ticket_status_id = $request->ticket_status_id;
    $ticketsCannedField->ticket_type_id = $request->ticket_type_id;
    $ticketsCannedField->ticket_priority_id = $request->ticket_priority_id;
    $ticketsCannedField->subject = $request->subject;
    $ticketsCannedField->description = $request->description;

    $ticketsCannedField->update();

    return redirect('admin/ticket-canned-fields');
  }
}
