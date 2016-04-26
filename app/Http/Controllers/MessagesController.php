<?php

namespace App\Http\Controllers;

use App\Http\Requests\Messages\CreateMessageRequest;
use App\Models\DeletedMessage;
use App\Models\StolenItem;
use Auth;
use App\Models\Message;

use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessagesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $messages = Message::with('sender', 'recipient', 'regarding.item')->where(function($query) {
            $query->where('sender_id', Auth::user()->id)->orwhere('recipient_id', Auth::user()->id);
        })->whereDoesntHave('deletionRecord', function($query) {
            $query->where('deleted_by', Auth::user()->id);
        })->orderBy('created_at', 'DESC')->get();

        $messages = collect(['sent' => [], 'received' => []])->merge($messages->groupBy(function($message) {
            return $message->sender_id == Auth::user()->id ? 'sent' : 'received';
        }));

        return view('messages.index', ['sent' => $messages['sent'], 'received' => $messages['received']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $item = StolenItem::findOrFail($id);

        if ($item->item->user_id == Auth::user()->id)
            return redirect()->route('messages::index');

        $sender = Auth::user();
        $recipient = $item->item->user;

        return view('messages.create', compact('item', 'sender', 'recipient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function reply($id) {
        $message = Message::findOrFail($id);

        $item = $message->regarding;

        if ($message->sender_id == Auth::user()->id || $item->trashed())
            return redirect()->route('messages::index');

        $sender = Auth::user();
        $recipient = $message->sender;

        return view('messages.reply', compact('message', 'item', 'sender', 'recipient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateMessageRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request, $id) {
        $item = StolenItem::findOrFail($id);

        if ($item->item->user_id == Auth::user()->id)
            return redirect()->route('messages::index');

        $message = new Message([
            'sender_id'     => Auth::user()->id,
            'recipient_id'  => $item->item->user_id,
            'content'       => $request->get('content')
        ]);

        $item->messages()->save($message);

        return redirect()->route('messages::view', [$message->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $message = Message::findOrFail($id);

        if ($message->sender_id != Auth::user()->id && $message->recipient_id != Auth::user()->id) {
            return redirect()->route('messages::index');
        } else if ($message->recipient_id == Auth::user()->id) {
            $message->update(['seen_at' => Carbon::now()]);
        }

        $type = $message->sender_id == Auth::user()->id ? 'sent' : 'received';
        return view('messages.view', compact('message', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateMessageRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMessageRequest $request, $id) {
        $message = Message::findOrFail($id);

        if ($message->sender_id == Auth::user()->id)
            return redirect()->route('messages::index');

        $newMessage = new Message([
            'sender_id'     => Auth::user()->id,
            'recipient_id'  => $message->sender_id,
            'content'       => $request->get('content')
        ]);

        $message->regarding->messages()->save($newMessage);

        return redirect()->route('messages::view', [$newMessage->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $message = Message::find($id);

        $success = $message && ($message->sender_id == Auth::user()->id || $message->recipient_id == Auth::user()->id);

        $record = new DeletedMessage([
            'deleted_by'    => Auth::user()->id
        ]);

        $success = $success && $message->deletionRecord()->save($record);

        if ($request->ajax()) {
            return \Response::json([
                'success' => $success,
                'message' => $success ? 'The message has been deleted.' : 'Unable to delete the message.'
            ], $success ? 200 : 400);
        } else {
            return redirect()->route('messages::index');
        }
    }
}
