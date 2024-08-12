<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\TicketAddress;
use App\Models\TicketFeed;
use App\Models\TicketList;

use App\Models\Company; 
use App\Models\Package;

class TicketController extends Controller
{
    // Ticket

    public function get($id) {
        $ticket = Ticket::where('id', $id)->first();

        if ($ticket) {
            return response()->json([
                'message' => 'Success!',
                'id' => $ticket->id,
                'name' => $ticket->name,
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'Ticket Not Found!',
            ], 404);
        }
    }

    public function get_all($id) {
        $tickets = Ticket::where('company_id', $id)->all();

        if ($tickets) {
            foreach ($tickets as $ticket) {
                return response()->json([
                    'message' => 'Success!',
                    'id' => $ticket->id,
                    'name' => $ticket->name,
                ], 200);
            }
        }

        else {
            return response()->json([
                'message' => 'Tickets Not Found!',
            ], 404);
        }
    }

    public function create(Request $request, $id) {
        $r1 = Ticket::where('name', request('name'))->count();
        $r2 = Ticket::where('desc', request('desc'))->count();

        $limit = Ticket::where('company_id', $id)->count();

        if ($r1 == 1 || $r2 == 1) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            if ($limit == 3) {
                return response()->json([
                    'message' => 'Unavailable!',
                ], 400);
            }

            else {
                $data = [
                    'company_id' => $id,
                    'name' => $request->name,
                    'desc' => $request->desc,
                    'clients_amount' => $request->clients_amount,
                    'kids' => $request->kids,
                    'pets' => $request->pets,
                    'breakfast' => $request->breakfast,
                    'gym' => $request->gym,
                    'pool' => $request->pool,
                    'rooms_amount' => $request->rooms_amount,
                    'price' => $request->price,
                    'status' => 1,
                ];

                Ticket::create($data);

                return response()->json([
                    'message' => 'Success!',
                ], 201);
            }
        }
    }

    public function update(Request $request, $id) {
        $r1 = Ticket::where('name', request('name'))->count();
        $r2 = Ticket::where('desc', request('desc'))->count();

        if ($r1 == 1 || $r2 == 1) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            $data = [
                'name' => $request->name,
                'desc' => $request->desc,
                'clients_amount' => $request->clients_amount,
                'kids' => $request->kids,
                'pets' => $request->pets,
                'breakfast' => $request->breakfast,
                'gym' => $request->gym,
                'pool' => $request->pool,
                'rooms_amount' => $request->rooms_amount,
                'price' => $request->price,
            ];

            Ticket::update($data);
            
            return response()->json([
                'message' => 'Success!',
            ], 201);
        }
    }

    public function delete(Request $request, $id) {
        $data = [
            'status' => 0,
        ];

        Ticket::where('id', $id)->update($data);

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }

    // TicketAddress

    public function get_address($id) {
        $address = TicketAddress::where('ticket_id', $id)->first();

        if ($address) {
            return response()->json([
                'message' => 'Success!',
                'street' => $address->street,
                'number' => $address->number,
                'city' => $address->city,
            ], 200);
        }

        else {
            return response()->json([
                'message' => 'Address Not Found!',
            ], 404);
        }
    }

    public function create_address(Request $request, $id) {
        $data = [
            'ticket_id' => $id,
            'street' => $request->street,
            'number' => $request->number,
            'city' => $request->city,
        ];

        TicketAddress::create($data);

        return response()->json([
            'message' => 'Success!',
        ], 201);
    }

    public function update_address(Request $request, $id) {
        $data = [
            'street' => $request->street,
            'number' => $request->number,
            'city' => $request->city,
        ];

        TicketAddress::where('client_id', $id)->update($data);

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }

    // TicketFeed

    public function get_all_feed($id) {
        $images = TicketFeed::where('ticket_id', $id)->all();

        if ($images) {
            foreach ($images as $image) {
                return response()->json([
                    'message' => 'Success!',
                    'id' => $image->id,
                    'file' => $image->file,
                ], 200);
            }
        }

        else {
            return response()->json([
                'message' => 'Images Not Found!',
            ], 404);
        }
    }

    public function create_feed(Request $request, $id) {
        $limit = TicketFeed::where('ticket_id', $id)->count();

       if ($limit == 3) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            $data = [
                'ticket_id' => $id,
                'file' => $request->file,
            ];

            TicketFeed::create($data);

            return response()->json([
                'message' => 'Success!',
            ], 201);
        }
    }

    public function update_feed(Request $request, $id) {
        $data = [
            'file' => $request->file,
        ];

        TicketFeed::update($data);
        
        return response()->json([
            'message' => 'Success!',
        ], 201);
    }

    public function delete_feed(Request $request, $id) {
        TicketFeed::where('id', $id)->delete();

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }

    // TicketList

    public function get_all_list($id) {
        $list = TicketList::where('package_id', $id)->all();

        if ($list) {
            foreach ($list as $ticket) {
                return response()->json([
                    'message' => 'Success!',
                    'id' => $ticket->id,
                    'ticket_id' => $ticket->ticket_id,
                    'package_id' => $ticket->package_id,
                    'start_date' => $ticket->start_date,
                    'final_date' => $ticket->final_date,
                    'price' => $ticket->price,
                ], 200);
            }
        }

        else {
            return response()->json([
                'message' => 'TicketList Not Found!',
            ], 404);
        }
    }

    public function create_list(Request $request, $id, $id_l) {
        $ticket = Ticket::where('id', $id_l)->first();
        $limit = TicketList::where('package_id', $id)->count();

       if ($limit == 3) {
            return response()->json([
                'message' => 'Unavailable!',
            ], 400);
        }

        else {
            if ($ticket->rooms_amount == 0) {
                return response()->json([
                    'message' => 'No Rooms!',
                ], 400);
            }

            else {
                $data = [
                    'ticket_id' => $id_l,
                    'package_id' => $id,
                    'start_date' => $request->start_date,
                    'final_date' => $request->final_date,
                    'price' => $request->price,
                ];
    
                TicketList::create($data);
    
                return response()->json([
                    'message' => 'Success!',
                ], 201);
            }
        }
    }

    public function delete_list(Request $request, $id) {
        TicketList::where('ticket_id', $id)->delete();

        return response()->json([
            'message' => 'Success!',
        ], 200);
    }
}
