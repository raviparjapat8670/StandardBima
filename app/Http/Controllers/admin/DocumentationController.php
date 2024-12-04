<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\documentation\CreateDocumentationRequest;
use App\Http\Requests\admin\documentation\EditDocumentationRequest;
use App\Http\Requests\admin\documentation\GetDocumentationRequest;
use App\Services\admin\DocumentationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DocumentationController extends Controller
{
    //
    protected $DocumentationService;

    public function __construct(DocumentationService $DocumentationService)
    {
        $this->DocumentationService = $DocumentationService;
    }
    public function index(GetDocumentationRequest $request)
    {
    
        $validated = $request->validated();
        // Retrieve the list of users from the UserService
        $documentations = $this->DocumentationService->getDocumentations($validated);

        return view('admin.documentation.index', compact('documentations'));
    }

    public function CreateDocumentation(CreateDocumentationRequest $request)
    {
        if ($request->isMethod('get')) {
            // For GET request: Show the form
            return view('admin.documentation.create');  // This is your form view
        }
        // Use the CreateUserRequest only for POST requests
        $validated = $request->validated(); // Manually validate on POST request
        // Retrieve the cretaed of user from the UserService
        $documentation = $this->DocumentationService->CreateDocumentation($validated);

        if ($documentation) {
            session()->flash('success', 'Documentation has been created successfully.');
            return redirect()->route('admin.documentations');
        }

        session()->flash('error', 'Sorry something went wrong! Please try again later.');
        return redirect()->route('admin.documentations');
    }

    // Show Documentation details or edit the Documentation
    public function EditDocumentation(EditDocumentationRequest $request, $id)
    {

        if (empty($id))
        return redirect()->route('admin.documentations');

        $id = Crypt::decrypt($id);

        if ($request->isMethod('get')) {
            // Decrypt the ID
            $documentation = $this->DocumentationService->getDocumentationById($id); // Get the user or throw 404 if not found
            // If the request is GET, display the user details with the edit form
            return view('admin.documentation.edit', compact('documentation'));
        }

        // If the request is POST, update the user details
        $validated = $request->validated(); // Manually validate on POST request
        // Update the user

        $validated['id'] = $id;
        // Retrieve the edit of user from the UserService
        $documentation = $this->DocumentationService->EditDocumentation($validated);
        if ($documentation) {
            // Redirect back to the user details page with a success message
            session()->flash('success', 'Documentation details updated successfully.');
            return redirect()->route('admin.documentations');
        }
        // Redirect back to the user details page with a error message
        session()->flash('error', 'Sorry something went wrong! Please try again later.');
        return redirect()->route('admin.documentations');
    }
}
