<?php

namespace App\Http\Controllers;

use App\Http\Requests\Resources\CreateResourceRequest;
use App\Http\Requests\Resources\UpdateResourceRequest;
use App\Models\Item;
use App\Models\Resource;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ResourcesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('resources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateResourceRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateResourceRequest $request) {
        $file = $request->file('file');
        $item = Item::find($request->get('item_id'));

        $success = ($item && $item->user_id == Auth::user()->id) && ($file && $file->isValid());

        if ($success) {
            $fileName = $file->getFilename() . '-' . time() . '.' . $file->getClientOriginalExtension();
            $storagePath = 'uploads/' . Auth::user()->storagePath() . '/' . $item->storagePath();
            $file->move($storagePath, $fileName);

            $success = $item->resources()->save(new Resource([
                'alias' => $file->getClientOriginalName(),
                'name'  => $fileName,
                'path'  => $storagePath,
                'type'  => str_contains($file->getClientMimeType(), 'image') ? Resource::$PRIVATE : Resource::$OTHER
            ]));
        }

        return \Response::json([
            'success' => $success,
            'message' => $success ? 'The resource has been uploaded.' : 'Unable to uploaded the file, please try again.'
        ], $success ? 200 : 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function edit($id) {
        $resource = Resource::find($id);
        if ($resource && $resource->item->user_id == Auth::user()->id) {
            $typeToggle = Resource::where('item_id', $resource->item_id)->where('type', Resource::$PUBLIC)->count() > 1;

            $typeToggle = ($typeToggle && $resource->type == Resource::$PUBLIC) || $resource->type == Resource::$PRIVATE;


            return view('resources.edit', compact('resource', 'typeToggle'));
        } else {
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @param UpdateResourceRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param $UpdateResourceRequest
     */
    public function update(UpdateResourceRequest $request, $id) {
        $resource = Resource::find($id);

        $success = $resource && $resource->item->user_id == Auth::user()->id;

        if ($success) {
            $success = $resource->update([
                'alias' => $request->get('alias'),
                'type'  => $resource->type != Resource::$OTHER && $request->has('type') && $request->get('type') < Resource::$OTHER ? $request->get('type') : $resource->type
            ]);
        }

        return \Response::json([
            'success' => $success,
            'message' => $success ? 'The resource has been updated.' : 'Unable to update the resource.'
        ], $success ? 200 : 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $resource = Resource::with('item')->where('id', $id)->first();
        $publicResources = Resource::where('item_id', $resource->item_id)->where('type', Resource::$PUBLIC);


        $success = $resource && $resource->item->user_id == Auth::user()->id
            && ($resource->type != Resource::$PUBLIC || $publicResources->count() > 1)
            && $resource->delete();

        return \Response::json([
            'success' => $success,
            'message' => $success ? 'The resource has been deleted.' : 'Unable to delete the resource.'
        ], $success ? 200 : 400);
    }
}
