<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Link;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LinkController extends Controller
{
    private $postFields = ['url', 'target', 'title'];
    private $putFields = ['url', 'target', 'title'];
    private $allowedFilters = ['id', 'url', 'target', 'title'];

    /**
     * @SWG\Get(
     *   path="/links",
     *   summary="Find links",
     *   @SWG\Response(
     *     response=200,
     *     description="A list of links"
     *   ),
     *   @SWG\Parameter(
     *     name="_page",
     *     description="Skip to page",
     *     type="integer",
     *     in="query"
     *   ),
     *   @SWG\Parameter(
     *     name="_perPage",
     *     description="Limit results per page",
     *     type="integer",
     *     in="query"
     *   ),
     *   @SWG\Parameter(
     *     name="_sortDir",
     *     description="Sort direction",
     *     type="string",
     *     in="query",
     *     enum="[ASC, DESC]"
     *   ),
     *   @SWG\Parameter(
     *     name="_sortField",
     *     description="Field to order results by",
     *     type="string",
     *     in="query"
     *   ),
     *   @SWG\Parameter(
     *     name="_filter",
     *     description="Filter results by JSON",
     *     type="string",
     *     in="query"
     *   )
     * )
     */
    public function index()
    {
        $model = new Link();

        return $this->findAll($model);
    }

    /**
     * @SWG\Post(
     *   path="/links",
     *   summary="Add a new link",
     *   @SWG\Response(
     *     response=200,
     *     description=""
     *   ),
     *   @SWG\Parameter(
     *     name="body",
     *     description="",
     *     in="body",
     *     schema=""
     *   )
     * )
     */
    public function store(Request $request)
    {
        $body = $request->json()->all(); // JSON Request Body
        $body = (object)$body;
        $model = new Link; // Create an instance of our Eloquent Model

        if (isset($model::$rules)) {
            $this->validate($request, $model::$rules);
        }

        foreach ($this->postFields as $field) {
            $model->$field = @$body->$field;
        }

        if ($model->save()) {
            $model = Link::findOrFail($model->id);
            return response()->json($model);
        }

        App::abort(500, 'Unable to save record');
    }

    /**
     * @SWG\Get(
     *   path="/links/{linkId}",
     *   summary="Find link by ID",
     *   @SWG\Response(
     *     response=200,
     *     description=""
     *   ),
     *   @SWG\Parameter(
     *     name="linkId",
     *     description="ID of Link to return",
     *     type="integer",
     *     in="path"
     *   )
     * )
     */
    public function show($id)
    {
        $model = Link::findOrFail($id);

        return response()->json($model);
    }

    /**
     * @SWG\Put(
     *   path="/links/{linkId}",
     *   summary="Search links by query",
     *   @SWG\Response(
     *     response=200,
     *     description=""
     *   ),
     *   @SWG\Parameter(
     *     name="characterId",
     *     description="ID of link to update",
     *     type="integer",
     *     in="path"
     *   )
     * )
     */
    public function update(Request $request, $id)
    {
        $body = $request->json()->all(); // JSON Request Body

        $body = (object)$body;

        $model = Link::findOrFail($id);

        foreach ($this->putFields as $field) {
            if (isset($body->$field)) {
                $model->$field = @$body->$field;
                if (isset($model::$rules) && array_key_exists($field, $model::$rules)) {
                    $this->validate($request, [$field => $model::$rules[$field]]);
                }
            }
        }

        if ($model->save()) {
            return response()->json($model);
        }

        App::abort(500, 'Unable to save record');
    }

    /**
     * @SWG\Delete(
     *   path="/links/{linkId}",
     *   summary="Delete a link",
     *   @SWG\Response(
     *     response=200,
     *     description=""
     *   ),
     *   @SWG\Parameter(
     *     name="linkId",
     *     description="ID of link to return",
     *     type="integer",
     *     in="path"
     *   )
     * )
     */
    public function destroy($id)
    {
        $model = Link::findOrFail($id);
        $model->delete();

        return response()->json(['success' => true]);
    }

    private function findAll($data, $params = null)
    {
        // Request Query String

        $queryPerPage = Input::get('_perPage');
        $querySortDir = Input::get('_sortDir');
        $querySortField = Input::get('_sortField');
        $queryPage = Input::get('_page');
        $queryFilters = json_decode(Input::get('_filters'));

        // Initiate Filter Vars
        $perPage = $queryPerPage ? intval($queryPerPage) : 30;
        $page = $queryPage ? intval($queryPage) : 1;
        $skip = ($page - 1) * $perPage;

        if (isset($querySortDir) && isset($querySortField)) {
            $data = $data->orderBy($querySortField, $querySortDir); // Add sorting to our Query Builder
        }

        if ($queryFilters) {
            foreach ($queryFilters as $key => $value) {
                if (in_array($key, $this->allowedFilters)) {
                    $data = $data->where($key, $value);
                }
            }
        }
        $count = $data->count(); // Get Query Count

        $data = $data->skip($skip)->take($perPage);
        $contentRange = ($skip + $perPage) > $count ? $count : ($skip + $perPage);

        $data = $data->get();

        return response()->json($data)
            ->header('X-Per-Page', $perPage)
            ->header('X-Current-Page', $page)
            ->header('X-Total-Pages', ceil($count / $perPage))
            ->header('X-Total-Count', $count)
            ->header('Content-Range', 'entities '.($skip + 1).'-'.$contentRange.'/'.$count);

    }

}
