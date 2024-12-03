<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\documentation\GetDocumentationRequest;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    //
    protected $DocumentationService;
    public function index(GetDocumentationRequest $request)
    {
    
        $validated = $request->validated();
        // Retrieve the list of users from the UserService
        $documentations = $this->DocumentationService->getDocumentations($validated);

        return view('admin.documentation.index', compact('documentations'));
    }
}
