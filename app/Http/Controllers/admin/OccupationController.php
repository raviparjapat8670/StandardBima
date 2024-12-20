<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\occupation\CreateOccupationRequest;
use App\Http\Requests\admin\occupation\EditOccupationRequest;
use App\Http\Requests\admin\occupation\GetOccupationRequest;
use App\Models\Occupation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\admin\OccupationService;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;  // Add this import
use Illuminate\Support\Facades\Crypt;

class OccupationController extends Controller
{

    protected $OccupationService;

    public function __construct(OccupationService $OccupationService)
    {
        $this->OccupationService = $OccupationService;
    }
    public function index(GetOccupationRequest $request)
    {

        $validated = $request->validated();
        // Retrieve the list of users from the UserService
        $occupations = $this->OccupationService->getOccupations($validated);

        return view('admin.occupations.index', compact('occupations'));
    }
    public function CreateOccupation(CreateOccupationRequest $request)
    {
        if ($request->isMethod('get')) {
            // For GET request: Show the form
            return view('admin.occupations.create');  // This is your form view
        }
        // Use the CreateUserRequest only for POST requests
        $validated = $request->validated(); // Manually validate on POST request
        // Retrieve the cretaed of user from the UserService
        $occupation = $this->OccupationService->CreateOccupation($validated);

        if ($occupation) {
            session()->flash('success', 'Occupation has been created successfully.');
            return redirect()->route('admin.occupations');
        }

        session()->flash('error', 'Sorry something went wrong! Please try again later.');
        return redirect()->route('admin.occupations');
    }

    // Show Occupation details or edit the Occupation
    public function EditOccupation(EditOccupationRequest $request, $id)
    {
        if (empty($id))
            return redirect()->route('admin.occupations');

        $id = Crypt::decrypt($id);

        if ($request->isMethod('get')) {
            // Decrypt the ID

            $occupation = $this->OccupationService->getOccupationById($id); // Get the user or throw 404 if not found
            // If the request is GET, display the user details with the edit form
            return view('admin.occupations.edit', compact('occupation'));
        }

        // If the request is POST, update the user details
        $validated = $id; // Manually validate on POST request
        // Update the user

        $validated['id'] = $request->input('id');
        // Retrieve the edit of user from the UserService
        $occupation = $this->OccupationService->EditOccupation($validated);
        if ($occupation) {
            // Redirect back to the user details page with a success message
            session()->flash('success', 'Occupation details updated successfully.');
            return redirect()->route('admin.occupations');
        }
        // Redirect back to the user details page with a error message
        session()->flash('error', 'Sorry something went wrong! Please try again later.');
        return redirect()->route('admin.occupations');
    }
}
