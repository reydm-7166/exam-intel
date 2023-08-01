<?php

namespace App\Http\Controllers;
use App\Services\processAPIResponse;
use Inertia\ResponseFactory;
use Illuminate\Http\Request;

class APIProcessorController extends Controller
{
    public function __construct
    (
        protected processAPIResponse $processAPIResponse
    )
    {}
    public function index(): \Inertia\Response|ResponseFactory
    {
        return Inertia('Result/Index');
    }

    public function getAPI(Request $request)
    {
        // get the original response from the api
        $result_original = $this->processAPIResponse->getFrom3rdPartyAPI($request->input('query'));

        // transform the response according to instructions
        $result_transformed = $this->processAPIResponse->transformResponse($result_original);
        return redirect()->route('processor.index')
                        ->with('result_transformed', $result_transformed)
                        ->with('result_original', json_decode($result_original, true));
    }

}
